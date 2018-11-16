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
        $idea = new Idea();
        $idea->content = $request->get('content');
        $idea->status = 0;
        $idea->user()->associate(Auth::user());

        $idea->save();

        $idea->courses()->sync($request->get('courses'));
        $idea->departments()->sync($request->get('departments'));

        return redirect('/ideas');
    }

    public function show($id) {
        $idea = Idea::find($id);

        return view('app.ideas.show', [
            'title' => 'Ideia de: ' . $idea->user->name,
            'idea' => $idea
        ]);
    }
}
