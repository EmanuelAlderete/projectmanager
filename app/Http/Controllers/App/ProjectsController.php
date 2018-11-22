<?php

namespace App\Http\Controllers\App;

use App\TypeProject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Project;
use App\Tag;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Auth::user()->projects;

        return view('app.projects.index', [
            'title' => 'Seus Projetos',
            'projects' => $projects
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = TypeProject::all();
        $tags = Tag::all();

        return view('app.projects.create', [
            'title' => 'Começar novo projeto',
            'types' => $types,
            'tags' => $tags
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  dd($request->all());

        $project = Project::create([
            'title' => $request->title,
            'user_id' => Auth::user()->id,
            'description' => $request->description,
            'authors' => $request->authors,
            'type_project_id' => $request->type,
            'deadline' => date('Y-m-d', strtotime($request->deadline)),
            'subject' => $request->subject,
            'teacher_id' => $request->teacher_id
        ]);

        $project->tags()->sync($request->tags);

        return redirect('/projects');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::user()->projects->contains(Project::find($id))) {
            return redirect("/project/" . $id);
        }


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
