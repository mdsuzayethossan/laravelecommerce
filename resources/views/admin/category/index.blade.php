
@extends('layouts.admin')
@section('categoryactive')
    active
@endsection
@section('title')
    Covid-Category
@endsection

@section('content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="{{ url('/home') }}">Dashboard</a>
            <span class="breadcrumb-item active">Category</span>
        </nav>

        <div class="sl-pagebody">
            <div class="">
                <div class="row" style="margin-bottom: 50px;">
                    <div class="col-lg-4 m-auto">
                        <div class="card custom_card">
                            <div class="card-header"
                                style="text-transform: uppercase; letter-spacing: 2px; background: linear-gradient(-155deg, #fb5d5d 0, #fd7863 98%, #f3dfe0 100%); color: white;">
                                <div class="card-title">
                                    <h1
                                        style="text-transform: uppercase; letter-spacing: 2px; color: white; text-align: center;">
                                        Add Category</h1>
                                </div>

                            </div>
                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <div class="card-body">
                                <form action="{{ route('category_insert') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="" class="form-label">Category Name</label>
                                        <input type="text" class="form-control" name="category_name">
                                        @error('category_name')
                                            <strong class="text-danger">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                    <div class="form-group text-center mt-3">
                                        <button
                                            style="text-transform: uppercase; letter-spacing: 2px;background: linear-gradient(-155deg, #fb5d5d 0, #fd7863 98%, #f3dfe0 100%); color: white;"
                                            class="btn text-center" type="submit">Add Category</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-10 m-auto">
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
                                            <th scope="col">Category Name</th>
                                            <th scope="col">Added By</th>
                                            <th scope="col"> Image</th>
                                            <th scope="col">Created At</th>
                                            <th scope="col">Updated At</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <thead>
                                        @foreach ($catemaks as $category)
                                            <tr>
                                                <th scope="row">{{ $loop->index + 1 }}</th>
                                                <td>{{ $category->category_name }}</td>
                                                <td>{{ App\Models\User::where('id', $category->added_by)->first()->name }}
                                                </td>
                                                <td><img width="70"
                                                        src="{{ asset('uploads/category/') }}/{{ $category->category_image }}"
                                                        alt=""></td>
                                                <td>{{ $category->created_at->diffforHumans() }}</td>
                                                <td>{{ $category->updated_at->diffforHumans() }}</td>
                                                <td>
                                                    <a href="{{ url('/category/edit') }}/{{ $category->id }}"
                                                        class="btn btn-secondary">Edit</a>
                                                    <a href="{{ url('/category/delete') }}/{{ $category->id }}"
                                                        class="btn btn-danger">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </thead>
                                </table>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="row">
                    <div class="col-lg-10 m-auto">
                        <div class="card">
                            <div class="card-header"
                                style="text-transform: uppercase; letter-spacing: 2px; background: linear-gradient(-155deg, #fb5d5d 0, #fd7863 98%, #f3dfe0 100%); color: white;">
                                <div class="card-title">
                                    <h1
                                        style="text-transform: uppercase; letter-spacing: 2px; color: white; text-align: center;">
                                        Trashed Category Information</h1>
                                </div>
                            </div>
                            @if (session('cate_success'))
                                <div class="alert alert-success">
                                    {{ session('cate_success') }}
                                </div>
                            @endif
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Sl</th>
                                            <th scope="col">Category Name</th>
                                            <th scope="col">Added By</th>
                                            <th scope="col"> Image</th>
                                            <th scope="col">Created At</th>
                                            <th scope="col">Updated At</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <thead>
                                        @foreach ($trashed_categories as $trashed_category)
                                            <tr>
                                                <th scope="row">{{ $loop->index + 1 }}</th>
                                                <td>{{ $trashed_category->category_name }}</td>
                                                <td>{{ App\Models\User::where('id', $trashed_category->added_by)->first()->name }}
                                                </td>
                                                <td><img width="70"
                                                        src="{{ asset('uploads/category/') }}/{{ $trashed_category->category_image }}"
                                                        alt=""></td>
                                                <td>{{ $trashed_category->created_at->diffforHumans() }}</td>
                                                <td>{{ $trashed_category->updated_at->diffforHumans() }}</td>
                                                <td>
                                                    <a href="{{ url('/category/edit') }}/{{ $trashed_category->id }}"
                                                        class="btn btn-secondary">Edit</a>
                                                    <a href="{{ url('/category/restore') }}/{{ $trashed_category->id }}"
                                                        class="btn btn-danger">Restore</a>
                                                    <a href="{{ url('/category/forcedelete') }}/{{ $trashed_category->id }}"
                                                        class="btn btn-danger">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </thead>
                                </table>
                            </div>
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
    @if (session('category_force_delete'))
    const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  })

  Toast.fire({
    icon: 'success',
    title: '{{ session('category_force_delete') }}'
  });


@endif
</script>
@endsection
