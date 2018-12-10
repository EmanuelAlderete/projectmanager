@extends('layouts.app')

@section('content')
<div class="container-fluid" id="area">
    <a href="/projects/{{ $project->id }}" class="btn btn-primary btn-fab btn-fab-mini btn-round"><i class="material-icons">arrow_back</i></a>

    <div class="row" id="list">
        @forelse ($project->checkpoints as $checkpoint)
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <p> {{ $checkpoint->title }}</strong>
                            <small> -
                                @switch($checkpoint->status)
                                    @case(0)
                                        Aguardando Feedback
                                        @break
                                    @case(1)
                                        Aguardando Feedback para publicar
                                        @break
                                    @case(2)
                                        Revisado
                                        @break
                                    @case(3)
                                        Revisado e Publicado
                                        @break
                                    @case(4)
                                        Publicado
                                        @break
                                    @case(5)
                                        Não Publicado
                                        @break
                                    @default
                                    Concluído
                                @endswitch
                            </small>
                        </p>

                    </div>
                    <div class="card-body">
                        {{ $checkpoint->message }}
                        <hr>
                        <strong>Listas de Tarefas:</strong>
                        <ul class="tasks-list">
                            @foreach ($checkpoint->todolists as $todolist)
                                <li>{{ $todolist->description }}</li>
                            @endforeach
                        </ul>
                        @if($checkpoint->status == 2 || $checkpoint->status == 3)
                            <div class="card-title">
                                <strong>Feedback</strong>
                                <p>{{ $project->teacher()->name }}: {{ $checkpoint->feedback->message }}</p>
                            </div>
                        @endif
                    </div>
                    @if(Auth::user()->teacher == 1 && $project->teacher_id == Auth::user()->id)
                        <div class="card-footer">
                            <a href="/projects/{{ $project->id }}/checkpoints/{{ $checkpoint->id }}" class="btn btn-primary">Ver</a>
                        </div>
                    @endif
                </div>
            </div>
        @empty
        @endforelse
    </div>
</div>
@endsection

