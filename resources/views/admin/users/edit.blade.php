@extends('layouts.admin') 
@section('content')
<div class="container-fluid">
    <div class="row">
        <a href="/users"><button class="btn btn-primary btn-md"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></button></a>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
            <form method="post" action="/users/{{ $user->id }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="exampleFormControlInput1">Nome</label>
                    <input type="text" name="name" class="form-control" id="exampleFormControlInput1" placeholder="Âderson Alves da Silva" value="{{ $user->name }}" required>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">E-mail</label>
                    <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" value="{{ $user->email }}" required>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Insira a nova senha:</label>
                    <input type="password" name="password" class="form-control" minlength="6" id="exampleFormControlInput1">
                    <small id="emailHelp" class="form-text text-muted">Deixe em branco para não alterar.</small>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Cargos</label>
                    <select id="inputState" class="form-control" name="roles[]" multiple required>
                        @forelse($roles as $role)
                        <option value="{{ $role->id }}" {{ $user->roles->contains($role) ? 'selected' : '' }}>{{ $role->name }}</option>
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