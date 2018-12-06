<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Project;
use App\Todolist;
use App\Task;

class TodolistsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $project = Project::find($id);

        return view('app.projects.todolists.index' , [
            'title' => 'Listas de Tarefa',
            'project' => $project
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $project = Project::find($id);

        return view('app.project.todolists.create' , [
            'title' => 'Listas de Tarefa',
            'project' => $project
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id) {
        $todolist = Todolist::create([
            'description' => $request->description,
            'deadline' => $request->deadline,
            'priority' => $request->priority,
            'project_id' => $id,
            'status' => 1
        ]);

        foreach ($request->tasks as $task) {
            $new_task = Task::create([
                'description' => $task,
                'status' => 0,
                'todolist_id' => $todolist->id
            ]);
        }

        return response()->json($todolist->load('tasks'));
    }

    public function completeTask(Request $request) {

        $task = Task::find($request->task_id);
        $task->status = 1;
        $task->save();

        $list_finished = false;

        $available_tasks = Task::all()->where('todolist_id', $task->todolist_id)->where('status', 0);

        if (count($available_tasks) == 0) {
            // Definindo Todolist como Concluída
            $todolist = Todolist::find($task->todolist_id);
            $todolist->status = 4;
            $todolist->save();
            $list_finished = true;
        }

        return response()->json([
            'task' => $task,
            'finished' => $list_finished
        ]);
    }

    public function undoTask(Request $request) {
        $task = Task::find($request->task_id);
        $task->status = 0;
        $task->save();

        // Definindo Todolist como Em Andamento
        $todolist = Todolist::find($task->todolist_id);
        $todolist->status = 0;
        $todolist->save();

        return response()->json($task);
    }

    public function deleteTask(Request $request) {

        $task = Task::find($request->task_id);
        $available_tasks = Task::all()->where('todolist_id', $task->todolist_id)->where('status', 0);
        $list_finished = false;

        if (count($available_tasks) == 0) {
            // Definindo Todolist como Concluída
            $todolist = Todolist::find($task->todolist_id);
            $todolist->status = 4;
            $todolist->save();
            $list_finished = true;
        }

        $task->destroy();


        if(count(Todolist::find($task->todolist_id)->tasks) == 0) {
            Todolist::destroy($task->todolist_id);
            return response()->json([
                'list_finished' => $list_finished
            ]);
        }

        return response()->json([
            'checkpoint_ended' => false
        ]);
    }

    public function activateTodolist(Request $request) {

        $project = Todolist::find($request->id)->project;

        foreach($project->todolists()->where('status', 0)->get() as $todolist) {
            $todolist->status = 1;
            $todolist->save();
        }

        $todolist = Todolist::find($request->id);
        $todolist->status = 0;
        $todolist->save();

        return response()->json(true);
    }
}
