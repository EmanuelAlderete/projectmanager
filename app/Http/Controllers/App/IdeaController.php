<?php

namespace App\Http\Controllers\App;

use App\Idea;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IdeaController extends Controller
{
    public function index() {
        $ideas = Idea::all();
        $ideas = $ideas->sortByDesc('created_at');
        return view('app.ideas.index', [
            'title' => 'Ideias',
            'ideas' => $ideas
        ]);
        
    }

    public function store(Request $request) {
        $idea = Idea::create([
            'content' => $request->get('content'),
            'status' => 0,
            'user_id' => Auth::user()->id
        ]);

        return redirect('/ideas');
    }
}
