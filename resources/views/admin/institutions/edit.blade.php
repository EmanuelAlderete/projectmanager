@extends('layouts.app') 
@section('content')
<div class="container-fluid">
    <div class="row">
        <a href="/institutions"><button class="btn btn-primary btn-md"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></button></a>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
            <form method="post" action="/institutions/{{ $institution->id }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="exampleFormControlInput1">Nome</label>
                    <input type="text" name="name" class="form-control" id="exampleFormControlInput1" value="{{ $institution->name }}" placeholder="USP - Universidade de São Paulo" required>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Descrição</label>
                    <textarea class="form-control" name="about" id="exampleFormControlTextarea1" placeholder="Criada há muitos anos atrás.." rows="3" required>{{ $institution->about }}</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Endereço</label>
                    <textarea class="form-control" name="address" id="exampleFormControlTextarea1" placeholder="Estuda as leis" rows="3" required>{{ $institution->address }}</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Cursos</label>
                    <select class="form-control" name="courses[]" id="exampleFormControlSelect1" multiple>
                        @forelse($courses as $course)
                        <option value="{{ $course->id }}" {{ $institution->courses->contains($course) ? 'selected' : '' }}>{{ $course->name }}</option>
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