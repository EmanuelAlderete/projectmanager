@extends('layouts.app')


@section('content')
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    @foreach ($idea->tags()->get() as $tag)
                        <span class="badge badge-pill badge-warning">{{ $tag->name }}</span>
                    @endforeach
                    <hr>
                </div>
                <div class="card-body">
                    {{ $idea->content }}
                </div>
                <div class="card-footer">
                    <button type="button" id="like-{{ $idea->id }}" onclick="likeidea({{ $idea->id }});" class="btn btn-danger btn-sm"><i class="far fa-heart {{ Auth::user()->verifyLike($idea->id) ? 'd-none' : '' }}"></i><i class="fas fa-heart {{ Auth::user()->verifyLike($idea->id) ? '' : 'd-none' }}"></i> Curtir {{ count($idea->likes) }}</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
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
