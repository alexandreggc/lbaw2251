@extends('layouts.app')

@section('content')

<section class="vh-100" style="background-color: #ffffff;">
        <div class="container py-5 h-100">
          <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
              <div class="card shadow-2-strong" style="border-radius: 1rem;">
                <div class="card-body p-5 text-center" >

                  <h3 class="mb-5 ">RESER PASSWORD</h3>

                  <form method="POST" action="{{ route('reset.password.action') }}">
                    @csrf

                    @if ($errors->has('email'))
                        <span class="error">
                            {{ $errors->first('email') }}
                        </span>
                    @else
                    @endif
                    <div class="form-group text-start">
                        <label for="password">Password</label>
                        <input name="password" type="password" id="password" placeholder="Password" required>
                    </div>
                    <div class="form-group mt-4 text-start">
                        <label for="password">Confirm Password</label>
                        <input name="password_confirmation" type="password" id="password-confirm" placeholder="Confirm Password" required>
                        <input type="hidden" name="token" value="{{ $token }}">
                        <input type="hidden" name="email" value="{{ request()->email }}">
                      </div>

                    
                    <hr class="my-4">
                    <button type="submit" class="btn btn-primary" >
                    Reset Password
                    </button>
                    
                    
                </form>

                  

                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
@endsection
