@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <a href="/degrees/create"><button class="btn btn-primary btn-md">Adicionar <i class="fa fa-plus-circle" aria-hidden="true"></i></button></a>
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
                @forelse($degrees as $degree)
                <tr>
                    <td class="text-center">{{ $degree->id }}</td>
                    <td>{{ $degree->name }}</td>
                    <td>{{ $degree->label }}</td>
                    <td class="td-actions text-right">
                        <a href="/degrees/{{ $degree->id }}">
                            <button type="button" rel="tooltip" class="btn btn-info">
                                <i class="material-icons">person</i>
                            </button>
                        </a>
                        <a href="/degrees/{{ $degree->id }}/edit">
                            <button type="button" rel="tooltip" class="btn btn-success">
                                <i class="material-icons">edit</i>
                            </button>
                        </a>
                        <button onclick="event.preventDefault();document.getElementById('{{ $degree->id }}').submit();" rel="tooltip" class="btn btn-danger">
                            <i class="material-icons">close</i>
                        </button>
                        <form id="{{ $degree->id }}" action="/degrees/{{ $degree->id }}" method="POST" style="display: none;">
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