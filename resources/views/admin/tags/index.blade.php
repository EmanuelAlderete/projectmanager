@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <a href="/tags/create"><button class="btn btn-primary btn-md">Adicionar <i class="fa fa-plus-circle" aria-hidden="true"></i></button></a>
    </div>
    <hr>
    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th>Nome</th>
                    <th>Áreas</th>
                    <th class="text-right">Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tags as $tag)
                <tr>
                    <td class="text-center">{{ $tag->id }}</td>
                    <td>{{ $tag->name }}</td>
                    <td>
                        @foreach ($tag->departments as $department)
                            <span class="badge badge-pill badge-primary">{{ $department->name }}</span>
                        @endforeach
                    </td>
                    <td class="td-actions text-right">
                        <a href="/tags/{{ $tag->id }}">
                            <button type="button" rel="tooltip" class="btn btn-info">
                                <i class="material-icons">person</i>
                            </button>
                        </a>
                        <a href="/tags/{{ $tag->id }}/edit">
                            <button type="button" rel="tooltip" class="btn btn-success">
                                <i class="material-icons">edit</i>
                            </button>
                        </a>
                        <button onclick="event.preventDefault();document.getElementById({{ $tag->id }}).submit();" rel="tooltip" class="btn btn-danger">
                            <i class="material-icons">close</i>
                        </button>
                        <form id="{{ $tag->id }}" action="/tags/{{ $tag->id }}" method="POST" style="display: none;">
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
