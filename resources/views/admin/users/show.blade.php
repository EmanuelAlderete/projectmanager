@extends('layouts.admin') 
@section('content')
<div class="container-fluid">
    <div class="row">
        <a href="/users"><button class="btn btn-primary btn-md"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></button></a>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
            <form method="post" action="#">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Nome</label>
                    <input type="text" name="name" class="form-control" id="exampleFormControlInput1" value="{{ $user->name }}" readonly>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlInput1">E-mail</label>
                    <input type="email" name="email" class="form-control" id="exampleFormControlInput1" value="{{ $user->email }}" readonly>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection