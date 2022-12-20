@extends('layout')
@section('konten')
<section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
      <div class="row justify-content-center align-items-center h-100">
        <div class="col-12 col-lg-9 col-xl-7">
          <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
            <div class="card-body p-4 p-md-5">
              <h3 >Register as a Job Finder</h3>
              <div class="row mb-3 pb-1 pb-md-0 mb-md-3">
                <div class="col">
                    <a href="registerc"  style="font-size:15px;color:cornflowerblue;">Are you an Employer?</a>
                </div>
                </div>
              <form method="post" action="{{url('/register/doRegister')}}">
                @csrf
                <div class="row">
                  <div class="col-md-6 mb-4">

                    <div class="form-outline">

                        <input type="text" name="first_name" class="form-control form-control-lg @error('first_name')
                            is-invalid
                        @enderror" />
                        <label class="form-label" for="first_name">First Name</label>
                    </div>

                  </div>
                  <div class="col-md-6 mb-4">

                    <div class="form-outline">
                        <input type="text" name="last_name" class="form-control form-control-lg @error('last_name')
                        is-invalid
                    @enderror" />
                        <label class="form-label" for="last_name">Last Name</label>
                    </div>

                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 mb-4 d-flex align-items-center">

                    <div class="form-outline datepicker w-100">
                      <input type="date" class="form-control form-control-lg @error('dob')
                      is-invalid
                  @enderror" name="dob" />
                      <label for="dob" class="form-label">Birth Date</label>
                    </div>

                  </div>
                  <div class="col-md-6 mb-4">

                    <h6 class="mb-2 pb-1">Gender: </h6>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input @error('gender')
                        is-invalid
                    @enderror" type="radio" name="gender" id="genderM"
                          value="L" />
                        <label class="form-check-label" for="maleGender">Male</label>
                    </div>

                    <div class="form-check form-check-inline">
                      <input class="form-check-input @error('gender')
                      is-invalid
                  @enderror" type="radio" name="gender" id="genderF"
                        value="P" />
                      <label class="form-check-label" for="femaleGender">Female</label>
                    </div>



                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 mb-4 pb-2">

                    <div class="form-outline">
                      <input type="email" name="email" class="form-control form-control-lg @error('email')
                      is-invalid
                  @enderror" />
                      <label class="form-label" for="email">Email</label>
                    </div>

                  </div>
                  <div class="col-md-6 mb-4 pb-2">

                    <div class="form-outline">
                      <input type="tel" name="number" class="form-control form-control-lg @error('number')
                      is-invalid
                  @enderror" />
                      <label class="form-label" for="number">Phone Number</label>
                    </div>

                  </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-4 pb-2">

                      <div class="form-outline">
                        <input type="password" name="password" class="form-control form-control-lg @error('password')
                        is-invalid
                    @enderror">
                        <label class="form-label" for="password">Password</label>
                      </div>

                    </div>
                  </div>
                <div class="row">
                    <div class="col-md-12 mb-4 pb-2">

                      <div class="form-outline">
                        <input type="password" name="password_confirmation" class="form-control form-control-lg @error('password_confirmation')
                        is-invalid
                    @enderror">
                        <label class="form-label" for="password_confirmation">Confirm Password</label>
                      </div>

                    </div>
                  </div>
                <div class="mt-4 pt-2">
                  <input class="btn btn-lg" type="submit" value="Register" />
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
