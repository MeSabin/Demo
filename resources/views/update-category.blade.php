@extends('main-layout')
@section('content')
    <div class=" min-h-screen flex justify-center items-center">
        <div class="shadow-lg p-6 w-[350px]">
            <form action="{{ route('product-category.update', $product_category->id) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="flex flex-col">
                    <label for="">Name:</label>
                    <input name="name" value="{{ $product_category->name }}" type="text"
                        class="border py-1 border-gray-900 rounded-md px-2">
                    <span class="text-red-600">
                        @error('name')
                            {{ $message }}
                        @enderror
                    </span>
                </div>
                <div class="mt-6">
                    <input type="file" id="" name="image" value="">
                    <img src="{{ $product_category->image_path }}" alt="Image not found"
                        class="h-14 w-14 rounded-full mt-3">
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
