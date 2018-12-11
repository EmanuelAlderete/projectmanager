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

        $projects = Auth::user()->projects;
        $managed_projects = Project::all()->where('teacher_id', Auth::user()->id);

        $projects = $projects->merge($managed_projects);

        return view('app.projects.index', [
            'title' => 'Seus Projetos',
            'projects' => $projects,
        ]);

    }

    public function show($id) {

        $project = Project::find($id);

        if ($project->status == 2) {
            return view('app.projects.show', [
                'title' => 'Ver Projeto',
                'project' => $project
            ]);
        } elseif (Auth::user()->projects->contains($project) || $project->teacher_id == Auth::user()->id) {
            if ($project->status == 1 || $project->status == 3 || $project->status == 5) {
                return view('app.projects.show', [
                    'title' => 'Ver Projeto',
                    'project' => $project
                ]);
            } else {
                $todolist = $project->todolists->where('status', 0);

                return view('app.projects.open',[
                    'title' => 'Projeto: ' . $project->title,
                    'project' => $project,
                    'teacher' => User::find($project->teacher_id)
                ]);
            }
        } else {
            abort(401);
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

        foreach ($tags as $tag) {
            // Remove acentos
            $tag = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/", "/(ç)/", "/(Ç)/"),explode(" ","a A e E i I o O u U n N c C"), $tag);
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
