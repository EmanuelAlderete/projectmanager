<?php

namespace App\Http\Controllers\App;

use App\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index($id) {
        $project = Project::find($id);
        if (Auth::user()->projects->contains($project)) {
            return view('app.project.index',[
                'title' => 'Projeto: ' . $project->title,
                'project' => $project
            ]);
        }
    }
}
