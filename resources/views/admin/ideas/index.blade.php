@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <a href="/ideas-admin/create"><button class="btn btn-primary btn-md">Adicionar <i class="fa fa-plus-circle" aria-hidden="true"></i></button></a>
    </div>
    <hr>
    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th class="text-center">#</th>
                    <th>Ideia</th>
                    <th>Status</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ideas as $idea)
                <tr>
                    <td class="text-center">{{ $idea->id }}</td>
                    <td>{{ $idea->content }}</td>
                    <td>
                        @switch($idea->status)
                            @case(0)
                                 Disponível 
                                @break
                            @case(1)
                                 Em desenvolvimento 
                                @break
                            @case(2)
                                 Ideia já desenvolvida
                            @break    
                            @default
                                
                        @endswitch
                    </td>
                    <td class="td-actions text-right">
                        <a href="/ideas-admin/{{ $idea->id }}">
                            <button type="button" rel="tooltip" class="btn btn-info">
                                <i class="material-icons">person</i>
                            </button>
                        </a>
                        <a href="/ideas-admin/{{ $idea->id }}/edit">
                            <button type="button" rel="tooltip" class="btn btn-success">
                                <i class="material-icons">edit</i>
                            </button>
                        </a>
                        <button onclick="event.preventDefault();document.getElementById({{ $idea->id }}).submit();" rel="tooltip" class="btn btn-danger">
                            <i class="material-icons">close</i>
                        </button>
                        <form id="{{ $idea->id }}" action="/ideas-admin/{{ $idea->id }}" method="POST" style="display: none;">
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