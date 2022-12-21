@extends('userlayout')
@section('konten')
<div class="container" style="margin-top:100px; margin-bottom:100px;">
@foreach ($users as $u)
<table class="table">
    <tr>
        <th>Job Title</th>
        <th>Description</th>
        <th>Job Type</th>
        <th>Company Name</th>
        <th>Job Location</th>
        <th>Status</th>
    </tr>

        <tr>
            @foreach ($u->jobs as $j)

            @php

                if($j->pivot->status == 1){
                    $stat = "Interview Planned";
                }else{
                    $stat = "Waiting for Company";
                }
            @endphp
            <td>{{ $j->title}}</td>
            <td>{{ $j->description }}</td>
            <td>{{ $j->Type->type }}</td>
            <td>{{ $j->Company->name }}</td>
            <td>{{ $j->location }}</td>
            <td>{{ $stat }}</td>

        </tr>
            @endforeach
        </table>
        @endforeach
</div>
@endsection
