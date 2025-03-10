<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <style>
        body {
            background-color: #f3f4f6;
            font-family: Arial, sans-serif;
            padding: 40px;
        }

        .container {
            background: #ffffff;
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
        }

        .button {
            background: #00615F;
            color: #ffffff !important;
            padding: 10px 20px;
            text-decoration: none;
            display: inline-block;
            border-radius: 4px;
            margin-top: 20px;
            text-align: center;
            font-weight: bold;
        }


        .footer {
            font-size: 12px;
            color: #555;
            margin-top: 20px;
        }

        .footer a {
            color: #00615F;
            text-decoration: none;
        }

        .nostyle {
            color: #ffffff;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        {{-- <div class="header">
            <img src="{{ asset('assets/Image/Logo copy.png') }}" class="w-64 h-64" alt="logo">
        </div> --}}
        <h2>Hello!</h2>
        <p>You are receiving this email because we received a password reset request for your account.</p>
        <p style="text-align: center;">
            <a href="{{ $resetLink }}" class="button">Reset Password</a>
        </p>
        <p>This password reset link will expire in 60 minutes.</p>
        <p>If you did not request a password reset, no further action is required.</p>
        <p>Regards,<br>Laravel</p>
        <hr>
        <div class="footer">
            <p>If you're having trouble clicking the "Reset Password" button, copy and paste the URL below into your web
                browser:</p>
            <p><a href="{{ $resetLink }}" class="nostyle">{{ $resetLink }}</a></p>
        </div>
    </div>
</body>

</html>
