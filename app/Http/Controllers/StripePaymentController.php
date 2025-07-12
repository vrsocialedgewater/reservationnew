<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\PaymentIntent;

class StripePaymentController extends Controller
{
    public function return(Request $request)
    {
        // Handle the redirect back from Stripe here
        $paymentIntentId = $request->query('payment_intent');

        // Retrieve the PaymentIntent and check its status
        $intent = PaymentIntent::retrieve($paymentIntentId);

        if ($intent->status === 'succeeded') {
            // Payment was successful; process the order here
            return 'Payment successful!';
        } else {
            // Handle failed payment
            return 'Payment failed or requires additional action.';
        }
    }
}
