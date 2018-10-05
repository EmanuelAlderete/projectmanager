@extends('layouts.admin') 
@section('content')
<div class="container-fluid">
    <div class="row">
        <a href="/institutions"><button class="btn btn-primary btn-md"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></button></a>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
            <form method="post" action="/institutions">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlInput1">Nome</label>
                    <input type="text" name="name" class="form-control" id="exampleFormControlInput1" placeholder="USP - Universidade de São Paulo" required>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Descrição</label>
                    <textarea class="form-control" name="about" id="exampleFormControlTextarea1" placeholder="Criada há muitos anos atrás.." rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Endereço</label>
                    <textarea class="form-control" name="address" id="exampleFormControlTextarea1" placeholder="Estuda as leis" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Graduação</label>
                    <select class="form-control" name="courses[]" id="exampleFormControlSelect1" multiple>
                        @forelse($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->name }}</option>
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