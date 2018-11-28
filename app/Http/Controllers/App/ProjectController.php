<?php

namespace App\Http\Controllers\App;

use App\Task;
use App\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Todolist;

class ProjectController extends Controller
{
    public function index($id) {
        $project = Project::find($id);
        if (Auth::user()->projects->contains($project)) {

            $todolist = $project->todolists->where('status', 0);

            return view('app.project.index',[
                'title' => 'Projeto: ' . $project->title,
                'project' => $project
            ]);
        }
    }

    public function completeTask(Request $request) {

        $task = Task::find($request->task_id);
        $task->status = 1;
        $task->save();

        $finished = false;

        $available_tasks = Task::all()->where('todolist_id', $task->todolist_id)->where('status', 0);

        if (count($available_tasks) == 0) {
            $finished = true;
        }

        return response()->json([
            'task' => $task,
            'finished' => $finished
        ]);
    }

    public function undoTask(Request $request) {
        $task = Task::find($request->task_id);
        $task->status = 0;
        $task->save();

        return response()->json($task);
    }

    public function deleteTask(Request $request) {

        $task = Task::find($request->task_id);
        Task::destroy($request->task_id);
        if(count(Todolist::find($task->todolist_id)->tasks) == 0) {

            Todolist::destroy($task->todolist_id);


            return response()->json([
                'checkpoint_ended' => true
            ]);
        }

        return response()->json([
            'checkpoint_ended' => false
        ]);
    }
}
