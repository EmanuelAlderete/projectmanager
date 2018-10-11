@extends('layouts.admin') 
@section('content')
<div class="container-fluid">
    <div class="row">
        <a href="/ideas"><button class="btn btn-primary btn-md"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></button></a>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
            <form method="post" action="/ideas/{{ $idea->id }}">
                @csrf @method('PUT')
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Ideia</label>
                    <textarea class="form-control" name="content" id="exampleFormControlTextarea1" placeholder="Criar um robo para varrer" rows="3"
                        required>{{ $idea->content }}</textarea>
                </div>
                <div class="form-group">
                    <label for="inputState">Status</label>
                    <select id="inputState" class="form-control" name="status" required>
                        <option value="0" {{ $idea->status == 0 ? 'selected' : '' }}>Disponível</option>
                        <option value="1" {{ $idea->status == 1 ? 'selected' : '' }}>Em desenvolvimento</option>
                        <option value="2" {{ $idea->status == 2 ? 'selected' : '' }}>Já desenvolvida</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="inputState">Cursos de Interesse</label>
                    <select id="inputState" class="form-control" name="courses[]" multiple>
                    @forelse($courses as $course)
                    <option value="{{ $course->id }}" {{ $idea->courses->contains($course) ? 'selected' : '' }}>{{ $course->name }}</option>
                    @empty
                    Não há registros
                    @endforelse
                </select>
                </div>
                <div class="form-group">
                    <label for="inputState">Areas de Interesse</label>
                    <select id="inputState" class="form-control" name="departments[]" multiple>
                        @forelse($departments as $department)
                        <option value="{{ $department->id }}" {{ $idea->departments->contains($department) ? 'selected' : '' }}>{{ $department->name }}</option>
                        @empty
                        Não há registros
                        @endforelse
                    </select>
                </div>
                <button type="submit" class="btn btn-success btn-md">Atualizar</button>
            </form>
        </div>
    </div>
</div>
@endsection