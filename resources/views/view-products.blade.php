@extends('main-layout')
@section('pageName')
    Products
@endsection
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
        <div class="flex justify-between items-center">
            <div>
                <a href="{{ route('products.create') }}" class="rounded bg-green-500 text-white py-2 px-3">Add Category</a>
            </div>
            <div class="border border-gray-500 rounded-md">
                <form action="{{ route('products.index') }}" method="GET" class="block py-1">
                    @csrf
                    <input class="py-1 px-3 focus:outline-none" type="text" name="search" placeholder="Search products."
                        value="{{ request('search') }}">
                    <button type="submit"
                        class="text-gray-600 pr-1 border-l-2 font-bold border-gray-500 pl-1 ">Search</button>
                </form>
            </div>
        </div>
        <div class="mt-10">
            <table class="min-w-full bg-gray-50 overflow-hidden border-gray-300 rounded-md">
                <thead>
                    <tr class="border-gray-300 bg-gray-600 text-white">
                        <th class="text-center py-2">S.N</th>
                        <th class="text-center py-2">Name</th>
                        <th class="text-center py-2">Category</th>
                        <th class="text-center py-2">Image</th>
                        <th class="text-center py-2">Description</th>
                        <th class="text-center py-2">Price</th>
                        <th class="text-center py-2">Discount</th>
                        <th class="text-center py-2">Created_by</th>
                        <th class="text-center py-2">Stock</th>
                        <th class="text-center py-2">Status</th>
                        <th class="text-center py-2">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @php $i = $products->firstItem(); @endphp
                    @foreach ($products as $product)
                        <tr class="hover:bg-gray-100">
                            <td class="text-center">{{ $i++ }}.</td>
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
                                    class=" px-2 text-white bg-blue-500 hover:bg-blue-600 duration-200 rounded-md ">Edit</a>
                                <a href="#" onclick="deleteProduct({{ $product->id }});"
                                    class="bg-red-500 hover:bg-red-600 duration-200 text-white rounded-md px-2 ml-3 ">Delete</a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="post"
                                    id ="product-{{ $product->id }}">
                                    @method('DELETE')
                                    @csrf
                                    {{-- <button type="submit">Delete</button> --}}
                                </form>


                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-4 cursor-pointer">

                <div class="flex justify-between items-center text-gray-500">

                    <div>
                        Showing <strong>{{ $products->firstItem() }}</strong> to
                        <strong>{{ $products->lastItem() }}</strong> out of
                        <strong>{{ $products->total() }}</strong> entries
                    </div>


                    {{ $products->links() }}
                </div>
            </div>
        </div>
        <script>
            function deleteProduct(id) {
                if (confirm("Do you really want to delete?")) {
                    document.getElementById('product-' + id).submit();
                }
            }
        </script>
    @endsection
