<div>
    <div class="landing-home section-py-space pb-0 mt-5 bg-gray" id="main-container">
        <div class="container">
            <div class="row demo-block demo-imgs justify-content-center">
                <div class="col-lg-8 col-md-10 slideInUp wow">
                    <div class="card bg-black">
                        <div class="card-body">
                            @include('admin.common.alert')
                            @foreach($errors as $key -> $value)
                                <div class="text-danger">{{ $key }}: {{ $value }}</div>
                            @endforeach
                            <form class="g-3" wire:submit="makePayment">
                                <div style="display: {{ $checkout ? "none" : "block" }}">
                                    <livewire:booking.location/>
                                    <livewire:booking.service-type/>

                                    @if($service_type_id && $location_id)
                                        <livewire:booking.service location_id="{{ $location_id }}" service_type_id="{{ $service_type_id }}" service_type_text="{{ $service_type_text }}"/>

                                        @if($service_id)
                                            @if($service_image)
                                                <div class="card" id="service-image-card" >
                                                    <div class="card-body" >
                                                        <img class="img-thumbnail" id="service-image" src="{{ asset('storage/'.$service_image) }}" alt="{{ $service_id }}">
                                                    </div>
                                                </div>
                                            @endif
                                            <livewire:booking.person slots="{{ $slots }}"/>
                                            @if($persons > 0)
                                                <livewire:booking.calendar/>
                                                @if($date)
                                                    <livewire:booking.time date="{{ $date }}" service_id="{{ $service_id }}" slots="{{ $slots }}" quantity="{{ $persons }}"/>
{{--                                                    @if($booking_schedule_id)--}}
{{--                                                        <livewire:booking.quantity date="{{ $date }}" schedule_id="{{ $booking_schedule_id }}" quantity="{{ $quantity }}" start_time="{{ @$schedule['start_time'] }}" service_id="{{ $service_id }}" slots="{{ $slots }}"/>--}}
{{--                                                    @endif--}}
                                                @endif
                                            @endif
                                        @endif
                                    @endif

                                    <div class="card">
                                        <div class="card-header pb-0 border-b-info">
                                            <h3 class="sub-title">Summary</h3>
                                        </div>
                                        <div class="card-body bg-primary text-white">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h3 class="sub-title text-white">Venue</h3>

                                                    <h5 class="f-m-light mt-1 text-white">
                                                        {{ @$location['address'] }} <br/>
                                                        {{ @$location['city'] }} <br/>
                                                        {{ @$location['state'] }} <br/>
                                                        {{ @$location['zip_code'] }} <br/>
                                                        {{ @$location['phone_number'] }} <br/>
                                                    </h5>
                                                </div>
                                                <div class="col-md-6">
                                                    <h3 class="sub-title text-white">{{ $service_type_text }}</h3>
                                                    <h5 class="f-m-light mt-1 text-white">{{ $service_text }}</h5>
                                                    @if($service_package_id)
                                                        <h6 class="f-m-light mt-1 text-white text-muted">{{ $service_package_name }}</h6>
                                                    @endif
                                                    <h5 class="f-m-light mt-1 text-white">@if($persons) {{ $persons }} Player{{ $persons > 0 ? 's' : '' }} @endif</h5>
                                                    @if(!empty($additional_services))
                                                        <h4 class="f-m-light mt-1 text-white">Additional</h4>
                                                        @foreach($additional_services as $additional_service)
                                                            <h5 class="f-m-light mt-1 text-white">{{ @$additional_service['title'] }}</h5>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                            <hr/>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    @if(@$schedule['start_time'] and @$schedule['end_time'])
                                                    <h3 class="sub-title text-white">Session Time</h3>
                                                    <h5 class="f-m-light mt-1 text-white">{{ \Carbon\Carbon::parse($schedule['start_time'])->format('h:i A') }} - {{ \Carbon\Carbon::parse($schedule['end_time'])->format('h:i A') }}</h5>
                                                    <h5 class="f-m-light mt-1 text-white">Outbreak ({{ \Carbon\Carbon::parse($schedule['start_time'])->diffInMinutes(\Carbon\Carbon::parse($schedule['end_time'])) }} Minutes)</h5>
                                                    <h6 class="f-m-light mt-1 text-white">Arrive 15 minutes early for the safety briefing and experience intro.</h6>
                                                    @endif
                                                </div>
                                                <div class="col-md-6">
                                                    @if(@$persons && $price)
                                                        <h3 class="sub-title text-white">Ticket</h3>
                                                        @if(!$fixed_price)
                                                            <h5 class="f-m-light mt-1 text-white">Per Person ${{ $price }}</h5>
                                                        @endif
                                                        @if(!empty($additional_services))
                                                            <h5 class="f-m-light mt-1 text-white">Total Additional Price ${{ $additional_total_price }} </h5>
                                                        @endif
                                                        <h5 class="f-m-light mt-1 text-white">Players {{ $persons }}
                                                            @if(!$fixed_price)
                                                                x ${{ $price }}
                                                            @endif
                                                        </h5>
                                                        <h5 class="f-m-light mt-1 text-white">6% Booking Fee ${{ $fee }}</h5>
                                                        <h5 class="f-m-light mt-1 text-white">Total ${{ $total_price}}</h5>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @if($persons > 0 && $date && $service_id)
                                        <div class="card border-0">
                                            <div class="card-body">
                                                <button type="button" wire:click="checkoutOn" class="btn btn-primary btn-lg float-end">Proceed to checkout</button>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div style="display: {{ $checkout ? "block" : "none" }}">
                                    <div class="row demo-block demo-imgs">
                                        <div class="col-md-12  slideInUp wow">
                                            <div class="card">
                                                <div class="card-header border-b-info">
                                                    {{--                    <a href="/"> <h2 class=" float-start"> <i class="fa fa-arrow-left"></i> Previous </h2> </a>--}}
                                                    <h2 class="float-end">Checkout</h2>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                        </div>
                                        <div class="col-md-6 slideInUp wow" id="user-information-section">
                                            <div class="card bg-black">
                                                <div class="card-body">
                                                    <div class="card">
                                                        <div class="card-header pb-0 border-b-info">
                                                            <h3 class="sub-title">Email Address</h3>
                                                        </div>
                                                        <div class="card-body">
                                                            <input class="form-control form-control-lg" type="email" placeholder="Enter your email" wire:model="email" required >
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-header pb-0 border-b-info">
                                                            <h3 class="sub-title">Full Name</h3>
                                                        </div>
                                                        <div class="card-body">
                                                            <input class="form-control form-control-lg" type="text" placeholder="Enter your full name" wire:model="name" required>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-header pb-0 border-b-info">
                                                            <h3 class="sub-title">Phone Number</h3>
                                                        </div>
                                                        <div class="card-body">
                                                            <input class="form-control form-control-lg" type="text" placeholder="Enter your phone number" wire:model="number" required>
                                                        </div>
                                                    </div>
                                                    <div class="card">
                                                        <div class="card-header pb-0 border-b-info">
                                                            <h3 class="sub-title text-info">Important Information</h3>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="form-check radio radio-primary ps-0">
                                                                <ul class="list-group list-group-flush">
                                                                    <li class="list-group-item text-info">
                                                                        Glasses are permitted however contact lenses are recommended.
                                                                    </li>
                                                                    <li class="list-group-item text-info">
                                                                        Refer to packages for minimum age requirements. Players must be taller than 130cm
                                                                    </li>
                                                                    <li class="list-group-item text-info">
                                                                        We will not permit players who are under the influence of alcohol or drugs.
                                                                    </li>
                                                                    <li class="list-group-item text-info">
                                                                        We do not recommend our experiences for players who are pregnant, or who have a heart condition or seizure disorder.
                                                                    </li>
                                                                    <li class="list-group-item text-info">
                                                                        The purchasing customer is responsible for sharing the Terms and Conditions with other players in their booking.
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 slideInUp wow">

                                            <livewire:booking.additional-service service_id="{{ $service_id }}"/>
                                            <div class="card checkout-summery">
                                                <div class="card-header pb-0 border-b-info">
                                                    <h3 class="sub-title">Summary</h3>
                                                </div>
                                                <div class="card-body bg-primary text-white">

                                                    <div class="row">
                                                        <div class="col-md-6">

                                                        </div>
                                                        <div class="col-md-6">

                                                        </div>
                                                    </div>
                                                    <hr/>
                                                    <div class="row">
                                                        <div class="col-md-6">

                                                        </div>
                                                        <div class="col-md-6">

                                                        </div>
                                                    </div>


                                                    <h3 class="sub-title text-white">Venue</h3>

                                                    <h5 class="f-m-light mt-1 text-white">
                                                        {{ @$location['address'] }} <br/>
                                                        {{ @$location['city'] }} <br/>
                                                        {{ @$location['state'] }} <br/>
                                                        {{ @$location['zip_code'] }} <br/>
                                                        {{ @$location['phone_number'] }} <br/>
                                                    </h5>
                                                    <hr/>
                                                    <h3 class="sub-title text-white">{{ $service_type_text }}</h3>
                                                    <h5 class="f-m-light mt-1 text-white">{{ $service_text }}</h5>
                                                    @if($service_package_id)
                                                        <h6 class="f-m-light mt-1 text-white text-muted">{{ $service_package_name }}</h6>
                                                    @endif
                                                    <h5 class="f-m-light mt-1 text-white">@if($persons) {{ $persons }} Player{{ $persons > 0 ? 's' : '' }} @endif</h5>
                                                    @if(!empty($additional_services))
                                                        <h4 class="f-m-light mt-1 text-white">Additional</h4>
                                                        @foreach($additional_services as $additional_service)
                                                            <h5 class="f-m-light mt-1 text-white">{{ @$additional_service['title'] }}</h5>
                                                        @endforeach
                                                    @endif
                                                    <hr/>
                                                    @if(@$schedule['start_time'] and @$schedule['end_time'])
                                                        <h3 class="sub-title text-white">Session Time</h3>
                                                        <h5 class="f-m-light mt-1 text-white">{{ \Carbon\Carbon::parse($schedule['start_time'])->format('h:i A') }} - {{ \Carbon\Carbon::parse($schedule['end_time'])->format('h:i A') }}</h5>
                                                        <h5 class="f-m-light mt-1 text-white">Outbreak ({{ \Carbon\Carbon::parse($schedule['start_time'])->diffInMinutes(\Carbon\Carbon::parse($schedule['end_time'])) }} Minutes)</h5>
                                                        <h6 class="f-m-light mt-1 text-white">Arrive 15 minutes early for the safety briefing and experience intro.</h6>
                                                    @endif
                                                    <hr/>
                                                    @if(@$persons && $price)
                                                        <h3 class="sub-title text-white">Ticket</h3>
                                                        @if(!$fixed_price)
                                                            <h5 class="f-m-light mt-1 text-white">Per Person ${{ $price }}</h5>
                                                        @endif
                                                        @if(!empty($additional_services))
                                                            <h5 class="f-m-light mt-1 text-white">Total Additional Price ${{ $additional_total_price }} </h5>
                                                        @endif
                                                        <h5 class="f-m-light mt-1 text-white">Players {{ $persons }}
                                                            @if(!$fixed_price)
                                                                x ${{ $price }}
                                                            @endif
                                                        </h5>
                                                        <h5 class="f-m-light mt-1 text-white">6% Booking Fee ${{ $fee }}</h5>
                                                        <h5 class="f-m-light mt-1 text-white">Total ${{ $total_price }}</h5>
                                                        <h5 class="f-m-light mt-1 text-white">Deposit Amount ${{ $partial_payment }}</h5>
                                                        <h5 class="f-m-light mt-1 text-white">Due at Event ${{ $total_price - $partial_payment }}</h5>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 slideInUp wow">
                                            <div class="card">
                                                <div class="card-header pb-0 border-b-info">
                                                    <h3 class="sub-title">Payment</h3>
                                                </div>
                                                <div class="card-footer">
                                                    <button class="btn btn-primary btn-lg float-end" type="submit" wire:loading.attr="disabled">Proceed to Payment</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

