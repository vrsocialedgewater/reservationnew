<?php

namespace App\Console\Commands;

use App\Mail\BookingReminderEmail;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class OneDayBeforeReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:one-day-before-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $bookings = Booking::whereHas('order', function ($q){$q->where('status', 'succeeded');})->date('next_reminder', '<=', Carbon::now())->hasNull('reminder')->with('additionalServices', 'location', 'service.serviceType', 'bookingSchedule')->get();
        foreach ($bookings as $booking) {
            try {
                Mail::to($this->order->booking->email)->send(new BookingReminderEmail($booking));
            } catch (Exception $e) {
                logger("Reminder mail failed");
                logger($e->getMessage());
            }
            $booking->reminder = 1;
            $booking->save();
        }

    }
}
