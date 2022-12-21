@extends('companylayout')
@section('konten')
<div class="container box_1170" style="padding-bottom:200px;">
    <h1 class="text-heading" style="margin-top:100px; font-size:50px;">Post a Job</h3>
        <form action="{{url('/company/jobs/doEdit')}}" method="post">
            @csrf
            <input type="hidden" name="job_id" value="{{$job->id}}">
            {{-- Job Title Input --}}
            <div class="mt-10">
                <label>Job Title</label>
                <input type="text" name="title" value="{{$job->title}}"
                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Job Title'" required
                    class="form-control">
            </div>

            {{-- Job Desc Input --}}
            <div class="mt-10">
                <label>Job Description</label>
                <textarea class="form-control"  name="description"  required>{{$job->description}}</textarea>
            </div>

            {{-- Salary Input --}}
            <label class="mt-10">Salary Range</label>
            <div class="form-row">
                <div class="col">
                  <input type="number" name="min" class="form-control" value="{{$job->min}}">
                </div>
                <div class="col">
                  <input type="number" name="max" class="form-control" value="{{$job->max}}">
                </div>
            </div>

            {{-- Job Location Input --}}
            <div class="mt-10">
                <label>Job Location</label>
                <input type="text" name="location" value="{{$job->location}}"
                     required
                    class="form-control">
            </div>

            {{-- Job Nature --}}
            <label class="mt-10">Job Nature</label>
            <div class="form-row">
                <div class="col">
                    <select class="form-select h-100 w-100" name="type_id" style="width:auto;">
                        <option value="1">Full Time</option>
                        <option value="2">Part Time</option>
                        <option value="3">Internship</option>
                    </select>
                </div>
            </div>
            <input type="hidden" name="company_id" value="{{getAuthUser()->id}}">
            <button type="submit" class="btn mt-10">Add Job</button>
        </form>
        @if (Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
    @endif

</div>
@endsection
