<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Branch;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branches = Branch::all();

        return view('admin.branches.index', [
            'branches' => $branches,
            'title' => 'Áreas do Conhecimento'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.branches.create', [
            'title' => 'Criar Área'
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
        $branch = Branch::create([
            'name' => $request->get('name'),
            'label' => $request->get('label'),
            'icon' => $request->get('icon'),
            'main_branch' => $request->get('main')
        ]);

        return redirect('/branches');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $branch = Branch::find($id);

        return view('admin.branches.show', [
            'branch' => $branch,
            'title' => 'Área: '.$branch->name
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
        $branch = Branch::find($id);

        return view('admin.branches.edit', [
            'branch' => $branch,
            'title' => 'Editar Área'
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
        $branch = Branch::find($id);

        $branch->name = $request->get('name');
        $branch->label = $request->get('label');
        $branch->icon = $request->get('icon');
        $branch->main_branch = $request->get('main');
        $branch->save();

        return redirect('/branches');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Branch::destroy($id);

        return redirect('/branches');
    }
}
