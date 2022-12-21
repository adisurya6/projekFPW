@extends('userlayout')
@section('konten')

<div class="container box_1170" style="padding-bottom:200px;">
    <div class="single-job-items mb-50">
        <div class="job-items">
            <div class="company-img company-img-details">
                @foreach ($user as $u)


                <a href="#"><img src="{{asset('img/icon/'. $u->image)}}" height="100px" width="100px" alt="'"></a>

            </div>
            <div class="job-tittle">
                    <h4>{{$u->first_name . " " . $u->last_name}}</h4>
                <ul>
                    <li>{{$u->email}}</li>
                </ul>
            </div>

        </div>
    </div>
    <form class="mt-10" action="{{ url('user/profile/doUpload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        Change Profile Picture :
        <input type="file" name="photo" id="" class="form-control">
        <input type="submit" value="Upload" class="btn btn-success">
    </form>
    <form action="{{ url('user/profile/addCV') }}" method="POST" enctype="multipart/form-data">
        @csrf
        Add your CV (in .pdf format) :
        <input type="file" name="cv" id="" class="form-control">
        <input type="submit" value="Upload" class="btn">
    </form>
    <a href={{url('/user/profile/download')}} style="font-size:15px; color:cornflowerblue;">Download your CV</a>
    @if (Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
    @endif
    @endforeach

</div>

@endsection
