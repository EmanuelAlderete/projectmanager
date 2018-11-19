<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Degree;

class DegreeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($this->authorize('view')) {
            $degrees = Degree::all();

            return view('admin.degrees.index', [
                'degrees' => $degrees,
                'title' => 'Graduações'
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
            return view('admin.degrees.create', [
                'title' => 'Criar Graduação'
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
        $degrees = Degree::create([
            'name' => $request->get('name'),
            'label' => $request->get('label')
        ]);

        return redirect('/degrees');
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
            $degree = Degree::find($id);

            return view('admin.degrees.show', [
                'degree' => $degree,
                'title' => 'Graduação: ' . $degree->name
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
            $degree = Degree::find($id);

            return view('admin.degrees.edit', [
                'degree' => $degree,
                'title' => 'Editar Graduação'
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
        $degree = Degree::find($id);

        $degree->name = $request->get('name');
        $degree->label = $request->get('label');
        $degree->save();

        return redirect('/degrees');
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
            Degree::destroy($id);
            return redirect('/degrees');
        }

        return abort(401);
    }
}
