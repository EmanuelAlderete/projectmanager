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
                        <form action="/teacher-requests" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                <div class="col-sm-12 col-md-4">
                                    <label for="cpf">CPF</label>
                                    <input type="text" class="form-control" name="cpf" required>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label for="document">Foto do Documento</label>
                                    <input type="file" name="document" class="form-control" required>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label for="registry">Nº de Registro</label>
                                    <input type="text" class="form-control" name="registry" required>
                                </div>
                            </div>
                            <div class="form-row">
                            </div>
                            <button class="btn btn-success" type="submit">Enviar Solicitação</button>
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
