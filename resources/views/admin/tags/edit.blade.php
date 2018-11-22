@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <a href="/tags"><button class="btn btn-primary btn-md"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></button></a>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
            <form method="post" action="/tags/{{ $tag->id }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="exampleFormControlInput1">Nome</label>
                    <input type="text" name="name" class="form-control" id="exampleFormControlInput1" value="{{ $tag->name }}">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Descrição</label>
                    <select name="departments[]" id="" multiple class="form-control">
                        @foreach ($tag->departments as $department)
                            <option value="{{ $department->id }}" {{ $tag->departments->contains($department) ? 'selected' : '' }}>{{ $department->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-success btn-md">Cadastrar</button>
            </form>
        </div>
    </div>
</div>
@endsection
