@extends('layouts.admin')
@section('submenus')
active
@endsection
@section('title')
Submenus
@endsection
@section('content')
 <!-- ########## START: MAIN PANEL ########## -->
 <div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="index.html">Dashboard</a>
      <a class="breadcrumb-item" href="index.html">Submenus</a>
    </nav>

    <div class="sl-pagebody">
      <div class="sl-page-title">
       <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header"
                style="text-transform: uppercase; letter-spacing: 2px; background: linear-gradient(-155deg, #fb5d5d 0, #fd7863 98%, #f3dfe0 100%); color: white;">
                    <div class="card-title">
                        <h1 style="text-transform: uppercase; letter-spacing: 2px; color: white; text-align: center;">
                            Submenus
                        </h1>
                    </div>

                </div>
                <div class="card-body">

                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header"
                style="text-transform: uppercase; letter-spacing: 2px; background: linear-gradient(-155deg, #fb5d5d 0, #fd7863 98%, #f3dfe0 100%); color: white;">
                    <div class="card-title">
                        <h1 style="text-transform: uppercase; letter-spacing: 2px; color: white; text-align: center;">
                            Add Submenus
                        </h1>
                    </div>

                </div>
                <div class="card-body">
                    <div class="form-group">
                        <select class="custom-select" style="width: 100%">
                            <option selected>Open this select menu</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Submenu Name</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Type submenu Name">
                    </div>
                    <div class="form-group text-center mt-3">
                        <button style="text-transform: uppercase; letter-spacing: 2px; background-color: #fb5d5d; color: white;" class="btn text-center" type="submit">Add Submenu</button>
                    </div>
                </div>
            </div>
        </div>
       </div>
      </div><!-- sl-page-title -->

    </div><!-- sl-pagebody -->
  </div><!-- sl-mainpanel -->
  <!-- ########## END: MAIN PANEL ########## -->
@endsection
