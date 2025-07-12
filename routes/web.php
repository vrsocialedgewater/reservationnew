<?php
use App\Http\Middleware\AdminAuthMiddleware;
use App\Models\Booking;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\Admin\ProfileController;

//Booking
Route::get('/', function () {
    return view('booking');
});


Route::prefix('admin')->middleware([AdminAuthMiddleware::class]) ->group(function () {
    Route::get('/', \App\Livewire\Admin\Dashboard\Index::class);
    Route::get('locations', \App\Livewire\Admin\Location\Index::class);
    Route::get('locations/{location_id}', \App\Livewire\Admin\Location\View::class);

    Route::get('experience_types', \App\Livewire\Admin\ServiceType\Index::class);
    Route::get('experience_types/{service_type_id}', \App\Livewire\Admin\ServiceType\View::class);

    Route::get('experiences', \App\Livewire\Admin\Service\Index::class);
    Route::get('experiences/{service_id}', \App\Livewire\Admin\Service\View::class);

    Route::get('packages', \App\Livewire\Admin\Service\Package\Index::class);
//    Route::get('services/{service_id}', \App\Livewire\Admin\Service\Package\View::class);

    Route::get('upgrades', \App\Livewire\Admin\AdditionalService\Index::class);
    Route::get('upgrades/{additional_service_id}', \App\Livewire\Admin\AdditionalService\View::class);

    Route::get('schedules', \App\Livewire\Admin\BookingSchedule\Index::class);

    Route::get('schedules/generate', \App\Livewire\Admin\GenerateSchedule\Index::class);

    Route::get('holiday_schedules', \App\Livewire\Admin\HolidaySchedule\Index::class);

    Route::get('stripe_credentials', \App\Livewire\Admin\StripeCredential\Index::class);

    Route::get('bookings', [\App\Http\Controllers\Admin\AdminBookingController::class, 'index']);

    Route::get('orders', \App\Livewire\Admin\Order::class);

    Route::get('customers', \App\Livewire\Admin\Customer::class);


    Route::get('/profile', [ProfileController::class, 'index'])->name('admin.profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('admin.profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
    Route::get('/profile/change-password', [ProfileController::class, 'changePassword'])->name('admin.profile.change-password');

    Route::post('/profile/change-password', [ProfileController::class, 'updatePassword'])->name('admin.profile.update-password');
});


Route::get('/payment/{order}', function (\App\Models\Order $order) {
    return view('payment', compact('order'));
});

Route::get('/payment/{order}/success', function (\App\Models\Order $order) {
    return view('payment-success', compact('order'));
});

Route::get('/payment/return', [\App\Http\Controllers\StripePaymentController::class, 'return'])->name('payment.return');




Route::get('/orders/{order_unique_id}/invoice', function ($order_unique_id) {
    $order_id = base64_decode($order_unique_id);

    if (strpos($order_id, env('INVOICE_UNIQUE')) === 0) {
        $order_id = substr($order_id, strlen(env('INVOICE_UNIQUE')));
    }
    $booking = Booking::whereHas('order', function ($q){$q->where('status', 'succeeded');})->where("order_id", $order_id)->with('additionalServices', 'location', 'service.serviceType', 'bookingSchedule', 'order', 'servicePackage')->firstOrFail();
    $additional_price = 0;
    foreach ($booking->additionalServices as $additional_service) {
        $additional_price += @$additional_service['price'];
    }
    $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdfs.invoice', compact('booking', 'additional_price'));
    return $pdf->download(env('APP_NAME').' Invoice_'.$order_id.'.pdf');
//    return view('pdfs.invoice', compact('booking', 'additional_price'));
});






//Route::get('reset-password/{token}', [PasswordResetController::class, 'showResetForm'])
//->middleware('guest')->name('password.reset');
//
//Route::post('reset-password', [PasswordResetController::class, 'reset'])
//->middleware('guest')->name('password.update');


//
//Route::middleware([AdminAuthMiddleware::class])->group(function () {
//    Route::get('/admin', function () {
//        return view('admin.dashboard');
//    });
//
//
//

//});

require __DIR__.'/auth.php';
