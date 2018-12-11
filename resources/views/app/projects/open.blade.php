@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header card-header-warning card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">place</i>
                </div>
                    <p class="card-category">Listas de Tarefa</p>
                    <h3 class="card-title">{{ count($project->todolists) }}
                    </h3>
            </div>
            <div class="card-footer">
                    <div class="stats">
                        <a href="/projects/{{ $project->id }}/todolists">Ver</a>
                    </div>
                </div>
            </div>
        </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-header card-header-success card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">feedback</i>
                </div>
                <p class="card-category">Checkpoints</p>
                <h3 class="card-title">{{ $project->checkpoints()->count() }}</h3>
              </div>
              <div class="card-footer">
                <div class="stats">
                  <a href="/projects/{{ $project->id }}/checkpoints">Ver</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-header card-header-danger card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">folder_open</i>
                </div>
                <p class="card-category">Arquivos</p>
                <h3 class="card-title">{{ $project->checkpoints()->count() }}</h3>
              </div>
              <div class="card-footer">
                <div class="stats">
                  <a href="/projects/{{ $project->id }}/documents/">Ver</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-header card-header-info card-header-icon">
                <div class="card-icon">
                    <i class="material-icons">hourglass_empty</i>
                </div>
                <p class="card-category">Prazo</p>
                <h3 class="card-title">{{ (new DateTime())->diff(date_create($project->deadline))->d }} Dias</h3>
              </div>
              <div class="card-footer">
                <div class="stats">
                  <small>Organize seus horários</small>
                </div>
              </div>
            </div>
          </div>
    </div>
    <div class="row">
      <div class="col-lg-6 col-md-12">
        <div class="card">
          <div class="card-header card-header-tabs card-header-primary">
            <div class="nav-tabs-navigation">
              <div class="nav-tabs-wrapper">
                <span class="nav-tabs-title">Tarefas:</span>
                <ul class="nav nav-tabs" data-tabs="tabs">
                  <li class="nav-item">
                    <a class="nav-link active" href="#inprogress" data-toggle="tab">
                      <i class="material-icons">hourglass_empty</i> Em andamento
                      <div class="ripple-container"></div>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#completed" data-toggle="tab">
                      <i class="material-icons">done_all</i> Concluídas
                      <div class="ripple-container"></div>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="tab-content">
              <div class="tab-pane active" id="inprogress">
                <table class="table">
                  <tbody>
                        @if (count($project->todolists->where('status', 0)) > 0)
                            @forelse($project->todolists->where('status', 0) as $todolist)
                                @forelse ($todolist->tasks->where('status', 0) as $task)
                                    <tr id="task-{{ $task->id }}">
                                        <td>
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                <input class="form-check-input" type="checkbox" onclick="completeTask({{ $task->id }})">
                                                <span class="form-check-sign">
                                                    <span class="check"></span>
                                                </span>
                                                </label>
                                            </div>
                                        </td>
                                        <td>{{ $task->description }}</td>
                                    </tr>
                                    @empty
                                    <tr id="finished">
                                        <td>Acesse essa <a href="/projects/{{ $project->id }}/todolists">página</a> para criar um novo checkpoint.</td>
                                    </tr>
                                @endforelse
                                @empty
                            @endforelse
                        @else
                        <tr id="finished">
                                <td>Acesse essa <a href="/projects/{{ $project->id }}/todolists">página</a> para criar uma nova lista.</td>
                            </tr>
                        @endif
                  </tbody>
                </table>
              </div>
              <div class="tab-pane" id="completed">
                <table class="table">
                  <tbody>
                    @if (count($project->todolists->where('status', 0)) > 0)
                        @foreach ($project->todolists->where('status', 0) as $todolist)
                        @foreach ($todolist->tasks->where('status', 1) as $task)
                        <tr id="taskc-{{ $task->id }}">
                            <td>
                                <div class="form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" onclick="undoTask({{ $task->id }});" type="checkbox" checked>
                                    <span class="form-check-sign">
                                    <span class="check"></span>
                                    </span>
                                </label>
                                </div>
                            </td>
                            <td>{{ $task->description }}</td>
                        </tr>
                        @endforeach

                        @endforeach
                    @endif
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-12">
        <div class="card">
          <div class="card-header card-header-warning">
            <h4 class="card-title">Integrantes</h4>
            <p class="card-category">Integrantes, cargos e contribuições</p>
          </div>
          <div class="card-body table-responsive">
            <table class="table table-hover">
              <thead class="text-warning">
                <tr>
                <th>Name</th>
                <th>Cargo</th>
              </tr></thead>
              <tbody>
                  @if($teacher)
                      <tr>
                          <td>{{ $teacher->name }}</td>
                          <td>Orientador</td>
                      </tr>
                  @endif

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
</div>
      {{-- MODAL CHECKPOINT --}}
<div class="modal fade" id="modal-checkpoint" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-signup" role="document">
              <div class="modal-content">
                <div class="card card-signup card-plain">
                  <div class="modal-header">
                    <h5 class="modal-title card-title">Salvar Checkpoint</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="material-icons">clear</i>
                    </button>
                  </div>
                    <form id="modalFormCheckpoint" action="/projects/{{ $project->id }}/checkpoints" method="post" enctype="multipart/form-data">
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
                                    @foreach ($project->todolists->where('status', 2) as $todolist)
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
          </div>
@endsection

@section('scripts')
      <script>

          $(document).ready(function () {
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

          function undoTask(id) {
            $.ajax({
            method: "POST",
            url: "/undo-task",
            data: {
                task_id: id,
                '_token': "{{ csrf_token() }}"
            },
            success: function (data){

                $(`#taskc-${id}`).remove();
                $('#finished').remove();
                $('div#inprogress > table > tbody').append(`
                    <tr id="task-${ data.id }">
                        <td>
                            <div class="form-check">
                                <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" onclick="completeTask(${ data.id })">
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                                </label>
                            </div>
                        </td>
                        <td>${ data.description }</td>
                    </tr>
                `);
            }
            });
          }

          function completeTask(id) {
            $.ajax({
            method: "POST",
            url: "/complete-task",
            data: {
                task_id: id,
                '_token': "{{ csrf_token() }}"
            },
            success: function (data){
                $(`#task-${id}`).remove();
                $('div#completed > table > tbody').prepend(`
                    <tr id="taskc-${data.task.id}">
                        <td>
                            <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" onclick="undoTask(${data.task.id})" checked>
                                <span class="form-check-sign">
                                <span class="check"></span>
                                </span>
                            </label>
                            </div>
                        </td>
                        <td>${ data.task.description }</td>
                    </tr>
                `);

                if (data.finished == true) {
                console.log(data.finished)
                    $('div#inprogress > table > tbody').append(`
                    <tr id="finished">
                        <td>Acesse essa <a href="/projects/{{ $project->id }}/todolists">página</a> para criar um checkpoint</td>
                    </tr>
                `);
                }
                }
            });
          }

          function deleteTask(id) {
              $.ajax({
                  method: "POST",
                  url: "/delete-task",
                  data: {
                      task_id: id,
                      '_token': "{{ csrf_token() }}"
                  },
                  success: function (data) {
                      $(`#task-${id}`).remove();

                      if (data.finished == true) {
                            $('div#inprogress > table > tbody').append(`
                            <tr id="finished">
                                <td>Acesse essa <a href="/projects/{{ $project->id }}/todolists">página</a> para criar um checkpoint</td>
                            </tr>
                        `);
                        }
                  }
              });
          }
      </script>
@endsection
