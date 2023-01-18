{{-- Category Edit --}}
@extends('layouts.admin')
@section('categoryactive')
    active
@endsection
@section('title')
    Covid-Category-Edit
@endsection
@section('content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ url('/home') }}">Dashboard</a>
            <a class="breadcrumb-item" href="{{ url('/category') }}">Category</a>
            <span class="breadcrumb-item active">Edit</span>
        </nav>
        <div class="sl-pagebody">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 m-auto">
                        <div class="card custom_card">
                            <div class="card-header"
                                style="text-transform: uppercase; letter-spacing: 2px; background: linear-gradient(-155deg, #fb5d5d 0, #fd7863 98%, #f3dfe0 100%); color: white;">
                                <div class="card-title">
                                    <h1
                                        style="text-transform: uppercase; letter-spacing: 2px; color: white; text-align: center;">
                                        Edit Category</h1>
                                </div>

                            </div>
                            @if (session('update'))
                                <div class="alert alert-success"> {{ session('update') }}</div>
                            @endif
                            <div class="card-body">
                                <form action="{{ url('/category/update') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="" class="form-label">Category Name</label>
                                        <input type="hidden" name="category_id" value="{{ $edit_category->id }}">
                                        <input type="text" class="form-control" name="category_name"
                                            value="{{ $edit_category->category_name }}">
                                        @error('category_name')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                    <img width="70"
                                        src="{{ URL::asset('uploads/category/' . $edit_category->category_image) }}" />
                                    <div class="form-group">
                                        <label for="" class="form-label">Category Image</label>
                                        <input type="file" class="form-control" name="category_image">
                                    </div>
                                    <div class="form-group text-center mt-3">
                                        <button
                                            style="text-transform: uppercase; letter-spacing: 2px; background: linear-gradient(-155deg, #fb5d5d 0, #fd7863 98%, #f3dfe0 100%); color: white;"
                                            class="btn text-center" type="submit">Update Category</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div><!-- sl-pagebody -->
    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
@endsection
