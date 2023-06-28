function show_add_cart(element) {
    var div2 = element.getElementsByClassName("product-price")[0];
    var div3 = element.getElementsByClassName("product-show-buy")[0];
    div2.style.display = "none";
    div3.style.display = "block";
}
function hide_add_cart(element) {
    var div2 = element.getElementsByClassName("product-price")[0];
    var div3 = element.getElementsByClassName("product-show-buy")[0];
    div2.style.display = "block";
    div3.style.display = "none";
}
