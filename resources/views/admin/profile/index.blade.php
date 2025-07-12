@extends('admin.layouts.app-main')
@section('styles')

@endsection

@section('container')
    <div class="container-fluid">
        <div class="user-profile">
            <div class="row">
                <!-- user profile first-style start-->
                <div class="col-sm-12">
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <div class="card hovercard text-center">
                        <div class="user-image">
                            <div class="avatar"><img alt="" src="/assets/images/avatar.jpg"></div>
{{--                            <div class="icon-wrapper"><i class="icofont icofont-pencil-alt-5"></i></div>--}}
                        </div>
                        <div class="info">
                            <div class="row">
                                <div class="col-sm-6 col-lg-4 order-sm-1 order-xl-0">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="ttl-info text-start">
                                                <h6><i class="fa fa-envelope"></i>&nbsp;&nbsp;Email</h6><span>{{ $user->email }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="ttl-info text-start">
                                                <h6><i class="fa fa-user"></i>&nbsp;&nbsp;Username</h6><span>{{ $user->username }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-lg-4 order-sm-0 order-xl-1">
                                    <div class="user-designation">
                                        <div class="title"><a target="_blank" href="">{{ $user->name }}</a></div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-4 order-sm-2 order-xl-2">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="ttl-info text-start">
                                                <h6><a href="/admin/profile/edit"><i class="fa fa-pencil"></i>&nbsp;&nbsp;Edit</a></h6><span></span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="ttl-info text-start">
                                                <h6><a href="/admin/profile/change-password"><i class="fa fa-key"></i>&nbsp;&nbsp;Change Password</a> </h6><span></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- user profile first-style end-->
            </div>
        </div>
    </div>
@endsection


@section("scripts")

@endsection
