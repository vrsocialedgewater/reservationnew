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
                                <form class="theme-form needs-validation custom-input" method="POST" action="/admin/profile/change-password">
                                    @csrf
                                    <h3>Change Password</h3>
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
                                        <label class="col-form-label">Old Password</label>
                                        <div>
                                            <input class="form-control" type="password" required="" placeholder="Enter your old password" name="old_password">
                                        </div>
                                        @error('old_password') <div class="text-danger">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">New Password</label>
                                        <div>
                                            <input class="form-control" type="password" required="" placeholder="Enter new password" name="password">
                                        </div>
                                        @error('password') <div class="text-danger">{{ $message }}</div> @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">Confirm Password</label>
                                        <div>
                                            <input class="form-control" type="password" required="" placeholder="Enter your new password" name="password_confirmation">
                                        </div>
                                        @error('password_confirmation') <div class="text-danger">{{ $message }}</div> @enderror
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
