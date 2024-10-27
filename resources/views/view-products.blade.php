@extends('main-layout')

@section('content')
    <div class="mt-40 px-10">
        <a href="{{ route('product-category.create') }}" class="rounded bg-green-500 text-white py-2 px-3">Add Category</a>
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
                        <th class="text-center">Updated_by</th>
                        <th class="text-center">Stock</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td class="text-center">1</td>
                        <td class="text-center">T-Shirt</td>
                        <td class="text-center">Clothes</td>
                        <td class="text-center">Image</td>
                        <td class="text-center">Nepali brand with high quality fabric</td>
                        <td class="text-center">Rs.999</td>
                        <td class="text-center">7%</td>
                        <td class="text-center">Sabin Kaphle</td>
                        <td class="text-center">Sabin Kaphle</td>
                        <td class="text-center">20</td>
                        <td class="text-center">
                            <a href="" class="py-1 px-2 rounded-sm bg-blue-500">Edit</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    @endsection
