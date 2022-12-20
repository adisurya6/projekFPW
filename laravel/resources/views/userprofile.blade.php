@extends('userlayout')
@section('konten')

<div class="container box_1170" style="padding-bottom:200px;">
    <div class="single-job-items mb-50">
        <div class="job-items">
            <div class="company-img company-img-details">
                <a href="#"><img src="{{asset('img/icon/blank.png')}}" alt="{{asset('img/icon/blank.png')}}'"></a>

            </div>
            <div class="job-tittle">
                    <h4>John</h4>
                <ul>
                    <li>Creative Agency</li>
                    <li><i class="fas fa-map-marker-alt"></i>Athens, Greece</li>
                    <li>hr@abc.com</li>
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
        Add your CV :
        <input type="file" name="cv" id="" class="form-control">
        <input type="submit" value="Upload" class="btn">
    </form>



</div>

@endsection
