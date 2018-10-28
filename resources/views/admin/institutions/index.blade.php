@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <a href="/institutions/create"><button class="btn btn-primary btn-md">Adicionar <i class="fa fa-plus-circle" aria-hidden="true"></i></button></a>
    </div>
    <hr>
    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($institutions as $institution)
                <tr>
                    <td class="text-center">{{ $institution->id }}</td>
                    <td>{{ $institution->name }}</td>
                    <td>{{ $institution->about }}</td>
                    <td class="td-actions text-right">
                        <a href="/institutions/{{ $institution->id }}">
                            <button type="button" rel="tooltip" class="btn btn-info">
                                <i class="material-icons">person</i>
                            </button>
                        </a>
                        <a href="/institutions/{{ $institution->id }}/edit">
                            <button type="button" rel="tooltip" class="btn btn-success">
                                <i class="material-icons">edit</i>
                            </button>
                        </a>
                        <button onclick="event.preventDefault();document.getElementById('{{ $institution->id }}').submit();" rel="tooltip" class="btn btn-danger">
                            <i class="material-icons">close</i>
                        </button>
                        <form id="{{ $institution->id }}" action="/institutions/{{ $institution->id }}" method="POST" style="display: none;">
                            @csrf
                            @method('delete')
                        </form>
                    </td>
                </tr>
                @empty
                Não há registros
                @endforelse
            </tbody>
        </table>
    </div>
  </div>
@endsection