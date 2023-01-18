
{{-- frontend Register --}}
@extends('frontend.master')
@section('content')
    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-12 text-center">
                    <h2 class="breadcrumb-title">Shop</h2>
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Login</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>

    <!-- breadcrumb-area end -->
    <!-- login area start -->
    <div class="login-register-area pt-100px pb-100px">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-12 ml-auto mr-auto">
                    <div class="login-register-wrapper">
                        <div class="login-register-tab-list nav">
                            <a class="active" data-bs-toggle="tab" href="#lg1">
                                <h4>login</h4>
                            </a>
                            <a data-bs-toggle="tab" href="#lg2">
                                <h4>register</h4>
                            </a>
                        </div>
                        @if (session('registersuccess'))
                        <div class="alert alert-info text-center">
                            {{ session('registersuccess') }}
                        </div>
                    @endif
                        @if (session('verified'))
                        <div class="alert alert-success text-center">
                            {{ session('verified') }}
                        </div>
                    @endif

                        @if (session('notverified'))
                        <div class="alert alert-warning text-center">
                            {{ session('notverified') }}
                        </div>
                    @endif
                        <div class="tab-content">
                            <div id="lg1" class="tab-pane active">
                                <div class="login-form-container">
                                    <div class="login-register-form">
                                        <div class="login_left_part">
                                            <form action="{{ url('/customer/login') }}" method="POST">
                                                @csrf
                                                <input type="email" name="email" placeholder="Email" />
                                                <input type="password" name="password" placeholder="Password" />
                                                <div class="button-box">
                                                    <div class="login-toggle-btn">
                                                        <input type="checkbox" />
                                                        <a class="flote-none" href="javascript:void(0)">Remember me</a>
                                                        <a href="{{ route('forgotpassword') }}">Forgot Password?</a>
                                                    </div>
                                                </div>

                                        </div>
                                        <div class="login_right_part">
                                            <div class="login_button">
                                                <button class="text-center" type="submit">sign in</button>
                                            </div>
                                        </form>
                                            <div class="or_login_with">
                                                <span style="padding: 10px 0">Or, sign in with</span>
                                            </div>

                                            <div class="third_party_facebook">
                                                    <a class="third_party_login_fb" href="{{ route('facebook.redirect') }}"><i class="fa fa-facebook" aria-hidden="true"></i>Facebook</a>
                                            </div>
                                            <div class="third_party_google">
                                                    <a class="third_party_login_g" href="{{ url('/google/redirect') }}"><i class="fa fa-google" aria-hidden="true"></i>Google</a>
                                            </div>
                                            <div class="third_party_github">
                                                    <a class="third_party_login_gt" href="{{ url('/github/redirect') }}"><i class="fa fa-github" aria-hidden="true"></i>Github</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="lg2" class="tab-pane">
                                <div class="login-form-container">
                                    <div class="login-register-form">

                                        <form action="{{ url('/customer/register') }}" method="post">
                                            @csrf
                                            <input type="text" name="name" placeholder="Name" value="{{ old ('name') }}">
                                            <span class="text-danger">@error(
                                                'name'){{ $message }}

                                               @enderror</span>
                                            <input name="email" placeholder="Email" type="email" value="{{ old ('email') }}">
                                            @error(
                                                'email')
                                            <span class="text-danger">
                                                {{ $message }}

                                              </span>
                                              @enderror
                                            <input type="password" name="password" placeholder="Password" value="{{ old ('password') }}">

                                            <span class="text-danger">@error(
                                                'password'){{ $message }}

                                               @enderror</span>
                                            <input type="password" name="cpassword" placeholder="Confirm Password" value="{{ old ('cpassword') }}">
                                           <span class="text-danger">@error(
                                            'cpassword'){{ $message }}

                                           @enderror</span>

                                            <div class="button-box" style="margin-top: 30px">
                                                <button type="submit"><span>Register</span></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- login area end -->
@endsection
