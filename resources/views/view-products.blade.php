@extends('main-layout')

@if (session('addProducts'))
    <x-alert>
        <div id="alert"
            class="bg-white absolute right-5 top-5 z-50 py-3 px-6 rounded-md border-2 border-green-500 flex flex-row items-center ">
            <img src="{{ asset('images/check-mark.png') }}" alt="Image not found" class="w-8">
            <p class="text-green-500 font-bold">{{ session('addProducts') }}</p>
        </div>
    </x-alert>
@endif
@if (session('productDelete'))
    <x-alert>
        <div id="alert"
            class="bg-white absolute right-5 top-5 z-50 py-3 px-6 rounded-md border-2 border-green-500 flex flex-row items-center ">
            <img src="{{ asset('images/check-mark.png') }}" alt="Image not found" class="w-8">
            <p class="text-green-500 font-bold">{{ session('productDelete') }}</p>
        </div>
    </x-alert>
@endif
@if (session('updateProduct'))
    <x-alert>
        <div id="alert"
            class="bg-white absolute right-5 top-5 z-50 py-3 px-6 rounded-md border-2 border-green-500 flex flex-row items-center ">
            <img src="{{ asset('images/check-mark.png') }}" alt="Image not found" class="w-8">
            <p class="text-green-500 font-bold">{{ session('updateProduct') }}</p>
        </div>
    </x-alert>
@endif
@section('content')
    <div class="mt-40 px-10">
        <a href="{{ route('products.create') }}" class="rounded bg-green-500 text-white py-2 px-3">Add Category</a>
        <div class="mt-10">
            <table class="min-w-full border-2 border-gray-300 rounded-lg">
                <thead>
                    <tr class="border-2 border-gray-300">
                        <th class="text-center">ID</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">Category</th>
                        <th class="text-center">Image</th>
                        <th class="text-center">Description</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Discount</th>
                        <th class="text-center">Created_by</th>
                        {{-- <th class="text-center">Updated_by</th> --}}
                        <th class="text-center">Stock</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td class="text-center">{{ $product->id }}</td>
                            <td class="text-center">{{ $product->name }}</td>
                            <td class="text-center">{{ $product->productCategory->name }}</td>
                            <td class="text-center">
                                <img src="{{ $product->image_product }}" alt="Image not found"
                                    class="w-12 h-12 rounded-full">
                            </td>
                            <td class="text-center">{{ $product->description }}</td>
                            <td class="text-center">Rs. {{ $product->price }}</td>
                            @if ($product->discount == null && $product->discount == 0)
                                <td class="text-center">0.00%</td>
                            @else
                                <td class="text-center">{{ $product->discount }}%</td>
                            @endif
                            <td class="text-center">{{ $product->created_by }}</td>
                            {{-- <td class="text-center">{{ $product->updated_by }}</td> --}}
                            <td class="text-center">{{ $product->stock }}</td>
                            <td class="text-center">{{ $product->status }}</td>
                            <td class="text-center flex items-center justify-center pt-3">
                                <a href="{{ route('products.edit', $product->id) }}"
                                    class=" px-2 text-white bg-blue-500 rounded-md ">Edit</a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="post">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit"
                                        class="bg-red-500 text-white rounded-md px-2 ml-3 ">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4 cursor-pointer">
                <p class="bg-blue-500"> {{ $products->links() }}</p>
            </div>
        </div>
    @endsection
