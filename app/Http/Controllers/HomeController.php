<?php

namespace App\Http\Controllers;

use App\Idea;
use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();

        if($user->can('access-menu-root')) {
            return view('admin.index', [
                'title' => 'Dashboard'
            ]);
        } else if ($user->can('access-menu')) {
            return view('app.index', [
                'title' => 'Dashboard',
                'teacher_status' => Auth::user()->teacherRequest()->count() == 0 ? 0 : Auth::user()->teacherRequest->status,
                'courses' => Course::all(),
                'ideas' => Idea::all()->sortByDesc('created_at')
            ]);
        }
    }

    public function search(Request $request) {

        if ($request->all()) {


            if ($request->q) {
                $text_filter = Idea::where('content', 'like' ,'%' . $request->q . '%')->get();
            }

            if ($request->courses) {
                foreach ($request->courses as $course) {
                    $course_filter = Idea::where('course_id', $course);
                }
            }

            if ($request->tags) {
                foreach ($request->tags as $tag) {
                    $tag_filter = $tag_filter->merge(Idea::whereHas('tags', function ($query) {
                        $query->where('id', $tag);
                    })->fisrt());
                }
            }
        }

        return response()->json($ideas);
    }



}
