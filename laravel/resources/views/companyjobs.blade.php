@extends('companylayout')
@section('konten')
<div class="container" style="margin-top:100px;margin-bottom:100px;">
    @if (Session::has("message"))
        <div class="alert alert-success">
            {{ Session::get("message") }}
        </div>
    @endif
    <table class="table">
<tr>
    <th>Job Title</th>
    <th>Description</th>
    <th>Job Type</th>
    <th>Min Salary</th>
    <th>Max Salary</th>
    <th>Location</th>
    <th>Edit Job Attributes</th>
    <th>Close Job Request</th>
</tr>

    <tr>
        @foreach ($jobs as $j)

        <td>{{ $j->title}}</td>
        <td>{{ $j->description }}</td>
        <td>{{ $j->Type->type }}</td>
        <td>{{ $j->min }}</td>
        <td>{{ $j->max }}</td>
        <td>{{ $j->location }}</td>
        <td><a href="{{ url("company/jobs/edit/$j->id") }}" class="btn btn-primary">Edit</a></td>
        <td><a href="{{ url("company/jobs/close/$j->id") }}" class="btn btn-primary">Close</a></td>

    </tr>
        @endforeach
    </table>
</div>
@endsection
