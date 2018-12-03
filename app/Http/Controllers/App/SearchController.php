<?php

namespace App\Http\Controllers\App;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Course;
use App\Idea;
use Illuminate\Http\Response;

class SearchController extends Controller
{
    public function index(Request $request) {

        $title = "Pesquisar";
        $courses = Course::all();
        $ideas = Idea::all()->sortByDesc('created_at');
        $filter = 'disable';

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

            $filter = 'enable';
        }

        return view('app.search.index', [
            'title' => $title,
            'courses' => $courses,
            'ideas' => $ideas,
            'filter' => $filter,
            'request' => $request
        ]);
    }
}
