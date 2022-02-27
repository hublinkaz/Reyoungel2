@extends('layouts.authentication.master')
@section('title', 'Login')

@section('css')
@endsection

@section('style')
@endsection

@section('content')
@include('sweetalert::alert')

    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-5"><img class="bg-img-cover bg-center" src="{{asset('assets/images/login/3.jpg')}}" alt="looginpage"></div>
            <div class="col-xl-7 p-0">
                <div class="login-card">
                    <div>
                        <div><a class="logo text-start" href="/"><img class="img-fluid for-light" src="{{asset('assets/images/logo/login.png')}}" alt="looginpage"><img class="img-fluid for-dark" src="{{asset('assets/images/logo/logo_dark.png')}}" alt="looginpage"></a></div>
                        <div class="login-main">
                            <form class="theme-form" method="POST" action="{{ route('signin.custom') }}">
                      @csrf
                                <h4>{{ trans('lang.Sign in to account') }}</h4>
                                <p>{{ trans('lang.Enter your email & password to login') }}</p>
                       <div class= "form-group">
                            <label class="col-form-label">{{ trans('lang.Email Address') }}</label>
                            <input class="form-control" type="email" required autofocus name="email" placeholder="Email" id="email">
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">{{ trans('lang.Password') }}</label>
                            <input class="form-control" type="password"  required="" name="password" placeholder="Password" id="password">
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-0">
{{--                            <div class="checkbox p-0">--}}
{{--                                <input id="checkbox1" type="checkbox">--}}
{{--                                <label class="text-muted"  name="remember" for="checkbox1">Remember password</label>--}}
{{--                            </div>--}}
                            <button class="btn btn-primary btn-block" type="submit">{{ trans('lang.Sign in') }}</button>
                        </div>
                        <h6 class="text-muted mt-4 or">{{ trans('lang.Or Sign in with') }}</h6>

                        <p class="mt-4 mb-0">{{ trans('lang.Dont have account?') }}<a style="color: red; font-weight: 900; font-size: 18px"  class="ms-2" href="{{ route('register') }}">{{ trans('lang.Create Account') }}</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@section('script')
@endsection
