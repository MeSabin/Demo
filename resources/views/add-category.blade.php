@extends('main-layout')
@section('content')
    <div class=" min-h-screen flex justify-center items-center">
        <div class="shadow-lg p-6 w-[350px]">
            <form action="{{ route('product-category.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="flex flex-col">
                    <label for="">Name:</label>
                    <input name="name" type="text" class="border py-1 border-gray-900 rounded-md px-2"
                        value="{{ old('name') }}">
                    <span class="text-red-600">
                        @error('name')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="mt-6">
                    <input type="file" id="" name="image">
                </div>
                <span class="text-red-600">
                    @error('image')
                        {{ $message }}
                    @enderror
                </span>
                <button type="submit" class="py-1 px-4 rounded-md bg-green-600 text-white w-full mt-10">Add
                    Category</button>
            </form>
        </div>
    </div>
@endsection
