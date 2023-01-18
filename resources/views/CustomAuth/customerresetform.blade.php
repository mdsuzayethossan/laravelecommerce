@extends('frontend.master')
@section('content')
    <!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-12 text-center">
                    <h2 class="breadcrumb-title">Reset</h2>
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Reset</li>
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
                <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                    <div class="login-register-wrapper">
                        <div class="login-register-tab-list nav">
                            <a class="active" data-bs-toggle="tab" href="#lg1">
                                <h4>Reset Password</h4>
                            </a>

                        </div>
                        <div class="tab-content">
                            <div id="lg1" class="tab-pane active">
                                <div class="login-form-container">
                                    <div class="login-register-form d-block">
                                        <form action="{{ route('customer.reset.update') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="reset_token" value="{{ $reset_token }}">
                                            <input type="password" name="password" placeholder="New Password">
                                            @error('password')
                                            <span class="text-danger">
                                                {{ $message }}
                                               </span>
                                               @enderror
                                            <input type="password" name="Confirm_Password" placeholder="Confirm Password">
                                            @error('Confirm_Password')
                                            <span class="text-danger">
                                                {{ $message }}
                                               </span>
                                               @enderror
                                            <div class="button-box mt-4">

                                                <button type="submit"><span>Reset</span></button>
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
