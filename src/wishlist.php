<?php
session_start();
session_destroy();
$array_php = array();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>wishlist</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body>

    <div id="main">
        <div id="products">
            <!-- THIS SECTION WOULD BE DYNAMIC -->
            <?php
            $product = array(
                array('id' => 101, 'name' => "Basket Ball", 'image' => "basketball.png", 'price' => 150),
                array('id' => 102, 'name' => "Football", 'image' => "football.png", 'price' => 120),
                array('id' => 103, 'name' => "Soccer", 'image' => "soccer.png", 'price' => 90),
                array('id' => 104, 'name' => "Table Tennis", 'image' => "table-tennis.png", 'price' => 110),
                array('id' => 105, 'name' => "Tennis", 'image' => "tennis.png", 'price' => 80)
            );
            $_SESSION['length'] = count($product);
            echo '<div id="products">';
            $i = 0;
            foreach ($product as $k => $v) {
                echo '<div id="product-101" class="product">
	<img src="images/' . $v['image'] . '">
	<h3 class="title"><a href="#">Product ' . $v['id'] . '</a></h3>
	<span>Price: $' . $v['price'] . '</span><br>
	<a class="add-to-cart" data-id=" ' . $v['id'] . ' " data-name="' . $v['name'] . ' " data-image="' . $v['image'] . '" data-price="' . $v['price'] . '" >Add To Cart</a>
    <a class="buy-now" data-id=" ' . $v['id'] . ' " data-name="' . $v['name'] . ' " data-image="' . $v['image'] . '" data-price="' . $v['price'] . '" >Buy Now</a>
    <a class="add-to-wishlist" data-id=" ' . $v['id'] . ' " data-name="' . $v['name'] . ' " data-image="' . $v['image'] . '" data-price="' . $v['price'] . '" >Add To Wishlist</a>
	</div>';
                $i++;
            }

            echo '</div>';
            ?>

            <!-- DYNAMIC SECTION ENDS HERE -->
        </div>
    </div>
    <div>
        <h1>ADD TO CART</h1>
        <div id="addtocart"></div>
    </div>
    <div>
        <h1>BUY NOW</h1>
        <div id="buynow"></div>
    </div>
    <div>
        <h1>WISH LIST</h1>
        <div id="wishlist"></div>
    </div>

    <div id="lastDiv">
        <button id="clearCart">clear cart</button>
    </div>
</body>

</html>

<script>
    var cart_array = [];
    var buy_array = [];
    var wish_array = [];
    $("#main").on("click", ".add-to-cart", function(event) {
        event.preventDefault();
        add2Cart($(this).data("id"), $(this).data("name"), $(this).data("image"), $(this).data("price"));
    });
    $("#main").on("click", ".buy-now", function(event) {
        event.preventDefault();
        buyNow($(this).data("id"), $(this).data("name"), $(this).data("image"), $(this).data("price"));
    });
    $("#main").on("click", ".add-to-wishlist", function(event) {
        event.preventDefault();
        add2Wishlist($(this).data("id"), $(this).data("name"), $(this).data("image"), $(this).data("price"));
    });

    function add2Cart(id, name, image, price) {
        $.ajax({
            url: 'post.php',
            type: 'post',
            data: {
                action: 'addToCart',
                id: id,
                name: name,
                image: image,
                price: price
            },
            datatype: 'json',
            success: function(data) {
                cart_array = JSON.parse(data);
                display(cart_array);
            }
        })
    }
    function buyNow(id, name, image, price) {
      
         $.ajax({
            url: 'post.php',
            type: 'post',
            data: {
                action: 'buyNow',
                id: id,
                name: name,
                image: image,
                price: price
            },
            datatype: 'json',
            success: function(data) {
                buy_array = JSON.parse(data);
                display1(buy_array);
            }
         })
    }
    function add2Wishlist(id, name, image, price) {
        $.ajax({
            url: 'post.php',
            type: 'post',
            data: {
                action: 'addToWishlist',
                id: id,
                name: name,
                image: image,
                price: price
            },
            datatype: 'json',
            success: function(data) {
                wish_array = JSON.parse(data);
                display2(wish_array);
            }
        })
    }

    function remove(id){
        for (var i = 0; i < cart_array.length; i++) {
            if(i == id){
                $.ajax({
                    url: 'post.php',
                    type: 'post',
                    data: {
                        action: 'remove',
                        id: id,
                        },
                    datatype: 'json',
                    success: function(data) {
                           cart_array = JSON.parse(data);
                           display(cart_array);
                            }
                    })
            }
        }
    }

    function remove1(id){
        for (var i = 0; i < buy_array.length; i++) {
            if(i == id){
                $.ajax({
                    url: 'post.php',
                    type: 'post',
                    data: {
                        action: 'remove1',
                        id: id,
                        },
                    datatype: 'json',
                    success: function(data) {
                           buy_array = JSON.parse(data);
                           display1(buy_array);
                            }
                    })
            }
        }
    }

    function remove2(id){
        for (var i = 0; i < wish_array.length; i++) {
            if(i == id){
                $.ajax({
                    url: 'post.php',
                    type: 'post',
                    data: {
                        action: 'remove2',
                        id: id,
                        },
                    datatype: 'json',
                    success: function(data) {
                           wish_array = JSON.parse(data);
                           display2(wish_array);
                            }
                    })
            }
        }
    }
  
