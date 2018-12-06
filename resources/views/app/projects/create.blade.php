@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-6">
                <form action="/projects" method="post" id="form">
                    <div class="card step step1 d-none">
                        <div class="card-header card-header-primary">
                            <h4>1º Passo - Informações Básicas</h4>
                        </div>
                        <div class="card-body">
                                @csrf
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
                                <button class="btn btn-success" type="button" onclick="callstep('step2');">Seguir</button>
                        </div>
                    </div>
                    <div class="card step step2 d-none">
                        <div class="card-header card-header-primary">
                            <h4>2º Passo - Características do Projeto</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-gruop">
                                <label for="subject">Assunto</label>
                                <input type="text" class="form-control" name="subject" id="subject" required>
                            </div>
                            <div class="form-group">
                                <label for="">Você tem algum professor cadastrado orientando você?</label>
                                <br>
                                <div class="form-check form-check-radio form-check-inline">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="teacher" id="noTeacher" value="false" checked> Não
                                        <span class="circle">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                    </div>
                                    <div class="form-check form-check-radio form-check-inline">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="teacher" id="teacher" value="true"> Sim
                                        <span class="circle">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                    </div>
                                    <input type="text" class="form-control d-none" id="input_id_teacher" placeholder="#121554" name="public_teacher_id">
                            </div>
                            <div class="form-group">
                                    <label for="tags">Palavras-chave</label>
                                    <small id="emailHelp" class="form-text text-muted">* Obrigatório</small>
                                    <input type="text" class="form-control" id="tags" name="tags" data-role="tagsinput" required>
                                </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-dark" type="button" onclick="callstep('step1');">Voltar</button>
                            <button class="btn btn-success" type="button" onclick="callstep('step3');">Seguir</button>
                        </div>
                    </div>
                    <div class="card step step3 d-none">
                            <div class="card-header card-header-primary">
                                <h4>3º Passo - Datas e prazos</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-gruop">
                                    <label for="deadline">Data de entrega</label>
                                    <input type="date" id="deadline" name="deadline" class="form-control" min="{{ date('Y-m-d') }}" required>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-dark" type="button" onclick="callstep('step2');">Voltar</button>
                                <button class="btn btn-success" type="button" onclick="submit();">Concluir</button>
                            </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@endsection
@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
        // Transição entre steps
        function callstep(step) {

            $('.step').fadeOut(250);
            $('.' + step).delay(250).fadeIn(250);
        };

        function submit() {
            $('#form').submit();
        }


        $(document).ready(function(){
            $('.date').mask('00/00/0000');
            $('.step').hide();
            $('.step').removeClass('d-none');
            $('.step1').fadeIn(250);

            // ID professor
            $('#teacher').change(function() {
                if(this.checked == true){
                    $('#input_id_teacher').removeClass('d-none');
                    $('#input_id_teacher').prop('required',true);
                }
            });

            $('#noTeacher').change(function() {
                if(this.checked == true){
                    $('#input_id_teacher').addClass('d-none');
                    $('#input_id_teacher').prop('required',false);
                }
            });

            // Setup Select2
            $('#courses').select2();
        });
    </script>
@endsection
