@extends('layouts.app')

@section('content')
<div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h6>Precisamos saber se você é professor de verdade.</h6>
                    </div>
                    <div class="card-body">
                        <form action="/teacher-requests/{{ $request->id }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="card mb-3">
                                        <img class="card-img-top" src="{{ '/storage/documents/' . $request->document }}" alt="Card image cap">
                                        <div class="card-body">
                                            <h4 class="card-title">Nome: {{ $request->user->name }}</h4>
                                            <p class="card-text">CPF: {{ $request->cpf }}</p>
                                            <p class="card-text"><small class="text-muted">Nº de Registro: {{ $request->registry }}</small></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-12">
                                    <div class="form-check form-check-radio">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="2" >
                                            Aprovar
                                            <span class="circle">
                                                <span class="check"></span>
                                            </span>
                                        </label>
                                    </div>
                                    <div class="form-check form-check-radio">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="status" id="exampleRadios2" value="3" checked>
                                            Negar
                                            <span class="circle">
                                                <span class="check"></span>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-success" type="submit">Enviar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
      </div>
@endsection

@section('styles')
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
<script>

    $(document).ready(function(){
		$("input[name=cpf]").mask("999.999.999-99");
	});

</script>
@endsection
