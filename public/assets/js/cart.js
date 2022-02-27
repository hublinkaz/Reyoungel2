// ************************************************
// Shopping Cart API
// ************************************************

var shoppingCart = (function() {
    // =============================
    // Private methods and propeties
    // =============================
    cart = [];

    // Constructor
    function Item(id, price, count,image,name_az,name_en,name_ru,name_tr) {
        this.id =id;
        this.price = price;
        this.count = count;
        this.image = image;
        this.name_az = name_az;
        this.name_en = name_en;
        this.name_ru = name_ru;
        this.name_tr = name_tr;

    }

    // Save cart
    function saveCart() {
        sessionStorage.setItem('shoppingCart', JSON.stringify(cart));

    }

    // Load cart
    function loadCart() {
        cart = JSON.parse(sessionStorage.getItem('shoppingCart'));
    }
    if (sessionStorage.getItem("shoppingCart") != null) {
        loadCart();
    }


    // =============================
    // Public methods and propeties
    // =============================
    var obj = {};

    // Add to cart
    obj.addItemToCart = function(id, price, count,image,name_az,name_en,name_ru,name_tr) {
        for(var item in cart) {
            if(cart[item].id === id) {
                cart[item].count ++;
                saveCart();
                return;
            }
        }
        var item = new Item(id, price, count,image,name_az,name_en,name_ru,name_tr);
        cart.push(item);
        saveCart();
    }
    // Set count from item
    obj.setCountForItem = function(id, count) {
        for(var i in cart) {
            if (cart[i].id === id) {
                cart[i].count = count;
                break;
            }
        }
    };
    // Remove item from cart
    obj.removeItemFromCart = function(id) {
        for(var item in cart) {
            if(cart[item].id === id) {
                cart[item].count --;
                if(cart[item].count === 0) {
                    cart.splice(item, 1);
                }
                break;
            }
        }
        saveCart();
    }

    // Remove all items from cart
    obj.removeItemFromCartAll = function(id) {
        for(var item in cart) {
            if(cart[item].id === id) {
                cart.splice(item, 1);
                break;
            }
        }
        saveCart();
    }

    // Clear cart
    obj.clearCart = function() {
        cart = [];
        saveCart();
    }

    // Count cart
    obj.totalCount = function() {
        var totalCount = 0;
        for(var item in cart) {
            totalCount += cart[item].count;
        }
        return totalCount;
    }

    // Total cart
    obj.totalCart = function() {
        var totalCart = 0;
        for(var item in cart) {
            totalCart += cart[item].price * cart[item].count;
        }
        return Number(totalCart.toFixed(2));
    }

    // List cart
    obj.listCart = function() {
        var cartCopy = [];
        for(i in cart) {
            item = cart[i];
            itemCopy = {};
            for(p in item) {
                itemCopy[p] = item[p];

            }
            itemCopy.total = Number(item.price * item.count).toFixed(2);
            cartCopy.push(itemCopy)
        }
        return cartCopy;
    }

    // cart : Array
    // Item : Object/Class
    // addItemToCart : Function
    // removeItemFromCart : Function
    // removeItemFromCartAll : Function
    // clearCart : Function
    // countCart : Function
    // totalCart : Function
    // listCart : Function
    // saveCart : Function
    // loadCart : Function
    return obj;
})();


// *****************************************
// Triggers / Events
// *****************************************
// Add item
$('.add-to-cart').click(function(event) {
    event.preventDefault();
    var id = $(this).data('id');
    var name_az = $(this).data('name_az');
    var name_en = $(this).data('name_en');
    var name_ru = $(this).data('name_tr');
    var name_tr = $(this).data('name_ru');
    var image = $(this).data('image');
    var price = Number($(this).data('price'));
    shoppingCart.addItemToCart(id, price, 1,image,name_az,name_en,name_ru,name_tr);
    displayCart();
});

// Clear items
$('.clear-cart').click(function() {
    shoppingCart.clearCart();
    displayCart();
});




