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
                    <li class="breadcrumb-item active">Success</li>
                </ul>
                <!-- breadcrumb-list end -->
            </div>
        </div>
    </div>
</div>

<!-- breadcrumb-area end -->
<div class="container">
    <div class="row">
        <div class="col-lg-8">
            @if (session('order_success'))
            <h3>success</h3>
            <span id="countdown"></span>
            @endif
        </div>
    </div>
</div>
@endsection
@section('footer_script')
<script>
    $().ready(function(){
        var time=10;
        var url='http://127.0.0.1:8000/';
        function countdown(){
            setTimeout(countdown,1000);
            $('#countdown').html("Redirect in"+ time + "Seconds");
            time --;
            if(time<0){
                window.location=url;
            }

        }
        countdown();
    })
</script>

@endsection
