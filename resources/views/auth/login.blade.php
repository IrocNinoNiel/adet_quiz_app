@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
                <div class="card-body text-center bg-light-green py-5">
                    <h3 class="card-title font-weight-bold">Login to Digital Workbook</h3>                    
                    @include('inc.message')
                        <form method="POST" action="{{ route('login') }}" id="loginFOrm">
                            @csrf
                            <div class="form-label-group m-3">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" autocomplete="email" autofocus placeholder="Email">
                            </div>
                            {{-- @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>Email or Password is Invalid</strong>
                                </span>
                            @enderror --}}
                            <div class="form-label-group m-3">
                                <input id="password" type="password" class="form-control" name="password" autocomplete="current-password" placeholder="Password">

                                {{-- @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror  --}}
                            </div >
                            <div class="form-group row mb-0">
                                <div class="col-md-4 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                            </div>
                            <hr class="my-4">
                        </form>
                        <h6>New to Digital Workbook</h6>
                        <div class="mt-2">
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                            @endif
                        </div>
                </div>
            </div>
          </div>
    </div>
</div>
@endsection
