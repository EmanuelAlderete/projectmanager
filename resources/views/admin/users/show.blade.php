@extends('layouts.app') 
@section('content')
<div class="container-fluid">
    <div class="row">
        <a href="/users"><button class="btn btn-primary btn-md"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></button></a>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
            <form method="post" action="#">
                <div class="row">
                    <div class="col">
                        <label for="exampleFormControlInput1">Nome</label>
                        <input type="text" name="name" class="form-control" id="exampleFormControlInput1" value="{{ $user->name }}" readonly>
                    </div>
                    <div class="col">
                        <label for="exampleFormControlInput1">E-mail</label>
                        <input type="email" name="email" class="form-control" id="exampleFormControlInput1" value="{{ $user->email }}" readonly>
                    </div>
                </div>
                <div class="row">
                    @if ($user->teacher != 0)
                    <div class="col">
                        <label for="exampleFormControlInput1">Professor:</label>
                        <input type="email" name="email" class="form-control" id="exampleFormControlInput1" value="{{ $user->registry }}" readonly>
                    </div>

                    @endif @if($user->gender >= 0)
                    <div class="col">
                        <label for="exampleFormControlInput1">Sexo:</label> @switch($user->gender) @case(0)
                        <div class="form-check form-check-radio">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked readonly>
                                Masculino
                                <span class="circle">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>
                        @break @case(1)
                        <div class="form-check form-check-radio">
                            <label class="form-check-label">
                                <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                                Feminino
                                <span class="circle">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>
                        @break @endswitch
                    </div>
                    @endif
                </div>

                <div class="row">
                    <div class="form-group">
                        <label for="">Cargos: </label>
                        @foreach($user->roles as $role)
                            <span class="badge badge-dark">{{ $role->name }}</span>
                        @endforeach
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection