@extends('layouts.login')

@section('content')
<div class="container-fluid d-flex justify-content-center align-items-center vh-100 bg-planet">
    <div class="row">
        <div class="col-md-7 d-flex justify-content-center align-items-center">
            <h6 class="" style="font-size: 50px">The global tracking <br>platform you’ve been <br>searching </h6>
        </div>
        <div class="col-md-4">
            <div class="card rounded-4 shadow-lg" style="min-width: 350px; min-height: 300px;">
                <div class="card-body p-5">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <div class="col">
                                <input class="rounded-5"  type="checkbox" name="" style="height: 20px;width: 20px;">
                                <span><strong>PW</strong>Software</span>
                            </div>
                        </div>
                        <label class="py-4" style="font-size: 24px">Login into account</label>

                        <div class="row mb-3">
                            <div class="col">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror rounded-3" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email Address" style="font-size: 14px">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror rounded-3" name="password" placeholder="Password" required autocomplete="current-password" style="font-size: 14px">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col">
                                <button type="submit" class="btn btn-dark form-control rounded-3">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col text-center">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}" style="text-decoration: none;color: black;font-size: 14px;">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-1">
            
        </div>
    </div>
</div>
@endsection
