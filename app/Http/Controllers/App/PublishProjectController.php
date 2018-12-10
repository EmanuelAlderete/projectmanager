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
    public function index() {
        if (Auth::user()->teacher == 1) {
            $projects = Project::all()->where('status', 5);

            return view('app.projectpublish.index', [
                'title' => 'Aprovar Projetos',
                'projects' => $projects
            ]);
        } else {
            abort(401);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
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
    public function store(Request $request) {
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
            'status' => 5,
            'public_id' => 'project_' . time()
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
                $tag->projects()->sync($project->id);
            }

        }

        return redirect('/projects');
    }

    public function show($id) {
        if (Auth::user()->teacher == 1) {
            $project = Project::find($id);

            return view('app.projectpublish.show', [
                'title' => 'Projeto: '.$project->title,
                'project' => $project
            ]);
        } else {
            abort(401);
        }
    }

    public function response(Request $request) {
        $project = Project::find($request->project_id);
        $project->status = $request->status;
        $project->save();

        return redirect('/publish-project');
    }
}
