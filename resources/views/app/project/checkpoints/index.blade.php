@extends('layouts.app')

@section('content')
<div class="container-fluid" id="area">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Novo checkpoint</button>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Criar novo checkpoint</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
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
                <button type="button" onclick="createCheckpoint();" data-dismiss="modal" class="btn btn-primary">Salvar</button>
            </div>
            </div>
        </div>
    </div>
    <div class="row" id="list">
        @forelse ($project->checkpoints as $checkpoint)
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <p> Data de entrega: <strong>{{ date_format(date_create($checkpoint->deadline), "Y/m/d") }}</strong>
                            <small> - {{ $checkpoint->status == 1 ? 'Concluído' : 'Em andamento' }}</small>
                        </p>
                    </div>
                    <div class="card-body">
                        <strong>Descrição:</strong> {{ $checkpoint->description }}
                        <hr>
                        <strong>Tarefas:</strong>
                        <ul class="tasks-list">
                            @forelse ($checkpoint->tasks as $task)
                                <li>{{ $task->description }}</li>
                            @empty
                                <li>Não há tarefas.</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        @empty
        @endforelse
    </div>
</div>
@endsection

@section('scripts')
<script>

    function createCheckpoint() {

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
            url: "checkpoints",
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
                                <p> Data de entrega: <strong>${data.deadline}</strong> - <small>Em andamento</small></p>
                            </div>
                            <div class="card-body">
                                <strong>Descrição:</strong>  ${data.description}
                                <hr>
                                <strong>Tarefas:</strong>
                                <ul class="tasks-list">

                                </ul>
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


    $(document).ready(
    function(){
        $('#button').click(
            function(){
                var toAdd = $('input[name=task]').val();
                if (toAdd != "") {
                    $('ul.todo-list').append('<li class="task-item"><p>' + toAdd + '</p></li>');
                    $('input[name=task]').val("");
                }
            });
        }
    );
    $(document).on('dblclick','li', function(){
            $(this).fadeOut('slow').remove();
        });

</script>
@endsection
