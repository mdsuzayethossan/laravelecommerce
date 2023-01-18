@extends('layouts.admin')
@section('dahboardactive')
    active
@endsection
@section('title')
    Covid-user
@endsection
@section('content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <span class="breadcrumb-item active">Dashboard</span>
        </nav>

        <div class="sl-pagebody">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title" style="text-transform: uppercase;">
                                    <h2>Welcome, {{ $logged_user }} <span class="float-end"> Total User:
                                            {{ $total_user }}</span></h2>
                                </div>
                            </div>
                            <div class="card-body">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Sl</th>
                                            <th scope="col">Name</th>

                                            <th scope="col">Email</th>
                                            <th scope="col">Role</th>
                                            <th scope="col">Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($all_users as $key => $user)
                                            <tr>
                                                <th scope="row">{{ $all_users->firstitem() + $key }}</th>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>
                                                    @php
                                                        if ($user->role == 1) {
                                                            echo 'Author';
                                                        } elseif ($user->role == 2) {
                                                            echo 'Admin';
                                                        } elseif ($user->role == 3) {
                                                            echo 'Moderator';
                                                        } elseif ($user->role == 4) {
                                                            echo 'Editor';
                                                        } elseif ($user->role == 5) {
                                                            echo 'Subscriber';
                                                        } else {
                                                            echo 'Viewer';
                                                        }
                                                    @endphp
                                                </td>
                                                <td>{{ $user->created_at->diffInHours() > 24? $user->created_at->format('d-m-y h:i:s A'): $user->created_at->diffForHumans() }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $all_users->links() }}

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header"
                                style="text-transform: uppercase; letter-spacing: 2px; background: linear-gradient(-155deg, #fd3d6b 0, #fd7863 98%, #f3dfe0 100%); color: white;">
                                <div class="card-title">
                                    <h1
                                        style="text-transform: uppercase; letter-spacing: 2px; color: white; text-align: center;">
                                        Add User</h1>

                                </div>
                            </div>
                            @if (session('add_role'))
                                <div class="alert alert-success">
                                    {{ session('add_role') }}
                                </div>
                            @endif
                            <div class="card-body">
                                <form action="{{ url('/add/role') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="" class="form-label">Name</label>
                                        <input type="text" class="form-control" name="name">
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="form-label">Email Address</label>
                                        <input type="email" class="form-control" name="email">
                                    </div>
                                    <div class="form-group">
                                        <label for="" class="form-label">Password</label>
                                        <input type="password" class="form-control" name="password">
                                    </div>
                                    <div class="form-group">
                                        <select name="role" id="" class="form-control">
                                            <option value="">--Select Role--</option>
                                            <option value="1">Owner</option>
                                            <option value="2">Admin</option>
                                            <option value="3">Moderator</option>
                                            <option value="4">Editor</option>
                                            <option value="5">Subscriber</option>
                                            <option value="6">Viewer</option>

                                        </select>
                                    </div>
                                    <div class="form-group text-center mt-3">
                                        <button
                                            style="text-transform: uppercase;     background: linear-gradient(-155deg, #fd3d6b 0, #fd7863 98%, #f3dfe0 100%); letter-spacing: 2px; color: white;"
                                            class="btn text-center" type="submit">Add User</button>
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
