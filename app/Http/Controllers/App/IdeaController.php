<?php

namespace App\Http\Controllers\App;

use App\Idea;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    public function index() {
        $ideas = Idea::all();
        return view('app.ideas.index', [
            'title' => 'Ideias',
            'ideas' => $ideas
        ]);
    }
}
