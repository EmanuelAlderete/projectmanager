@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-5">
            <div class="row justify-content-center">
                <div class="card">
                    <div class="card-body">
                        <form class="form-search" id="form-search" method="get">
                            <div class="col-sm-12 search-area">
                                <input type="search" class="form-control" name="q" value="{{ $q }}" placeholder="Pesquise algo..." autofocus>
                                <button type="submit" class="btn btn-primary btn-round" id="submit"><i class="fas fa-search"></i></button>
                                <div style="display: inline; float:right; margin-top:10px;">
                                    <div class="form-check form-check-radio form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="filter" value="ideas" {{ empty($filter) ? 'checked' : $filter == 1 ? 'checked' : '' }}> Ideias
                                            <span class="circle">
                                                <span class="check"></span>
                                            </span>
                                        </label>
                                        </div>
                                        <div class="form-check form-check-radio form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="filter" value="projects" {{ empty($filter) ? '' : $filter == 2 ? 'checked' : '' }}> Projetos
                                            <span class="circle">
                                                <span class="check"></span>
                                            </span>
                                        </label>
                                        </div>
                                        <div class="form-check form-check-radio form-check-inline">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="filter" value="checkpoints" {{ empty($filter) ? '' : $filter == 3 ? 'checked' : '' }}> Checkpoints
                                            <span class="circle">
                                                <span class="check"></span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        @switch($filter)
            @case(1)
                @forelse ($data as $idea)
                <div class="col-sm-12 col-md-7">
                    <div class="card">
                        <div class="card-header card-header-icon card-header-warning">
                            <div class="card-icon">
                                <i class="material-icons"><i class="far fa-lightbulb"></i></i>
                            </div>
                            <h3 class="card-title">{{ $idea->user->name }}</h3>
                        </div>
                        <div class="card-body">
                            {{ $idea->content }}
                        </div>
                        <div class="card-footer">
                            <a href="/ideas/{{ $idea->id }}" class="btn btn-primary">Ver</a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-sm-12 col-md-7">
                    <div class="card">
                        <div class="card-body">
                            <strong>Nenhum resultado foi encontrado</strong>
                        </div>
                    </div>
                </div>
                @endforelse
                @break
            @case(2)
                @forelse ($data as $project)
                <div class="col-sm-12 col-md-7">
                    <div class="card">
                        <div class="card-header card-header-icon card-header-warning">
                            <div class="card-icon">
                                <i class="material-icons"><i class="fas fa-archive"></i></i>
                            </div>
                            <h3 class="card-title">{{ $project->user->name }}</h3>
                        </div>
                        <div class="card-body">
                            <strong>{{ $project->title }}</strong>
                            <p>{{ $project->description }}</p>
                        </div>
                        <div class="card-footer">
                            <a href="/projects/{{ $project->id }}" class="btn btn-primary">Ver</a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-sm-12 col-md-7">
                    <div class="card">
                        <div class="card-body">
                            <strong>Nenhum resultado foi encontrado</strong>
                        </div>
                    </div>
                </div>
                @endforelse
                @break
            @case(3)
                @forelse ($data as $checkpoint)
                <div class="col-sm-12 col-md-7">
                    <div class="card">
                        <div class="card-header card-header-icon card-header-warning">
                            <div class="card-icon">
                                <i class="material-icons">place</i>
                            </div>
                            <p class="card-category">{{ $checkpoint->project->user->name }}</p>
                        </div>
                        <div class="card-body">
                            <strong>{{ $checkpoint->title }}</strong>
                            <p>{{ $checkpoint->message }}</p>
                        </div>
                        <div class="card-footer">
                            <a href="/checkpoints/{{ $checkpoint->id }}" class="btn btn-primary">Ver</a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-sm-12 col-md-7">
                    <div class="card">
                        <div class="card-body">
                            <strong>Nenhum resultado foi encontrado</strong>
                        </div>
                    </div>
                </div>
                @endforelse
                @break
            @default

        @endswitch
    </div>
@endsection
