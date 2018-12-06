<?php

namespace App\Http\Controllers\App;

use App\Tag;
use App\Project;
use App\TypeProject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Invitation;
use App\User;

class ProjectsController extends Controller
{
    public function index() {

        $projects = Auth::user()->projects->where('status', '!=', 5);

        return view('app.projects.index', [
            'title' => 'Seus Projetos',
            'projects' => $projects
        ]);

    }

    public function show($id) {

        $project = Project::find($id);
        if (Auth::user()->projects->contains($project)) {

            $todolist = $project->todolists->where('status', 0);

            return view('app.projects.show',[
                'title' => 'Projeto: ' . $project->title,
                'project' => $project
            ]);
        }

    }

    public function create() {
        return view('app.projects.create', [
            'title' => 'Criar Projeto',
            'tags' => Tag::all(),
            'types' => TypeProject::all(),
        ]);
    }

    public function store(Request $request) {
        $project = Project::create([
            'title' => $request->title,
            'user_id' => Auth::user()->id,
            'description' => $request->description,
            'authors' => $request->authors,
            'type_project_id' => $request->type,
            'deadline' => date('Y-m-d', strtotime($request->deadline)),
            'subject' => $request->subject,
            'public_id' => 'project_' . time()
        ]);

        if($request->public_teacher_id) {
            Invitation::create([
                'user_id' => User::where('public_id', $request->public_teacher_id)->first()->id,
                'project_id' => $project->id
            ]);
        }

        $tags = explode(',', $request->tags);
        // ARRUMAR
        foreach ($tags as $tag) {
            if (Tag::all()->where('name', $tag)->count() == 0) {
                $tag = Tag::create(['name' => $tag]);
                $project->tags()->attach($tag->id);
            } else {
                foreach(Tag::all()->where('name', $tag) as $tag) {
                    $project->tags()->attach($tag->id);
                }
            }
        }
        return redirect('/projects');
    }
}
