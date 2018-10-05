@extends('layouts.admin') 
@section('content')
<div class="container-fluid">
    <div class="row">
        <a href="/departments"><button class="btn btn-primary btn-md"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></button></a>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
            <form method="post" action="/departments/{{ $department->id }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="exampleFormControlInput1">Nome</label>
                    <input type="text" name="name" class="form-control" value="{{ $department->name }}" id="exampleFormControlInput1" placeholder="Turismo" required>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Descrição</label>
                    <textarea class="form-control" name="label" id="exampleFormControlTextarea1" placeholder="Área relacionda ao turismo" rows="3" required>{{ $department->label }}</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Ícone - FontAwesome 5.3.1</label>
                    <input type="text" name="icon" class="form-control" value="{{ $department->icon }}" id="exampleFormControlInput1" placeholder='<i class="fas fa-atom"></i>' required>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Área Principal</label>
                    <br>
                    <div class="form-check form-check-radio form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="main" id="inlineRadio1" value="0" {{ $department->main_department == 0 ? 'checked' : '' }}> Nenhum
                            <span class="circle">
                                <span class="check"></span>
                            </span>
                        </label>
                    </div>
                    <div class="form-check form-check-radio form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="main" id="inlineRadio1" value="1" {{ $department->main_department == 1 ? 'checked' : '' }}> Exatas
                            <span class="circle">
                                <span class="check"></span>
                            </span>
                        </label>
                    </div>
                    <div class="form-check form-check-radio form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="main" id="inlineRadio2" value="2" {{ $department->main_department == 2 ? 'checked' : '' }}> Humanas
                            <span class="circle">
                                <span class="check"></span>
                            </span>
                        </label>
                    </div>
                    <div class="form-check form-check-radio form-check-inline">
                        <label class="form-check-label">
                            <input class="form-check-input" type="radio" name="main" id="inlineRadio3" value="3" {{ $department->main_department == 3 ? 'checked' : '' }}> Biológicas
                            <span class="circle">
                                <span class="check"></span>
                            </span>
                        </label>
                    </div>
                </div>    
                <button type="submit" class="btn btn-success btn-md">Cadastrar</button>
            </form>
        </div>
    </div>
</div>
@endsection