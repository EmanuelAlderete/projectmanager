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
    public function index($id)
    {
        $project = Project::find($id);
        if (Auth::user()->projects->contains($project)) {
            return view('app.projects.checkpoints.index', [
                'title' => 'Checkpoints',
                'project' => $project
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        $upload = $request->annex->storeAs('projects/project-{$request->project_id}', $nameFile);

        $checkpoint = Checkpoint::create([
            'project_id' => $request->project_id,
            'title' => $request->title,
            'message' => $request->message,
            'status' => $request->status == 1 ? 1 : 0,
            'annex' => $nameFile
        ]);

        foreach($request->todolists as $todolist) {
            $todolist =  Todolist::find($todolist);
            $todolist->checkpoint()->associate($checkpoint);
            $todolist->save();
        }

        return redirect('/checkpoints');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
