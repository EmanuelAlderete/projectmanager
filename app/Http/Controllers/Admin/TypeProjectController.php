<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\TypeProject;

class TypeProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($this->authorize('view')) {
            $tps = TypeProject::all();

            return view('admin.type-projects.index', [
                'title' => 'Tipos de Projetos',
                'types' => $tps
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
            return view('admin.type-projects.create', [
                'title' => 'Criar um Tipo de Projeto'
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

        $type = TypeProject::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return redirect('/type-projects');
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
            $type = TypeProject::find($id);

            return view('admin.type-projects.show', [
                'title' => 'Tipo: ' . $type->name,
                'type' => $type
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
            $type = TypeProject::find($id);

            return view('admin.type-projects.edit', [
                'title' => 'Editar: ' . $type->name,
                'type' => $type
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
        $type = TypeProject::find($id);

        $type->name = $request->name;
        $type->description = $request->description;
        $type->save();

        return redirect('/type-projects');
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
            TypeProject::destroy($id);

            return redirect('/type-projects');
        }
        return abort(401);
    }
}
