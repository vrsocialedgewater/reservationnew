<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .header {
            background-color: #356e70;
            color: white;
            text-align: center;
            padding: 20px;
        }
        .content {
            padding: 20px;
        }
        .footer {
            background-color: #3b3f97;
            color: white;
            text-align: center;
            padding: 10px;
            font-size: 12px;
        }
        .button {
            background-color: #3b3f97;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 4px;
            display: inline-block;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="email-container">
    <div class="header">
        <h1>{{ env('APP_NAME') }}</h1>
    </div>
    <div class="content">
        <p>This is to confirm that a booking has been successfully made with {{ env('APP_NAME') }}. The seat has been reserved accordingly. If any further actions are required, please proceed as necessary.</p>
        <a href="{{ url('/orders/' . base64_encode( env('INVOICE_UNIQUE') . $order_id) . '/invoice') }}" class="button">Download Receipt</a>
        <h3>Booking Details:</h3>
        <ul>
            <li><strong>Date:</strong> {{ $date }}</li>
            <li><strong>Time:</strong> {{ $start_time }}</li>
            <li><strong>Duration:</strong> {{ $duration }} Minutes</li>
            <li><strong>Location:</strong>
                {{ @$location['address'] . ", " . @$location['city'] . ", " . @$location['state'] . ", " . @$location['zip_code'] . ", " . @$location['phone_number'] }}
            </li>
        </ul>
        <h3>{{ $service_type }}:</h3>
        <ul>
            <li><strong>Service:</strong> {{ $service }} @if($service_package_id)<i>({{ $service_package_name }})</i>@endif </li>
            <li><strong>Players:</strong> {{ $quantity }}</li>
        </ul>
        <h3>Payment Details:</h3>
        <ul>
            <li><strong>Total Amount:</strong> ${{ $price }}</li>
            <li><strong>Deposit Amount:</strong> ${{ $partial_amount }}</li>
            <li><strong>Due at Event:</strong> ${{ $due_amount }}</li>
        </ul>
    </div>
    <div class="footer">
        <a style="color: #fff" title="Call us!" href="tel:+17205248882">
            Hotline <span class="uk-visible@s">&nbsp;+1 (720) 524-8882</span>
        </a>
        <p>© {{ date("Y") }} {{ env('APP_NAME') }}</p>
    </div>
</div>
</body>
</html>
