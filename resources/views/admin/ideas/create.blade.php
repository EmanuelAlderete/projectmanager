@extends('layouts.admin') 
@section('content')
<div class="container-fluid">
    <div class="row">
        <a href="/ideas"><button class="btn btn-primary btn-md"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></button></a>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
            <form method="post" action="/ideas">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Ideia</label>
                    <textarea class="form-control" name="content" id="exampleFormControlTextarea1" placeholder="Criar um robo para varrer" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label for="inputState">Status</label>
                    <select id="inputState" class="form-control" name="status" required>
                        <option value="0">Disponível</option>
                        <option value="1">Em desenvolvimento</option>
                        <option value="2">Já desenvolvida</option>
                    </select>
                </div>
                <div class="form-group">
                <label for="inputState">Cursos de Interesse</label>
                <select id="inputState" class="form-control" name="courses[]" multiple>
                    @forelse($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                    @empty
                    Não há registros
                    @endforelse
                </select>
                </div>
                <div class="form-group">
                    <label for="inputState">Areas de Interesse</label>
                    <select id="inputState" class="form-control" name="departments[]" multiple>
                        @forelse($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @empty
                        Não há registros
                        @endforelse
                    </select>
                </div>
                <button type="submit" class="btn btn-success btn-md">Cadastrar</button>
            </form>
        </div>
    </div>
</div>
@endsection