@extends('layouts.admin')
@section('content')
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ url('/home') }}">Dashboard</a>
            <span class="breadcrumb-item active">Inventory</span>
        </nav>

        <div class="sl-pagebody">
            <div class="row">
                <div class="col-lg-8">
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
                                        <th scope="col">Pro_Id</th>
                                        <th scope="col">Pro_Name</th>
                                        <th scope="col">color</th>
                                        <th scope="col">Co_Id</th>
                                        <th scope="col">Size</th>
                                        <th scope="col">Si_Id</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pro_inventories as $key => $pro_inventories)
                                        <tr>
                                            <th scope="row">{{ $key + 1 }}</th>
                                            <td>{{ $pro_inventories->product_id }}</td>
                                            <td>{{ App\Models\Product::find($pro_inventories->product_id)->product_name }}
                                            </td>
                                            <td>{{ App\Models\color::find($pro_inventories->color_id)->color_name }}</td>
                                            <td> {{ $pro_inventories->size_id }}</td>
                                            <td>{{ App\Models\size::find($pro_inventories->size_id)->size_name }}</td>
                                            <td>{{ $pro_inventories->size_id }}</td>
                                            <td>{{ $pro_inventories->product_quantity }}</td>
                                            <td><img src="{{ asset('') }}" alt=""></td>

                                        </tr>
                                    @endforeach

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header"
                            style="text-transform: uppercase; letter-spacing: 2px; background-color: #fb5d5d; color: white;">
                            <div class="card-title">
                                <h2
                                    style="text-transform: uppercase; letter-spacing: 2px; color: white; text-align: center;">
                                    Add Inventory</h2>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('/inventory/insert') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="" class="form-label">
                                        Product Name
                                    </label>
                                    <input type="text" readonly name="product_name"
                                        value="{{ $product_info->product_name }}" class="form-control">
                                    <input type="hidden" name="product_id" value="{{ $product_info->id }}"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <select name="color_id" id="" class="form-control">
                                        <option value="">--Select Color--</option>
                                        @foreach ($colors as $color)
                                            <option value="{{ $color->id }}">{{ $color->color_name }}</option>
                                        @endforeach


                                    </select>
                                </div>
                                <div class="form-group">
                                    <select name="size_id" id="" class="form-control">
                                        <option value="">--Select Size--</option>
                                        @foreach ($sizes as $size)
                                            <option value="{{ $size->id }}">{{ $size->size_name }}</option>
                                        @endforeach


                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="" class="form-label">Product Quantity</label>
                                    <input type="text" name="product_quantity" class="form-control">
                                </div>
                                <div class="form-group text-center mt-3">
                                    <button
                                        style="text-transform: uppercase; letter-spacing: 2px; background-color: #fb5d5d; color: white;"
                                        class="btn text-center" type="submit">Add Inventory</button>
                                </div>


                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
