@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-5 search-area">
            <form action="/search" method="get" class="form-search" id="form-text">
                <input type="hidden" id="filter" name="filter" value="{{ $filter }}">
                <input type="search" name="q" id="q" value="{{ $request->q }}" placeholder="Pesquise algo..." autofocus>
                <button type="submit" id="submit-btn"><i class="fas fa-search"></i></button> 
                <button type="button" id="filters-toggle"><i class="fas fa-filter"></i></button>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-12">
           <div class="filters invisible">
                    <div class="row">
                        <div class="col-sm-12 col-md-4 col-lg-4">
                            <label for="">Áreas:</label>
                            <select name="departments[]" class="form-control select2" id="departments" multiple>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}" {{ $request->departments ? in_array($department->id,  $request->departments) ? 'selected' : '' : '' }}>{{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-4">
                            <label for="">Cursos:</label>
                            <select name="courses[]" class="form-control select2" id="courses" multiple>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}" {{ $request->courses ? in_array($course->id,  $request->courses) ? 'selected' : '' : '' }}>{{ $course->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-4">
                            <label for="">Status:</label>
                            <select name="status[]" class="form-control select2" id="status">
                                <option value="0" {{ $request->status ? in_array(0,  $request->status) ? 'selected' : '' : '' }}>Disponível</option>
                                <option value="1" {{ $request->status ? in_array(1,  $request->status) ? 'selected' : '' : ''}}>Em Andamento</option>
                                <option value="2" {{ $request->status ? in_array(2,  $request->status) ? 'selected' : '' : ''}}>Concluído</option>
                            </select>
                        </div>
                    </div>
                </form>
           </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-8 col-lg-7">
           @forelse ($ideas as $idea)
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
                    <button type="button" class="btn btn-dark btn-sm">Ver</button>
                </div>
               </div>
           @empty
               
           @endforelse
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    
{{-- Filter Scripts --}}
<script>
    if($('#filter').val() ==  'enable') {
        $('div.filters').toggleClass('invisible');
    }

    $('#filters-toggle').on('click', function() {
        $('div.filters').toggleClass('invisible');
    });

    // 
    $(document).ready(function (event) {
        $('.select2').select2();
    })
</script>

{{-- AJAX EXAMPLE --}}
<script type="text/javascript">

    // $("#submit-btn").click(function(e){

    //     e.preventDefault();

    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     });

    //     var q = $("#q").val();

    //     var departments = $("#departments").val();
    //     var courses = $("#courses").val();
    //     var status = $("#status").val();

    //     console.log(q);
    //     console.log(departments);
    //     console.log(courses);
    //     console.log(status);

    //     $.ajax({

    //        type:'POST',
    //        url:'/search',
    //        data: {
    //            q: q,
    //            departments: departments,
    //            courses: courses,
    //            status: status 
    //         },

    //        success:function(result){
    //           alert(result.success);
    //        }
    //     });
    // });

</script> --}}

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