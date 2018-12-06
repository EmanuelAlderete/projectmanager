@extends('layouts.app')

@section('content')
<div class="container-fluid" id="area">
    <a href="/home" class="btn btn-primary btn-fab btn-fab-mini btn-round"><i class="material-icons">arrow_back</i></a>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h2>Seus convites</h2>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>De</th>
                                <th>Mensagem</th>
                                <th>Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($invitations->where('status', 0) as $invitation)
                                <tr>
                                    <td>{{ $invitation->project->user->name }}</td>
                                    <td>Olá, quer ser o orientador do meu projeto, {{ $invitation->project->title }}?</td>
                                    <td class="td-actions">
                                        <button type="button" rel="tooltip" onclick="$('#acceptForm').submit();" class="btn btn-success btn-round">
                                            <i class="material-icons">done</i>
                                        </button>
                                        <button type="button" rel="tooltip" onclick="$('#denyForm').submit();" class="btn btn-danger btn-round">
                                            <i class="material-icons">close</i>
                                        </button>
                                        <form action="/answer-invite" id="acceptForm" method="post">
                                            @csrf
                                            <input type="hidden" name="answer" value="true">
                                            <input type="hidden" name="id" value="{{ $invitation->id }}">
                                        </form>
                                        <form action="/answer-invite" id="denyForm" method="post">
                                            @csrf
                                            <input type="hidden" name="answer" value="false">
                                            <input type="hidden" name="id" value="{{ $invitation->id }}">
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td>Um robô do sistema</td>
                                    <td>Você não possui nenhum convite. :(</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

