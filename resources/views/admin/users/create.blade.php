@extends('layouts.admin') 
@section('content')
<div class="container-fluid">
    <div class="row">
        <a href="/users"><button class="btn btn-primary btn-md"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></button></a>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
            <form method="post" action="/users">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlInput1">Nome</label>
                    <input type="text" name="name" class="form-control" id="exampleFormControlInput1" placeholder="Âderson Alves da Silva" required>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">E-mail</label>
                    <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" required>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Senha</label>
                    <input type="password" name="password" class="form-control" minlength="6" id="exampleFormControlInput1" required>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Cargos</label>
                    <select id="inputState" class="form-control" name="permissions[]" multiple required>
                        @forelse($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
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