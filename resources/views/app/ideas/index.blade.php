@extends('layouts.app')


@section('content')
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-6">
            <div class="card">
                <div class="card-body">
                    <form action="/ideas" method="POST">
                        @csrf
                        <div class="row">
                           <div class="col-12">
                            <div class="form-group">
                                <label for="content">Sua Ideia <i class="fas fa-lightbulb"></i></label>
                                <textarea style="resize:none;border-bottom:none;" minlength="25" maxlength="1000" name="content" id="content" rows="5" placeholder="Descreva sua ideia" class="form-control" required></textarea>
                            </div>
                           </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-6">
                                <div class="form-group">
                                    <label for="">Cursos <i class="fas fa-graduation-cap"></i></label>
                                    <select name="courses[]" id="courses" class="form-control" multiple>
                                        @foreach ($courses as $course)
                                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                                        @endforeach
                                    </select>
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
@endsection

@section('scripts')

@endsection
