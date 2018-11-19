<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Department;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($this->authorize('view')) {
            $departments = Department::all();

            return view('admin.departments.index', [
                'departments' => $departments,
                'title' => 'Áreas do Conhecimento'
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
            return view('admin.departments.create', [
                'title' => 'Criar Área'
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
        $department = Department::create([
            'name' => $request->get('name'),
            'label' => $request->get('label'),
            'icon' => $request->get('icon'),
            'main_department' => $request->get('main')
        ]);

        return redirect('/departments');
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
            $department = Department::find($id);

            return view('admin.departments.show', [
                'department' => $department,
                'title' => 'Área: ' . $department->name
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
            $department = Department::find($id);

            return view('admin.departments.edit', [
                'department' => $department,
                'title' => 'Editar Área'
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
        $department = Department::find($id);

        $department->name = $request->get('name');
        $department->label = $request->get('label');
        $department->icon = $request->get('icon');
        $department->main_department = $request->get('main');
        $department->save();

        return redirect('/departments');
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
            Department::destroy($id);

            return redirect('/departments');
        }
        return abort(401);
    }
}
