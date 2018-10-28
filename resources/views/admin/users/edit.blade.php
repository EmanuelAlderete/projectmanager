@extends('layouts.app') 
@section('content')
<div class="container-fluid">
    <div class="row">
        <a href="/users"><button class="btn btn-primary btn-md"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></button></a>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
            <form method="post" action="/users/{{ $user->id }}">
                @csrf @method('PUT')
                <div class="form-group">
                    <label for="exampleFormControlInput1">Nome</label>
                    <input type="text" name="name" class="form-control" placeholder="Âderson Alves da Silva" value="{{ $user->name }}" required>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">E-mail</label>
                    <input type="email" name="email" class="form-control" placeholder="name@example.com" value="{{ $user->email }}" required>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">Insira a nova senha:</label>
                    <input type="password" name="password" class="form-control" minlength="6">
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
                <div class="row">
                        <div class="col">
                            <label for="">Sexo: </label>
                            <div class="form-check form-check-radio form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="0" {{ $user->gender == 0 ? 'checked' : '' }}>Masculino
                                    <span class="circle">
                                        <span class="check"></span>
                                    </span>
                                </label>
                            </div>
                            <div class="form-check form-check-radio form-check-inline">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="1" {{ $user->gender == 1 ? 'checked' : '' }}>Feminino
                                    <span class="circle">
                                        <span class="check"></span>
                                    </span>
                                </label>
                            </div>  
                        </div>
                        <div class="col">
                            <div class="form-check form-check-inline">
                                <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" id="check-registry" name="teacher" value="true" {{ $user->teacher == 1 ? 'checked' : '' }}> Professor
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                            </div>
                            <input type="text" id="input-registry" name="registry" class="form-control {{ $user->teacher == 0 ? 'hide' : '' }}" placeholder="191951-51" value="{{ $user->registry }}">
                        </div>
                    </div>
                <button type="submit" class="btn btn-success btn-md">Atualizar</button>
            </form>
        </div>
    </div>
</div>
@endsection