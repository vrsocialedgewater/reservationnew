@extends('layouts.booking')

@section('styles')
    <style>
        .payment-section {
            min-height: 90vh;
            margin: 0;
            padding: 0;
        }
        /*.landing-home {*/
        /*    padding-top: 110px !important;*/
        /*}*/
    </style>
@endsection

@section('container')
    <div class="landing-home payment-section section-py-space pb-0 mt-5 bg-gray" id="main-container">
        <div class="container">
            <div class="row demo-block demo-imgs justify-content-center">
                <div class="col-lg-8 col-md-10 slideInUp wow">
                    <div class="card bg-black">
                        <div class="card-body">
                            <livewire:booking.payment order_id="{{ $order->id }}"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        {{--var stripe = Stripe("{{ env('STRIPE_KEY') }}");--}}
        {{--var elements = stripe.elements();--}}

        {{--var style = {--}}
        {{--    base: {--}}
        {{--        color: '#ffffff',--}}
        {{--        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',--}}
        {{--        fontSmoothing: 'antialiased',--}}
        {{--        fontSize: '16px',--}}
        {{--        '::placeholder': {--}}
        {{--            color: '#aab7c4'--}}
        {{--        }--}}
        {{--    },--}}
        {{--    invalid: {--}}
        {{--        color: '#eb1c26',--}}
        {{--        iconColor: '#eb1c26'--}}
        {{--    }--}}
        {{--};--}}

        {{--var card = elements.create('card', {style: style});--}}
        {{--card.mount('#card-element');--}}

        {{--var form = document.getElementById('payment-form');--}}
        {{--form.addEventListener('submit', function(event) {--}}
        {{--    event.preventDefault();--}}

        {{--    stripe.createToken(card).then(function(result) {--}}
        {{--        if (result.error) {--}}
        {{--            // Inform the user if there was an error.--}}
        {{--            var errorElement = document.querySelector('.alert');--}}
        {{--            errorElement.textContent = result.error.message;--}}
        {{--            errorElement.classList.add('alert-danger');--}}
        {{--        } else {--}}
        {{--            // Send the token to your server.--}}
        {{--            var hiddenInput = document.createElement('input');--}}
        {{--            hiddenInput.setAttribute('type', 'hidden');--}}
        {{--            hiddenInput.setAttribute('name', 'stripeToken');--}}
        {{--            hiddenInput.setAttribute('value', result.token.id);--}}
        {{--            form.appendChild(hiddenInput);--}}

        {{--            // Submit the form--}}
        {{--            form.submit();--}}
        {{--        }--}}
        {{--    });--}}
        {{--});--}}
    </script>
@endsection
