<div>
    @include('admin.common.alert')

    <form wire:submit.prevent="createPaymentIntent">

        <input type="hidden" wire:model="amount" required />

        <!-- Include Stripe Elements for payment method input -->
        <div id="card-element"></div>

        <button type="submit">Pay</button>
    </form>


    <script src="https://js.stripe.com/v3/"></script>
    <script>
        document.addEventListener('livewire:init', function () {
            var stripe = Stripe('{{ config("services.stripe.key") }}');
            var elements = stripe.elements();
            var cardElement = elements.create('card');
            cardElement.mount('#card-element');

            cardElement.on('change', function(event) {
                // Example dynamic feedback like validation errors
            });

            Livewire.on('createPaymentMethod', function() {
                stripe.createPaymentMethod({
                    type: 'card',
                    card: cardElement,
                }).then(function(result) {
                    if (result.error) {
                        // Handle error
                    } else {
                        Livewire.emit('paymentMethodCreated', result.paymentMethod.id);
                    }
                });
            });

            Livewire.on('paymentMethodCreated', function(paymentMethodId) {
                Livewire.emit('completePayment', paymentMethodId);
            });
        });
    </script>

</div>

