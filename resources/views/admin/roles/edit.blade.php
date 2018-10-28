@extends('layouts.app') 
@section('content')
<div class="container-fluid">
    <div class="row">
        <a href="/roles"><button class="btn btn-primary btn-md"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></button></a>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
            <form method="post" action="/roles/{{ $role->id }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="exampleFormControlInput1">Nome</label>
                    <input type="text" name="name" class="form-control" id="exampleFormControlInput1" value="{{ $role->name }}">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Descrição</label>
                    <textarea class="form-control" name="label" id="exampleFormControlTextarea1" placeholder="Deletar usuários" rows="3">{{ $role->label }}</textarea>
                </div>
                <select id="inputState" class="form-control" name="permissions[]" multiple required>
                    @forelse($permissions as $permission)
                    <option value="{{ $permission->id }}" {{ $role->permissions->contains($permission) ? 'selected' : '' }}>{{ $permission->name }}</option>
                    @empty
                    Não há registros
                    @endforelse
                </select>
                <button type="submit" class="btn btn-success btn-md">Atualizar</button>
            </form>
        </div>
    </div>
</div>
@endsection