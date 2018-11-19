<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Institution;
use App\Course;

class InstitutionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($this->authorize('view')) {
            $institutions = Institution::all();

            return view('admin.institutions.index', [
                'institutions' => $institutions,
                'title' => 'Instituições'
            ]);

        }
        return abort(401);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if ($this->authorize('create')) {
            $courses = Course::all();

            return view('admin.institutions.create', [
                'courses' => $courses,
                'title' => 'Criar Instituição'
            ]);
        }
        return abort(401);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $institution = Institution::create([
            'name' => $request->get('name'),
            'about' => $request->get('about'),
            'address' => $request->get('address'),
        ]);

        $institution->courses()->sync($request->get('courses'));

        return redirect('/institutions');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($this->authorize('view')) {
            $institution = Institution::find($id);

            return view('admin.institutions.show', [
                'institution' => $institution,
                'title' => 'Instituição: ' . $institution->name
            ]);
        }
        return abort(401);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ($this->authorize('update')) {
            $institution = Institution::find($id);
            $courses = Course::all();

            return view('admin.institutions.edit', [
                'institution' => $institution,
                'courses' => $courses,
                'title' => 'Editar Instituição'
            ]);
        }
        return abort(401);
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
        $institution = Institution::find($id);

        $institution->name = $request->get('name');
        $institution->about = $request->get('about');
        $institution->address = $request->get('address');
        $institution->save();
        $institution->courses()->sync($request->get('courses'));

        return redirect('/institutions');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->authorize('delete')) {
            Institution::destroy($id);
            return redirect('/institutions');
        }
        return abort(401);
    }
}
