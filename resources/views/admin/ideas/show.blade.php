@extends('layouts.admin') 
@section('content')
<div class="container-fluid">
    <div class="row">
        <a href="/ideas"><button class="btn btn-primary btn-md"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></button></a>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
            <form method="post" action="#">
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Ideia</label>
                    <textarea class="form-control" name="label" id="exampleFormControlTextarea1" placeholder="Deletar usuários" rows="3" readonly>{{ $idea->content }}</textarea>
                </div>
                <div class="form-group">
                    <label for="">Status: </label>
                    @switch($idea->status)
                        @case(0)
                        <span class="badge badge-success">Disponível</span>
                            @break
                        @case(1)
                        <span class="badge badge-info">Em Desenvolvimento</span>
                            @break
                        @case(2)
                        <span class="badge badge-warning">Já desenvolvida</span>
                        @break
                        @default
                            
                    @endswitch
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Cursos de Interesse: </label>
                    @forelse($idea->courses as $course)
                    <span class="badge badge-info">{{ $course->name }}</span>
                    @empty
                    <span class="badge badge-danger">Não existem registros</span>
                    @endforelse
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Áreas de Interesse: </label>
                    @forelse($idea->departments as $department)
                    <span class="badge badge-info">{{ $department->name }}</span>
                    @empty
                    <span class="badge badge-danger">Não existem registros</span>
                    @endforelse
                </div>
            </form>
        </div>
    </div>
</div>
@endsection