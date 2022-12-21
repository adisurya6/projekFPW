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
                            <h2>Get your job</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero Area End -->
    <!-- Job List Area Start -->
    <div class="job-listing-area pt-120 pb-120 d-flex">
        <div class="container">
            <div class="row">
                <!-- Left content -->
                <div class="col-xl-3 col-lg-3 col-md-4">
                    <div class="row">
                        <div class="col-12">
                                <div class="small-section-tittle2 mb-45">
                                <div class="ion"> <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="20px" height="12px">
                                <path fill-rule="evenodd"  fill="rgb(27, 207, 107)"
                                    d="M7.778,12.000 L12.222,12.000 L12.222,10.000 L7.778,10.000 L7.778,12.000 ZM-0.000,-0.000 L-0.000,2.000 L20.000,2.000 L20.000,-0.000 L-0.000,-0.000 ZM3.333,7.000 L16.667,7.000 L16.667,5.000 L3.333,5.000 L3.333,7.000 Z"/>
                                </svg>
                                </div>
                                <h4>Search Jobs</h4>
                            </div>
                        </div>
                    </div>
                    <!-- Job Category Listing start -->
                    <div class="job-category-listing mb-50">
                        <!-- single one -->
                        <div class="single-listing">
                           <div class="small-section-tittle2">
                                 <h4>Search</h4>
                           </div>
                            <!-- Search job items start -->
                            <div class="select-job-items2">
                                <form method="GET" action="{{url('/user/listing')}}">
                                    <input type="text" name="search" class="form-control">
                                    <input type="submit" class="btn mt-10" value="Search!">
                                </form>
                            </div>
                            <!--  Search job items End-->

                        </div>
                    </div>
                </div>
                <!-- Right content -->
                <div class="col-xl-9 col-lg-9 col-md-8">
                    <!-- Featured_job_start -->
                    <section class="featured-job-area">
                        <div class="container">
                            <!-- Count of Job list Start -->
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="count-job mb-35">
                                        <span>{{$count}} Jobs found</span>

                                    </div>
                                </div>
                            </div>
                            <!-- Count of Job list End -->
                            <!-- single-job-content -->
                            @foreach ($jobs as $j)
                            <div class="single-job-items mb-30">
                                <div class="job-items">
                                    <div class="company-img">
                                        <a href="#"><img src="{{asset('img/icon/'.$j->Company->image)}}" alt=""></a>
                                    </div>
                                    <div class="job-tittle job-tittle2">
                                        <a href="{{url('user/job/'.$j->id)}}">
                                            <h4>{{$j->title}}</h4>
                                        </a>
                                        <ul>
                                            <li style="font-size:12px;">{{$j->Company->name}}</li>
                                            <li style="font-size:12px;"><i class="fas fa-map-marker-alt"></i>{{$j->location}}</li>
                                            <li style="font-size:12px;">Rp.{{number_format($j->min, 2, ',','.')}} - Rp.{{number_format($j->max, 2, ',','.')}}</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="items-link items-link2 f-right">
                                <a href="job_details.html">{{$j->Type->type}}</a>
                                    <span>{{$j->updated_at}}</span>
                                </div>
                            </div>
                            @endforeach


                        </div>
                    </section>
                    <!-- Featured_job_end -->
                </div>
            </div>
        </div>
    </div>
    <!-- Job List Area End -->


</main>

@endsection
