@extends('layouts.admin') 
@section('content')
<div class="container-fluid">
    <div class="row">
        <a href="/branches"><button class="btn btn-primary btn-md"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></button></a>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
            <form method="post" action="#">
                <div class="form-group">
                    <label for="exampleFormControlInput1">Nome</label>
                    <input type="text" name="name" class="form-control" id="exampleFormControlInput1" value="{{ $branch->name }}" readonly>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Descrição</label>
                    <textarea class="form-control" name="label" id="exampleFormControlTextarea1" placeholder="Deletar usuários" rows="3" readonly>{{ $branch->label }}</textarea>
                </div>
                @if($branch->icon)
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Ícone: </label>
                    {!! $branch->icon !!}
                </div>
                @endif
                @if($branch->main_branch > 0)
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Área Principal: </label>
                    @switch($branch->main_branch)
                        @case(1)
                        <span class="badge badge-success">Exatas</span>
                            @break
                        @case(2)
                        <span class="badge badge-success">Humanas</span>
                            @break
                        @case(3)
                        <span class="badge badge-success">Biológicas</span>
                        @break
                        @default      
                    @endswitch
                    </div>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection