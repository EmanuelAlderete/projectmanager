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

        $tags = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/", "/(ç)/", "/(Ç)/"),explode(" ","a A e E i I o O u U n N c C"), $request->tags);
        $tags = explode(',', $tags);


        foreach ($tags as $tag) {

            if (Tag::all()->where('name', $tag)->count() == 0) {
                Tag::create(['name' => $tag]);
            }
            $idea->tags()->attach(Tag::all()->where('name', $tag)->first()->id);
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
