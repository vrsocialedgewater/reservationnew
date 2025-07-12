<?php

namespace App\Livewire\Booking;

use App\Jobs\SendBookingConfirmationJob;
use App\Mail\AdminBookingConfirmationMail;
use App\Mail\BookingConfirmation;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\On;
use Livewire\Component;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Exception;

class Payment extends Component
{
    public $order_id, $order, $loading = false;
    public $paymentMethodId;

    public function mount(){
        $this->order = Order::where("status", "incomplete")->with('booking')->findOrFail($this->order_id);
    }

    public function createPaymentIntent($paymentMethodId)
    {
        $this->paymentMethodId = $paymentMethodId;
        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $paymentIntent = PaymentIntent::create([
                'amount' => $this->order->partial_payment ? $this->order->partial_payment * 100 : $this->order->price * 100, // Convert to cents
                'currency' => 'usd',
                'payment_method' => $paymentMethodId,
                'confirmation_method' => 'manual',
                'confirm' => true,
                'return_url' => url('/payment/return'),
            ]);
            $this->order->update(["status" => "succeeded"]);
            $this->success = true;
            session()->flash('form-success', 'Payment done.');

            // Send the email
//            dispatch(new SendBookingConfirmationJob(["to" => $this->order->booking->email, "order_id" => $this->order->id]));
            try {
                Mail::to($this->order->booking->email)->send(new BookingConfirmation($this->order->id));
            } catch (Exception $e) {
                logger("Mail confirmation failed");
                logger($e->getMessage());
            }

            try {
                Mail::to(env('MAIL_CONTACT'))->send(new AdminBookingConfirmationMail($this->order->id));
            } catch (Exception $e) {
                logger("Admin mail confirmation failed");
                logger($e->getMessage());
            }

            return redirect('/payment/' . $this->order->id . '/success' );


        } catch (\Exception $e) {
            session()->flash('form-error', $e->getMessage());
        }
    }

    public function proceedPaymentIntent()
    {

    }

    public function render()
    {
        return view('booking.payment');
    }
}
