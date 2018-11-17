@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <a href="/type-projects"><button class="btn btn-primary btn-md"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></button></a>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
            <form method="post" action="/type-projects/{{ $type->id }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="exampleFormControlInput1">Nome</label>
                    <input type="text" name="name" class="form-control" id="exampleFormControlInput1" value="{{ $type->name }}">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Descrição</label>
                    <textarea class="form-control" name="description" id="exampleFormControlTextarea1" placeholder="Deletar usuários" rows="3">{{ $type->description }}</textarea>
                </div>
                <button type="submit" class="btn btn-success btn-md">Salvar</button>
            </form>
        </div>
    </div>
</div>
@endsection
