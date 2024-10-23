<?php
include 'cartp.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="stylecart.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    <div class="main">
        <header>
            <div class="container">
                <div class="logo">
                    <a href="main.php">
                        <img src="image1.png">
                    </a>
                </div>

                <div class="search-bar">
                    <form action="search.php" method="GET">
                        <input type="text" name="query" placeholder="Search for products..." style="color: #e671a3;">
                        <button type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="2em" height="em" viewBox="0 0 32 32">
                                <path fill="none" stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m5 27l7.5-7.5M28 13a9 9 0 1 1-18 0a9 9 0 0 1 18 0" />
                            </svg></button>
                    </form>
                    <?php if (isset($_COOKIE['UserName'])) : ?>
                        <button class="login" onclick="window.location.href = 'logout.php'" id="login">Logout<button>
                            <?php else : ?>
                                <button class="login" onclick="window.location.href = 'login.php'" id="login">Login</button>
                            <?php endif; ?>
                            <button class="basket" data-items="All" onclick="emptycart()"><svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24">
                                    <path class="basket" fill="white" d="M0 1h4.764l.545 2h18.078l-3.666 11H7.78l-.5 2H22v2H4.72l1.246-4.989L3.236 3H0zm7.764 11h10.515l2.334-7H5.855zM4 21a2 2 0 1 1 4 0a2 2 0 0 1-4 0m14 0a2 2 0 1 1 4 0a2 2 0 0 1-4 0" />
                                </svg></button>
                </div>
            </div>
        </header>
    </div>
    <main>
        <div class="cart-container" id="cart-container">
            <!-- Cart items will be dynamically added here -->
            <?php foreach ($items as $item) : ?>
                <div class="cart-item" data-title="<?= htmlspecialchars($item['title']) ?>">
                    <div class="maindiv">
                        <div class="imgdiv">
                            <img class="img1" src="<?= htmlspecialchars($item['Image']) ?>" alt="Product Image">
                        </div>
                        <div class="detailsdiv">
                            <h2 class="title"><?= htmlspecialchars($item['title']) ?>: <span class="info"><?= htmlspecialchars($item['description']) ?></span></h2>
                            <div class="price-quantity">
                                <p class="price"><?= htmlspecialchars($item['price']) ?></p>
                                <div class="quantity-selector">
                                    <button class="quantity-button" data-username="<?= htmlspecialchars($username) ?>">-</button>
                                    <span class="quantity" id="quantity"><?= htmlspecialchars($item['quantity']) ?></span>
                                    <button class="quantity-button" data-username="<?= htmlspecialchars($username) ?>">+</button>
                                </div>
                                <button class="delete" onclick="deleteItem('<?= htmlspecialchars($item['title']) ?>')" data-items="All">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" viewBox="0 0 24 24">
                                        <path fill="pink" d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6zM19 4h-3.5l-1-1h-5l-1 1H5v2h14z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="checkout" id="checkout">
            <button class="checkoutbut" onclick="openModal()">Proceed to Checkout</button>
        </div>
        <div id="product-modal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <form action="confirmorder.php" class="confirm" method="get">
                    <div class="inp">
                        <h1 class="confirmheader" id="total-price"></h1>
                        <input type="hidden" id="totalPriceInput" name="total_price">
                        <div class="userName">
                            <input class="UserName" id="UserName" name="UserName" placeholder="<?= $username ?>" readonly>
                        </div>
                        <div class="location">
                            <input type="text" class="location" id="location" name="location" placeholder="Enter Your Location.." required>
                        </div>
                        <button type="submit" class="Submit" name="submit">Submit Order</button>
                    </div>
            </div>
            </form>
        </div>
        </div>
        <script>
            $(document).ready(function() {
                $(".delete").click(function() {
                    const cart = $(this).data('items');
                    window.location.href = "cart.php?cart=" + encodeURIComponent(cart);
                });
            });

            function deleteItem(title) {
                const url = `delete_item.php?title=${encodeURIComponent(title)}`;
                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Remove the item from the DOM
                            const itemElement = document.querySelector(`.cart-item:contains('${title}')`);
                            if (itemElement) {
                                itemElement.remove();
                            }
                        } else {
                            console.error('Failed to delete item');
                        }
                    })
                    .catch(error => console.error('Error deleting item:', error));
            }

            function openModal() {

                document.getElementById("product-modal").style.display = "block";
                const cartItems = document.querySelectorAll('.cart-item');
                let totalPrice = 0;

                cartItems.forEach(item => {
                    const priceText = item.querySelector('.price').innerText;
                    const price = parseFloat(priceText.replace('$', ''));
                    const quantity = parseInt(item.querySelector('.quantity').innerText);
                    totalPrice += price * quantity;
                });

                document.getElementById('total-price').innerText = `Total Price: $${totalPrice.toFixed(2)}`;
                document.getElementById('totalPriceInput').value = totalPrice.toFixed(2);

            }

            function closeModal() {
                document.getElementById("product-modal").style.display = "none";
            }


            function changeQuantity(amount, button) {
                let quantityElement = button.closest('.quantity-selector').querySelector(".quantity");
                let currentQuantity = parseInt(quantityElement.innerText);
                if (currentQuantity + amount > 0) {
                    quantityElement.innerText = currentQuantity + amount;

                    let username = button.getAttribute('data-username');
                    let title = button.closest('.cart-item').getAttribute('data-title');
                    let newQuantity = currentQuantity + amount;
                    let itemData = {
                        username: username,
                        quantity: newQuantity,
                        title: title,
                    };

                    $.ajax({
                        url: 'update_item.php', // Change to your server script path
                        method: 'POST',
                        data: itemData,
                        success: function(response) {
                            console.log('Done updating item in cart:', response);
                        },
                        error: function(error) {
                            console.error('Error updating item in cart:', error);
                        }
                    });
                }
            }

            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('.quantity-button').forEach(button => {
                    button.addEventListener('click', function() {
                        let amount = this.innerText === '+' ? 1 : -1;
                        changeQuantity(amount, this);
                    });
                });
            });

            function calculateTotalPrice() {
                const cartItems = document.querySelectorAll('.cart-item');
                let totalPrice = 0;

                cartItems.forEach(item => {
                    const priceText = item.querySelector('.price').innerText;
                    const price = parseFloat(priceText.replace('$', ''));
                    const quantity = parseInt(item.querySelector('.quantity').innerText);
                    totalPrice += price * quantity;
                });

                document.getElementById('total-price').innerText = `Total Price: $${totalPrice.toFixed(2)}`;
            }

            // Call the function to
        </script>
</body>

</html>