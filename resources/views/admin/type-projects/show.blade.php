@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <a href="/type-projects"><button class="btn btn-primary btn-md"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></button></a>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
            <form method="post" action="#">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Nome</label>
                    <input type="text" name="name" class="form-control" id="exampleFormControlInput1" value="{{ $type->name }}" readonly>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Descrição</label>
                    <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3" readonly>{{ $type->description }}</textarea>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
