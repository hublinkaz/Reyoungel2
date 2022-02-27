// ************************************************
// Shopping Cart API
// ************************************************

var managercart = (function() {
    // =============================
    // Private methods and propeties
    // =============================
    cartmanager = [];

    // Constructor
    function Item(id, price, count,image,name) {
        this.id =id;
        this.price = price;
        this.count = count;
        this.image = image;
        this.name = name;

    }

    // Save cart
    function saveCart() {
        sessionStorage.setItem('managercart', JSON.stringify(cartmanager));

    }

    // Load cart
    function loadCart() {
        cartmanager = JSON.parse(sessionStorage.getItem('managercart'));
    }
    if (sessionStorage.getItem("managercart") != null) {
        loadCart();
    }


    // =============================
    // Public methods and propeties
    // =============================
    var obj = {};

    // Add to cart
    obj.addItemToCartmanager = function(id, price, count,image,name) {
        for(var item in cartmanager) {
            if(cartmanager[item].id === id) {
                cartmanager[item].count ++;
                saveCart();
                return;
            }
        }
        var item = new Item(id, price, count,image,name);
        cartmanager.push(item);
        saveCart();
    }
    // Set count from item
    obj.setCountForItem = function(id, count) {
        for(var i in cartmanager) {
            if (cartmanager[i].id === id) {
                cartmanager[i].count = count;
                break;
            }
        }
    };
    // Remove item from cart
    obj.removeItemFromCart = function(id) {
        for(var item in cartmanager) {
            if(cartmanager[item].id === id) {
                cartmanager[item].count --;
                if(cartmanager[item].count === 0) {
                    cartmanager.splice(item, 1);
                }
                break;
            }
        }
        saveCart();
    }

    // Remove all items from cart
    obj.removeItemFromCartAll = function(id) {
        for(var item in cartmanager) {
            if(cartmanager[item].id === id) {
                cartmanager.splice(item, 1);
                break;
            }
        }
        saveCart();
    }

    // Clear cart
    obj.clearCart = function() {
        cartmanager = [];
        saveCart();
    }

    // Count cart
    obj.totalCountmanager = function() {
        var totalCountmanager = 0;
        for(var item in cartmanager) {
            totalCountmanager += cartmanager[item].count;
        }
        return totalCountmanager;
    }

    // Total cart
    obj.totalCartmanager = function() {
        var totalCartmanager = 0;
        for(var item in cartmanager) {
            totalCartmanager += cartmanager[item].price * cartmanager[item].count;
        }
        return Number(totalCartmanager.toFixed(2));
    }

    // List cart
    obj.listCart = function() {
        var cartCopy = [];
        for(i in cartmanager) {
            item = cartmanager[i];
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
    // addItemToCartmanager : Function
    // removeItemFromCart : Function
    // removeItemFromCartAll : Function
    // clearCart : Function
    // countCart : Function
    // totalCartmanager : Function
    // listCart : Function
    // saveCart : Function
    // loadCart : Function
    return obj;
})();


// *****************************************
// Triggers / Events
// *****************************************
// Add item
$('.manager').click(function(event) {
    event.preventDefault();
    var id = $(this).data('mid');
    var name = $(this).data('mname');
    var image = $(this).data('mimage');
    var price = Number($(this).data('mprice'));
    managercart.addItemToCartmanager(id, price, 1,image,name);
    displayCart();
});

// Clear items
$('.clear-cart').click(function() {
    managercart.clearCart();
    displayCart();
});




$('.checkout_post_manager').click(function() {
    const location= $("#location").val();
    const doctor =$("#doctorid").val();
    const user_id =$("#user").val();
    const role_id =$("#role").val();

    if (!location || location.length === 0 ){
        alert('Çatdırılma ünvanını qeyd edin.');
    }
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
        data:managercart.listCart()
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
            console.log(data);
        },
        error: function (data) {
            console.log('Error:', data);

        },
    });
    console.log(cart_data)
    // console.log(location,doctor)
    // console.log(managercart.listCart())
    // console.log(location)
});

function displayCart() {
    var cartArray = managercart.listCart();
    var output = "";
    for(var i in cartArray) {
        output += "<li>"+ cartArray[i].name +" × " + cartArray[i].count + " <span><a class='minus-item-manager btn btn-primary' data-id=" + cartArray[i].id + ">-</a> <a class='plus-item-manager btn btn-primary' data-id=" + cartArray[i].id + ">+</a> " + cartArray[i].price * cartArray[i].count + " ₼  </span></li>";

    }
    $('.show-cart-manager').html(output);
    $('.total-cart-manager').html(managercart.totalCartmanager());
    $('.totalmanagercount').html(managercart.totalCountmanager());
    console.log(cartArray);
}

// Delete item button

$('.show-cart-manager').on("click", ".delete-item", function(event) {
    var id = $(this).data('id')
    managercart.removeItemFromCartAll(id);
    displayCart();
})


// -1
$('.show-cart-manager').on("click", ".minus-item-manager", function(event) {
    var id = $(this).data('id')
    managercart.removeItemFromCart(id);
    displayCart();
})
// +1
$('.show-cart-manager').on("click", ".plus-item-manager", function(event) {
    var id = $(this).data('id')
    managercart.addItemToCartmanager(id);
    displayCart();
})

// Item count input
$('.show-cart-manager').on("change", ".item-count-manager", function(event) {
    var id = $(this).data('id');
    var count = Number($(this).val());
    managercart.setCountForItem(id, count);
    displayCart();
});



displayCart();
