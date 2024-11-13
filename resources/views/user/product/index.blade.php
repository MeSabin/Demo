<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Products List</title>
    @vite('resources/css/app.css')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<body class="h-screen">
    <div class="bg-gray-300 py-2 flex justify-around items-center fixed right-0 left-0 top-0 mb-10 z-50">
        <div>
            <h1 class="text-gray-700 font-bold">Products</h1>
        </div>
        <div class="border border-gray-500 rounded-md w-1/3">
            <form action="{{ route('manage_cart') }}" method="GET" class="mb-0 py-1" id="form">
                <div class="flex items-center justify-between relative">
                    <input class="flex-1 py-1 px-3 focus:outline-none bg-transparent" type="text" name="search"
                        placeholder="Search products." value="{{ request('search') }}" id="search_bar">
                    <a href="/"
                        class="hidden hover:bg-gray-400 p-1 rounded-full mr-1 absolute right-16 duration-200"
                        id="cancel">
                        <img src="{{ asset('images/close.png') }}" alt="Image" class="h-4 w-4 ">
                    </a>
                    <button type="submit"
                        class="text-gray-600 pr-1 border-l-2 font-bold border-gray-600 pl-1 hover:text-gray-500 duration-200 ">Search</button>
                </div>
            </form>
        </div>

        <div>
            <a href="{{ route('cart_items') }}">
                <div class="relative cursor-pointer">
                    <img src="{{ asset('images/shopping-cart.png') }}" alt="Image not found" class="w-10 h-10">
                    <p id="cartNumberCount"
                        class="absolute top-[-4px] right-[-10px] bg-yellow-600 text-white rounded-full px-2">0</p>
                </div>
            </a>

        </div>
    </div>

    <div class="flex justify-center items-center mt-[100px]">
        <div class="grid grid-cols-4 w-2/3 gap-x-7 gap-y-12 ">
            @foreach ($products as $product)
                <div class=" flex flex-col justify-center p-4 bg-gray-200 rounded-md">
                    <a href="{{ route('product_details', $product->id) }}">
                        <div>
                            <div class="flex justify-center pb-4 hover:opacity-70 duration-200">
                                <img src="{{ $product->image_product }}" alt="" class="h-40 w-40 rounded-2xl">
                            </div>
                            <div class="flex justify-between text-sm">
                                <p class="text-gray-700">{{ $product->name }}</p>
                                @if ($product->discount > 0)
                                    <del class="text-gray-600 font-bold">Rs. {{ $product->price }}</del>
                                @else
                                    <p class="text-gray-600 font-bold">Rs. {{ $product->price }}</p>
                                @endif
                            </div>
                            @if ($product->discount > 0)
                                <div class="flex justify-between items-center">
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
                        </div>
                    </a>
                    {{-- <p data-message="{{ $product->id }}" class="message font-bold text-green-500"></p> --}}
                    <button data-id="{{ $product->id }}"
                        class="addToCart bg-yellow-600 text-white py-1 px-2 rounded-2xl mt-3 hover:bg-yellow-700 duration-200">Add
                        to Cart</button>

                </div>
            @endforeach
        </div>
    </div>
</body>
<script src="{{ asset('js/searchCancel.js') }}"></script>
<script src="{{ asset('js/cartProducts.js') }}"></script>
<script>
    // const cartCountElem = document.querySelector("#cartNumberCount");
    // let storageCartCount = JSON.parse(localStorage.getItem('cartCount'));

    // let cartCount = 0;
    // // if (storageCartCount) {
    // //     productsLength = storageCartCount.length;
    // //     // console.log(productsLength);
    // // }
    // if (storageCartCount) {
    //     cartCount = storageCartCount.length;
    //     cartCountElem.textContent = cartCount;
    // } else {
    //     storageCartCount = [];

    // }
    // // let cartCount = 0;
    // const addToCartElems = document.querySelectorAll('.addToCart');
    // addToCartElems.forEach(function(elem) {
    //     elem.addEventListener('click', function(e) {
    //         const buttonID = elem.dataset.id;
    //         console.log('clicked');
    //         // const buttonID = elem.getAttribute('data-id');
    //         cartCount++;
    //         cartCountElem.innerText = cartCount;
    // if(!storageCartCount.includes(buttonID)){
    //         storageCartCount.push(buttonID);

    // }
    //         let selected_products = JSON.stringify(storageCartCount)
    //         localStorage.setItem('cartCount', (selected_products));
    //         // location.reload();
    //     });
    // });
</script>

</html>
