<?php

namespace App\Jobs;

use App\Mail\AdminBookingConfirmationMail;
use App\Mail\BookingConfirmation;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;
use Exception;

class SendBookingConfirmationJob implements ShouldQueue
{
    use Queueable;
    public $data = [];
    /**
     * Create a new job instance.
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            Mail::to($this->data["to"])->send(new BookingConfirmation($this->data["order_id"]));
        } catch (Exception $e) {
            logger("Mail confirmation failed");
            logger($e->getMessage());
        }
        try {
            Mail::to(env('MAIL_CONTACT'))->send(new AdminBookingConfirmationMail($this->data["order_id"]));
        } catch (Exception $e) {
            logger("Admin mail confirmation failed");
            logger($e->getMessage());
        }

    }
}
