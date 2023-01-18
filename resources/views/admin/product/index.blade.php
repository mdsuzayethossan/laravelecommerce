@extends('layouts/admin')
@section('productactive')
    active
@endsection
@section('title')
    product
@endsection
@section('content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ url('/home') }}">Dashboard</a>
            <span class="breadcrumb-item active">Product</span>
        </nav>

        <div class="sl-pagebody">
            <div class="sl-page-title">
                <div class="row">
                    <div class="col-lg-12 m-auto">
                        <div class="card">
                            <div class="card-header"
                                style="text-transform: uppercase; letter-spacing: 2px; background-color: #fb5d5d; color: white;">
                                <div class="card-title">
                                    <h2
                                        style="text-transform: uppercase; letter-spacing: 2px; color: white; text-align: center;">
                                        Add Information</h2>
                                </div>
                            </div>
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <div class="card-body">
                                <form action="{{ url('/product/insert') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group"
                                        style="display: inline-block; width: 49%; margin-right: .8%;">
                                        <select name="category_id" class="form-control" id="select_category">
                                            <option value="">--Select Category--</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->category_name }}
                                                </option>
                                            @endforeach

                                        </select>
                                    </div>
                                    <div class="form-group subcategory_field"
                                        style="display: inline-block; width: 49%; margin-left: .8%;">
                                        <select name="subcategory_id" class="form-control" id="subcategory">

                                        </select>
                                    </div>
                                    <div class="form-group" style="display: inline-block; width: 49%; margin-right: .8%;>
                                          <label for="" class="  form-label">Product Name</label>
                                        <input type="text" name="product_name" id="" class="form-control">
                                    </div>
                                    <div class="form-group" style="display: inline-block; width: 49%; margin-left: .8%;>
                                          <label for="" class="  form-label">Product Price</label>
                                        <input type="text" name="product_price" id="" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="form-label">Discount Price</label>
                                        <input type="text" name="discount" id="" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="form-label">Product Description</label>
                                        <textarea name="description" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group" style="display: inline-block; width: 49%; margin-right: .8%;>
                                          <label for="" class="  form-label">Product Image</label>
                                        <input type="file" name="product_image" class="form-control">
                                    </div>
                                    <div class="form-group" style="display: inline-block; width: 49%; margin-left: .8%;>
                                          <label for="" class="  form-label">Product Thumbnail</label>
                                        <input multiple type="file" name="product_thumbnail[]" class="form-control">
                                    </div>
                                    <div class="form-group text-center mt-3">
                                        <button
                                            style="text-transform: uppercase; letter-spacing: 2px; background-color: #fb5d5d; color: white;"
                                            class="btn text-center" type="submit">Add Sub Category</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 20px">
                    <div class="col-lg-12 m-auto">
                        <div class="card">
                            <div class="card-header"
                                style="text-transform: uppercase; letter-spacing: 2px; background-color: #fb5d5d; color: white;">
                                <div class="card-title">
                                    <h2
                                        style="text-transform: uppercase; letter-spacing: 2px; color: white; text-align: center;">
                                        Products Information</h2>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Sl</th>
                                            {{-- <th scope="col">Category Name</th>
                                    <th scope="col">Subcategory Name</th> --}}
                                            <th scope="col">Product Name</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Discount</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $key => $product)
                                            <tr>
                                                <th scope="row">{{ $key + 1 }}</th>
                                                <td>{{ $product->product_name }}</td>
                                                <td>{{ $product->product_price }}</td>
                                                <td>{{ $product->discount_price }}</td>
                                                <td>{{ substr($product->description, 0, 50) . ' ' . 'More...' }}</td>
                                                <td>
                                                    <img width="50"
                                                        src="{{ asset('uploads/products/preview') }}/{{ $product->product_image }}"
                                                        alt="">
                                                </td>
                                                <td><a class="btn btn-primary"
                                                        href="{{ route('inventory', $product->id) }}">Inventory</a></td>
                                                <td><a class="btn btn-success"
                                                        href="{{ url('/edit/product') }}/{{ $product->id }}">Edit</a>
                                                </td>
                                                <td><a class="btn btn-danger" href="3">Delete</a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div><!-- sl-pagebody -->
        </div><!-- sl-mainpanel -->
        <!-- ########## END: MAIN PANEL ########## -->
    @endsection
    @section('footer_script')
        <script>
            $('#select_category').change(function() {
                var category_id = $(this).val();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: '/getsubcategory',
                    data: {
                        category_id: category_id
                    },
                    success: function(data) {
                        $('#subcategory').html(data);
                    }
                });

            });
            // In your Javascript (external .js resource or <script> tag)
            $(document).ready(function() {
                $('.select_category').select2();
            });
        </script>
    @endsection
