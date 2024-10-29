@extends('main-layout')
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
        <a href="{{ route('product-category.create') }}" class="rounded bg-green-500 text-white py-2 px-3">Add Category</a>
        <div class="mt-10">
            <table class="min-w-full border-2 border-gray-300 rounded-lg">

                <thead>
                    <tr class="border-2 border-gray-300">
                        <th class="text-center">S.N</th>
                        <th class="text-center">Category</th>
                        <th class="text-center">Image</th>
                        <th class="text-center">Added By</th>
                        <th class="text-center">Action</th>

                    </tr>
                </thead>

                <tbody>
                    @php
                        $i = $categories->firstItem();
                    @endphp
                    @foreach ($categories as $category)
                        <tr class="">
                            <td class="text-center">{{ $i++ }}</td>
                            <td class="text-center">{{ $category->name }}</td>
                            <td class="flex justify-center items-center">
                                <img class=" text-center w-14 h-14 rounded-full" src="{{ $category->image_path }}"
                                    alt="Image not found">
                            </td>
                            <td class="text-center">{{ $category->users->name }}</td>
                            <td class="pb-2 flex justify-center">
                                <a href="{{ route('product-category.edit', $category->id) }}"
                                    class="bg-blue-500 text-white px-2 mr-2 rounded">Edit</a>
                                <a href="#" onclick = "deleteProduct({{ $category->id }})"
                                    class="bg-red-500 text-white px-2 rounded">Delete</a>
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
            <div class="mt-3">
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
