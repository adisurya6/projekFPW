@extends('userlayout')
@section('konten')
<div class="container">
@foreach ($jobs as $j)
<h3>{{$j->title}}</h3>
<table class="table">
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Phone Number</th>
        <th>Gender</th>
        <th>CV</th>
        <th>Action</th>
    </tr>

        <tr>
            @foreach ($j->users as $u)


            <td>{{ $u->first_name}}</td>
            <td>{{ $u->last_name }}</td>
            <td>{{ $u->email }}</td>
            <td>{{ $u->number }}</td>
            <td>{{ $u->gender }}</td>
            <td>{{ $u->CV }}</td>
            <td>
                <form action="{{url("company/plan")}}" method="get">
                    @csrf
                    <input type="hidden" name="id1" value="{{$j->id}}">
                    <input type="hidden" name="id2" value="{{$u->id}}">
                    {{-- @php
                        $jbs = Job::where('id', '=', $j->id)->first();
                        $jbs->Users()->updateExistingPivot($u->id, ['status' => 1]);
                    @endphp --}}
                    @if($u->pivot->status == 1)

                    <input type="submit" value="Already Planned" disabled="true"  class="btn" style="width:195px;">
                    @else

                    <input type="submit" value="Plan Interview"  class="btn btn-primary">
                    @endif
                </form>
            </td>
        </tr>
            @endforeach
        </table>
        @endforeach
</div>
@endsection
