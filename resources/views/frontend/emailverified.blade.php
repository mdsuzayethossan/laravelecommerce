@extends('frontend.master')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="card">
                <div class="card-header">
                    <div class="card-title text-center">
                        <img src="{{asset('frontend_assets/images/logo/logo.png')}}" alt="">

                    </div>
                </div>
                <div class="card-body text-center">
                    <h2>Hi!, @if (session('customer_name'))
                        {{ session('customer_name') }}

                    @endif</h2>
                    <h3 class="text-center">congratulations! </h3>
                    <h5 class="text-center">
                        @if (session('verified'))
                        <div class="alert alert-success" role="alert">
                            {{ session('verified') }}
                          </div>

                        @endif
                    </h5>

                    <a href="{{ route('customer_register') }}" style="width: 135px; height: 33px; text-align:center; display:inline-block;   line-height: 33px;" class="shop-link btn btn-primary">Login Now</a>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
