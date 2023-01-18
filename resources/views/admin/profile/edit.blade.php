@extends('layouts.admin');
@section('content')
<!-- ########## START: MAIN PANEL ########## -->
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="index.html">Starlight</a>
      <a class="breadcrumb-item" href="index.html">Pages</a>
      <span class="breadcrumb-item active">Blank Page</span>
    </nav>

    <div class="sl-pagebody">
        <div class="row">
            <div class="col-lg-5 m-auto">
                <div class="card">
                    <div class="card-header" style="text-transform: uppercase; letter-spacing: 2px; background-color: #fb5d5d; color: white;">
                        <div class="card-title">
                            <h1 style="text-transform: uppercase; letter-spacing: 2px; color: white; text-align: center;">
                                Profile Edit</h1>
                        </div>


                    </div>
                    @if (session('update_pass'))
                        <div class="alert alert-warning">
                            {{session('update_pass')}}
                        </div>
                    @endif
                    @if (session('error_update_pass'))

                    <div class="alert alert-warning">
                        {{session('error_update_pass')}}
                    </div>

                    @endif
                    <div class="card-body">
                        <form action="{{url('/profile/update')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="" class="form-label">
                                    Change Name
                                </label>
                                <input type="text" class="form-control" name="profile_name" value="{{Auth::user()->name}}">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="ol_password" placeholder="Type Old Password">

                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password" placeholder="Type New Password">
                                @error('password')
                                    <div class="alert alert-warning">
                                        {{$message}}
                                    </div>

                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
                            </div>
                            <div class="form-group">
                                <label for="" class="form-label">Photo</label>
                                <input type="file" class="form-control" name="photo">
                                @error('photo')
                                    <div class="alert alert-warning">
                                        {{$message}}
                                    </div>

                                @enderror
                            </div>
                            <div class="form-group text-center mt-3">
                                <button style="text-transform: uppercase; letter-spacing: 2px; background-color: #fb5d5d; color: white;" class="btn text-center" type="submit">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- sl-pagebody -->
  </div><!-- sl-mainpanel -->
  <!-- ########## END: MAIN PANEL ########## -->

@endsection
