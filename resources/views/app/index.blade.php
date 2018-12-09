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

                <h4 class="card-title">{{ Auth::user()->name }} - {{ Auth::user()->public_id }}</h4>
                <p class="card-description">
                  {{ Auth::user()->bio }}
                </p>

                <a href="/account/edit" class="btn btn-primary btn-round">Editar Perfil</a>
                <a href="/projects" class="btn btn-primary btn-round">Meus Projetos</a>
              </div>
            </div>
          </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-7">
                <div class="card">
                    <div class="card-header card-header-primary">
                        Publique sua ideia <i class="fas fa-lightbulb"></i>
                    </div>
                    <div class="card-body">
                        <form action="/ideas" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                <div class="form-group">
                                    <textarea style="resize:none;border-bottom:none;" minlength="25" maxlength="1000" name="content" id="content" rows="5" placeholder="Descreva sua ideia" class="form-control" required></textarea>
                                </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="tags">Palavras-chave</label>
                                        <small id="emailHelp" class="form-text text-muted">* Obrigatório</small>
                                        <input type="text" class="form-control" id="tags" name="tags" data-role="tagsinput" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <button style="width:100%" class="btn btn-lg btn-primary" type="submit">Publicar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-6">
                @foreach ($ideas as $idea)
                    <div class="card">
                        <div class="card-header">
                            <p>{{ ucwords($idea->user->name) }}</p>
                        </div>
                        <div class="card-body">
                            <p>{{ $idea->content }}</p>
                        </div>
                        <div class="card-footer">
                            <button type="button" id="like-{{ $idea->id }}" onclick="likeidea({{ $idea->id }});" class="btn btn-danger btn-sm"><i class="far fa-heart {{ Auth::user()->verifyLike($idea->id) ? 'd-none' : '' }}"></i><i class="fas fa-heart {{ Auth::user()->verifyLike($idea->id) ? '' : 'd-none' }}"></i> Curtir</button>
                            <small>{{ count($idea->likes) }} Likes - Publicado em {{ $idea->created_at->format('d M Y') }}</small>
                            <a href="/ideas/{{ $idea->id }}" class="btn btn-dark btn-sm">Ver</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
      <script>

        $(document).ready(function () {

            // SetupSelect2
            $('.select2-js').select2();

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

{{-- Like Scripts --}}
<script>

    function likeidea(id) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({

           type:'post',
           url:'/like',
           data: {
               idea_id: id
            },

           success:function(result){
              $('#like-' + id + ' i').toggleClass('d-none');
           }
        });


    }

</script>

@endsection
