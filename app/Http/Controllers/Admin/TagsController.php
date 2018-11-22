<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tag;
use App\Department;

class TagsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($this->authorize('view')) {

            $tags = Tag::all();

            return view('admin.tags.index', [
                'title' => 'Tags',
                'tags' => $tags
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
            $departments = Department::all();

            return view('admin.tags.create', [
                'title' => 'Criar Tag',
                'departments' => $departments
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
        $tag = Tag::create(['name' => $request->name]);

        $tag->departments()->sync($request->departments);

        return redirect('/tags');
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
            $tag = Tag::find($id);

            return view('admin.tags.show', [
                'title' => 'Tag: ' . $tag->name,
                'tag' => $tag
            ]);
        }

        return abort(404);
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
            $tag = Tag::find($id);

            return view('admin.tags.edit', [
                'title' => 'Editar Tag',
                'tag' => $tag
            ]);
        }

        return abort(404);
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
        $tag = Tag::find($id);

        $tag->name = $request->name;
        $tag->departments()->sync($request->departments);
        $tag->save();

        return redirect('/tags');
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
            Tag::destroy($id);
            return redirect('/tags');
        }
        return abort(404);
    }
}
