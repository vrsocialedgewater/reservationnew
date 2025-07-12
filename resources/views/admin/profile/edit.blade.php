@extends('admin.layouts.app-main')

@section('container')
    <div class="container-fluid">
        <div class="user-profile">
            <div class="row">
                <!-- user profile first-style start-->
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <div>
                            <form class="theme-form needs-validation custom-input" method="POST" action="/admin/profile">
                                @csrf
                                <h3>Edit Profile</h3>
                                <hr/>

                                @if (session()->has('message'))
                                    <div class="alert alert-success">
                                        {{ session('message') }}
                                    </div>
                                @endif

                                @if (session()->has('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label class="col-form-label">Name</label>
                                    <div>
                                        <input class="form-control" type="text" required="" placeholder="Enter your name" name="name" value="{{ old('name', $user->name) }}">
                                    </div>
                                    @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Username</label>
                                    <div>
                                        <input class="form-control" type="text" required="" placeholder="Enter your username" name="username" value="{{ old('username', $user->username) }}">
                                    </div>
                                    @error('username') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Email</label>
                                    <div>
                                        <input class="form-control" type="email" required="" placeholder="Enter your email" name="email" value="{{ old('email', $user->email) }}">
                                    </div>
                                    @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>
                                <div class="form-group mb-0">
                                    <div class="text-end mt-3">
                                        <button class="btn btn-primary btn-block w-100" type="submit" id="submit">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        </div>

                    </div>
                </div>
                <!-- user profile first-style end-->
            </div>
        </div>
    </div>
@endsection
