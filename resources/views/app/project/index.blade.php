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
                <p class="card-category">Checkpoints</p>
                <h3 class="card-title">{{ count($project->todolists) }}
                </h3>
              </div>
              <div class="card-footer">
                <div class="stats">
                  <a href="/project/{{ $project->id }}/todolists">Ver</a>
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
                <p class="card-category">Feedbacks</p>
                <h3 class="card-title">15</h3>
              </div>
              <div class="card-footer">
                <div class="stats">
                  <a href="#pablo">Ver</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-header card-header-danger card-header-icon">
                <div class="card-icon">
                  <i class="material-icons">info_outline</i>
                </div>
                <p class="card-category">Sugestões</p>
                <h3 class="card-title">75</h3>
              </div>
              <div class="card-footer">
                <div class="stats">
                  <a href="#pablo">Ver</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
              <div class="card-header card-header-info card-header-icon">
                <div class="card-icon">
                  <i class="fa fa-twitter"></i>
                </div>
                <p class="card-category">Followers</p>
                <h3 class="card-title">+245</h3>
              </div>
              <div class="card-footer">
                <div class="stats">
                  <a href="#pablo">Ver</a>
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
                                @foreach ($project->todolists->where('status', 0) as $todolist)
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
                                            <td class="td-actions text-right">
                                                <button type="button" id="delete" onclick="deleteTask({{ $task->id }});" rel="tooltip" class="btn btn-danger btn-link btn-sm">
                                                <i class="material-icons">close</i>
                                                </button>
                                            </td>
                                        </tr>
                                        @empty
                                        @endforelse
                            @endforeach
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
                    <tr><th>ID</th>
                    <th>Name</th>
                    <th>Cargo</th>
                    <th>Contribuições</th>
                  </tr></thead>
                  <tbody>
                    <tr>
                      <td>1</td>
                      <td>Dakota Rice</td>
                      <td>$36,738</td>
                      <td>Niger</td>
                    </tr>
                    <tr>
                      <td>2</td>
                      <td>Minerva Hooper</td>
                      <td>$23,789</td>
                      <td>Curaçao</td>
                    </tr>
                    <tr>
                      <td>3</td>
                      <td>Sage Rodriguez</td>
                      <td>$56,142</td>
                      <td>Netherlands</td>
                    </tr>
                    <tr>
                      <td>4</td>
                      <td>Philip Chaney</td>
                      <td>$38,735</td>
                      <td>Korea, South</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection

@section('scripts')
      <script>

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
                        <td class="td-actions text-right">
                            <button type="button" onclick="deleteTask(${data.id})" rel="tooltip" class="btn btn-danger btn-link btn-sm">
                            <i class="material-icons">close</i>
                            </button>
                        </td>
                    </tr>
                `);
                console.log(data);
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
                console.log(data);
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

                      if (data.checkpoint_ended) {
                        $('div#inprogress > table > tbody').append(`

                            <tr>
                                <a class="btn btn-round btn-primary">Novo Checkpoint</a>
                            </tr>

                        `);
                      }
                  }
              });
          }



      </script>
@endsection
