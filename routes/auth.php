<?php
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminGuestMiddleware;

Route::middleware([AdminGuestMiddleware::class])->group(function () {
    Route::get('admin/login', function () {
        return view('admin.auth.login');
    });

    Route::get('admin/forgot-password', function () {
        return view('admin.auth.forgot-password');
    });

    Route::get('admin/reset-password/{token}', function () {
        return view('admin.auth.reset-password');
    })->name('password.reset');

});
