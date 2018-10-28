@extends('layouts.app') 
@section('content')
<div class="container-fluid">
    <div class="row">
        <a href="/permissions"><button class="btn btn-primary btn-md"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></button></a>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
            <form method="post" action="/roles">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlInput1">Nome</label>
                    <input type="text" name="name" class="form-control" id="exampleFormControlInput1" placeholder="Administrador" required>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Descrição</label>
                    <textarea class="form-control" name="label" id="exampleFormControlTextarea1" placeholder="Administra funções básicas do sistema" rows="3" required></textarea>
                </div>
                <div class="form-group">
                <label for="inputState">Permissões</label>
                <select id="inputState" class="form-control" name="permissions[]" multiple required>
                    @forelse($permissions as $permission)
                    <option value="{{ $permission->id }}">{{ $permission->name }}</option>
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