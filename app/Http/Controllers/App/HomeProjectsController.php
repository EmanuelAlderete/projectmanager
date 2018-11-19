<?php

namespace App\Http\Controllers\App;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\TypeProject;

class HomeProjectsController extends Controller
{

    public function index() {
        $projects = Auth::user()->projects();

        return view('app.projects.index', [
            'title' => 'Seus Projetos',
            'projects' => $projects
        ]);
    }

    public function start() {
        $types = TypeProject::all();

        return view('app.projects.start', [
            'title' => 'Começar novo projeto',
            'types' => $types
        ]);
    }

}
