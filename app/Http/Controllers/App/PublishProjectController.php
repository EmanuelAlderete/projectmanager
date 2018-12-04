<?php

namespace App\Http\Controllers\App;

use App\Tag;
use App\Course;
use App\Project;
use App\Institution;
use App\TypeProject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PublishProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.projectpublish.create', [
            'title' => 'Publicar um Projeto',
            'courses' => Course::all(),
            'institutions' => Institution::all(),
            'types' => TypeProject::all(),
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
        $project = Project::create([
            'title' => $request->title,
            'description' => $request->description,
            'subtitle' => $request->subtitle,
            'authors' => $request->authors,
            'institution_id' => $request->institution,
            'course_id' => $request->course,
            'teacher_name' => $request->teacher,
            'website' => $request->website,
            'type_project_id' => $request->type,
            'user_id' => Auth::user()->id,
            'status' => 5
        ]);

        $name = uniqid(date('HisYmd'));
        $extension = $request->annex->getClientOriginalExtension();
        $nameFile = "{$name}.{$extension}";
        $upload = $request->annex->storeAs('annexes', $nameFile);

        $project->annex = $nameFile;
        $project->save();

        $tags = explode(',', $request->tags);

        foreach ($tags as $tag) {
            if (Tag::all()->where('name', $tag)->count() == 0) {
                $tag = Tag::create(['name' => $tag]);
                if ($request->course != 0) {
                    $tag->courses()->sync($request->course);
                }
            }
            foreach(Tag::all()->where('name', $tag) as $tag) {
                $tag->projects()->attach($project->id);
            }

        }

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
