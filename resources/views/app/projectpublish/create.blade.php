@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="card">
                <div class="card-header card-header-primary">
                    Preencha o formulário abaixo para publicar seu projeto em nossa plataforma.
                </div>
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data" action="/publish-project">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="title">Título</label>
                                <input type="text" name="title" class="form-control" id="title" placeholder="Um projeto bacana" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="subtitle">Subtítulo</label>
                                <input type="text" class="form-control" name="subtitle" id="subtitle" placeholder="um projeto que ajuda as pessoas" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="authors">Autores</label>
                            <input type="text" class="form-control" name="authors" id="authors" placeholder="João da Silva e Maria" required>
                        </div>
                        <div class="form-group">
                                <label for="teacher">Orientador</label>
                                <input type="text" class="form-control" id="teacher" name="teacher" placeholder="João da Silva e Maria" required>
                            </div>
                        <div class="form-group">
                            <label for="description">Descrição</label>
                            <textarea name="description" id="description" cols="30" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="tags">Palavras-chave</label>
                            <small id="emailHelp" class="form-text text-muted">* Obrigatório</small>
                            <input type="text" class="form-control" id="tags" name="tags" data-role="tagsinput" required>
                        </div>
                        <div class="form-group">
                            <label for="website">Website</label>
                            <input type="text" name="website" id="website" placeholder="www.meuprojeto.com" class="form-control">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm-12 col-md-4">
                                <label for="type">Selecione o tipo de projeto</label>
                                <select name="type" id="type" class="form-control selectpicker" data-style="btn btn-link">
                                        @foreach ($types as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-12 col-md-4">
                                <label for="institution">Instituição onde foi desenvolvido</label>
                                <select name="institution" id="institution" class="form-control selectpicker" data-style="btn btn-link">
                                        <option>Nenhuma</option>
                                        @foreach ($institutions as $institution)
                                            <option value="{{ $institution->id }}">{{ $institution->name }}</option>
                                        @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-12 col-md-4">
                                    <label for="course">Este projeto foi desenvolvido em qual curso?</label>
                                    <select name="course" id="course" class="form-control selectpicker" data-style="btn btn-link">
                                        <option>Nenhuma</option>
                                        @foreach ($courses as $course)
                                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                        </div>
                        <div class="form-group form-file-upload form-file-multiple">
                            <input type="file" name="annex" class="inputFileHidden" id="inputFile">
                            <div class="input-group">
                                <input type="text"  class="form-control inputFileVisible inputTrigger" accept="application/pdf, application/zip, application/rar" required placeholder="Single File" onkeypress="return false;">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-fab btn-round btn-primary inputTrigger">
                                        <i class="material-icons">attach_file</i>
                                    </button>
                                </span>
                                <small id="emailHelp" class="form-text text-muted">Comprima seus arquivos em .zip ou .rar</small>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar para avaliação</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    <script>

        $(document).ready(function() {

            $('.inputTrigger').on('click', function () {
                $('#inputFile').trigger('click');
                $(this).focusout();
            });

            $('.inputTrigger').on("cut copy paste",function(e) {
                e.preventDefault();
            });

            $('#inputFile').on('change', function () {
                $('input.inputTrigger').val($(this).val().split('\\').pop());
                $(this).focusout();
            });

        });

    </script>
@endsection
