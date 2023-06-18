function onload(){
    addressEventListener();
}

function addToShoppingCart(articleid) {
    const cart = document.getElementById("cart");

    const element2 = document.getElementById(articleid);
    let name = element2.getAttribute("data-name");
    let  price = element2.getAttribute("data-price");

    const optionElement = document.createElement("option");
    optionElement.value = articleid;
    optionElement.text = name;
    //optionElement.selected = true;
    optionElement.setAttribute("data-price", price);
    cart.appendChild(optionElement);
    totalAmount();
    btnblock();
}

function totalAmount(){
    const element = document.getElementById("totalprice");
    let total = 0;
    const cart = document.getElementById("cart");

    Array.from(cart).forEach(function (item) {
        total += parseFloat(item.getAttribute("data-price"));
    });
    element.textContent = total.toFixed(2);
}

function deleteAllCartItems(){
    const cart = document.getElementById("cart");
    cart.options.length = 0;
    totalAmount();
}

function deleteSelectedCartItems(){
    const cart = document.getElementById("cart");
    /*
    for (let i = cart.length - 1; i >= 0; i--) {
        if (cart[i].selected) {
            cart.remove(i);
        }
    }
    */
    Array.from(cart).forEach(function (item) {
        if(item.selected){
            cart.remove(item);
        }
    });
    totalAmount();
}

function addressEventListener(){
    const address = document.getElementById("address");
    address.addEventListener("change", btnblock);
}

function btnblock(){
    const cart = document.getElementById("cart");
    const address = document.getElementById("address");
    const submitButton = document.getElementById("btnsubmit");

    if (cart.length === 0 || address.value === "") {
        submitButton.disabled = true;
    }else{
        submitButton.disabled = false;
    }
}

function changeSelected(){
    // called in sumbit
    var form = document.getElementById("form234");
    var cart = document.getElementById("cart");
    var submitButton = document.getElementById("btnsubmit");

    Array.from(cart).forEach(function (item) {
        item.selected = true;
    });

    document.forms["form234"].submit();

}