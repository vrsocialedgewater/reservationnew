@assets
<style>
    #card-element {
        border: 1px solid #ced4da;
        border-radius: 0.375rem;
        padding: 10px;
        margin-top: 10px;
    }
    .StripeElement {
        background-color: white;
        padding: 8px 12px;
        border-radius: 4px;
        border: 1px solid transparent;
        box-shadow: 0 1px 3px 0 #e6ebf1;
        transition: box-shadow 150ms ease;
    }
    .StripeElement--focus {
        box-shadow: 0 1px 3px 0 #cfd7df;
    }
    .StripeElement--invalid {
        border-color: #fa755a;
    }
    .StripeElement--webkit-autofill {
        background-color: #fefde5 !important;
    }
    .card-icons {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
    }
    .card-icons img {
        width: 40px;
        height: auto;
    }

    .overlay {
        position: fixed; /* Sit on top of the page content */
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5); /* Black with opacity */
        z-index: 1000; /* High z-index to sit on top */
        display: flex;
        justify-content: center;
        align-items: center;
        display: none; /* Initially hidden */
    }

    /* Loading Icon Style */
    .loading-icon {
        font-size: 8rem;
        color: white;
    }

    .payment-form {
        max-width: 400px;
        margin: 50px auto;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        font-family: Arial, sans-serif;
    }
    .form-group {
        margin-bottom: 20px;
    }
    .form-group label {
        display: block;
        margin-bottom: 5px;
        font-size: 14px;
    }
    .form-group div {
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #f9f9f9;
    }
    #card-errors {
        color: red;
        margin-top: 10px;
    }
    button {
        width: 100%;
        padding: 10px;
        background-color: #28a745;
        color: #fff;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    button:hover {
        background-color: #218838;
    }
</style>
@endassets


<div>
    <div class="overlay" id="loadingOverlay">
        <i class="fa fa-xl fa-spinner fa-spin loading-icon"></i>
    </div>

    <h2>Stripe Payment</h2>
    <hr/>
    @include('admin.common.alert')
    <div id="stripe-error" class="alert txt-danger border-danger outline-2x alert-dismissible fade alert-icons" role="alert">
        <i class="fa fa-exclamation-triangle"></i>
        <p></p>
        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <div class="card-icons">
        <h3>Supported Cards</h3><br/>
        <!-- Card Icons -->
        <img src="https://img.icons8.com/color/48/000000/visa.png" alt="Visa">
        <img src="https://img.icons8.com/color/48/000000/mastercard.png" alt="MasterCard">
        <img src="https://img.icons8.com/color/48/000000/amex.png" alt="American Express">
        <img src="https://img.icons8.com/ios-filled/50/000000/discover.png" alt="Discover">
        <img src="https://img.icons8.com/ios-filled/50/000000/diners-club.png" alt="Diners Club">
        <img src="https://img.icons8.com/ios-filled/50/000000/jcb.png" alt="JCB">
    </div>
    <form id="payment-form" >

        <div class="mb-3">
            <label for="amount" class="form-label">Total bill: ${{ @$order->price }}</label><br/>
            <label for="amount" class="form-label">Deposit Amount: ${{ @$order->partial_payment }}</label>
            <input type="hidden" wire:model="amount" required />
        </div>



        <!-- Include Stripe Elements for payment method input -->
{{--        <div class="mb-3">--}}
{{--            <label for="card-element" class="form-label">Credit or debit card</label>--}}
{{--            <div id="card-element"></div>--}}
{{--        </div>--}}

        <div class="form-group">
            <label for="card-number">Card Number</label>
            <div id="card-number"></div>
        </div>
        <div class="form-group">
            <label for="card-expiry">Expiry Date</label>
            <div id="card-expiry"></div>
        </div>
        <div class="form-group">
            <label for="card-cvc">CVC</label>
            <div id="card-cvc"></div>
        </div>

        <button type="submit" class="btn btn-primary w-100" onclick="showLoadingOverlay()"> ${{ @$order->partial_payment }} Pay Now</button>
    </form>

</div>



<script src="https://js.stripe.com/v3/"></script>
<script>
    document.addEventListener('livewire:init', function () {
        var stripe = Stripe('{{ config("services.stripe.key") }}');
        var elements = stripe.elements();
        const options = {
            style: {
                base: {
                    color: "#ffffff",
                    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                    fontSmoothing: "antialiased",
                    fontSize: "16px",
                    "::placeholder": {
                        color: "#aab7c4"
                    }
                },
                invalid: {
                    color: "#eb1c26",
                    iconColor: "#eb1c26"
                }
            }
        };
        // var cardElement = elements.create('card', options);
        // cardElement.mount('#card-element');

        const cardNumber = elements.create('cardNumber', options);
        const cardExpiry = elements.create('cardExpiry', options);
        const cardCvc = elements.create('cardCvc', options);

        cardNumber.mount('#card-number');
        cardExpiry.mount('#card-expiry');
        cardCvc.mount('#card-cvc');

        Livewire.hook('morph.updated', ({ component, cleanup }) => {
            var elements = stripe.elements();
            const cardNumber = elements.create('cardNumber', options);
            const cardExpiry = elements.create('cardExpiry', options);
            const cardCvc = elements.create('cardCvc', options);

            cardNumber.mount('#card-number');
            cardExpiry.mount('#card-expiry');
            cardCvc.mount('#card-cvc');
            // var cardElement = elements.create('card', options);
            // cardElement.mount('#card-element');
        })

        Livewire.on('payment_error', (r) => {
            hideLoadingOverlay();
        });

        form = document.getElementById('payment-form')
        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            stripe.createPaymentMethod({
                type: 'card',
                card: cardNumber,
            }).then(function(result) {
                if (result.error) {
                    console.log("error");
                    document.getElementById("")
                    hideLoadingOverlay();
                } else {
                    @this.call('createPaymentIntent', result.paymentMethod.id)
                }
            });
        });



    });

    function showLoadingOverlay() {
        document.getElementById('loadingOverlay').style.display = 'flex';
    }

    function hideLoadingOverlay() {
        document.getElementById('loadingOverlay').style.display = 'none';
    }


</script>
