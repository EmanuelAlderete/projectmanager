@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-5 search-area">
            <form action="/search" method="get" class="form-search" id="form-text">
                <input type="search" name="q" placeholder="Pesquise algo..." autofocus>
                <button type="button" onclick="preventDefault();"><i class="fas fa-search"></i></button> 
                <button type="button" id="filters-toggle"><i class="fas fa-filter"></i></button>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-12">
           <div class="filters">
                    <div class="row">
                        <div class="col-sm-12 col-md-4 col-lg-4">
                            <label for="">Áreas:</label>
                            <select name="areas[]" class="form-control select2" id="" multiple>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-4">
                            <label for="">Cursos:</label>
                            <select name="courses[]" class="form-control select2" id="" multiple>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-4 col-lg-4">
                            <label for="">Status:</label>
                            <select name="status" class="form-control" id="">
                                <option value="0">Disponível</option>
                                <option value="1">Em Andamento</option>
                                <option value="2">Concluído</option>
                            </select>
                        </div>
                    </div>
                </form>
           </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
     $('#filters-toggle').on('click', function() {
        $('div.filters').toggleClass('hide');
    });

    $(document).ready(function (event) {
        document.preventDefault();
        $('.select2').select2();
    })
    </script>
@endsection