{{--    <div wire:ignore.self class="modal fade" id="form_modal" tabindex="-1" role="dialog" aria-labelledby="form_modal" aria-hidden="true" data-backdrop="static" data-keyboard="false">--}}
{{--        <div class="modal-dialog modal-dialog-centered" role="document">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header bg-secondary-subtle modal-lg">--}}
{{--                    <h4 class="p-1">Make Payment</h4>--}}
{{--                    <button class="btn-close py-0" type="button" data-bs-dismiss="modal" aria-label="Close"></button>--}}
{{--                </div>--}}
{{--                <div class="modal-body">--}}
{{--                    @if($has_payment && $total_price)--}}
{{--                        <livewire:booking.payment  amount="{{ $total_price }}"/>--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <livewire:booking.payment  amount="65"/>--}}
</div>

<script>
    document.addEventListener('livewire:init', function () {
        Livewire.hook('element.init', () => {
            initialize();
        });
        Livewire.hook('morph.updated', () => {
            initialize();
        })

        Livewire.on('open_payment_modal', () => {
            $('#form_modal').modal('show');
        });

        Livewire.on('unset_package', () => {
            setTimeout(function() {
                if ($('input[name="service_package"]').is(':checked')) {
                    // Uncheck all radio buttons in the group
                    $('input[name="service_package"]:checked').prop('checked', false);
                }
            }, 300);
        });
    });

    function initialize() {
        $(document).ready(function() {
            flatpickr("#inline-calender", {
                inline: true,
                minDate: "today",
                onChange: function(selectedDates, dateStr, instance) {
                    Livewire.dispatch('set_date', {date: dateStr})
                }
            });
        } );
    }

</script>



