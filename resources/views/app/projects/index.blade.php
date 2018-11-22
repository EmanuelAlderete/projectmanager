@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Tem uma ideia??</h5>
                    </div>
                    <div class="card-body">
                        <a href="/projects/create">Inicie um novo projeto</a>
                    </div>
                </div>
            </div>
            @forelse ($projects as $project)
                <div class="col-md-4 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h5>{{ strtoupper($project->title) }}</h5>
                            <p>{{ $project->typeProject->name }}</p>
                        </div>
                        <div class="card-body">
                            <p>{{ $project->description }}</p>
                        </div>
                        <div class="card-footer">
                            <a href="/projects/{{ $project->id }}" class="btn btn-primary">Acessar</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h3>Parece que você ainda não iniciou nenhum projeto...</h3>
                    </div>
                    <div class="card-body">
                        <a href="/projects/create">Clique aqui</a> para começar um novo projeto
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection
