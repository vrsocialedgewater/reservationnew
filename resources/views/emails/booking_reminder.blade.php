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
        <p>Dear {{ $name }},</p>
        <p>Just a friendly reminder of your {{ $service }} experience with <a href="{{ env('APP_URL') }}">{{ env('APP_NAME') }}</a>!</p>
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
            <li><strong>Players:</strong> {{ $quantity }}</li>
        </ul>
        <p>Please arrive 15 minutes early for a brief orientation. If you need to reschedule or have questions, contact us at <a href="mailto:{{ env("MAIL_CONTACT") }}">{{ env("MAIL_CONTACT") }}</a> or call us at <a class="" title="Call us!" href="tel:+17205248882">&nbsp +1 (720) 524-8882</a>.</p>
        <a href="{{ env('APP_URL') }}" class="button">Visit Our Website</a>
    </div>
    <div class="footer">
        <a style="color: #fff" title="Call us!" href="tel:+17205248882">
            Hotline <span class="uk-visible@s">&nbsp +1 (720) 524-8882</span>
        </a>
        <p>© {{ date("Y") }} {{ env('APP_NAME') }}</p>
    </div>
</div>
</body>
</html>
