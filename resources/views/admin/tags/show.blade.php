@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <a href="/tags"><button class="btn btn-primary btn-md"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></button></a>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
            <form method="post" action="#">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Nome</label>
                    <input type="text" name="name" class="form-control" id="exampleFormControlInput1" value="{{ $tag->name }}" readonly>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Áreas: </label>
                    @foreach ($tag->departments as $department)
                        <span class="badge badge-pill badge-primary">{{ $department->name }}</span>
                    @endforeach
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
