<?php

namespace App\Http\Controllers\App;

use App\Tag;
use App\Idea;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class IdeaController extends Controller
{

    public function store(Request $request) {
        $idea = new Idea();
        $idea->content = $request->get('content');
        $idea->status = 0;
        $idea->user()->associate(Auth::user());
        $idea->save();

        $tags = explode(',', $request->tags);


        foreach ($tags as $tag) {
            if (Tag::all()->where('name', $tag)->count() == 0) {
                $tag = Tag::create(['name' => $tag]);
                $idea->tags()->attach($tag->id);
            } else {
                foreach(Tag::all()->where('name', $tag) as $tag) {
                    $idea->tags()->attach($tag->id);
                }
            }
        }

        return redirect('/home');
    }

    public function show($id) {
        $idea = Idea::find($id);

        return view('app.ideas.show', [
            'title' => 'Ideia de: ' . $idea->user->name,
            'idea' => $idea
        ]);
    }
}
