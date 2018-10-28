@extends('layouts.app') 
@section('content')
<div class="container-fluid">
    <div class="row">
        <a href="/roles"><button class="btn btn-primary btn-md"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></button></a>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
            <form method="post" action="#">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Nome</label>
                    <input type="text" name="name" class="form-control" id="exampleFormControlInput1" value="{{ $role->name }}" readonly>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Descrição</label>
                    <textarea class="form-control" name="label" id="exampleFormControlTextarea1" placeholder="Deletar usuários" rows="3" readonly>{{ $role->label }}</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Permissões: </label>
                    @forelse($role->permissions as $permission)
                    <span class="badge badge-info">{{ $permission->name }}</span>
                    @empty
                    <span class="badge badge-danger">Não existem registros</span>
                    @endforelse
                </div>
            </form>
        </div>
    </div>
</div>
@endsection