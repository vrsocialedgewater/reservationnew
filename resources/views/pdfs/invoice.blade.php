<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Booking Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            line-height: 1.6;
            margin: 30px;
            color: #333;
        }
        .header, .footer {
            text-align: center;
            color: #000;
            background-color: #ccc;
            padding: 10px 0;
        }
        .header h1, .footer p {
            margin: 0;
        }
        .content {
            margin-top: 30px;
            border-top: 2px solid #2865B1;
            padding-top: 20px;
        }
        .section {
            margin-bottom: 30px;
        }
        .section h2 {
            background-color: #2865B1;
            color: #ffffff;
            padding: 10px;
            margin: 0 0 10px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }
        th {
            text-align: left;
            background-color: #f2f2f2;
            font-weight: bold;
        }
        td {
            background-color: #fafafa;
        }
        .note {
            font-style: italic;
            color: #777;
        }
    </style>
</head>
<body>

<div class="header">
    <img src="{{ public_path('vrs-logo2.png') }}" width="120" alt="{{ env("app_name") }}"/>
    <h4>Your {{ \Carbon\Carbon::createFromFormat('H:i:s', @$booking->bookingSchedule->start_time)->diffInMinutes(@$booking->bookingSchedule->end_time) + 1 }}-Minutes {{ @$booking->service->title }} @if(@$booking->servicePackage->id) ({{ @$booking->servicePackage->name }}) @endif has been successfully booked! </h4>
    <p>This reservation was automatically accepted on your behalf by <a href="{{ env("APP_URL") }}">{{ env("APP_NAME") }}</a>. Get ready to dive into an unforgettable virtual adventure!</p>
</div>

<div class="content">

    <div class="section">
        <table>
            <tr>
                <th>{{ \Carbon\Carbon::create($booking->date)->format('l jS F, Y') }}</th>
                <th>Arrive by {{ \Carbon\Carbon::createFromFormat('H:i:s', @$booking->bookingSchedule->start_time)->subMinutes(15)->format('h:i:s A') }} - STARTS AT {{ @$booking->bookingSchedule->start_date }}</th>
            </tr>
            <tr>
                <th>Customer Details</th>
                <th>Order Details</th>
            </tr>
            <tr>
                <td>
                    Name: {{ $booking->name }}<br/>
                    Email: {{ $booking->email }}<br/>
                    Contact: {{ $booking->number }}<br/>
                    Persons: {{ $booking->quantity }}<br/>
                </td>
                <td>
                    Service: VR Social ( ${{ $booking->service->price }} x {{ $booking->quantity }} )<br/>
                    @if($additional_price)
                        Additional Services Price: ${{ $additional_price }} x {{ $booking->quantity }}<br/>
                    @endif
                    Sub-total: $ {{ @$booking->order->sub_total }} <br/>
                    Fee 6%: $ {{ @$booking->order->fee }} <br/>
                    <b>Total</b>: $ {{ @$booking->order->price }} <br/>
                    <b>Deposit Amount</b>: $ {{ @$booking->order->partial_payment }} <br/>
                    <b>Due at Event</b>: $ {{ @$booking->order->due_amount }} <br/>
                </td>
            </tr>
        </table>
    </div>

</div>

<div class="footer">
    <p class="note">Please contact us at {{ env('MAIL_CONTACT') }} for any assistance.</p>
    <p>© {{ date('Y') }} {{ env("APP_NAME") }} – All Rights Reserved</p>
</div>

</body>
</html>
