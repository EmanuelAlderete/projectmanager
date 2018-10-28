<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Idea;
use Illuminate\Support\Facades\Auth;

class IdeaController extends Controller
{
    //API

    public function index() {

        return response()->json(Idea::with('users')->get());

    }

    public function store(Request $request) {

        $idea = Idea::create([
            'content' => $request->get('content'),
            'status' => 0
        ]);

        $idea->user()->associate(Auth::user());

        if ($request->get('courses') != null) { 
            $idea->courses()->sync($request->get('courses'));
        } 
        if ($request->get('departments') != null) {
            $idea->departments()->sync($request->get('departments'));
        }
        
        $idea = Idea::where('id', $idea->id)->with('user')->first();

        return $idea->toJson();

    }
}
