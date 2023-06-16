function addToShoppingCart(articleid) {
    const cart = document.getElementById("cart");

    const element2 = document.getElementById(articleid);
    let name = element2.getAttribute("data-name");
    let  price = element2.getAttribute("data-price");


    const optionElement = document.createElement("option");
    optionElement.value = articleid;
    optionElement.text = name;
    optionElement.setAttribute("data-price", price);
    cart.appendChild(optionElement);
    totalAmount()
}

function totalAmount(){
    const element = document.getElementById("totalprice");
    let total = 0;
    const cart = document.getElementById("cart");
    for (let i = 0; i < cart.length; i++) {
        total += parseFloat(cart[i].getAttribute("data-price"));
    }
    element.textContent = total.toFixed(2);
}

function deleteAllCartItems(){
    const cart = document.getElementById("cart");
    cart.options.length = 0;
    totalAmount();
}

function deleteSelectedCartItems(){
    const cart = document.getElementById("cart");
    for (let i = cart.length - 1; i >= 0; i--) {
        if (cart[i].selected) {
            cart.remove(i);
        }
    }
    totalAmount();
}

function sumbitBlocker(){
    const submitButton = document.getElementById("submit");
    const cart = document.getElementById("cart");
    const address = document.getElementById("address");

    // add eventlister

    address.addEventListener("change", function () {
        if (cart.length === 0 || address.value === "") {
            submitButton.disabled = true;
        }else{
            submitButton.disabled = false;
        }
    });

    // add cart event listerner
    cart.addEventListener("change", function () {
        if (cart.length === 0 || address.value === "") {
            submitButton.disabled = true;
        }else{
            submitButton.disabled = false;
        }
    });
}