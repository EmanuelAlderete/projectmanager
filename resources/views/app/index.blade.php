@extends('layouts.app')

@section('content')
<div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card card-profile card-full-bg" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://images.pexels.com/photos/159657/paint-notebook-brush-pencil-159657.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260') center center no-repeat;background-size: cover;">
              <div class="card-avatar">
                <a href="#pablo">
                  <img class="img" src="../assets/img/faces/marc.jpg">
                </a>
              </div>
              <div class="card-body" style="color: white;">
                <h6 class="card-category text-gray" id="occupation-area" >
                    <div class="form d-none">
                        <input type="text" class="form-control" placeholder="Digíte sua profissão" style="text-align:center;">
                        <button class="btn btn-sm btn-primary btn-round">Salvar</button>
                    </div>
                    @if (!Auth::user()->occupation)
                    <a href="#" id="occupation">Adicione sua profissão</a>
                    @else
                        {{ Auth::user()->occupation }}

                        {{  Auth::user()->course()->count() > 0 ? '- ' . Auth::user()->course->name : '' }}

                        {{ Auth::user()->institution()->count() > 0 ? '- ' . Auth::user()->institution->name : '' }}
                    @endif
                </h6>

                @switch($teacher_status)
                    @case(1)
                        Aguardando Aprovação
                        @break
                    @case(2)
                        Professor Verificado
                        @break
                    @case(3)
                        Pedido Negado
                        @break
                    @default
                    <a href="/teacher-requests/create">Solicitar perfil professor</a>
                @endswitch

                <h4 class="card-title">{{ Auth::user()->name }}</h4>
                <p class="card-description">
                  {{ Auth::user()->bio }}
                </p>

                <a href="/account/edit" class="btn btn-primary btn-round">Editar Perfil</a>
                <a href="/projects" class="btn btn-primary btn-round">Meus Projetos</a>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection

@section('scripts')
      <script>

        $(document).ready(function () {

            $('a#occupation').on('click', function () {
                $(this).hide();
                $('div.form').fadeIn().toggleClass('d-none');
            });

            $('div.form button').on('click', function () {
                $('div.form').toggleClass('d-none');

                if ($('div.form input').val().replace(/ /g,'') != "") {

                    $.ajax({
                        type: 'POST',
                        data: {
                            occupation: $('div.form input').val(),
                            '_token': "{{ csrf_token() }}"
                        },
                        url: '/update-occupation',
                        success: function() {
                            $('#occupation-area').append(`${$('div.form input').val()}`);
                        }
                    });

                } else {
                    $('a#occupation').fadeOut().show();
                }
            });

        });

      </script>
@endsection
