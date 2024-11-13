<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>
    @vite('resources/css/app.css')
</head>
@if (session('loginError'))
    <x-alert>
        <div id="alert"
            class="bg-white absolute right-5 top-5 z-50 py-3 px-6 rounded-md border-2 border-red-500 flex flex-row items-center ">
            <img src="{{ asset('images/error.png') }}" alt="Image not found" class="w-8 mr-3">
            <p class="text-red-500 font-bold">{{ session('loginError') }}</p>
        </div>
    </x-alert>
@endif

<body class="flex justify-center items-center min-h-screen">
    <div class=" shadow-lg rounded p-6">
        <h2 class="font-bold text-lg text-center">Login</h2>
        <form action="{{ route('loginUser') }}" method="post">
            @csrf
            <div class="flex flex-col pb-6">
                <label for="">Email:</label>
                <input name="email" type="text" class="border border-gray-400 w-72 p-1 rounded"
                    value="{{ old('email') }}">
                <span class="text-red-500">
                    @error('email')
                        {{ $message }}
                    @enderror
                </span>
            </div>
            <div class="flex flex-col pb-6 relative">
                <label for="">Password:</label>
                <input name="password" type="password" id="password" class="border border-gray-400 p-1 rounded">
                <span class="text-red-500">
                    @error('password')
                        {{ $message }}
                    @enderror
                </span>
                <img src="{{ asset('images/hide.png') }}" id="eye" alt="Image not found"
                    class="absolute h-5 w-5 right-3 top-8 cursor-pointer">
            </div>
            <button type="submit"
                class="bg-green-500 hover:bg-green-600 duration-200 text-white text-base w-full rounded p-1 cursor-pointer">Login</button>
            <div class="flex justify-center mt-2">
                <a href="{{ route('register') }}" class="text-blue-500 text-sm text-center">Register</a>
            </div>
        </form>
    </div>

    <script src="{{ asset('js/passwordToggle.js') }}"></script>
</body>

</html>
