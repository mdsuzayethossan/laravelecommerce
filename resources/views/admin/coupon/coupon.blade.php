@extends('layouts.admin');
@section('couponactive')
active

@endsection
@section('title')
    Coupon
@endsection
@section('content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ url('/home') }}">Dashboard</a>
            <span class="breadcrumb-item active">Coupon</span>
        </nav>

        <div class="sl-pagebody">
            <div class="">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="card">
                            <div class="card-header"
                                style="text-transform: uppercase; letter-spacing: 2px; background: linear-gradient(-155deg, #fb5d5d 0, #fd7863 98%, #f3dfe0 100%); color: white;">
                                <div class="card-title">
                                    <h1
                                        style="text-transform: uppercase; letter-spacing: 2px; color: white; text-align: center;">
                                        Category Information</h1>
                                </div>
                            </div>

                            @if (session('delete'))
                                <div class="alert alert-success">
                                    {{ session('delete') }}
                                </div>
                            @endif
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Sl</th>
                                            <th scope="col">Coupon Name</th>
                                            <th scope="col">Validity</th>
                                            <th scope="col"> Discount</th>
                                            <th scope="col">Created At</th>
                                            <th scope="col">Updated At</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <thead>
                                        @foreach ($coupons as $coupon)
                                            <tr>
                                                <th scope="row">{{ $loop->index + 1 }}</th>
                                                <td>{{ $coupon->coupon_name }}</td>
                                                <td>{{ $coupon->validity}}
                                                </td>
                                                <td>{{ $coupon->discount }}</td>
                                                <td>{{ $coupon->created_at->diffforHumans() }}</td>
                                                <td>{{ $coupon->updated_at }}</td>
                                                <td>
                                                    {{-- <a href="{{ url('/category/edit') }}/{{ $coupon->id }}"
                                                        class="btn btn-secondary">Edit</a>
                                                    <a href="{{ url('/category/delete') }}/{{ $coupon->id }}"
                                                        class="btn btn-danger">Delete</a> --}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </thead>
                                </table>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-5">
                        <div class="card custom_card">
                            <div class="card-header"
                                style="text-transform: uppercase; letter-spacing: 2px; background: linear-gradient(-155deg, #fb5d5d 0, #fd7863 98%, #f3dfe0 100%); color: white;">
                                <div class="card-title">
                                    <h1
                                        style="text-transform: uppercase; letter-spacing: 2px; color: white; text-align: center;">
                                        Coupon</h1>
                                </div>

                            </div>
                            @if (session('coupon_added'))
                                <div class="alert alert-success">
                                    {{ session('coupon_added') }}
                                </div>
                            @endif
                            <div class="card-body">
                                <form action="{{ route('coupon_insert') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="" class="form-label">Coupon Name</label>
                                        <input type="text" class="form-control" name="coupon_name">
                                        {{-- @error('category_name')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror --}}
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="form-label">Coupon Validity</label>
                                        <input type="date" class="form-control" name="validity">
                                        {{-- @error('category_name')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror --}}
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="form-label">Coupon discount percentage</label>
                                        <input type="number" class="form-control" name="discount">
                                        {{-- @error('category_name')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror --}}
                                    </div>
                                    <div class="form-group text-center mt-3">
                                        <button
                                            style="text-transform: uppercase; letter-spacing: 2px;background: linear-gradient(-155deg, #fb5d5d 0, #fd7863 98%, #f3dfe0 100%); color: white;"
                                            class="btn text-center" type="submit">Add Coupon</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