$('.checkout_post').click(function() {
    const location= 0;
    const doctor =$("#doctorid").val();
    const user_id =$("#user").val();
    const role_id =$("#role").val();
    const order_type =$("#order_type").val();
    const pdf =$("#pdf").val();
    console.log(order_type);
    console.log('Doctor:'+doctor);
    console.log('user_id:'+user_id);
    console.log('role_id:'+role_id);
    console.log('pdf:'+pdf);


    var token =  $('input[name="_token"]').attr('value')
    $.ajaxSetup({
        beforeSend: function(xhr) {
            xhr.setRequestHeader('X-CSRF-Token', token);
        }
    });

    let resault={
        location:location,
        doctor: doctor,
        user_id:user_id,
        role_id:role_id,
        order_type:order_type,
        pdf:pdf,
        data:shoppingCart.listCart()
    }

    let cart_data = JSON.stringify(resault);

    $.ajax({
        type: "POST",
        url: "/api/order/store",
        async:false,
        dataType: "json",
        contentType: 'application/json',
        data: cart_data,
        success: function (data) {

            shoppingCart.clearCart();
            console.log('Sifarish Verildi');

            swal({
                title: "Uğurlu Əməliyyat !",
                text: "Sifarish Verildi.",
                type: "success",
                button: "Əla!",

            }).then(function() {
                shoppingCart.clearCart();
                history.go(0);

                // location.reload();
                // history.back();


            });


            // window.history.go(-1);

        },
        error: function (data) {
            console.log('Error:', data);

        },
    });
    console.log(cart_data)
    // console.log(location,doctor)
    // console.log(shoppingCart.listCart())
    // console.log(location)
});

function displayCart() {
    var cartArray = shoppingCart.listCart();
    var output = "";
    // var outputfront = "";
    for(var i in cartArray) {
        // output += "<li>"+ cartArray[i].name +" × " + cartArray[i].count + " <span><a class='minus-item btn btn-primary' data-id=" + cartArray[i].id + ">-</a> <a class='plus-item btn btn-primary' data-id=" + cartArray[i].id + ">+</a> " + cartArray[i].price * cartArray[i].count + " ₼  </span></li>";

        output += "<tr class='item_cart'>"
            +"     <td class=' product-name'>"
            +"         <div class='product-img'>"
            +"             <img width='50px' src='/public/assets/images/product/" + cartArray[i].image + "' alt='Product'>"
            +"         </div>"
            +"     </td>"
            +"     <td class='product-desc'>"
            +"         <div class='product-info'>"
            +"             <a href='#' title=''>" + cartArray[i].name_az + "  : </a>"
            +"             <span></span>"
            +"         </div>"
            +"     </td>"


            +"     <td class='product-same total-price'>"
            +"         <p class=''> &nbsp;" + cartArray[i].price + "&nbsp;</p>"
            +"     </td>"
            +"     <td class='bcart-quantity single-product-detail'>"
            +"         <div class='cart-qtt'>"

            +"             <p class=''> -  " + cartArray[i].count + "  - </p>"

            +"         </div>"
            +"     </td>"
            +"     <td class='total-price'>"
            +"         <p class=''>&nbsp; "  + cartArray[i].price * cartArray[i].count + "₼ &nbsp;&nbsp;</p>"
            +"     </td>"
            +"     <td class='product-remove'>"
            +"             <a class='minus-item btn btn-primary' data-id=" + cartArray[i].id + ">-</a>"
            +"     </td>"
            +"     <td class='product-remove'>"
            +"             <a class='plus-item btn btn-primary' data-id=" + cartArray[i].id + ">+</a> "

            +"     </td>"
            +" </tr>";
    }





    $('.show-cart').html(output);
    // $('.front-cart').html(outputfront);

    $('.total-cart').html(shoppingCart.totalCart());
    $('.total-count').html(shoppingCart.totalCount());
    console.log(cartArray);
}





// Delete item button

$('.show-cart').on("click", ".delete-item", function(event) {
    var id = $(this).data('id')
    shoppingCart.removeItemFromCartAll(id);
    displayCart();
})


// -1
$('.show-cart').on("click", ".minus-item", function(event) {
    var id = $(this).data('id')
    shoppingCart.removeItemFromCart(id);
    displayCart();
})
// +1
$('.show-cart').on("click", ".plus-item", function(event) {
    var id = $(this).data('id')
    shoppingCart.addItemToCart(id);
    displayCart();
})

// Item count input
$('.show-cart').on("change", ".item-count", function(event) {
    var id = $(this).data('id');
    var count = Number($(this).val());
    shoppingCart.setCountForItem(id, count);
    displayCart();
});



displayCart();
