@extends('layouts.app')@extends('layouts.app')

@section('content')
<div class="container-fluid" id="area">
    <a href="/projects/{{ $project->id }}" class="btn btn-primary btn-fab btn-fab-mini btn-round"><i class="material-icons">arrow_back</i></a>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newTodolist">Nova Lista</button>
    <div class="modal fade" id="newTodolist" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Criar nova Lista</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="modalForm" method="post">
                        <div class="form-group">
                            <label for="description">Descrição</label>
                            <textarea name="description" id="description" cols="10" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="deadline">Para quando?</label>
                            <input type="date" name="deadline" id="deadline" class="form-control" min="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="priority">Nível de prioridade?</label>
                            <select name="priority" id="priority" class="form-control">
                                <option value="0">Baixa</option>
                                <option value="1">Média</option>
                                <option value="2">Alta</option>
                            </select>
                        </div>

                        <label for="">Tarefas: </label>
                        <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <a href="#" class="btn btn-success btn-sm" id="button"><i class="fas fa-plus"></i></a>
                            </span>
                        </div>
                        <input type="text" name="task" class="form-control" placeholder="Criar diagramas">
                        </div>
                        <div class="form-group">
                            <div class="card-body">
                                <ul class="todo-list">
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" onclick="createTodolist();" data-dismiss="modal" class="btn btn-primary">Salvar</button>
                </div>
            </div>
        </div>
    </div>

    @if ($project->todolists->where('status', '>', 1)->count() > 0)
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newCheckpoint">Novo Checkpoint</button>
    <div class="modal fade" id="newCheckpoint" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Criar novo Checkpoint</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="modalFormCheckpoint" action="/checkpoints" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="project_id" value="{{ $project->id }}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Título</label>
                            <input type="text" name="title" id="title" class="form-control" maxlength="100" required>
                        </div>
                        <div class="form-group">
                            <label for="message">Mensagem</label>
                            <textarea name="message" id="message" cols="10" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="todolists">Listas de Tarefas</label>
                            <select name="todolists[]" id="todolists" class="form-control" multiple required>
                                @foreach ($project->todolists->where('status', '>', 1) as $todolist)
                                    <option value="{{ $todolist->id }}">{{ $todolist->description }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group form-file-upload form-file-multiple">
                            <input type="file" name="annex" class="inputFileHidden" id="inputFile">
                            <div class="input-group">
                                <input type="text"  class="form-control inputFileVisible inputTrigger" accept="application/pdf, application/zip, application/rar" required placeholder="Arquivo único" onkeypress="return false;">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-fab btn-round btn-primary inputTrigger">
                                        <i class="material-icons">attach_file</i>
                                    </button>
                                </span>
                            </div>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" name="publish" value="1">
                                Desejo tornar esse checkpoint público.
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @else

    @endif

    <div class="row" id="list">
        @forelse ($project->todolists as $todolist)
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <p> Data de entrega: <strong>{{ date_format(date_create($todolist->deadline), "d/m/Y") }}</strong>
                            <small> -
                                @switch($todolist->status)
                                    @case(0)
                                        Em Andamento
                                        @break
                                    @case(1)
                                        Parado
                                        @break
                                    @case(2)
                                        Concluído
                                        @break
                                    @default
                                    Concluído
                                @endswitch
                            </small>
                        </p>

                    </div>
                    <div class="card-body">
                        <strong>Descrição:</strong> {{ $todolist->description }}
                        <hr>
                        <strong>Tarefas:</strong>
                        <ul class="tasks-list">
                            @forelse ($todolist->tasks as $task)
                                @if ($task->status == 1)
                                <li><del>{{ $task->description }}</del></li>
                                @else
                                <li>{{ $task->description }}</li>
                                @endif

                            @empty
                                <li>Não há tarefas.</li>
                            @endforelse
                        </ul>
                    </div>
                    @if ($todolist->status < 2)
                    <div class="card-footer">
                        <button class="btn btn-round btn-primary" onclick="activateTodolist({{ $todolist->id }})">Ativar</button>
                    </div>
                    @endif

                </div>
            </div>
        @empty
        @endforelse
    </div>
</div>
@endsection

@section('scripts')
<script>

    $(document).ready(function () {
        // Add Task UX
        $('#button').click(function () {
            var toAdd = $('input[name=task]').val();
            if (toAdd != "") {
                $('ul.todo-list').append('<li class="task-item" id="task-li"><p>' + toAdd + '</p></li>');
                $('input[name=task]').val("");
            }
        });
        // Remove Task UX
        $(document).on('dblclick','li.task-item', function(){
            $(this).fadeOut('slow').remove();
        });
        // Prevent Submit Form
        $(window).keydown(function(event){
            if(event.keyCode == 13) {
            event.preventDefault();
            return false;
            }
        });
        // Submit Form modalFormCheckpoint
        $('#submitCheckpoint').click(function () {
            $('#modalFormCheckpoint').submit();
        });

        // ======================================
        // INPUT FILE
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
        // ======================================
    });

    function createTodolist() {

        var description = $('#description').val();
        var deadline = $('#deadline').val();
        var priority = $('#priority').val();
        var csrf = "{{ csrf_token() }}";
        var tasks = [];

        $('li.task-item').each(function () {
            tasks.push($(this).text());
            $(this).remove();
        });

        if (description == "" || deadline == "" || priority == "" || !$('ul.todo-list').has('li')) {
            $('div#area').prepend(`
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Opa!</strong> Você deve preencher todos os campos!!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
            `);
        } else {
            $('#description').val("");
            $('#deadline').val("");
            $('#priority').val("");

            $.ajax({
            method: "POST",
            url: "todolists",
            data: {
                description: description,
                deadline: deadline,
                priority: priority,
                tasks: tasks,
                '_token': csrf
            },
            success: function(data) {
                var tasks = data.tasks;
                $('#list').prepend(`
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <p> Data de entrega: <strong>${data.deadline}</strong> - <small>Parado</small></p>
                            </div>
                            <div class="card-body">
                                <strong>Descrição:</strong>  ${data.description}
                                <hr>
                                <strong>Tarefas:</strong>
                                <ul class="tasks-list">

                                </ul>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-round btn-primary" onclick="activateTodolist(${data.id} )">Ativar</button>
                            </div>
                        </div>
                    </div>`
                );

                for (var i = 0; i < tasks.length; i++) {
                    $('ul.tasks-list').first().prepend(`<li>${tasks[i].description}</li>`);
                }
            }
        });
        }
    }

    function activateTodolist(id) {
        $.ajax({
           method: 'post',
           url: '/activate-todolist',
           data: {
               id: id,
               _token: '{{ csrf_token() }}'
           },
           success: function(data) {

           }
        });
    }
</script>
@endsection


@section('content')
<div class="container-fluid" id="area">
    <a href="/projects/{{ $project->id }}" class="btn btn-primary btn-fab btn-fab-mini btn-round"><i class="material-icons">arrow_back</i></a>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newTodolist">Nova Lista</button>
    <div class="modal fade" id="newTodolist" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Criar nova Lista</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="modalForm" method="post">
                        <div class="form-group">
                            <label for="description">Descrição</label>
                            <textarea name="description" id="description" cols="10" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="deadline">Para quando?</label>
                            <input type="date" name="deadline" id="deadline" class="form-control" min="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="priority">Nível de prioridade?</label>
                            <select name="priority" id="priority" class="form-control">
                                <option value="0">Baixa</option>
                                <option value="1">Média</option>
                                <option value="2">Alta</option>
                            </select>
                        </div>

                        <label for="">Tarefas: </label>
                        <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <a href="#" class="btn btn-success btn-sm" id="button"><i class="fas fa-plus"></i></a>
                            </span>
                        </div>
                        <input type="text" name="task" class="form-control" placeholder="Criar diagramas">
                        </div>
                        <div class="form-group">
                            <div class="card-body">
                                <ul class="todo-list">
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" onclick="createTodolist();" data-dismiss="modal" class="btn btn-primary">Salvar</button>
                </div>
            </div>
        </div>
    </div>

    @if ($project->todolists->where('status', '>', 1)->count() > 0)
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newCheckpoint">Novo Checkpoint</button>
    <div class="modal fade" id="newCheckpoint" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Criar novo Checkpoint</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="modalFormCheckpoint" action="/checkpoints" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="project_id" value="{{ $project->id }}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Título</label>
                            <input type="text" name="title" id="title" class="form-control" maxlength="100" required>
                        </div>
                        <div class="form-group">
                            <label for="message">Mensagem</label>
                            <textarea name="message" id="message" cols="10" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="todolists">Listas de Tarefas</label>
                            <select name="todolists[]" id="todolists" class="form-control" multiple required>
                                @foreach ($project->todolists->where('status', '>', 1) as $todolist)
                                    <option value="{{ $todolist->id }}">{{ $todolist->description }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group form-file-upload form-file-multiple">
                            <input type="file" name="annex" class="inputFileHidden" id="inputFile">
                            <div class="input-group">
                                <input type="text"  class="form-control inputFileVisible inputTrigger" accept="application/pdf, application/zip, application/rar" required placeholder="Arquivo único" onkeypress="return false;">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-fab btn-round btn-primary inputTrigger">
                                        <i class="material-icons">attach_file</i>
                                    </button>
                                </span>
                            </div>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" name="publish" value="1">
                                Desejo tornar esse checkpoint público.
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @else

    @endif

    <div class="row" id="list">
        @forelse ($project->todolists as $todolist)
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <p> Data de entrega: <strong>{{ date_format(date_create($todolist->deadline), "d/m/Y") }}</strong>
                            <small> -
                                @switch($todolist->status)
                                    @case(0)
                                        Em Andamento
                                        @break
                                    @case(1)
                                        Parado
                                        @break
                                    @case(2)
                                        Concluído
                                        @break
                                    @default
                                    Concluído
                                @endswitch
                            </small>
                        </p>

                    </div>
                    <div class="card-body">
                        <strong>Descrição:</strong> {{ $todolist->description }}
                        <hr>
                        <strong>Tarefas:</strong>
                        <ul class="tasks-list">
                            @forelse ($todolist->tasks as $task)
                                @if ($task->status == 1)
                                <li><del>{{ $task->description }}</del></li>
                                @else
                                <li>{{ $task->description }}</li>
                                @endif

                            @empty
                                <li>Não há tarefas.</li>
                            @endforelse
                        </ul>
                    </div>
                    @if ($todolist->status < 2)
                    <div class="card-footer">
                        <button class="btn btn-round btn-primary" onclick="activateTodolist({{ $todolist->id }})">Ativar</button>
                    </div>
                    @endif

                </div>
            </div>
        @empty
        @endforelse
    </div>
</div>
@endsection

@section('scripts')
<script>

    $(document).ready(function () {
        // Add Task UX
        $('#button').click(function () {
            var toAdd = $('input[name=task]').val();
            if (toAdd != "") {
                $('ul.todo-list').append('<li class="task-item" id="task-li"><p>' + toAdd + '</p></li>');
                $('input[name=task]').val("");
            }
        });
        // Remove Task UX
        $(document).on('dblclick','li.task-item', function(){
            $(this).fadeOut('slow').remove();
        });
        // Prevent Submit Form
        $(window).keydown(function(event){
            if(event.keyCode == 13) {
            event.preventDefault();
            return false;
            }
        });
        // Submit Form modalFormCheckpoint
        $('#submitCheckpoint').click(function () {
            $('#modalFormCheckpoint').submit();
        });

        // ======================================
        // INPUT FILE
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
        // ======================================
    });

    function createTodolist() {

        var description = $('#description').val();
        var deadline = $('#deadline').val();
        var priority = $('#priority').val();
        var csrf = "{{ csrf_token() }}";
        var tasks = [];

        $('li.task-item').each(function () {
            tasks.push($(this).text());
            $(this).remove();
        });

        if (description == "" || deadline == "" || priority == "" || !$('ul.todo-list').has('li')) {
            $('div#area').prepend(`
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Opa!</strong> Você deve preencher todos os campos!!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
            `);
        } else {
            $('#description').val("");
            $('#deadline').val("");
            $('#priority').val("");

            $.ajax({
            method: "POST",
            url: "todolists",
            data: {
                description: description,
                deadline: deadline,
                priority: priority,
                tasks: tasks,
                '_token': csrf
            },
            success: function(data) {
                var tasks = data.tasks;
                $('#list').prepend(`
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <div class="card">
                            <div class="card-header card-header-primary">
                                <p> Data de entrega: <strong>${data.deadline}</strong> - <small>Parado</small></p>
                            </div>
                            <div class="card-body">
                                <strong>Descrição:</strong>  ${data.description}
                                <hr>
                                <strong>Tarefas:</strong>
                                <ul class="tasks-list">

                                </ul>
                            </div>
                            <div class="card-footer">
                                <button class="btn btn-round btn-primary" onclick="activateTodolist(${data.id} )">Ativar</button>
                            </div>
                        </div>
                    </div>`
                );

                for (var i = 0; i < tasks.length; i++) {
                    $('ul.tasks-list').first().prepend(`<li>${tasks[i].description}</li>`);
                }
            }
        });
        }
    }

    function activateTodolist(id) {
        $.ajax({
           method: 'post',
           url: '/activate-todolist',
           data: {
               id: id,
               _token: '{{ csrf_token() }}'
           },
           success: function(data) {

           }
        });
    }
</script>
@endsection
