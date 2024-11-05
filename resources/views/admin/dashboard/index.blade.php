@extends('admin.dashboard.layout')
@section('pageName')
    Dashboard
@endsection
@section('content')
    @if (session('loginSuccess'))
        <x-alert>
            <div id="alert"
                class="bg-white absolute right-5 top-5 z-50 py-3 px-6 rounded-md border-2 border-green-500 flex flex-row items-center ">
                <img src="{{ asset('images/check-mark.png') }}" alt="Image not found" class="w-8">
                <p class="text-green-500 font-bold">{{ session('loginSuccess') }}</p>
            </div>
        </x-alert>
    @endif
    <div>
        Dashboard section
    </div>
@endsection
