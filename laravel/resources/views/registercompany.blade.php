@extends('layout')
@section('konten')
<section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
      <div class="row justify-content-center align-items-center h-100">
        <div class="col-12 col-lg-9 col-xl-7">
          <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
            <div class="card-body p-4 p-md-5">
              <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Register as an Employer</h3>
              {{-- Regist Form --}}
              <form method="post" action="{{url('/registerc/doRegister')}}">
                @csrf
                <div class="row">
                  <div class="col-md-6 mb-4">

                    <div class="form-outline">
                      <input type="text" name="name" class="form-control form-control-lg @error('name')
                      is-invalid
                  @enderror" />
                      <label class="form-label" for="name">Company Name</label>
                    </div>

                  </div>
                  <div class="col-md-6 mb-4">

                    <div class="form-outline">
                      <input type="text" name="address" class="form-control form-control-lg @error('address')
                      is-invalid
                  @enderror" />
                      <label class="form-label" for="address">Company Address</label>
                    </div>

                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 mb-4 d-flex align-items-center">

                    <div class="form-outline">
                      <input type="text" class="form-control form-control-lg @error('type')
                      is-invalid
                  @enderror" name="type" />
                      <label for="type" class="form-label">Company Type</label>
                    </div>

                  </div>
                  <div class="col-md-6 mb-4 pb-2">

                    <div class="form-outline">
                      <input type="email" name="email" class="form-control form-control-lg @error('email')
                      is-invalid
                  @enderror" />
                      <label class="form-label" for="email">Company Email</label>
                    </div>

                  </div>
                </div>

                <div class="row">
                  <div class="col-md-6 mb-4 pb-2">

                    <div class="form-outline">
                      <input type="text" name="website" class="form-control form-control-lg @error('website')
                      is-invalid
                  @enderror" />
                      <label class="form-label" for="website">Company Website</label>
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
                  <input class="btn btn-primary btn-lg" type="submit" value="Register" />
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
