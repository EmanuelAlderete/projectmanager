@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-6">
                <div class="card step step1">
                    <div class="card-header card-header-warning">
                        <h4>1º Passo - Informações Básicas</h4>
                    </div>
                    <div class="card-body">
                        <form action="/projects/start-new-project" method="post">
                            <div class="form-gruop">
                                <label for="title">Título</label>
                                <input type="text" class="form-control" name="title" id="title" required>
                            </div>
                            <div class="form-gruop">
                                <label for="authors">Autores</label>
                                <input type="text" class="form-control" name="authors" id="authors">
                            </div>
                            <div class="form-gruop">
                                <label for="description">Descrição</label>
                                <textarea name="description" id="description" cols="30" rows="5" class="form-control" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="type">Tipo de Projeto</label>
                                <select name="type" id="type" class="form-control">
                                    @foreach ($types as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button class="btn btn-warning" type="button" onclick="callstep('step2');">Seguir</button>
                    </div>
                </div>
                <div class="card step step2">
                        <div class="card-header card-header-danger">
                            <h4>2º Passo - Características do Projeto</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-gruop">
                                <label for="subject">Assunto</label>
                                <input type="text" class="form-control" name="subject" id="subject" required>
                                <br>
                            </div>
                            <label for="">Você tem algum professor orientando você?</label>
                            <div class="form-check form-check-radio form-check-inline">
                                <label class="form-check-label">
                                  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1"> Não
                                  <span class="circle">
                                      <span class="check"></span>
                                  </span>
                                </label>
                              </div>
                              <div class="form-check form-check-radio form-check-inline">
                                <label class="form-check-label">
                                  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"> Sim
                                  <span class="circle">
                                      <span class="check"></span>
                                  </span>
                                </label>
                              </div>
                            <div class="form-gruop">
                                <label for="description">Descrição</label>
                                <textarea name="description" id="description" rows="5" class="form-control" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="type">Tipo de Projeto</label>
                                <select name="type" id="type" class="form-control">
                                    @foreach ($types as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-warning" type="button" onclick="callstep('step1');">Voltar</button>
                            <button class="btn btn-danger" type="button" onclick="callstep('step3');">Seguir</button>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function () {
            $('.step').hide();
            $('.step1').show();
        })


        // Transição entre steps
        function callstep(step) {

            $('.step').fadeOut('fast', function () {
                $('.' + step).fadeIn('fast', function () {});
            });


        }

    </script>
@endsection
