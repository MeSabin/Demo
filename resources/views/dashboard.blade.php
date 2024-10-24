<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Dashboard</title>
   @vite('resources/css/app.css')
</head>
<body>
   <div class="text-blue-500 bg-gray-300 p-6 text-lg text-center">
      <p>User Dashboard</p>
      <a href="{{route('Logout')}}">Logout</a>
   </div>
   <p class="text-blue-500">Your Email: {{Auth::user()->email}}</p>
   <p class="text-blue-500">Your Name: {{ Auth::user()->name}}</p>
</body>
</html>