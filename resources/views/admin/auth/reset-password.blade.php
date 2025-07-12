@extends('admin.layouts.auth')

@section('container')
    <div class="login-main">
        <livewire:admin.reset-password :token="request()->token" />
    </div>
@endsection
