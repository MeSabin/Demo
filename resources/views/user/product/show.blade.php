<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product Details</title>
    @vite('resources/css/app.css')
</head>

<body class="h-screen flex justify-center items-center">
    <div class="shadow-lg rounded-md py-4 px-8 w-1/5">
        <div class="flex justify-center pb-4 hover:opacity-70 duration-200">
            <img src="{{ $product->image_product }}" alt="" class="h-40 w-40 rounded-2xl">
        </div>
        <div class="flex justify-between text-sm pb-2">
            <p class="text-gray-700">{{ $product->name }}</p>
            @if ($product->discount > 0)
                <del class="text-gray-600 font-bold">Rs. {{ $product->price }}</del>
            @else
                <p class="text-gray-600 font-bold">Rs. {{ $product->price }}</p>
            @endif
        </div>
        @if ($product->discount > 0)
            <div class="flex justify-between items-center pb-2">
                <p class="text-gray-700">Available:</p>
                @php
                    $amount = $product->price;
                    $discount = $product->discount;

                    $discountAmount = ($discount / 100) * $amount;
                    $amountAfterDiscount = floor($amount - $discountAmount);
                @endphp
                <p class="text-gray-600 font-bold text-sm">Rs. {{ $amountAfterDiscount }}</p>
                {{-- <p class="text-gray-700 font-bold">{{ $product->discount }}%</p> --}}
            </div>
        @endif
        <div class="flex justify-between pb-2">
            <label for="">Discount:</label>
            <p>{{ $product->discount }}</p>
        </div>
        <div class="pb-2">
            <label for="" class="font-bold text-gray-600">Description</label>
            <p class="text-sm">{{ $product->description }}</p>
        </div>
        <div class="flex justify-between pb-2 items-center">
            <label for="" class="font-bold text-gray-600">Stock:</label>
            <p class="text-sm">{{ $product->stock }}</p>
        </div>
        <div class="flex justify-between pb-2 items-center">
            <label for="" class="font-bold text-gray-600">Status:</label>
            <p class="text-sm py-1 bg-green-100 border border-green-600 rounded-full text-green-600 px-2">
                {{ $product->status }}</p>
        </div>
        <button class="bg-yellow-600 w-full text-white py-1 px-2 rounded-2xl mt-3 hover:bg-yellow-700 duration-200">Add
            to Cart</button>
    </div>
</body>

</html>
