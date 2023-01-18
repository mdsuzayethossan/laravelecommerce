{{-- sub category --}}
@extends('layouts.admin')
@section('color&sizeactive')
    active
@endsection
@section('title')
    Covid-color&size
@endsection
@section('content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ url('/home') }}">Dashboard</a>
            <span class="breadcrumb-item active">Color & Size</span>
        </nav>

        <div class="sl-pagebody">
            <section>
                <div class="">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-header"
                                    style="text-transform: uppercase; letter-spacing: 2px; background-color: tomato; color: white;">
                                    <div class="card-title">
                                        <h1
                                            style="text-transform: uppercase; letter-spacing: 2px; color: white; text-align: center;">
                                            Subcategory Information</h1>
                                    </div>
                                </div>
                                @if (session('delete'))
                                    <div class="alert alert-success">
                                        {{ session('delete') }}
                                    </div>
                                @endif
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Sl</th>
                                                <th scope="col">Color Name</th>
                                                <th scope="col">Color Id</th>
                                                <th scope="col">Created At</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($colors as $color)
                                                <tr>
                                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                                    <td>{{ $color->color_name }}</td>
                                                    <td>
                                                        {{ $color->id }}
                                                        {{-- <i
                                                            style="background-color: {{ $color->color_code }}; width: 15px; height: 15px; display: inline-block; border-radius: 50%;">
                                                        </i> --}}
                                                    </td>
                                                    <td>{{ $color->created_at }}</td>
                                                    <td>
                                                        <a href="{{ url('/subcategory/edit') }}/{{ $color->id }}"
                                                            class="btn btn-warning">Edit</a>
                                                        <a href="{{ url('/subcategory/delete') }}/{{ $color->id }}"
                                                            style="background: linear-gradient(-155deg, #fb5d5d 0, #fd7863 98%, #f3dfe0 100%); color:white"
                                                            class="btn">Delete</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4" style="margin-bottom: 20px">
                            <div class="card">
                                <div class="card-header"
                                    style="text-transform: uppercase; letter-spacing: 2px; background: linear-gradient(-155deg, #fb5d5d 0, #fd7863 98%, #f3dfe0 100%); color: white;">
                                    <div class="card-title">
                                        <h2
                                            style="text-transform: uppercase; letter-spacing: 2px; color: white; text-align: center;">
                                            Add Color</h2>
                                    </div>
                                </div>
                                @if (session('insert_color'))
                                    <div class="alert alert-success">
                                        {{ session('insert_color') }}
                                    </div>
                                @endif

                                @if (session('subnameexist'))
                                    <div class="alert alert-warning">
                                        {{ session('subnameexist') }}
                                    </div>
                                @endif
                                <div class="card-body">
                                    <form action="{{ route('color_size_insert') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label class="form-label" for="">Color Name</label>
                                            <input type="text" name="color_name" class="form-control">
                                            @error('color_name')
                                                <div class="alert alert-warning">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="">Color Code</label>
                                            <input type="text" name="color_code" class="form-control">
                                            @error('color_code')
                                                <div class="alert alert-warning">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group text-center mt-3">
                                            <button
                                                style="text-transform: uppercase; letter-spacing: 2px; background: linear-gradient(-155deg, #fb5d5d 0, #fd7863 98%, #f3dfe0 100%); color: white;"
                                                class="btn text-center" type="submit">Add Color</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        {{-- Size Information --}}
                        <div class="col-lg-8">
                            <div class="card">
                                <div class="card-header"
                                    style="text-transform: uppercase; letter-spacing: 2px; background: linear-gradient(-155deg, #fb5d5d 0, #fd7863 98%, #f3dfe0 100%); color: white;">
                                    <div class="card-title">
                                        <h1
                                            style="text-transform: uppercase; letter-spacing: 2px; color: white; text-align: center;">
                                            Size Information</h1>
                                    </div>
                                </div>
                                @if (session('delete'))
                                    <div class="alert alert-success">
                                        {{ session('delete') }}
                                    </div>
                                @endif
                                <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Sl</th>
                                                <th scope="col">Size Name</th>
                                                <th scope="col">Size Id</th>
                                                <th scope="col">Created At</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sizes as $size)
                                                <tr>
                                                    <th scope="row">{{ $loop->index + 1 }}</th>
                                                    <td>{{ $size->size_name }}</td>
                                                    <td>{{ $size->id }}</td>
                                                    <td>{{ $size->created_at }}</td>
                                                    <td>
                                                        <a href="{{ url('/subcategory/edit') }}/{{ $size->id }}"
                                                            class="btn btn-warning">Edit</a>
                                                        <a href="{{ url('/subcategory/delete') }}/{{ $size->id }}"
                                                            style="background: linear-gradient(-155deg, #fb5d5d 0, #fd7863 98%, #f3dfe0 100%); color:white"
                                                            class="btn">Delete</a>
                                                    </td>
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
                                    style="text-transform: uppercase; letter-spacing: 2px; background: linear-gradient(-155deg, #fb5d5d 0, #fd7863 98%, #f3dfe0 100%); color: white;">
                                    <div class="card-title">
                                        <h2
                                            style="text-transform: uppercase; letter-spacing: 2px; color: white; text-align: center;">
                                            Add Size</h2>
                                    </div>
                                </div>
                                @if (session('insert_size'))
                                    <div class="alert alert-success">
                                        {{ session('insert_size') }}
                                    </div>
                                @endif

                                @if (session('subnameexist'))
                                    <div class="alert alert-warning">
                                        {{ session('subnameexist') }}
                                    </div>
                                @endif
                                <div class="card-body">
                                    <form action="{{ route('size_insert') }}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <label class="form-label" for="">Size Name</label>
                                            <input type="text" name="size_name" class="form-control">
                                            @error('size_name')
                                                <div class="alert alert-warning">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group text-center mt-3">
                                            <button
                                                style="text-transform: uppercase; letter-spacing: 2px; background: linear-gradient(-155deg, #fb5d5d 0, #fd7863 98%, #f3dfe0 100%); color: white;"
                                                class="btn text-center" type="submit">Add size</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div><!-- sl-pagebody -->
    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
@endsection
