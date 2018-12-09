@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-5">
            <div class="row justify-content-center">
                <div class="card">
                    <div class="card-body">
                        <form class="form-search" id="form-search" method="post">
                            @csrf
                            <div class="col-sm-12 search-area">
                                <input type="search" class="form-control" name="query" placeholder="Pesquise algo..." autofocus>
                                <button type="submit" class="btn btn-primary btn-round" id="submit"><i class="fas fa-search"></i></button>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="project" value="true"> Projetos
                                        <span class="form-check-sign">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="ideia" value="true"> Ideias
                                        <span class="form-check-sign">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" name="checkpoint" value="true"> Checkpoints
                                        <span class="form-check-sign">
                                            <span class="check"></span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
    </div>
@endsection
