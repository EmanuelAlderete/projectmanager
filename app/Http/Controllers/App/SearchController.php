<?php

namespace App\Http\Controllers\App;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Idea;
use Illuminate\Http\Response;

class SearchController extends Controller
{
    public function index(Request $request) {

        if ($request->all()) {
            $ideas = Idea::all();

            if ($request->q) {
                $ideas = Idea::where('content', 'like' ,'%' . $request->q . '%')->get();
            }

            if ($request->courses) {
                foreach ($request->courses as $course) {
                    $ideas = $ideas->filter(function ($idea) use ($course) {
                        return $idea->courses->contains($course);
                    });
                }
            }
        }

        return response()->json($ideas);
    }
}
