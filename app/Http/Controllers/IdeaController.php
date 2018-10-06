<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Idea;
use App\Course;
use App\Department;
use Illuminate\Support\Facades\Auth;

class IdeaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ideas = Idea::all();

        return view('admin.ideas.index', [
            'ideas' => $ideas,
            'title' => 'Ideias'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = Course::all();
        $departments = Department::all();

        return view('admin.ideas.create', [
            'courses' => $courses,
            'departments' => $departments,
            'title' => 'Criar Ideia'
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
        $idea = new Idea();
        $idea->content = $request->get('content');
        $idea->status = $request->get('status');
        $idea->user()->associate(Auth::user());

        $idea->save();

        $idea->courses()->sync($request->get('courses'));
        $idea->departments()->sync($request->get('departments'));

        return redirect('/ideas');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $idea = Idea::find($id);

        return view('admin.ideas.show', [
            'idea' => $idea,
            'title' => 'Ideia'
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
        $idea = Idea::find($id);
        $courses = Course::all();
        $departments = Department::all();

        return view('admin.ideas.edit', [
            'idea' => $idea,
            'courses' => $courses,
            'departments' => $departments,
            'title' => 'Criar Ideia'
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
        $idea = Idea::find($id);
        $idea->content = $request->get('content');
        $idea->status = $request->get('status');
        $idea->save();
        $idea->courses()->sync($request->get('courses'));
        $idea->departments()->sync($request->get('departments'));

        return redirect('/ideas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Idea::destroy($id);
        return redirect('/ideas');
    }
}
