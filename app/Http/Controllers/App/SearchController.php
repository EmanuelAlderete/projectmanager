<?php

namespace App\Http\Controllers\App;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Department;
use App\Course;

class SearchController extends Controller
{
    public function index(Request $request) {

        $title = "Pesquisar";
        $departments = Department::all();
        $courses = Course::all();

        return view('app.search.index', [
            'title' => $title,
            'departments' => $departments,
            'courses' => $courses
        ]);
    }
}
