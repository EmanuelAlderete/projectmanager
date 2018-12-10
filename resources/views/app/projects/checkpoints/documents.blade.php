@extends('layouts.app')

@section('content')
<div class="container-fluid" id="area">
    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th>Checkpoint</th>
                    <th>Arquivo</th>
                    <th>Data de upload</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($checkpoints as $checkpoint)
                <tr>
                        <td><a href="/projects/{{ $checkpoint->project_id }}/checkpoints/" target="_blank" >{{ $checkpoint->title }}</a></td>
                        <td><a href="/storage/projects/project-{{ $checkpoint->project_id }}/{{ $checkpoint->annex}}" target="_blank">Download</a></td>
                        <td>{{ $checkpoint->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection

