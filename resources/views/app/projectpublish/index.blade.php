@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">

            <div class="col-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Assunto</th>
                            <th>Opções</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($projects as $project)
                            <tr>
                                <td>{{ $project->title }}</td>
                                <td>{{ $project->subject }}</td>
                                <td class="td-actions">
                                    <a href="/publish-project/{{ $project->id }}" class="btn btn-round btn-success">
                                        <i class="material-icons">gavel</i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    <script>


    </script>
@endsection
