<?php

namespace App\Http\Controllers\App;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Department;
use App\Course;
use App\Idea;
use Illuminate\Http\Response;

class SearchController extends Controller
{
    public function index(Request $request) {

        $title = "Pesquisar";
        $departments = Department::all();
        $courses = Course::all();
        $ideas = array();
        $filter = 'disable';

        if ($request->all()) {
            $ideas = Idea::all();

            if ($request->q) {
                $ideas = Idea::where('content', 'like' ,'%' . $request->q . '%')->get();
            }

            if ($request->departments) {
                foreach ($request->departments as $department) {
                    $ideas = $ideas->filter(function ($idea) use ($department) {
                        return $idea->departments->contains($department);
                    });
                }
            }

            if ($request->courses) {
                foreach ($request->courses as $course) {
                    $ideas = $ideas->filter(function ($idea) use ($course) {
                        return $idea->courses->contains($course);
                    });
                }
            }

            if ($request->status) {
                foreach ($request->status as $status) {
                    $ideas = $ideas->filter(function ($idea) use ($status) {
                        return $idea->status == $status;
                    });
                }
            }
            $filter = 'enable';
        }

        return view('app.search.index', [
            'title' => $title,
            'departments' => $departments,
            'courses' => $courses,
            'ideas' => $ideas,
            'filter' => $filter,
            'request' => $request
        ]);
    }
}
