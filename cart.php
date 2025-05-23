<?php
session_start();
require('db.php');

//Only allow access if logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
$user_id = $_SESSION['user_id'];
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <title>
        BEE BUY
    </title>
<style>
    h2{
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        color:#ffffff;
        text-align: center;
        font-weight: bolder;
        font-size: 40px;
    }
    button{
        width: 20%;
    }
   select {
    width: 100%;
    padding: 12px 14px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
    background-color: #fff;
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
    font-size: 14px;
    font-weight: 300;
    color: #333;
    appearance: none;
}

</style>
</head>

<body>
    <header>
        <i class="fa-solid fa-bug" style="color: #ffffff; font-size: 72px; display: block; align-content: center;margin-right: 15px;padding: 8px 16px; border-radius: 0px;"></i>
        <h1 id='p1' style="color: rgb(255, 255, 255); text-align: left; font-weight: bolder; font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif; font-size:32px;">
            BEE <br> BUY <br>
        </h1>
        <nav>
            <ul class="nav-links">
                <li><a href="index.html">HOME</a></li>
                <li><a href="gallery.php">SHOP</a></li>
                <li><a href="bio.html">BIO</a></li>
                <li><a href="contactus.html">CONTACT</a></li>
                <li><a href="cart.php" class="active">CART</a></li>
                <li><a href="login.php">LOGIN</a></li>
                <li><a href="dashboard.php">ADMIN</a></li>
                <li><a href="additem.php">POST</a></li>
                <a href="https://facebook.com" target="_blank"> 
                    <i class="fa-brands fa-facebook-f" style="color: #ffffff; align-content: center;margin-right: 15px;padding: 8px 16px; border-radius: 0px;"></i>
                </a><br>
                <a href="https://x.com" target="_blank"> 
                    <i class="fa-brands fa-x-twitter" style="color: #ffffff; align-content: center;margin-right: 15px;padding: 8px 16px; border-radius: 0px;"></i>
                </a><br>
                <a href="https://instagram.com" target="_blank"> 
                    <i class="fa-brands fa-instagram" style="color: #ffffff; align-content: center;margin-right: 15px;padding: 8px 16px; border-radius: 0px;"></i>
                </a>
                </ul>
        </nav>
    </header>
    <div class="card" style="background-color: rgba(0, 0, 0, 0.4);text-align: center;">
        <div class="card-header">
            <h2>Your Cart</h2>
            <ul id="cart-items"></ul>
            <p><strong>Total: $<span id="total-price">0.00</span></strong></p>
        </div>
        <script>
            function loadCart() {
    let cart = JSON.parse(localStorage.getItem("cart")) || [];
    let cartList = document.getElementById("cart-items");
    cartList.innerHTML = "";
    let totalPrice = 0; //Initialize total price

    if (cart.length === 0) {
        let emptyMessage = document.createElement("li");
        emptyMessage.textContent = "Your cart is empty";
        cartList.appendChild(emptyMessage);
    } else {
        cart.forEach((item, index) => {
            let listItem = document.createElement("li");
            listItem.className = "cart-item";
            let itemContainer = document.createElement("div"); //use styling
            let itemText = document.createElement("span");
            itemText.textContent = `${item.name} - $${item.price}`; 

            //total price 
            let itemPrice = parseFloat(item.price);
            if (!isNaN(itemPrice)) {
                totalPrice += itemPrice;
            }
            //allow users to remove their items
            let removeButton = document.createElement("button");
            removeButton.textContent = "Remove";
            removeButton.onclick = function() {
                cart.splice(index, 1); 
                localStorage.setItem("cart", JSON.stringify(cart));
                loadCart(); 
            };

            itemContainer.appendChild(itemText);
            itemContainer.appendChild(removeButton);
            listItem.appendChild(itemContainer);
            cartList.appendChild(listItem);
        });
    }

    document.getElementById("total-price").textContent = totalPrice.toFixed(2);
}
//card information
document.addEventListener("DOMContentLoaded", loadCart);

        </script>
    <div class="card">
        <div class="card-header">
            <p style="font-size: large;">Check-out</p>
        </div>
        <div class="card-body">
            <form style="text-align: center;">
                <input type="text" name="name" placeholder="Name on card" style="width: 100%;"><br>
                <div class="input-group full-width">
                    <input type="text" name="card-num" placeholder="16-digit card number">
                </div><br>
                <div class="input-group">
                    <input type="text" name="cvv" placeholder="CVV">
                    <input type="month" name="exp-date" placeholder="Expiration date">
                </div>
                <input type="text" name="address" placeholder="Address" style="width: 50%"><br>
                <input type="text" name="city" placeholder="City, State" style="width: 25%">
                <input type="text" name="area-code" placeholder="Area code" style="width: 25%"><br>
                <input type="submit">
            </form>
        </div>
    </div>
    
