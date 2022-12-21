@extends('userlayout')
@section('konten')
<main>

    <!-- Hero Area Start-->
    <div class="slider-area ">
    <div class="single-slider section-overly slider-height2 d-flex align-items-center" data-background="{{asset('img/hero/about.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="hero-cap text-center">
                        <h2>UI/UX Designer</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Hero Area End -->
    <!-- job post company Start -->
    <div class="job-post-company pt-120 pb-120">
        <div class="container">
            <div class="row justify-content-between">
                <!-- Left Content -->
                <div class="col-xl-7 col-lg-8">
                    <!-- job single -->
                    <div class="single-job-items mb-50">
                        @foreach ($jobs as $job)

                        <div class="job-items">
                            <div class="company-img company-img-details">
                                <a href="#"><img src="{{asset('img/icon/'.$job->Company->image)}}" alt=""></a>
                            </div>
                            <div class="job-tittle">
                                <a href="#">
                                    <h4>{{$job->title}}</h4>
                                </a>
                                <ul>
                                    <li>{{$job->Company->name}}</li>
                                    <li><i class="fas fa-map-marker-alt"></i>{{$job->company->address}}</li>
                                    <li>Rp.{{$job->min}} - Rp.{{$job->max}}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                      <!-- job single End -->

                    <div class="job-post-details">
                        <div class="post-details1 mb-50">
                            <!-- Small Section Tittle -->
                            <div class="small-section-tittle">
                                <h4>Job Description</h4>
                            </div>
                            <p>{{$job->description}}</p>
                        </div>

                    </div>

                </div>
                <!-- Right Content -->
                <div class="col-xl-4 col-lg-4">
                    <div class="post-details3  mb-50">
                        <!-- Small Section Tittle -->
                       <div class="small-section-tittle">
                           <h4>Job Overview</h4>
                       </div>
                      <ul>
                          <li>Posted date : <span>{{$job->created_at}}</span></li>
                          <li>Location : <span>{{$job->location}}</span></li>
                          <li>Job nature : <span>{{$job->type->type}}</span></li>
                          <li>Salary :  <span>Rp.{{$job->min}} - Rp.{{$job->max}}</span></li>
                          <li>Application date : <span> none</span></li>
                      </ul>

                     <div class="apply-btn2">
                        <form method="post" action="{{url('/user/doApply')}}">
                            @csrf
                            <input type="hidden" name="user_id" value="{{getAuthUser()->id}}">
                            <input type="hidden" name="titles" value="{{$job->title}}">
                            <input type="hidden" name="company_id" value="">
                            <input type="submit" class="btn" value="Apply">
                        </form>
                     </div>
                   </div>
                    <div class="post-details4  mb-50">
                        <!-- Small Section Tittle -->
                       <div class="small-section-tittle">
                           <h4>Company Information</h4>
                       </div>
                          <span>{{$job->Company->name}}</span>

                        <ul>
                            <li>Name: <span>{{$job->Company->name}} </span></li>
                            <li>Web : <span>{{$job->Company->website}}</span></li>
                            <li>Email: <span>{{$job->Company->email}}</span></li>
                        </ul>
                   </div>
                   @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- job post company End -->

</main>

@endsection
