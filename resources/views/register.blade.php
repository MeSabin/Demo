<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>
<body class="flex justify-center items-center min-h-screen">
    <div class=" shadow-lg rounded p-6">
        <h2 class="font-bold text-lg text-center">Register</h2>
    <form action="{{route('registerUser')}}" method="post">
        @csrf
        <div class="flex flex-col pb-6">
            <label for="">Name:</label>
            <input name="name" type="text" class="border border-gray-400 w-72 p-1 rounded">
            <span class="text-red-500">
                @error('name')
                    {{$message}}
                @enderror
            </span>
        </div>
        <div class="flex flex-col pb-6">
            <label for="">Email:</label>
            <input name="email" type="text" class="border border-gray-400 p-1 rounded">
            <span class="text-red-500">
                @error('email')
                    {{$message}}
                @enderror
            </span>
        </div>
        <div class="flex flex-col pb-6 relative">
            <label for="">Password:</label>
            <input name="password" type="password" id="password" class="border border-gray-400 p-1 rounded">
            <span class="text-red-500">
                @error('password')
                    {{$message}}
                @enderror
            </span>
            <img src="{{asset('images/hide.png')}}" id="eye" alt="Image not found" class="absolute right-3 top-8 h-5 w-5 cursor-pointer">
        </div>
        <div class="flex flex-col pb-6">
            <label for="">Confirm Password:</label>
            <input name="confirm_password" type="password" class="border border-gray-400 p-1 rounded">
            <span class="text-red-500">
                @error('confirm_password')
                    {{$message}}
                @enderror
            </span>
        </div>
        <button type="submit" class="bg-green-600 text-white text-base w-full rounded p-1 cursor-pointer">Register</button>
    </form>
    </div>

    <script src="{{asset('js/passwordToggle.js')}}"></script>
</body>
</html>