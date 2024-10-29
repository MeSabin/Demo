<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verification Notice</title>
    @vite('resources/css/app.css')
</head>

<body class="min-h-screen flex items-center justify-center">
    <div class="shadow-md bg-green-200 py-10 px-6 w-[300px]">
        <p>Mail has been sent to your {{ $email }}. Kindly check your mail to activate your account.</p>
    </div>
</body>

</html>