function buy1(id){
    for (var i = 0; i < cart_array.length; i++) {
            if(i == id){
                $.ajax({
                    url: 'post.php',
                    type: 'post',
                    data: {
                        action: 'buy1',
                        id: id,
                        },
                    datatype: 'json',
                    success: function(data) {
                        buy_array = JSON.parse(data);
                        display1(buy_array);
                       cart_array.splice(id ,1);
                       display(cart_array);
                            }
                    })
            }
        }
}
function add1(id){
    for (var i = 0; i < buy_array.length; i++) {
            if(i == id){
                $.ajax({
                    url: 'post.php',
                    type: 'post',
                    data: {
                        action: 'add1',
                        id: id,
                        },
                    datatype: 'json',
                    success: function(data) {
                        cart_array = JSON.parse(data);
                        display(cart_array);
                        buy_array.splice(id ,1);
                       display1(buy_array);
                            }
                    })
            }
        }
}
function add2(id){
    for (var i = 0; i < buy_array.length; i++) {
            if(i == id){
                $.ajax({
                    url: 'post.php',
                    type: 'post',
                    data: {
                        action: 'add2',
                        id: id,
                        },
                    datatype: 'json',
                    success: function(data) {
                        cart_array = JSON.parse(data);
                        display(cart_array);
                        wish_array.splice(id ,1);
                       display2(wish_array);
                            }
                    })
            }
        }
}
function buy1(id){
    for (var i = 0; i < cart_array.length; i++) {
            if(i == id){
                $.ajax({
                    url: 'post.php',
                    type: 'post',
                    data: {
                        action: 'buy1',
                        id: id,
                        },
                    datatype: 'json',
                    success: function(data) {
                        buy_array = JSON.parse(data);
                        display1(buy_array);
                       cart_array.splice(id ,1);
                       display(cart_array);
                            }
                    })
            }
        }
}
function buy2(id){
    for (var i = 0; i < wish_array.length; i++) {
            if(i == id){
                $.ajax({
                    url: 'post.php',
                    type: 'post',
                    data: {
                        action: 'buy2',
                        id: id,
                        },
                    datatype: 'json',
                    success: function(data) {
                        buy_array = JSON.parse(data);
                        display1(buy_array);
                        wish_array.splice(id ,1);
                       display2(wish_array);
                            }
                    })
            }
        }
}
function wish1(id){
    for (var i = 0; i < cart_array.length; i++) {
            if(i == id){
                $.ajax({
                    url: 'post.php',
                    type: 'post',
                    data: {
                        action: 'wish1',
                        id: id,
                        },
                    datatype: 'json',
                    success: function(data) {
                        wish_array = JSON.parse(data);
                        display2(wish_array);
                        cart_array.splice(id ,1);
                        display(cart_array);
                            }
                    })
            }
        }
}

function wish2(id){
    for (var i = 0; i < buy_array.length; i++) {
            if(i == id){
                $.ajax({
                    url: 'post.php',
                    type: 'post',
                    data: {
                        action: 'wish2',
                        id: id,
                        },
                    datatype: 'json',
                    success: function(data) {
                        wish_array = JSON.parse(data);
                        display2(wish_array);
                        buy_array.splice(id ,1);
                        display1(buy_array);
                            }
                    })
            }
        }
}

    function display(array) {

        html = '<table><tr><th>ID</th><th>NAME</th><th>IMAGE</th><th>PRICE</th><th>QUANTITY</th><th>BUY NOW</th><th>ADD TO WISH</th><th>REMOVE</th><tr>';
        for (var i = 0; i < array.length; i++) {

            html += '<tr><td>' + array[i][0] + '</td><td>' + array[i][1] + '</td><td>' + array[i][2] + '</td><td>' + array[i][3] + '</td><td>' + array[i][4] + '</td><td><button onclick="buy1('+i+')" id="buy">Buy Now</button></td><td><button onclick="wish1(' + i + ')" id="wish' + i + '">Add To Wishlist</button></td><td><button id="remove' + i + '" onclick="remove('+i+')">Remove</button></tr>';
        }
        html += '</table>';
        document.getElementById("addtocart").innerHTML = html;
    }
    function display1(array) {

        html = '<table><tr><th>NAME</th><th>ID</th><th>PRICE</th><th>IMAGE</th><th>QUANTITY</th><th>Move To Cart</th><th>ADD TO WISH</th><th>REMOVE</th><tr>';
        for (var i = 0; i < array.length; i++) {

        html += '<tr><td>' + array[i][0] + '</td><td>' + array[i][1] + '</td><td>' + array[i][2] + '</td><td>' + array[i][3] + '</td><td>' + array[i][4] + '</td><td><button onclick="add1('+i+')" id="cart' + i + '">Move To Cart</button></td><td><button onclick="wish2(' + i + ')" id="wish' + i + '">Add To Wishlist</button></td><td><button id="remove' + i + '" onclick="remove1('+i+')">Remove</button></tr>';
        }
        html += '</table>';
        document.getElementById("buynow").innerHTML = html;
    }
    function display2(array) {

        html = '<table><tr><th>NAME</th><th>ID</th><th>PRICE</th><th>IMAGE</th><th>QUANTITY</th><th>BUY NOW</th><th>Move To Cart</th><th>REMOVE</th><tr>';
        for (var i = 0; i < array.length; i++) {

        html += '<tr><td>' + array[i][0] + '</td><td>' + array[i][1] + '</td><td>' + array[i][2] + '</td><td>' + array[i][3] + '</td><td>' + array[i][4] + '</td><td><button onclick="buy2('+i+')" id="buy' + i + '">Buy Now</button></td><td><button onclick="add2('+i+')" id="cart' + i + '">Move To Cart</button></td><td><button id="remove' + i + '" onclick="remove2('+i+')">Remove</button></tr>';
        }
        html += '</table>';
        document.getElementById("wishlist").innerHTML = html;
    }
</script>