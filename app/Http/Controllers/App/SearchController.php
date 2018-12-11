<?php

namespace App\Http\Controllers\App;

use App\Tag;
use App\Idea;
use App\Project;
use App\Checkpoint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    public function index(Request $request) {
        $tagsIds = array();
        $tags = preg_split("/\s+/", $request->q);

        // Pega os ids das tags que já existem
        foreach($tags as $tag) {
            if(Tag::where('name', $tag)->count() > 0) {
                array_push($tagsIds, Tag::where('name', $tag)->first()->id);
            }
        }

        if($request->filter) {
            switch ($request->filter) {
                case "ideas":
                    $ideas = Idea::whereHas('tags', function ($q) use ($tagsIds) {
                        $q->whereIn('tag_id', $tagsIds);
                    })->get();

                    $ideas = $ideas->merge(Idea::where('content', 'like' ,'%' . $request->q . '%')->get());
                    return view('app.search.index', [
                        'title' => 'Pesquisar no Banco',
                        'q' => $request->q,
                        'filter' => 1, // 1 para ideas, 2 para projects, 3 para checkpoints
                        'data' => $ideas
                    ]);
                break;

                case "projects":
                    $projects = Project::whereHas('tags', function ($q) use ($tagsIds) {
                        $q->whereIn('tag_id', $tagsIds);
                    })->get();

                    $projects = $projects->merge(Project::where('status', 2)->where('description', 'like' ,'%' . $request->q . '%')->get());
                    $projects = $projects->merge(Project::where('status', 2)->where('title', 'like' ,'%' . $request->q . '%')->get());
                    $projects = $projects->merge(Project::where('status', 2)->where('subject', 'like' ,'%' . $request->q . '%')->get());

                    return view('app.search.index', [
                        'title' => 'Pesquisar no Banco',
                        'q' => $request->q,
                        'filter' => 2, // 1 para ideas, 2 para projects, 3 para checkpoints
                        'data' => $projects
                    ]);
                break;

                case "checkpoints":

                    $checkpoints = Checkpoint::where('status', '>', 2)->where('status', '<', 5)->where('title', 'like' ,'%' . $request->q . '%')->get();
                    $checkpoints = $checkpoints->merge(Checkpoint::where('status', '>', 2)->where('status', '<', 5)->where('message', 'like' ,'%' . $request->q . '%')->get());

                    return view('app.search.index', [
                        'title' => 'Pesquisar no Banco',
                        'q' => $request->q,
                        'filter' => 3, // 1 para ideas, 2 para projects, 3 para checkpoints
                        'data' => $checkpoints
                    ]);
                break;
            }
        } else {

            return view('app.search.index', [
                'title' => 'Pesquisar no Banco',
                'filter' => array(),
                'q' => ''
            ]);
        }

    }
}
