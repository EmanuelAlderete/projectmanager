@extends('layouts.app')

@section('content')
    <div class="container-fluid" id="area">
        <a href="/projects/{{ $project->id }}/checkpoints" class="btn btn-primary btn-fab btn-fab-mini btn-round"><i class="material-icons">arrow_back</i></a>

        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h1>{{ $checkpoint->title }}</h1>
                    </div>
                    <div class="card-body">
                        <p>{{ $checkpoint->message }}</p>
                        <strong>Listas de Tarefas:</strong>

                        <ul>
                            @foreach($checkpoint->todolists as $todolist)
                                <li>{{ $todolist->description }}
                                    <ul>
                                        @foreach($todolist->tasks as $task)
                                            <li>{{ $task->description }}</li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                        </ul>

                        <a href="/storage/projects/project-{{ $project->id }}/{{ $checkpoint->annex }}">Clique aqui</a> para fazer download
                        @if($checkpoint->feedback()->count() == 0)
                        <hr>
                        <div class="row">
                            <div class="col-12">
                                <form action="/feedbacks" method="post">
                                    @csrf
                                    <input type="hidden" name="checkpoint_id" value="{{ $checkpoint->id }}">
                                    <div class="form-group">
                                        <textarea name="message" class="form-control" placeholder="Escreva sua avaliação aqui." required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-success btn-round">Enviar</button>
                                </form>
                            </div>
                        </div>
                        @else
                            <div class="card-footer">
                                <p><strong>Avaliação do Orientador: </strong>{{ $checkpoint->feedback->message }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

