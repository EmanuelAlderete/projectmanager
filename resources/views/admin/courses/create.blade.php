@extends('layouts.admin') 
@section('content')
<div class="container-fluid">
    <div class="row">
        <a href="/courses"><button class="btn btn-primary btn-md"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></button></a>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
            <form method="post" action="/courses">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlInput1">Nome</label>
                    <input type="text" name="name" class="form-control" id="exampleFormControlInput1" placeholder="Direito" required>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Descrição</label>
                    <textarea class="form-control" name="label" id="exampleFormControlTextarea1" placeholder="Estuda as leis" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Ícone - FontAwesome 5.3.1</label>
                    <input type="text" name="icon" class="form-control" id="exampleFormControlInput1" placeholder='<i class="fas fa-atom"></i>' required>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Graduação</label>
                    <select class="form-control" name="degree" id="exampleFormControlSelect1">
                        @forelse($degrees as $degree)
                        <option value="{{ $degree->id }}">{{ $degree->name }}</option>
                        @empty
                        Não há registros
                        @endforelse
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Área</label>
                    <select class="form-control" name="department" id="exampleFormControlSelect1">
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