@extends('admin.layouts.app-main')
@section('styles')
    <link rel="stylesheet" type="text/css" href="/assets/css/vendors/calendar.css">
@endsection

@section('container')
    <div>
        <div class="container-fluid calendar-basic">
            <div class="card">
                <div class="card-body">
                    <div class="row" id="wrap">
                        <div class="col-12 box-col-12">
                            <div class="calendar-default" id="calendar-container">
                                <div id="calendar"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal modal-lg fade" id="booking_modal" tabindex="-1" role="dialog" aria-labelledby="booking_modal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-secondary-subtle ">
                        {{--                    <ul class="modal-img">--}}
                        {{--                        <li> <img src="../assets/images/gif/successful.gif" alt="error" style="width: 50px; height: 50px"></li>--}}
                        {{--                    </ul>--}}
                        <h4 class="p-1" id="booking-title"></h4>
                        <p class="text-muted pt-3" id="booking-date"></p>
                    </div>
                    <div class="modal-body">
                        <div class="modal-toggle-wrapper">
                            <div class="table-responsive custom-scrollbar">
                                <table class="table table-bordered">
                                    <tbody>
                                    <tr>
                                        <td>Additional Services</td>
                                        <td class="w-50" id="additional-services"></td>
                                    </tr>

                                    <tr>
                                        <td>Total Players</td>
                                        <td class="w-50" id="total-quantity"></td>
                                    </tr>
                                    <tr>
                                        <td rowspan="4">Booking Schedule</td>
                                        <td class="w-50" id="total-duration"></td>
                                    </tr>
                                    <tr>
                                        <td class="w-50" id="start-date-time"></td>
                                    </tr>
                                    <tr>
                                        <td class="w-50" id="end-date-time"></td>
                                    </tr>
                                    <tr>
                                        <td class="w-50" id="schedule-slot"></td>
                                    </tr>
                                    <tr>
                                        <td rowspan="3">Customer Information</td>
                                        <td class="w-50" id="customer-name"></td>
                                    </tr>
                                    <tr>
                                        <td class="w-50" id="customer-email"></td>
                                    </tr>
                                    <tr>
                                        <td class="w-50" id="customer-phone"></td>
                                    </tr>
                                    <tr>
                                        <td rowspan="5">Payment Information</td>
                                        <td class="w-50" id="sub-total"></td>
                                    </tr>
                                    <tr>
                                        <td class="w-50" id="fee-amount"></td>
                                    </tr>
                                    <tr>
                                        <td class="w-50" id="total-amount"></td>
                                    </tr>
                                    <tr>
                                        <td class="w-50" id="partial-amount"></td>
                                    </tr>
                                    <tr>
                                        <td class="w-50" id="due-amount"></td>
                                    </tr>
{{--                                    <tr>--}}
{{--                                        <td colspan="2" style="text-align: center"><a href="{{ url('/orders/' . base64_encode( env('INVOICE_UNIQUE') . $order_id) . '/invoice') }}" class="button">Download Receipt</a></td>--}}
{{--                                    </tr>--}}



                                    </tbody>
                                </table>
                            </div>

                            {{--                        <h6>Additional services: Snack Packs, Comfort Amenities, Entertainment Extras</h6>--}}
                            {{--                        <h6></h6>--}}
                            {{--                        <h6>Booking Duration 60:00 minutes</h6>--}}
                            {{--                        <h6>Wednesday, October 4, 2024, 4:35 PM - 5:35 PM</h6>--}}
                            {{--                        <p>5505 W 20th Ave suite 200, Edgewater</p>--}}

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary d-flex m-auto" type="button" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section("scripts")
<script src="../assets/js/calendar/fullcalendar.min.js"></script>
<script>

    document.addEventListener('livewire:init', function () {
        Livewire.hook('element.init', () => {
            initialize();
        });
        Livewire.hook('morph.updated', ({ component, cleanup }) => {
            // initialize();
        })
    });

    function initialize() {

            var calendarEl = document.getElementById('calendar');
            var today = new Date();
            var firstDayOfCurrentMonth = new Date(today.getFullYear(), today.getMonth(), 1);
            var calendar = new FullCalendar.Calendar(calendarEl, {
                eventClick: function(info) {
                    $('#booking_modal').modal('show');
                    $('#booking-title').text(info.event.title);
                    $('#booking-date').text(info.event.extendedProps?.start_formatted_date);
                    if(info.event.extendedProps?.additional_services){
                        var htmlContent = "<ul>";
                        var additionalServices = info.event.extendedProps.additional_services;

                        additionalServices.forEach(function(additionalService) {
                            htmlContent += "<li>"+ additionalService?.title +"</li>";
                        });
                        $('#additional-services').html(htmlContent)
                        htmlContent += "</ul>";
                    }
                    $('#total-quantity').text(info.event.extendedProps?.quantity);
                    $('#total-duration').text(info.event.extendedProps?.duration);
                    $('#start-date-time').text("From: " + info.event.extendedProps?.start_formatted_date);
                    $('#end-date-time').text("To: " + info.event.extendedProps?.end_formatted_date);
                    $('#schedule-slot').text("Slot: " + info.event.extendedProps?.schedule_slot);

                    $('#customer-name').text(info.event.extendedProps?.customer_name);
                    $('#customer-email').text(info.event.extendedProps?.customer_email);
                    $('#customer-phone').text(info.event.extendedProps?.customer_phone);

                    $('#sub-total').text("Sub-Total: $" + info.event.extendedProps?.sub_total);
                    $('#fee-amount').text("6% Service charge: $" + info.event.extendedProps?.fee);
                    $('#total-amount').text("Total: $" + info.event.extendedProps?.price);
                    $('#partial-amount').text("Partially Paid: $" + info.event.extendedProps?.partial_payment);
                    $('#due-amount').text("Due Amount: $" + info.event.extendedProps?.due_amount);

                    // change the border color just for fun
                    info.el.style.color = 'red';
                },
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                initialView: 'dayGridWeek',
                initialDate: today,
                navLinks: true, // can click day/week names to navigate views
                editable: true,
                selectable: true,
                nowIndicator: true,
                // dayMaxEvents: true, // allow "more" link when too many events
                events: @json($events),
                droppable: true, // this allows things to be dropped onto the calendar
                drop: function(arg) {
                    // is the "remove after drop" checkbox checked?
                    if (document.getElementById('drop-remove').checked) {
                        // if so, remove the element from the "Draggable Events" list
                        arg.draggedEl.parentNode.removeChild(arg.draggedEl);
                    }
                },
                // validRange: {
                //     start: firstDayOfCurrentMonth // Disallow navigation to previous months
                // },
            });
            calendar.render();
    }

</script>
@endsection
