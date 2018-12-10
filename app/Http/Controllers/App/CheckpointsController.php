<?php

namespace App\Http\Controllers\App;

use App\Project;
use App\Todolist;
use App\Checkpoint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CheckpointsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id) {
        $project = Project::find($id);
        if (Auth::user()->projects->contains($project) || $project->teacher_id == Auth::user()->id) {
                return view('app.projects.checkpoints.index', [
                    'title' => 'Checkpoints',
                    'project' => $project
                ]);
        } else {
            abort(401);
        }
    }

    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $name = uniqid(date('HisYmd'));
        $extension = $request->annex->getClientOriginalExtension();
        $nameFile = "{$name}.{$extension}";
        $upload = $request->annex->storeAs('projects/project-'.$request->project_id, $nameFile);

        $checkpoint = Checkpoint::create([
            'project_id' => $request->project_id,
            'title' => $request->title,
            'message' => $request->message,
            'status' => 0,
            'annex' => $nameFile
        ]);

        if (Project::find($request->project_id)->teacher_id) {
            if ($request->status) {
                $checkpoint->status = $request->status;
            } else {
                $checkpoint->status = 0;
            }
        } else {
            if ($request->status) {
                $checkpoint->status = 4;
            } else {
                $checkpoint->status = 5;
            }
        }

        $checkpoint->save();

        foreach($request->todolists as $todolist) {
            $todolist =  Todolist::find($todolist);
            $todolist->checkpoint()->associate($checkpoint);
            $todolist->status = 3;
            $todolist->save();
        }

        return redirect('/projects/'.$request->project_id.'/checkpoints');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($project_id, $checkpoint_id) {

        $project = Project::find($project_id);

        if (Auth::user()->teacher == 1 && $project->teacher_id == Auth::user()->id) {

            return view('app.projects.checkpoints.show', [
                'title' => 'Checkpoint: ',
                'project' => $project,
                'checkpoint' => Checkpoint::find($checkpoint_id)
            ]);

        } else {
            abort(401);
        }

    }

    public function documents($project_id) {
        $checkpoints = Checkpoint::all()->where('project_id', $project_id);

        return view('app.projects.checkpoints.documents', [
            'title' => 'Documentos',
            'checkpoints' => $checkpoints
        ]);
    }

}
