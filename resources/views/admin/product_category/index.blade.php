@extends('main-layout')
@section('pageName')
    Product Categories
@endsection
@section('content')
    @if (session('category_success'))
        <x-alert>
            <div id="alert"
                class="bg-white absolute right-5 top-5 z-50 py-3 px-6 rounded-md border-2 border-green-500 flex flex-row items-center ">
                <img src="{{ asset('images/check-mark.png') }}" alt="Image not found" class="w-8">
                <p class="text-green-500 font-bold">{{ session('category_success') }}</p>
            </div>
        </x-alert>
    @endif
    @if (session('update_category'))
        <x-alert>
            <div id="alert"
                class="bg-white absolute right-5 top-5 z-50 py-3 px-6 rounded-md border-2 border-green-500 flex flex-row items-center ">
                <img src="{{ asset('images/check-mark.png') }}" alt="Image not found" class="w-8">
                <p class="text-green-500 font-bold">{{ session('update_category') }}</p>
            </div>
        </x-alert>
    @endif
    @if (session('delete_category'))
        <x-alert>
            <div id="alert"
                class="bg-white absolute right-5 top-5 z-50 py-3 px-6 rounded-md border-2 border-green-500 flex flex-row items-center ">
                <img src="{{ asset('images/check-mark.png') }}" alt="Image not found" class="w-8">
                <p class="text-green-500 font-bold">{{ session('delete_category') }}</p>
            </div>
        </x-alert>
    @endif
    <div class="mt-40 px-10">
        <a href="{{ route('product-category.create') }}"
            class="rounded bg-green-500 hover:bg-green-600 duration-200 text-white py-2 px-3">Add Category</a>
        <div class="mt-10">
            <table class="min-w-full bg-gray-50 rounded-md overflow-hidden">

                <thead class="bg-gray-600 text-white ">
                    <tr class="border-gray-300">
                        <th class="text-center py-2">S.N</th>
                        <th class="text-center py-2">Category</th>
                        <th class="text-center py-2">Image</th>
                        <th class="text-center py-2">Added By</th>
                        <th class="text-center py-2">Action</th>

                    </tr>
                </thead>

                <tbody>
                    @php
                        $i = $categories->firstItem();
                    @endphp

                    @foreach ($categories as $category)
                        <tr class="hover:bg-gray-100">
                            <td class="text-center">{{ $i++ }}.</td>
                            <td class="text-center">{{ $category->name }}</td>
                            <td class="flex justify-center items-center mt-1">
                                <img class=" text-center w-14 h-14 rounded-full" src="{{ $category->image_path }}"
                                    alt="Image not found">
                            </td>
                            <td class="text-center">{{ $category->users->name }}</td>
                            <td class="text-center">
                                <a href="{{ route('product-category.edit', $category->id) }}"
                                    class="bg-blue-500 hover:bg-blue-600 duration-200 text-white px-2 mr-2 rounded">Edit</a>
                                <a href="#" onclick = "deleteProduct({{ $category->id }})"
                                    class="bg-red-500 hover:bg-red-600 duration-200 text-white px-2 rounded">Delete</a>
                                <form action="{{ route('product-category.destroy', $category->id) }}" method="post"
                                    id="category-{{ $category->id }}">
                                    @csrf
                                    @method('DELETE')
                                    {{-- <button type="submit"></button> --}}
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-3 flex items-center justify-between">
                <div class="text-gray-500">
                    Showing <strong>{{ $categories->firstItem() }}</strong> to
                    <strong>{{ $categories->lastItem() }}</strong> out of
                    <strong>{{ $categories->total() }}</strong> entries
                </div>
                {{ $categories->links() }}
            </div>
        </div>
    </div>
    <script>
        function deleteProduct(id) {
            if (confirm("Do you really want to delete?")) {
                document.querySelector('#category-' + id).submit();
            }
        }
    </script>
@endsection
