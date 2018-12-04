<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\TeacherRequest;
use Illuminate\Support\Facades\Auth;

class TeacherRequestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if ($this->authorize('view')) {
            $requests = TeacherRequest::all();

            return view('admin.teacher-requests.index', [
                'title' => 'Listagem de Solicitações',
                'requests' => $requests
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
        if (Auth::user()->teacherRequest) {
            return redirect('/home');
        }

        return view('admin.teacher-requests.create', [
            'title' => 'Solicitar Perfil de Professor'
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
        $name = uniqid(date('HisYmd'));
        $extension = $request->document->getClientOriginalExtension();
        $nameFile = "{$name}.{$extension}";
        $upload = $request->document->storeAs('documents', $nameFile);

        TeacherRequest::create([
            'cpf' => $request->cpf,
            'status' => 1, // 1- aguardando resposta - 2 - aprovado - 3 negado
            'registry' => $request->registry,
            'document' => $nameFile,
            'user_id' => Auth::user()->id
        ]);

        return redirect('/home');
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
            return view('admin.teacher-requests.show', [
                'title' => 'Analisar Solicitação',
                'request' => TeacherRequest::find($id)
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
        // if ($this->authorize('edit')) {
        //     return view('admin.teacher-requests.edit', [
        //         'title' => 'Analisar Solicitação',
        //         'request' => TeacherRequest::find($id)
        //     ]);
        // }
        // return abort(401);
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
        $t_request = TeacherRequest::find($id);

        $t_request->status = $request->status;
        $t_request->save();

        return redirect('/teacher-requests');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
