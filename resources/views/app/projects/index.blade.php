@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        @forelse ($projects as $project)
            <div class="card">
                <div class="card-header">
                    {{ $project->title }}
                </div>
                <div class="card-body">

                </div>
                <div class="card-footer">
                    <a href="/" class="btn btn-primary">Acessar</a>
                </div>
            </div>
        @empty
            <div class="card">
                <div class="card-header card-header-primary">
                    <h3>Parece que você ainda não iniciou nenhum projeto...</h3>
                </div>
                <div class="card-body">
                    <a href="/projects/start-new-project">Clique aqui</a> para começar um novo projeto
                </div>
            </div>
        @endforelse
    </div>
@endsection
