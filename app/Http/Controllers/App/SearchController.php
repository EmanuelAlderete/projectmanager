<?php

namespace App\Http\Controllers\App;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Idea;
use Illuminate\Http\Response;
use App\Checkpoint;
use App\Project;

class SearchController extends Controller
{
    public function index() {
        $checkpoints = Checkpoint::where('status', 3)->count();
        $ideas = Idea::all()->count();
        $projects = Project::where('status', 2)->count();

        return view('app.search.index', [
            'title' => 'Pesquisar no Banco',
            'checkpoints' => $checkpoints,
            'projects' => $projects
        ]);
    }
}
