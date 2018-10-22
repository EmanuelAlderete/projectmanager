<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Course;
use App\Department;
use App\Degree;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::all();

        return view('admin.courses.index', [
            'courses' => $courses,
            'title' => 'Cursos'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all();
        $degrees = Degree::all();

        return view('admin.courses.create', [
            'departments' => $departments,
            'degrees' => $degrees,
            'title' => 'Criar Curso',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $course = new Course();

        $course->name = $request->get('name');
        $course->label = $request->get('label');
        $course->icon = $request->get('icon');

        $department = Department::find($request->get('department'));
        $degree = Degree::find($request->get('degree'));

        $course->department()->associate($department);
        $course->degree()->associate($degree);

        $course->save();

        return redirect('/courses');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = Course::find($id);

        return view('admin.courses.show', [
            'course' => $course,
            'title' => 'Curso: '.$course->name
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = Course::find($id);
        $departments = Department::all();
        $degrees = Degree::all();

        return view('admin.courses.edit', [
            'course' => $course,
            'departments' => $departments,
            'degrees' => $degrees,
            'title' => 'Editar Curso',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $course = Course::find($id);

        $course->name = $request->get('name');
        $course->label = $request->get('label');
        $course->icon = $request->get('icon');

        $department = Department::find($request->get('department'));
        $degree = Degree::find($request->get('degree'));

        $course->department()->associate($department);
        $course->degree()->associate($degree);

        $course->save();

        return redirect('/courses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Course::destroy($id);
        return redirect('/courses');
    }
}
