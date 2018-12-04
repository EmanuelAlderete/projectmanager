@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <a href="/teacher-requests/create"><button class="btn btn-primary btn-md">Adicionar <i class="fa fa-plus-circle" aria-hidden="true"></i></button></a>
    </div>
    <hr>
    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($requests as $request)
                <tr>
                    <td class="text-center">{{ $request->id }}</td>
                    <td>{{ $request->user->name }}</td>
                    <td>{{ $request->cpf }}</td>
                    <td class="td-actions text-right">
                        <a href="/teacher-requests/{{ $request->id }}">
                            <button type="button" rel="tooltip" class="btn btn-info">
                                <i class="material-icons">person</i>
                            </button>
                        </a>
                        <button onclick="event.preventDefault();document.getElementById({{ $request->id }}).submit();" rel="tooltip" class="btn btn-danger">
                            <i class="material-icons">close</i>
                        </button>
                        <form id="{{ $request->id }}" action="/teacher-requests/{{ $request->id }}" method="POST" style="display: none;">
                            @csrf
                            @method('delete')
                        </form>
                    </td>
                </tr>
                @empty

                @endforelse
            </tbody>
        </table>
    </div>
  </div>
@endsection
