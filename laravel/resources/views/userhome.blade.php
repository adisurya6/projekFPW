@extends('userlayout')
@section('konten')
          <!-- slider Area Start-->
          <div class="slider-area ">
            <!-- Mobile Menu -->
            <div class="slider-active">
                <div class="single-slider slider-height d-flex align-items-center" data-background="{{asset('img/hero/h1_hero.jpg')}}">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-6 col-lg-9 col-md-10">
                                <div class="hero__caption">
                                    <h1>Find the most exciting startup jobs</h1>
                                </div>
                            </div>
                        </div>
                        <!-- Search Box -->
                        <div class="row">
                            <div class="col-xl-8">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- slider Area End-->
        <!-- Featured_job_start -->
        <section class="featured-job-area feature-padding">
            <div class="container">
                <!-- Section Tittle -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-tittle text-center">
                            <span>Recent Job</span>
                            <h2>Featured Jobs</h2>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-xl-10">

                         <!-- single-job-content -->
                         @foreach ($jobs as $j)
                         <div class="single-job-items mb-30">
                             <div class="job-items">
                                 <div class="company-img">
                                     <a href="{{url('job/'.$j->id)}}"><img src="{{asset('img/icon/'.$j->Company->image)}}" alt=""></a>
                                 </div>
                                 <div class="job-tittle job-tittle2">
                                     <a href="{{url('job/'.$j->id)}}">
                                         <h4>{{$j->title}}</h4>
                                     </a>
                                     <ul>
                                         <li>{{$j->Company->name}}</li>
                                         <li><i class="fas fa-map-marker-alt"></i>{{$j->location}}</li>
                                         <li>Rp.{{number_format($j->min, 2, ',','.')}} - Rp.{{number_format($j->max, 2, ',','.')}}</li>

                                     </ul>
                                 </div>
                             </div>
                             <div class="items-link items-link2 f-right">
                             <a href="#">{{$j->Type->type}}</a>
                                 <span>{{$j->updated_at}}</span>
                             </div>
                         </div>
                         @endforeach
                         <!-- single-job-content -->

                    </div>
                </div>
            </div>
        </section>
        <!-- Featured_job_end -->
        <!-- How  Apply Process Start-->
        <div class="apply-process-area apply-bg pt-150 pb-150" data-background="{{asset('img/gallery/how-applybg.png')}}">
            <div class="container">
                <!-- Section Tittle -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-tittle white-text text-center">
                            <span>Apply process</span>
                            <h2> How it works</h2>
                        </div>
                    </div>
                </div>
                <!-- Apply Process Caption -->
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="single-process text-center mb-30">
                            <div class="process-ion">
                                <span class="flaticon-search"></span>
                            </div>
                            <div class="process-cap">
                               <h5>1. Search a job</h5>
                               <p>Search for a job with our website.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="single-process text-center mb-30">
                            <div class="process-ion">
                                <span class="flaticon-curriculum-vitae"></span>
                            </div>
                            <div class="process-cap">
                               <h5>2. Apply for job</h5>
                               <p>Apply for the job you want to.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="single-process text-center mb-30">
                            <div class="process-ion">
                                <span class="flaticon-tour"></span>
                            </div>
                            <div class="process-cap">
                               <h5>3. Get your job</h5>
                               <p>Wait for the company to contact you.</p>
                            </div>
                        </div>
                    </div>
                </div>
             </div>
        </div>
        <!-- How  Apply Process End-->
        <!-- Testimonial Start -->

@endsection
