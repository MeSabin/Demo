<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Your Cart</title>
    @vite('resources/css/app.css')
</head>

<body>

    <div class="font-bold text-gray-600 text-center mb-10 mt-5 text-lg">Total Items</div>
    <div class="flex px-20 gap-7 justify-between mb-10">
        <div class="text-center rounded flex flex-col gap-5 w-1/2" id="cartItemsWrapper">
        </div>
        <div class="border p-4 border-gray-300 rounded h-60 w-96 ">
            <p class="text-gray-600 text-lg font-bold pb-10 text-center">Order Summary</p>
            <div class="flex justify-between">
                <p class="text-gray-600 font-bold">Total items:</p>
                <p id="total-cart-products"></p>
            </div>
            <div class="flex justify-between mt-4">
                <p class="text-gray-600 font-bold">Total Price:</p>
                <p id="totalprice">Rs. 1200</p>
            </div>
            <div class="mt-4">
                <button
                    class="bg-yellow-500 font-semibold text-white rounded-md py-1 hover:bg-yellow-600 duration-200 w-full">Place
                    your order</button>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</body>
{{-- <script src="{{ asset('js/cartProducts.js') }}"></script> --}}
<script>
    let storedProducts = JSON.parse(localStorage.getItem('cartCount'));
    let productIDs = [];
    let totalCartProducts = document.querySelector('#total-cart-products');


    if (storedProducts) {
        let productsLength = Object.keys(storedProducts).length;
        totalCartProducts.innerHTML = productsLength;
    }


    Object.keys(storedProducts).map((product) => {
        if (product) {
            productIDs.push(product)
        }
    })

    console.log(productIDs)


    const route = "{{ route('cart_products') }}"
    $.ajax({
        url: route,
        method: 'GET',
        data: {
            product_ids: productIDs
        },
        success: function(result) {

            const products = result;

            const cartItemWrapper = document.querySelector('#cartItemsWrapper');

            let content = "";


            let countCheck = 0;
            let TotalAmount = 0;

            products.forEach(function(item) {

                const amount = item.price;
                const discount = item.discount;
                const discountAmount = (discount / 100) * amount;
                const amountAfterDiscount = Math.floor(amount - discountAmount);

                TotalAmount += amountAfterDiscount * storedProducts[item.id];


                content += `<div class="border border-gray-300 py-4 flex px-4 rounded justify-between" data-id = '${item.id }'>
                                <div class="flex justify-center hover:opacity-70 duration-200">
                                    <img src="/storage/images/products/${item.image}" alt="" class="h-40 w-40 rounded-2xl">
                                </div>
                                <div>
                                    <p class ="productQuantity">${storedProducts[item.id] ?? JSON.stringify(storedProducts)}</p>

                                </div>
                                <div>
                                    <div>
                                        <p data-updateid = "${item.id }" class = "updateQuantity">
                                            Update
                                        </p>
                                    </div>
                                    <p data-deleteid = "${item.id }" class = "deleteProduct">
                                        Delete
                                    </p>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <div class= "flex justify-between flex-col">
                                        <div class= "flex gap-10 justify-between">
                                        <p class="text-gray-700">${item.name }</p>
                                            ${item.discount > 0 ? `<del class="text-gray-600 font-bold">Rs. ${item.price }</del>` : `<p class="text-gray-600 font-bold">Rs. ${ item.price }</p>`}
                                        </div> 
                                        ${item.discount > 0 ?
                                        `  <div class= "flex gap-10">
                                            <p class="text-gray-700">Available:</p>

                                            <p class="text-gray-600 font-bold text-sm">Rs. ${amountAfterDiscount}</p>
                                            </div>
                                        ` : ``
                                        }                       
                                        <div class ="max-w-52">
                                            <p class="text-gray-700">Description:</p>
                                            <p class="text-gray-600 font-bold text-sm">${item.description}</p>
                                        </div>
                                    </div>            
                                </div>
                            </div>`

            });
            document.querySelector('#totalprice').innerHTML = TotalAmount;
            cartItemWrapper.innerHTML = content;
        }
    });


    const cartItemWrapper = document.querySelector('#cartItemsWrapper');

    function updateProductQuantity() {

        cartItemWrapper.addEventListener('click', (e) => {
            if (e.target.matches('.updateQuantity'), e) {

                let updateID = e.target.dataset.updateid;
                console.log(updateID);
                if (updateID) {
                    let updateQuantity = parseInt(prompt('Enter the quantity in product id ' + updateID));

                    console.log(updateQuantity)
                    storedProducts = {
                        ...storedProducts,
                        [updateID]: updateQuantity
                    }

                    localStorage.setItem('cartCount', JSON.stringify(storedProducts));
                    location.reload();
                }
            }
        });
    }
    updateProductQuantity();

    function deleteProduct() {
        cartItemWrapper.addEventListener('click', (e) => {
            if (e.target.matches('.deleteProduct'), e) {
                let deleteID = e.target.dataset.deleteid;
                if (deleteID) {
                    if (confirm('Do you really want to remove this product ?' + deleteID)) {
                        removeFromCart(deleteID);
                    }
                }
            };
        });
    }
    deleteProduct();

    function removeFromCart(id) {

        delete storedProducts[id];
        localStorage.setItem('cartCount', JSON.stringify(storedProducts));



        location.reload();
    }
</script>


</html>
