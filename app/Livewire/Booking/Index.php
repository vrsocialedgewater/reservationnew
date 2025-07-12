<?php

namespace App\Livewire\Booking;

use App\Models\Booking;
use App\Models\BookingSchedule;
use App\Models\Order;
use App\Models\ServiceType;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component
{
    public $location_id, $service_type_id, $service_id, $service_package_id, $service_package_name, $service_deposit_price, $quantity, $persons, $date, $booking_schedule_id, $location, $service_type_text, $service_text, $schedule, $price, $total_price, $additional_service_ids = [],
        $additional_services = [], $additional_price = 0, $additional_total_price = 0, $additional_total_deposit_price = 0, $email, $name, $number, $checkout = false, $has_payment = false, $slots = 0, $service_image,$fixed_price,$extended_price,$subtotal_price,$fee,$partial_payment;

    protected $rules = [
        'name' => 'required|min:4|max:256',
        'email' => 'required|email:rfc,dns|min:5|max:256',
        'number' => 'required|min:5|max:256',
        'quantity' => 'required|numeric|between:1,9999',
        'date' => 'required|date',
        'total_price' => 'required|numeric|between:0.01,9999.99',

        'additional_service_ids.*' => 'required|integer|between:1,9999999',
        'location_id' => 'required|integer|between:1,9999999',
        'service_id' => 'required|integer|between:1,9999999',
        'service_package_id' => 'nullable|integer|between:1,9999999',
        'booking_schedule_id' => 'required|integer|between:1,9999999',
    ];



    #[On('set_location')]
    public function setLocation($id, $location)
    {
        $this->location_id = $id;
        $this->location = $location;
    }

    #[On('set_service_type')]
    public function setServiceType($id, $text)
    {
        $this->service_type_id = $id;
        $this->service_type_text = $text;
        $this->setSubtotalPrice();

    }

    #[On('set_service')]
    public function setService($id, $text, $price, $slot, $image, $fixed_price, $extended_price, $service_package_id, $service_package_name, $service_deposit_price)
    {
        $this->service_id = $id;
        $this->service_text = $text;
        $this->price = $price;
        $this->slots = $slot;
        $this->service_image = $image;
        $this->fixed_price = $fixed_price;
        $this->extended_price = $extended_price;
        $this->service_package_id = $service_package_id;
        $this->service_package_name = $service_package_name;
        $this->service_deposit_price = $service_deposit_price;
        $this->setSubtotalPrice();
    }

    #[On('unset_service')]
    public function unsetService()
    {
        $this->service_id = null;
        $this->service_text = null;
        $this->price = null;
        $this->slots = null;
        $this->service_image = null;
        $this->fixed_price = null;
        $this->extended_price = null;
        $this->service_package_id = null;
        $this->service_package_name = null;
        $this->service_deposit_price = null;
        $this->setSubtotalPrice();
    }

    #[On('set_persons')]
    public function setPersons($persons)
    {
        $this->persons = $persons;
        $this->quantity = $persons;
        $this->setSubtotalPrice();
    }

    #[On('set_date')]
    public function setDate($date)
    {
        $this->date = $date;
    }

    #[On('set_schedule')]
    public function setSchedule($id, $schedule)
    {
        $this->booking_schedule_id = $id;
        $this->schedule = $schedule;
    }


    #[On('set_additional_services')]
    public function setAdditionalService($ids, $additional_services)
    {
        $this->additional_service_ids = $ids;
        $this->additional_services = $additional_services;
        $this->additional_price = 0;
        $this->additional_total_price = 0;
        $this->additional_total_deposit_price = 0;

        foreach ($additional_services as $additional_service) {
            $this->additional_price += @$additional_service['price'];
            $this->additional_total_price += @$additional_service['fixed_price'] ? @$additional_service['price'] : $this->persons * @$additional_service['price'];
            $this->additional_total_deposit_price += @$additional_service['fixed_price'] ? @$additional_service['deposit_price'] : $this->persons * @$additional_service['deposit_price'];

        }
//        foreach ($additional_services as $additional_service) {
//            $this->additional_price += @$additional_service['price'];
//        }
        $this->setSubtotalPrice();
    }

    public function checkoutOn(){
        $this->checkout = true;
        $this->dispatch('set_checkout', checkout: true);
    }

    #[On('set_checkout')]
    public function setCheckout($checkout)
    {
        $this->checkout = $checkout;
    }

    public function makePayment(){
        $this->setSubtotalPrice();
        $validateData = $this->validate();
        $this->has_payment = true;
        $this->dispatch('set_amount', amount: $this->total_price);
        try {
            $order = Order::create([
                'price' => $this->total_price,
                'fee' => $this->fee,
                'sub_total' => $this->subtotal_price,
                'partial_payment' => $this->partial_payment,
                'due_amount' => $this->total_price - $this->partial_payment,
                'status' => "incomplete"
            ]);
            $validateData = array_merge($validateData, [
                'order_id' => $order->id,
                'next_reminder' => Carbon::createFromFormat('Y-m-d H:i:s', $this->date . ' ' . $this->schedule['start_time'] , 'America/Los_Angeles')->setTimezone('UTC')->subDay(),
                ]);
            $bookingSchedule = Booking::create($validateData);
            $bookingSchedule->additionalServices()->sync($this->additional_service_ids);

            return redirect('/payment/' . $order->id );
        } catch (Exception $e) {
            session()->flash('form-error', 'Data storing failed: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('booking.index');
    }

    public function setSubtotalPrice(){
        $this->subtotal_price = $this->fixed_price ? $this->additional_total_price + $this->price : ($this->persons * $this->price) + $this->additional_total_price;
        $this->fee = $this->subtotal_price * 0.06;
        $this->total_price = $this->subtotal_price + $this->fee;
        $this->partial_payment = $this->fixed_price  ? $this->service_deposit_price + $this->additional_total_deposit_price + $this->fee : ($this->persons * $this->service_deposit_price) + $this->additional_total_deposit_price + $this->fee;
    }
}
