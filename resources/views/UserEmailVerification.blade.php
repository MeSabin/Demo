<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email Verification</title>
    @vite('resources/css/app.css')
</head>

<body>
    <a href="">Hello {{ $details['username'] }}</p>
        <p>This is your link for email verification. Click here to activate your account
    </a>
    <a href="{{ route('emailVerification', $details['verification_token']) }}">{{ $details['verification_token'] }}</a>
</body>

</html>
