<?php

namespace App\Http\Controllers;

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
        $degrees = Degree::all();

        return view('admin.degrees.index', [
            'degrees' => $degrees,
            'title' => 'Graduações'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.degrees.create', [
            'title' => 'Criar Graduação'
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
        $degree = Degree::find($id);

        return view('admin.degrees.show', [
            'degree' => $degree,
            'title' => 'Graduação: '.$degree->name
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
        $degree = Degree::find($id);

        return view('admin.degrees.edit', [
            'degree' => $degree,
            'title' => 'Editar Graduação'
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
        Degree::destroy($id);
        return redirect('/degrees');
    }
}
