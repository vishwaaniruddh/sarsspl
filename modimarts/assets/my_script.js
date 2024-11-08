var notyf = new Notyf({
    duration: 5000,
  position: {
    x: 'center',
    y: 'top',
  },
});

function addtocart(t, r, a, e, c, o, s, n, d) {
    try {
        "" == d && (d = 1), $.ajax({
            type: "POST",
            url: "https://allmart.world/addcart.php",
            data: "prodid=" + r + "&cid=" + t + "&price=" + a + "&image=" + e + "&pname=" + c + "&pid=" + o + "&shipping=" + s + "&shipping_charges=" + n + "&quantity=" + d,
            success: function(t) {
                console.log(t), 2 == t ? notyf.error("sorry your session has been expired") : 1 == t ? notyf.success("Product added to cart successfully !") : notyf.error("Error  Please  try again after some time")
            }
        }), showcart(), loadcart(), showcartproduct()
    } catch (t) {
        alert(t)
    }
}

function addwishlist(t, r, a, e, c, o) {
    try {
        $.ajax({
            type: "POST",
            url: "https://allmart.world/addtowishlist.php",
            data: "prodid=" + t + "&cid=" + r + "&price=" + a + "&image=" + e + "&pname=" + c + "&pid=" + o,
            success: function(t) {
                2 == t ? notyf.error("Product deleted from wishlist successfully  !") : 1 == t ? notyf.success("Product added to wishlist successfully  !") : notyf.error("Error  Please  try again after some time")
            }
        })
    } catch (t) {
        alert(t)
    }
}

function addtowishlist(t, r, a, e, c, o) {
    try {
        $.ajax({
            type: "POST",
            url: "https://allmart.world/addtowishlist.php",
            data: "prodid=" + t + "&cid=" + r + "&price=" + a + "&image=" + e + "&pname=" + c + "&pid=" + o,
            success: function(t) {
                2 == t ? notyf.error("Product deleted from wishlist successfully  !") : 1 == t ? notyf.success("Product added to wishlist successfully  !") : notyf.error("Error  Please  try again after some time")
            }
        })
    } catch (t) {
        alert(t)
    }
}

function showcart() {
    try {
        $.ajax({
            type: "POST",
            url: "https://allmart.world/cartitem.php",
            success: function(t) {
                document.getElementById("cartCount").innerHTML = t, document.getElementById("cartCount1").innerHTML = t
            }
        })
    } catch (t) {
        alert(t)
    }
}

function loadcart() {
    fetch("https://allmart.world/cartitem.php").then(t => t.json()).then(t => {
        document.getElementById("cartCount").innerHTML = t, document.getElementById("cartCount1").innerHTML = t
    }).catch(t => console.log(t))
}

function cart_minus(t, r, a) {
    $.ajax({
        type: "POST",
        url: "https://allmart.world/cart_minus.php",
        data: "pid=" + t + "&catid=" + r + "&usrid=" + a,
        success: function(t) {
            location.reload()
        }
    })
}

function cart_plus(t, r, a) {
    $.ajax({
        data: "pid=" + t + "&catid=" + r + "&usrid=" + a,
        type: "POST",
        url: "https://allmart.world/cart_plus.php",
        success: function(t) {
            location.reload()
        }
    })
}

function showcartproduct() {
    $.ajax({
        type: "POST",
        url: "https://allmart.world/getcartproduct.php",
        success: function(t) {
            document.getElementById("showcartproduct").innerHTML = t
        }
    })
}

function remove_from_cart(t) {
    $.ajax({
        type: "POST",
        url: "https://allmart.world/remove_from_cart.php",
        data: "id=" + t,
        success: function(t) {
            showcartproduct(), loadcart()
        }
    })
}

function remove_cart(t, r, a) {
    $.ajax({
        type: "POST",
        url: "https://allmart.world/remove_from_cart.php",
        data: "id=" + t,
        success: function(t) {
            location.reload()
        }
    })
}

function addcart(t, r, a, e, c, o, s, n) {
    try {
        var d = $("#quantity").val();
        $.ajax({
            type: "POST",
            url: "https://allmart.world/addcart2.php",
            data: "prodid=" + r + "&cid=" + t + "&price=" + a + "&image=" + e + "&pname=" + c + "&pid=" + o + "&shipping=" + s + "&shipping_charges=" + n + "&quantity=" + d,
            success: function(t) {
                console.log(t), 2 == t ? notyf.error("sorry your session has been expired") : 1 == t ? notyf.success("Product added to cart successfully !") : notyf.error("Error  Please  try again after some time")
            }
        }), showcart(), loadcart(), showcartproduct()
    } catch (t) {
        alert(t)
    }
}

