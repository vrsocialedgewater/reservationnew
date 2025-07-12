<?php

namespace App\Mail;

use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookingConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $order_id;
    public $booking;

    /**
     * Create a new message instance.
     */
    public function __construct($order_id)
    {
        $this->order_id = $order_id;
        $this->booking = booking::where("order_id", $order_id)->with('additionalServices', 'location', 'service.serviceType', 'bookingSchedule', 'order', 'servicePackage')->first();
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Booking Confirmation',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.booking_confirmation',
            with: [
                'booking' => $this->booking,
                'name' => $this->booking->name,
                'email' => $this->booking->name,
                'date' => Carbon::create($this->booking->date)->format('l jS F, Y'),
                'start_time' => @$this->booking->bookingSchedule->start_date,
                'end_time' => @$this->booking->bookingSchedule->end_date,
                'duration' => Carbon::createFromFormat('H:i:s', @$this->booking->bookingSchedule->start_time)->diffInMinutes(@$this->booking->bookingSchedule->end_time) + 1,
                'service' => @$this->booking->service->title,
                'quantity' => @$this->booking->quantity,
                'service_type' => @$this->booking->service->serviceType->title,
                'service_price' => $this->booking->service->price,
                'location' => $this->booking->location,
                'order_id' => @$this->booking->order_id,
                'price' => @$this->booking->order->price,
                'partial_amount' => @$this->booking->order->partial_payment,
                'due_amount' => @$this->booking->order->due_amount,
                'service_package_id' => @$this->booking->servicePackage->id,
                'service_package_name' => @$this->booking->servicePackage->name,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
