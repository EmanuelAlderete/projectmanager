@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h6>Veja as especificações do seu projeto.</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <p><strong>Título:</strong> {{ $project->title }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <p><strong>Assunto:</strong> {{ $project->subject }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <p><strong>Autores:</strong> {{ $project->authors }}</p>
                            </div>
                        </div>
                        @if($project->teacher_name)
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <p><strong>Orientador:</strong> {{ $project->teacher_name }}</p>
                            </div>
                        </div>
                        @endif
                        @if($project->website)
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <p><strong>Website:</strong>{{ $project->website }}</p>
                            </div>
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <p><strong>Tipo de Projeto:</strong> {{ $project->typeProject->name }}</p>
                            </div>
                        </div>
                        @if($project->institution)
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <p><strong>Institutição:</strong> {{ $project->institution->name }}</p>
                            </div>
                        </div>
                        @endif
                        @if($project->course)
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <p><strong>Curso:</strong> {{ $project->course->name }}</p>
                            </div>
                        </div>
                        @endif
                        @if($project->tags->count() > 0)
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <p><strong>Tags: </strong>
                                @foreach($project->tags()->get() as $tag)
                                <span class="badge badge-primary">{{ $tag->name }}</span>
                                @endforeach
                                </p>
                            </div>
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <p><a href="/storage/annexes/{{ $project->annex }}" target="_blank" class="btn btn-primary"><strong>Download do Projeto</strong></a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    <script>


    </script>
@endsection
