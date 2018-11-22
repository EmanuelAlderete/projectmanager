@extends('layouts.app')

@section('content')
<div class="container-fluid">
        <div class="row">
          <div class="col-md-4">
            <div class="card card-profile">
              <div class="card-avatar">
                <a href="#pablo">
                  <img class="img" src="../assets/img/faces/marc.jpg">
                </a>
              </div>
              <div class="card-body">
                <h6 class="card-category text-gray">CEO / Co-Founder</h6>
                <h4 class="card-title">{{ Auth::user()->name }}</h4>
                <p class="card-description">
                  Don't be scared of the truth because we need to restart the human foundation in truth And I love you like Kanye loves Kanye I love Rick Owens’ bed design but the back is...
                </p>
                <a href="#pablo" class="btn btn-primary btn-round">Editar</a>
                <a href="/projects" class="btn btn-primary btn-round">Meus Projetos</a>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection
