
const cartCountElem = document.querySelector("#cartNumberCount");
let storageCartCount = JSON.parse(localStorage.getItem('cartCount'));
let cartQuantity = 0;

if (storageCartCount) {
    cartQuantity = Object.values(storageCartCount).reduce((total, quantity) => total + quantity, 0);
    cartCountElem.textContent = cartQuantity;
} else {
    storageCartCount = {};
}

const addToCartElems = document.querySelectorAll('.addToCart');

addToCartElems.forEach(function(elem) {
    elem.addEventListener('click', function(e) {
        let buttonID = elem.dataset.id;
        console.log('clicked');
        cartQuantity++;
        cartCountElem.textContent = cartQuantity;

        const itemExists = Object.keys(storageCartCount).find((product) => product == buttonID) // boolean

        if (!itemExists) {
            console.log(true)
            storageCartCount = {...storageCartCount ,  [buttonID] : 1}
        }else{
            console.log('update quantity')
            storageCartCount = {...storageCartCount ,  [buttonID] : storageCartCount[buttonID] + 1 }
        }


        console.log(storageCartCount);
        let selected_products = JSON.stringify(storageCartCount)
        localStorage.setItem('cartCount', (selected_products));
    });
});