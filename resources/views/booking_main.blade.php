@extends('layouts.booking')

@section('styles')
<style>
    .session-time-section li, .experience-section li {
        height: 100px;
        overflow: hidden;
        width: 150px;
        max-width: 150px !important;
        padding: 0;
        margin: 0;
    }
    .session-time-section li .timer {
        font-weight: bolder;
        font-size: 28px !important;
    }

    .session-time-section li .time-format {

    }

    ::-moz-selection { /* Code for Firefox */
        background: yellow;
    }

    ::selection {
        background: yellow;
    }
    .checkbox-wrapper li .form-check-input[type=radio], .radio-wrapper li .form-check-input[type=radio] {
        cursor: pointer;
    }
</style>
@endsection

@section('container')
    <div class="landing-home section-py-space pb-0 mt-5 bg-gray">
        <div class="title text-center mt-0 mb-5">
            <h3 class="mb-0 sub-title">Virtual Reality Social Reservation System</h3>
        </div>
        <div class="container">
            <div class="row demo-block demo-imgs justify-content-center">
                <div class="col-lg-8 col-md-10 slideInUp wow">
                    <div class="card bg-black">
                        <div class="card-body">
                            <form class="row g-3">
                                <div class="card">
                                    <div class="card-header pb-0 border-b-info">
                                        <h3 class="sub-title">Venue</h3>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="f-m-light mt-1">Edgewater Public Market - 5505 <br/> W 20th Ave, Edgewater, <br/>Mezzanine, second Floor, <br/>Private entrance also from the street.</h5>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header pb-0 border-b-info">
                                        <h3 class="sub-title">Reservation Type</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-check radio radio-primary ps-0">
                                            <ul class="radio-wrapper justify-content-center">
                                                <li>
                                                    <input class="form-check-input" id="type" type="radio" name="type" value="experience">
                                                    <label class="form-check-label" for="radio-icon"><i class="fa fa-gear"></i><br/><span>Experience</span></label>
                                                </li>
                                                <li>
                                                    <input class="form-check-input" id="type" type="radio" name="type" value="event" checked="">
                                                    <label class="form-check-label" for="radio-icon4"><i class="fa fa-calendar"></i><br/><span>Event</span></label>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header pb-0 border-b-info">
                                        <h3 class="sub-title">Choose Players</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="input-group input-group-lg">
                                            <button class="btn btn-outline-secondary" id="decrement" type="button"><i class="fa fa-minus"></i></button>
                                            <input class="form-control" type="number" placeholder="Enter total players" value="1" required>
                                            <button class="btn btn-outline-secondary" id="increment" type="button"><i class="fa fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header pb-0 border-b-info">
                                        <h3 class="sub-title">Choose Experience</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-check radio radio-primary ps-0">
                                            <ul class="radio-wrapper  justify-content-center experience-section">
                                                <li>
                                                    <input class="form-check-input " id="escape-room" type="radio" name="experience" value="escape-room">
                                                    <label class="form-check-label" for="radio-icon"><i class="fa fa-gamepad"></i><br/><span>Escape Room</span></label>
                                                </li>
                                                <li>
                                                    <input class="form-check-input" id="golf-simulator" type="radio" name="experience" value="golf-simulator" checked="">
                                                    <label class="form-check-label" for="radio-icon"><i class="fa fa-gamepad"></i><br/><span>Golf Simulator</span></label>
                                                </li>
                                                <li>
                                                    <input class="form-check-input" id="racing-simulator" type="radio" name="experience" value="racing-simulator">
                                                    <label class="form-check-label" for="radio-icon"><i class="fa fa-gamepad"></i><br/><span>Racing Simulator</span></label>
                                                </li>
                                                <li>
                                                    <input class="form-check-input" id="virtual-reality" type="radio" name="experience" value="virtual-reality">
                                                    <label class="form-check-label" for="radio-icon"><i class="fa fa-gamepad"></i><br/><span>Virtual Reality</span></label>
                                                </li>
                                                <li>
                                                    <input class="form-check-input" id="sports-watching" type="radio" name="experience" value="sports-watching">
                                                    <label class="form-check-label" for="radio-icon"><i class="fa fa-gamepad"></i><br/><span>Sports Watching</span></label>
                                                </li>
                                                <li>
                                                    <input class="form-check-input" id="event-space" type="radio" name="experience" value="event-space">
                                                    <label class="form-check-label" for="radio-icon"><i class="fa fa-gamepad"></i><br/><span>Event Space</span></label>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header pb-0 border-b-info">
                                        <h3 class="sub-title">Choose date</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-check radio radio-primary ps-0">
                                            <div class="card-body card-wrapper">
                                                <div class="row g-3">
                                                    <div class="col-12">
                                                        <div class="input-group main-inline-calender">
                                                            <input class="form-control mb-2" id="inline-calender" type="date" style="display: none">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header pb-0 border-b-info">
                                        <h3 class="sub-title">Choose Session Time</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-check radio radio-primary ps-0">
                                            <ul class="radio-wrapper justify-content-center session-time-section">
                                                <li>
                                                    <input class="form-check-input " id="escape-room" type="radio" name="experience" value="escape-room">
                                                    <label class="form-check-label" for="radio-icon"><span class="timer">10:00</span><span class="time-format text-muted">AM</span><br/> <span class="session-time-message text-danger">2 players left</span></label>
                                                </li>
                                                <li>
                                                    <input class="form-check-input " id="escape-room" type="radio" name="experience" value="escape-room">
                                                    <label class="form-check-label" for="radio-icon"><span class="timer">11:00</span><span class="time-format text-muted">AM</span><br/> <span class="session-time-message text-danger">5 players left</span></label>
                                                </li>
                                                <li>
                                                    <input class="form-check-input " id="escape-room" type="radio" name="experience" value="escape-room">
                                                    <label class="form-check-label" for="radio-icon"><span class="timer">12:30</span><span class="time-format text-muted">PM</span></label>
                                                </li>
                                                <li>
                                                    <input class="form-check-input " id="escape-room" type="radio" name="experience" value="escape-room" disabled>
                                                    <label class="form-check-label" for="radio-icon"><span class="timer">04:00</span><span class="time-format text-muted">PM</span><br/> <span class="session-time-message text-danger">Booked</span></label>
                                                </li>
                                                <li>
                                                    <input class="form-check-input " id="escape-room" type="radio" name="experience" value="escape-room">
                                                    <label class="form-check-label" for="radio-icon"><span class="timer">06:00</span><span class="time-format text-muted">PM</span></label>
                                                </li>
                                                <li>
                                                    <input class="form-check-input " id="escape-room" type="radio" name="experience" value="escape-room">
                                                    <label class="form-check-label" for="radio-icon"><span class="timer">08:00</span><span class="time-format text-muted">PM</span><br/> <span class="session-time-message text-danger">2 players left</span></label>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header pb-0 border-b-info">
                                        <h3 class="sub-title">Summary</h3>
                                    </div>
                                    <div class="card-body bg-primary text-white">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h3 class="sub-title text-white">Venue</h3>

                                                <h5 class="f-m-light mt-1 text-white">Edgewater Public Market - 5505 <br/> W 20th Ave, Edgewater, <br/>Mezzanine, second Floor, <br/>Private entrance also from the street.</h5>
                                            </div>
                                            <div class="col-md-6">
                                                <h3 class="sub-title text-white">Experience</h3>
                                                <h5 class="f-m-light mt-1 text-white">Golf Simulator</h5>
                                                <h5 class="f-m-light mt-1 text-white">4 Players</h5>
                                            </div>
                                        </div>
                                        <hr/>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h3 class="sub-title text-white">Session Time</h3>
                                                <h5 class="f-m-light mt-1 text-white">10:00 AM - 11:00 AM</h5>
                                                <h5 class="f-m-light mt-1 text-white">Outbreak (60 Minutes)</h5>
                                                <h6 class="f-m-light mt-1 text-white">Arrive 15 minutes early for the safety briefing and experience intro.</h6>
                                            </div>
                                            <div class="col-md-6">
                                                <h3 class="sub-title text-white">Ticket</h3>
                                                <h5 class="f-m-light mt-1 text-white">Per Person $49.00</h5>
                                                <h5 class="f-m-light mt-1 text-white">Players 4 x $49.00</h5>
                                                <h5 class="f-m-light mt-1 text-white">Total $196</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card border-0">
                                    <div class="card-body">
                                        <a href="/checkout" class="btn btn-info btn-lg float-end">Proceed to checkout</a>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
