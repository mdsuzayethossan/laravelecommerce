{{-- Sub Category Edit --}}
@extends('layouts.admin')
@section('subcategoryactive')
    active
@endsection
@section('title')
    Covid-Subcategory-Edit
@endsection
@section('content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ url('/home') }}">Dashboard</a>
            <a class="breadcrumb-item" href="{{ url('/subcategory') }}">Subcategory</a>
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
                            @if (session('existsubcategory'))
                                <div class="alert alert-danger">
                                    {{ session('existsubcategory') }}
                                </div>
                            @endif
                            <div class="card-body">
                                <form action="{{ url('/subcategory/update') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="subcategory_id" value="{{ $subcategories->id }}">
                                    <div class="form-group">
                                        <select name="category_id" id="" class="form-control form-label">
                                            <option value="">--Select Category--</option>
                                            @foreach ($category as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ $category->id == $subcategories->category_id ? 'selected' : '' }}>
                                                    {{ $category->category_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="alert alert-warning">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="">Sub Category Name</label>
                                        <input type="text" name="subcategory_name"
                                            value="{{ $subcategories->subcategory_name }}" class="form-control">
                                        @error('subcategory_name')
                                            <div class="alert alert-warning">
                                                {{ $message }}
                                            </div>
                                        @enderror
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
