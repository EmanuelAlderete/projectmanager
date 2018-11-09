<?php

namespace App\Http\Controllers\App;

use App\Idea;
use App\Course;
use App\Department;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IdeaController extends Controller
{
    public function index() {
        
        $courses = Course::all();
        $departments = Department::all();

        return view('app.ideas.index', [
            'title' => 'Publique sua Ideia',
            'courses' => $courses,
            'departments' => $departments
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
