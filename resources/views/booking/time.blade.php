<div>
    @php
        $hasHoliday = \App\Models\HolidaySchedule::where('start_date', '<=', $date)->where('end_date', '>=', $date)->first();
        if($hasHoliday){
            $schedules = [];
        } else {
            $schedules = \App\Models\BookingSchedule::whereNull("disabled")->where('service_id', $service_id)->whereHas('day', function ($q) use($day){$q->where('name', $day);})->with(['bookings' => function($r) use($date, $service_id){
            $r->selectRaw('booking_schedule_id, sum(quantity) as total_quantity')->where("date", $date)->where('service_id', $service_id)->whereHas('order', function ($s){$s->where("status", "succeeded");})->with('service')->groupBy('booking_schedule_id');
        }])->get();
        }

    @endphp
    <div class="card">
        <div class="card-header pb-0 border-b-info">
            <h3 class="sub-title">Choose Session Time</h3>
        </div>
        <div class="card-body">
            <div class="form-check radio radio-primary ps-0">
                <ul class="radio-wrapper justify-content-center session-time-section">
                    @if($hasHoliday)
                        <span style="color: #EE4B2B !important;"> Closed for an event will reopen {{ \Carbon\Carbon::parse($hasHoliday->end_date)->addDay()->format('l, F j') }}</span>
                    @endif
                    @foreach($schedules as $schedule)
                        @php($usedSlots = 0)
                        @foreach($schedule->bookings as $booking)
                            @php($usedSlots += (int)$booking->total_quantity)
                        @endforeach
                        <li>
                            <input class="form-check-input" type="radio" value="{{ $schedule->id }}" name="schedule" wire:model="id" wire:change="changeTime({{ $schedule->id }}, {{ $schedule }})" @if(($slots - $usedSlots) < $quantity) disabled @endif>
                            <label class="form-check-label" >
                                <span class="timer">{{ \Carbon\Carbon::parse($schedule->start_time)->format('h:i') }}</span>
                                <span class="time-format text-muted">{{ \Carbon\Carbon::parse($schedule->start_time)->format('A') }}</span><br/>
                                @if(($slots - $usedSlots) < $quantity)
                                    <span class="session-time-message text-danger">Booked</span>
                                @elseif($usedSlots > 0)
                                    <span class="session-time-message text-danger">{{ $slots-$usedSlots }} players left</span>
                                @endif
                            </label>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
