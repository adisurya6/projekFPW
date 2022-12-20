@extends('companylayout')
@section('konten')
<div class="container box_1170" style="padding-bottom:200px;">
    <h1 class="text-heading" style="margin-top:100px; font-size:50px;">Post a Job</h3>
        <form action="#">

            {{-- Job Title Input --}}
            <div class="mt-10">
                <label>Job Title</label>
                <input type="text" name="job_title" placeholder="Job Title"
                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Job Title'" required
                    class="form-control">
            </div>

            {{-- Job Desc Input --}}
            <div class="mt-10">
                <label>Job Description</label>
                <textarea class="form-control" placeholder="Job Description" name="job-description" onfocus="this.placeholder = ''"
                    onblur="this.placeholder = 'Job Description'" required></textarea>
            </div>

            {{-- Salary Input --}}
            <label class="mt-10">Salary Range</label>
            <div class="form-row">
                <div class="col">
                  <input type="number" name="salary-min" class="form-control" placeholder="Min">
                </div>
                <div class="col">
                  <input type="number" name="salary-max" class="form-control" placeholder="Max">
                </div>
            </div>

            {{-- Job Location Input --}}
            <div class="mt-10">
                <label>Job Location</label>
                <input type="text" name="job-location" placeholder="Job Location"
                    onfocus="this.placeholder = ''" onblur="this.placeholder = 'Job Location'" required
                    class="form-control">
            </div>

            {{-- Job Nature --}}
            <label class="mt-10">Job Nature</label>
            <div class="form-row">
                <div class="col">
                    <select class="form-select h-100 w-100" style="width:auto;">
                        <option value="1">Full Time</option>
                        <option value="2">Part Time</option>
                        <option value="3">Internship</option>
                    </select>
                </div>
            </div>

            <button type="submit" class="btn mt-10">Add Job</button>
        </form>

</div>
@endsection
