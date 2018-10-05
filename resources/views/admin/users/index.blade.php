@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <a href="/users/create"><button class="btn btn-primary btn-md">Adicionar <i class="fa fa-plus-circle" aria-hidden="true"></i></button></a>
    </div>
    <hr>
    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Cadastrado desde</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td class="text-center">{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->format('d M Y') }}</td>
                    <td class="td-actions text-right">
                        <a href="/users/{{ $user->id }}">
                            <button type="button" rel="tooltip" class="btn btn-info">
                                <i class="material-icons">person</i>
                            </button>
                        </a>
                        <a href="/users/{{ $user->id }}/edit">
                            <button type="button" rel="tooltip" class="btn btn-success">
                                <i class="material-icons">edit</i>
                            </button>
                        </a>
                        <button onclick="event.preventDefault();document.getElementById('delete-form').submit();" rel="tooltip" class="btn btn-danger">
                            <i class="material-icons">close</i>
                        </button>
                        <form id="delete-form" action="/users/{{ $user->id }}" method="POST" style="display: none;">
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