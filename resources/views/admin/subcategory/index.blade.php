{{-- sub category --}}
@extends('layouts.admin')
@section('subcategoryactive')
active
@endsection
@section('title')
Covid-Subcategory
@endsection
@section('content')

<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{url('/home')}}">Dashboard</a>
        <span class="breadcrumb-item active">Subcategory</span>
    </nav>

    <div class="sl-pagebody">
        <section>
            <div class="">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header" style="text-transform: uppercase; letter-spacing: 2px; background-color: #fb5d5d; color: white;">
                                <div class="card-title">
                                    <h2 style="text-transform: uppercase; letter-spacing: 2px; color: white; text-align: center;">
                                        Subcategory Information</h2>
                                </div>
                            </div>
                            @if (session('delete'))
                                <div class="alert alert-success">
                                    {{session('delete')}}
                                </div>

                            @endif
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">Sl</th>
                                        <th scope="col">Category Name</th>
                                        <th scope="col">Sub Category Name</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Updated At</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($subcategories as $subcategory)
                                        <tr>
                                            <th scope="row">{{$loop->index+1}}</th>
                                            <td> @if (App\Models\category::find($subcategory->category_id)){{App\Models\category::find($subcategory->category_id)->category_name}}
                                            @else
                                            {{ 'uncategorized' }}

                                            @endif</td>
                                            <td>{{$subcategory->subcategory_name}}</td>
                                            <td>{{$subcategory->created_at}}</td>
                                            <td>{{$subcategory->updated_at}}</td>
                                            <td>
                                                <a href="{{url('/subcategory/edit')}}/{{$subcategory->id}}" class="btn btn-warning">Edit</a>
                                                <a href="{{url('/subcategory/delete')}}/{{$subcategory->id}}" style="background-color: #fb5d5d; color:white" class="btn">Delete</a>
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
                            <div class="card-header" style="text-transform: uppercase; letter-spacing: 2px; background-color: #fb5d5d; color: white;">
                                <div class="card-title">
                                    <h2 style="text-transform: uppercase; letter-spacing: 2px; color: white; text-align: center;">
                                        Add Subcategory</h2>
                                </div>
                            </div>
                            @if (session('insert'))
                                <div class="alert alert-success">
                                    {{session('insert')}}
                                </div>
                            @endif

                            @if (session('subnameexist'))
                            <div class="alert alert-warning">
                                {{session('subnameexist')}}
                            </div>
                        @endif
                            <div class="card-body">
                                <form action="{{route('sub_category_insert')}}" method="POST">
                                    @csrf

                                    <div class="form-group">
                                        <select name="category_id" id="" class="form-control form-label">
                                            <option value="">--Select Category--</option>
                                            @foreach ($categories as $category)
                                                <option value="{{$category->id}}">{{$category->category_name}}</option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <div class="alert alert-warning">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="">Sub Category Name</label>
                                        <input type="text" name="subcategory_name" class="form-control">
                                        @error('subcategory_name')
                                        <div class="alert alert-warning">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group text-center mt-3">
                                        <button style="text-transform: uppercase; letter-spacing: 2px; background-color: #fb5d5d; color: white;" class="btn text-center" type="submit">Add Sub Category</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- Trashed Subcategory Information --}}
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header" style="text-transform: uppercase; letter-spacing: 2px; background-color: #fb5d5d; color: white;">
                                <div class="card-title">
                                    <h1 style="text-transform: uppercase; letter-spacing: 2px; color: white; text-align: center;">
                                        Trashed Subcategory Information</h1>
                                </div>
                            </div>
                            @if (session('delete'))
                                <div class="alert alert-success">
                                    {{session('delete')}}
                                </div>

                            @endif
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">Sl</th>
                                        <th scope="col">Category Name</th>
                                        <th scope="col">Sub Category Name</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Updated At</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($subtrashed as $trashedsubcategory)
                                        <tr>
                                            <th scope="row">{{$loop->index+1}}</th>
                                            <td>
                                            @if (App\Models\category::find($trashedsubcategory->category_id))
                                            {{App\Models\category::find($trashedsubcategory->category_id)->category_name}}
                                            @else
                                             {{ ('uncategorized') }}

                                            @endif
                                        </td>
                                            <td>{{$trashedsubcategory->subcategory_name}}</td>
                                            <td>{{$trashedsubcategory->created_at}}</td>
                                            <td>{{$trashedsubcategory->updated_at}}</td>
                                            <td>
                                                <a href="{{url('/subcategory/restore')}}/{{$trashedsubcategory->id}}" class="btn btn-warning">Restore</a>
                                                <a href="{{url('/subcategory/permanent_delete')}}/{{$trashedsubcategory->id}}" style="background-color: #fb5d5d; color:white" class="btn">Delete</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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
