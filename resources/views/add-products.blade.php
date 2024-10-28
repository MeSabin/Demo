@extends('main-layout')
@section('content')
    <div class="rounded-md min-h-screen flex justify-center items-center">
        <div class="shadow-lg px-6 py-4 rounded-md">
            <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="flex flex-row gap-10">
                    <div>
                        <div class="flex flex-col">
                            <label for="">Name:</label>
                            <input name="name" type="text" class="border py-1 border-gray-900 rounded-md px-2">
                            <span class="text-red-600">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="flex flex-col mt-3">
                            <label for="">Category:</label>
                            <select name="product_category" id="" class="border border-gray-700 p-1 rounded-md">
                                @foreach ($product_categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-9">
                            <input type="file" id="" name="image">
                        </div>
                        <span class="text-red-600">
                            @error('image')
                                {{ $message }}
                            @enderror
                        </span>
                        <div class="flex flex-col mt-4">
                            <label for="">Description:</label>
                            <input name="description" type="description"
                                class="border py-1 border-gray-900 rounded-md px-2">
                            <span class="text-red-600">
                                @error('description')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                    <div class="w-72">
                        <div class="flex flex-col">
                            <label for="">Price:</label>
                            <input name="price" type="number" class="border py-1 border-gray-900 rounded-md px-2">
                            <span class="text-red-600">
                                @error('price')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="flex flex-col mt-3">
                            <label for="">Discount:</label>
                            <input name="discount" type="number" class="border py-1 border-gray-900 rounded-md px-2">
                            <span class="text-red-600">
                                @error('discount')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                        <div class="flex flex-col mt-3">
                            <label for="">Stock:</label>
                            <input name="stock" type="number" class="border py-1 border-gray-900 rounded-md px-2">
                            <span class="text-red-600">
                                @error('stock')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>
                    </div>
                </div>
                <button type="submit" class="py-1 px-4 rounded-md bg-green-600 text-white mt-10">Add
                    Category</button>

            </form>
        </div>
    </div>
@endsection
