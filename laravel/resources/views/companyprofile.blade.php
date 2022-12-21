@extends('companylayout')
@section('konten')

<div class="container box_1170" style="padding-bottom:200px;">
    <div class="single-job-items mb-50">
        <div class="job-items">
            @foreach ($company as $c)


            <div class="company-img company-img-details">
                <a href="#"><img src="{{asset('img/icon/'. $c->image)}}" alt=""></a>

            </div>
            <div class="job-tittle">
                    <h4>{{$c->name}}</h4>
                <ul>
                    <li>{{$c->type}}</li>
                    <li><i class="fas fa-map-marker-alt"></i>{{$c->address}}</li>
                    <li>{{$c->email}}</li>
                </ul>
            </div>

        </div>
    </div>
    <div class="single-job-items mb-50">
        <div class="job-items">

            <h5>Balance</h5>
            <span style="margin-left:10px;margin-top:1px;">Rp.{{$c->saldo}}</span>

        </div>
    </div>
    <form action="{{ url('company/profile/topup') }}" method="POST">
        @csrf
        Top Up Balance :
        <input type="number" name="saldo" id="" class="form-control">
        <input type="submit" value="Top Up" class="btn">
    </form>
    <form class="mt-10" action="{{ url('company/profile/doUpload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        Change Profile Picture :
        <input type="file" name="photo" id="" class="form-control">
        <input type="submit" value="Upload" class="btn btn-success">
    </form>
@endforeach

</div>

@endsection
