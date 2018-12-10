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
                        <a href="/publish-project/create" style="float: right;">Publicar um projeto</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($projects as $project)
                <div class="col-md-4 col-sm-12">
                    <div class="card">
                        @if($project->status == 5)
                        <div class="card-header card-header-warning">
                            <h5>{{ strtoupper($project->title) }}</h5>
                            <p>{{ $project->typeProject->name }} - Aguardando Aprovação</p>
                        </div>
                        @else
                        <div class="card-header card-header-primary">
                            <h5>{{ strtoupper($project->title) }}</h5>
                            <p>{{ $project->typeProject->name }}</p>
                        </div>
                        @endif
                        <div class="card-body">
                            <p>{{ $project->description }}</p>
                        </div>
                        <div class="card-footer">
                            <a href="/projects/{{ $project->id }}" class="btn btn-primary">Acessar</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
