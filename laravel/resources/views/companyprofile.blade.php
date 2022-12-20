@extends('companylayout')
@section('konten')

<div class="container box_1170" style="padding-bottom:200px;">
    <div class="single-job-items mb-50">
        <div class="job-items">
            <div class="company-img company-img-details">
                <a href="#"><img src="{{asset('img/icon/blank.png')}}" alt="{{asset('img/icon/blank.png')}}'"></a>

            </div>
            <div class="job-tittle">
                    <h4>ABC Company</h4>
                <ul>
                    <li>Creative Agency</li>
                    <li><i class="fas fa-map-marker-alt"></i>Athens, Greece</li>
                    <li>hr@abc.com</li>
                </ul>
            </div>

        </div>
    </div>
    <div class="single-job-items mb-50">
        <div class="job-items">

            <h5>Balance</h5>
            <span style="margin-left:10px;margin-top:1px;">50000</span>

        </div>
    </div>
    <form action="{{ url('company/profile/topup') }}" method="POST" enctype="multipart/form-data">
        @csrf
        Top Up Balance :
        <input type="number" name="number" id="" class="form-control">
        <input type="submit" value="Top Up" class="btn">
    </form>
    <form class="mt-10" action="{{ url('company/profile/doUpload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        Change Profile Picture :
        <input type="file" name="photo" id="" class="form-control">
        <input type="submit" value="Upload" class="btn btn-success">
    </form>


</div>

@endsection
