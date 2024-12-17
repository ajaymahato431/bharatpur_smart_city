<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SmartWada Service Request</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }

        .email-container {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        .header {
            background-color: #f5b102;
            color: white;
            text-align: center;
            padding: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .content {
            padding: 20px;
        }

        .content p {
            font-size: 16px;
            color: #333;
            line-height: 1.6;
            margin: 0 0 15px;
        }

        .footer {
            background-color: #f1f1f1;
            text-align: center;
            padding: 10px;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <!-- Email Header -->
        <div class="header">
            <h1>SmartWada Service Request Update</h1>
        </div>

        <!-- Email Content -->
        <div class="content">
            <p>Dear {{ $data['name'] }},</p>
            <p>Your request to SmartWada for <strong>{{ $data['heading'] }}</strong> has been
                <strong>{{ $data['message1'] }}</strong>
            </p>
            @if (!empty($data['rejectMessage']))
                <p>From ward officer: {{ $data['rejectMessage'] }}</p>
            @endif
            <p>{{ $data['message2'] }}</p>
            <p>Thank you and regards,<br>SmartWada Team</p>
        </div>

        <!-- Email Footer -->
        <div class="footer">
            <p>&copy; {{ date('Y') }} SmartWada. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
