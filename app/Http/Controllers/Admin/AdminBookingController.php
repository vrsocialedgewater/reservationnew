<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminBookingController extends Controller
{
    public function index(){
//        $this->items = \App\Models\Booking::fromCurrentMonth()->with('service', 'order', 'bookingSchedule')->whereHas('order', function ($q) {$q->where('status', 'succeeded');})->latest()->get();
        $bookings = \App\Models\Booking::with('service', 'order', 'bookingSchedule', 'additionalServices')->whereHas('order', function ($q) {$q->where('status', 'succeeded');})->latest()->get();
        $events = [];
        foreach($bookings as $item){
            $additionalServices = [];
            foreach ($item->additionalServices as $additionalService) {
                $additionalServices[] = [
                    "id" => $additionalService->id,
                    "title" => $additionalService->title,
                    "price" => $additionalService->price,
                ];
            }
            $events[] = [
                'id' => $item->id,
                'title' => @$item->service->title,
                'start' => $item->start_date_time,
                'end' => $item->end_date_time,
                'extendedProps' =>  [
                    'quantity' => $item->quantity,
                    'duration' => Carbon::createFromFormat('H:i:s', @$item->bookingSchedule->start_time)->diffInMinutes(@$item->bookingSchedule->end_time),
                    'customer_name' => $item->name,
                    'customer_email' => $item->email,
                    'customer_phone' => $item->number,
                    'start_time' => @$item->bookingSchedule->start_time,
                    'end_time' => @$item->bookingSchedule->end_time,
                    'schedule_slot' => @$item->bookingSchedule->name,
                    'additional_services' => $additionalServices,
                    "start_formatted_date" => Carbon::parse($item->start_date_time)->format('h:i A. D M jS F, Y'),
                    "end_formatted_date" => Carbon::parse($item->end_date_time)->format('h:i A. D M jS F, Y'),
                    'sub_total' => @$item->order->sub_total,
                    'fee' => @$item->order->fee,
                    'price' => @$item->order->price,
                    'partial_payment' => @$item->order->partial_payment,
                    'due_amount' => @$item->order->due_amount,
                    'order_id' => @$item->order->id,
                ],


            ];

        }

        return view('admin.booking', compact('bookings', 'events'));

    }
}
