@extends('layouts.app') 
@section('content')
<div class="container-fluid">
    <div class="row">
        <a href="/courses"><button class="btn btn-primary btn-md"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></button></a>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
            <form method="post" action="#">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Nome</label>
                    <input type="text" name="name" class="form-control" id="exampleFormControlInput1" value="{{ $course->name }}" readonly>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Descrição</label>
                    <textarea class="form-control" name="label" id="exampleFormControlTextarea1" placeholder="Deletar usuários" rows="3" readonly>{{ $course->label }}</textarea>
                </div>
                <div class="form-group">
                    <label for="">Graduação: </label>
                    <span class="badge badge-success">{{ $course->degree->name }}</span>
                </div>
                <div class="form-group">
                    <label for="">Área: </label>
                    @if($course->area == 1)
                    <span class="badge badge-success">Exatas</span>
                        @elseif($course->area == 2)
                        <span class="badge badge-success">Humanas</span>
                            @else
                            <span class="badge badge-success">Biologicas</span>
                        @endif
                </div>
            </form>
        </div>
    </div>
</div>
@endsection