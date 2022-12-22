@extends('companylayout')
@section('konten')
<div class="container mt-10" style="margin-top:70px; margin-bottom:50px">
    @if (Session::has("message"))
        <div class="alert alert-success">
            {{ Session::get("message") }}
        </div>
    @endif


@foreach ($jobs as $j)
<h3 style="margin-top:50px;">{{$j->title}}</h3>
<table class="table">
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Phone Number</th>
        <th>Gender</th>
        <th>Age</th>
        <th>CV</th>
        <th>Action</th>
    </tr>

        <tr>
            @foreach ($j->users as $u)

            @php
                $bday = new DateTime($u->dob); // Your date of birth
                $today = new Datetime(date('m.d.y'));
                $diff = $today->diff($bday);
            @endphp

            <td>{{ $u->first_name}}</td>
            <td>{{ $u->last_name }}</td>
            <td>{{ $u->email }}</td>
            <td>{{ $u->number }}</td>
            <td>{{ $u->gender }}</td>
            <td>{{ $diff->y }}</td>
            <td>
                @if ($u->cv)
                    <a href={{url('/company/applications/download/'.$u->id)}} style='font-size:15px; color:cornflowerblue;''>{{$u->first_name}}.pdf</a>
                @else

                @endif
            </td>
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
