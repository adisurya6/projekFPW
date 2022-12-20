@extends('layout')
@section('konten')
<section class="vh-100 gradient-custom">
    <div class="container py-5 h-100">
      <div class="row justify-content-center align-items-center h-100">
        <div class="col-12 col-lg-9 col-xl-7">
          <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
            <div class="card-body p-4 p-md-5">
              <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Login</h3>
              {{-- Login Form --}}
              <form method="post" action="{{url('/doLogin')}}">
                @csrf
                  <div class="row">
                    <div class="col-md-12 mb-4 pb-2">

                      <div class="form-outline">
                        <input type="text" name="email" class="form-control form-control-lg">
                        <label class="form-label" for="email">Email</label>
                      </div>

                    </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12 mb-4 pb-2">

                      <div class="form-outline">
                        <input type="password" name="password" class="form-control form-control-lg">
                        <label class="form-label" for="password">Password</label>
                      </div>

                    </div>
                  </div>
                  <label class="mt-10">Login as</label>
            <div class="form-row">
                <div class="col">
                    <select class="form-select h-100 w-100" name="role" style="width:auto;">
                        <option value="1">User</option>
                        <option value="2">Company</option>
                    </select>
                </div>
            </div>
                <div class="mt-4 pt-2">
                  <input class="btn btn-lg" type="submit" value="Login" />
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
