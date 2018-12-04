@extends('layouts.app')

@section('content')
<div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h6>Edite seu perfil</h6>
                    </div>
                    <div class="card-body">
                        <form action="/account/update" method="post">
                            @csrf
                            <div class="form-row">
                                <div class="col-sm-12 col-md-6">
                                    <label for="name">Nome</label>
                                    <input type="text" name="name" class="form-control"value="{{ Auth::user()->name }}">
                                </div>
                                <div class="col-sm-12 col-md-3">
                                    <label for="occupation">Profissão</label>
                                    <input type="text" class="form-control" name="occupation" value="{{ Auth::user()->occupation }}">
                                </div>
                                <div class="col-sm-12 col-md-3">
                                    <label for="birth">Data de Aniversário</label>
                                    <input type="date" class="form-control" name="birth" value="{{ Auth::user()->birth }}">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-12">
                                    <label for="bio">Bio</label>
                                    <textarea name="bio" id="bio" cols="30" class="form-control">{{ Auth::user()->bio }}</textarea>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-sm-12 col-md-6">
                                    <label for="institution">Instituição</label>
                                    <select name="institution" id="institution" class="form-control">
                                        <option value=""></option>
                                        @foreach ($institutions as $institution)
                                            <option value="{{ $institution->id }}" {{ $institution->users->contains(Auth::user()) ? 'selected' : '' }}>{{ $institution->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <label for="course">Courso</label>
                                    <select name="course" id="course" class="form-control">
                                        <option value=""></option>
                                        @foreach ($courses as $course)
                                            <option value="{{ $course->id }}" {{ $course->users->contains(Auth::user()) ? 'selected' : '' }}>{{ $course->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <button class="btn btn-success" type="submit">Salvar Alterações</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
      </div>
@endsection

@section('styles')
@endsection

@section('scripts')
@endsection
