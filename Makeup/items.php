<?php
include 'itemsp.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Show Page</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
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
                        <button type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 32 32">
                                <path fill="none" stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m5 27l7.5-7.5M28 13a9 9 0 1 1-18 0a9 9 0 0 1 18 0" />
                            </svg></button>
                    </form>
                    <?php if (isset($_COOKIE['UserName'])) : ?>
                        <button class="login" onclick="window.location.href = 'logout.php'" id="login">Logout<button>
                            <?php else : ?>
                                <button class="login" onclick="window.location.href = 'login.php'" id="login">Login</button>
                            <?php endif; ?>
                            <button class="basket" data-items="All"><svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24">
                                    <path class="basket" fill="white" d="M0 1h4.764l.545 2h18.078l-3.666 11H7.78l-.5 2H22v2H4.72l1.246-4.989L3.236 3H0zm7.764 11h10.515l2.334-7H5.855zM4 21a2 2 0 1 1 4 0a2 2 0 0 1-4 0m14 0a2 2 0 1 1 4 0a2 2 0 0 1-4 0" />
                                </svg></button>
                </div>
            </div>
        </header>
    </div>
    <div class="product-grid" id="containerproduct">
        <?php foreach ($products as $info) : ?>
            <div class="product-card">
                <div class="product-image">
                    <img src="<?= $info['Image'] ?>" alt="Lipstick">
                </div>
                <div class="product-info">
                    <h2><?= $info['Name'] ?></h2>
                    <p><?= $info['Description'] ?></p>
                    <a class="product-button" onclick="openModal('<?= $info['Name'] ?>', '<?= $info['Description'] ?>', '<?= $info['Price'] ?>', '<?= $info['Image'] ?>')">View Details</a>
                </div>
            </div>
            <div id="product-modal" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeModal()">&times;</span>
                    <img src="" alt="Product Image" id="modal-img">
                    <div class="product-inf">
                        <h2 id="modal-title">Product Title</h2>
                        <p id="modal-description">Product Description</p>
                        <p class="price" id="modal-price">$0</p>
                        <div class="quantity-selector">
                            <button onclick="changeQuantity(-1)" class="quantity-button">-</button>
                            <span id="quantity" class="quantity">1</span>
                            <button onclick="changeQuantity(1)" class="quantity-button">+</button>
                        </div>
                        <button class="add-to-cart" onclick="addtocart()" data-username="<?php echo htmlspecialchars($username) ?>">Add to Cart</button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <script>
        function openModal(title, description, price, image) {
            document.getElementById("modal-img").src = image;
            document.getElementById("modal-title").innerText = title;
            document.getElementById("modal-description").innerText = description;
            document.getElementById("modal-price").innerText = price;
            document.getElementById("product-modal").style.display = "block";
        }

        function closeModal() {
            document.getElementById("product-modal").style.display = "none";
            document.querySelector(".add-to-cart").innerText = "Add to Cart";
            document.getElementById("quantity").innerText = 1;


        }

        function changeQuantity(amount) {
            let quantityElement = document.getElementById("quantity");
            let currentQuantity = parseInt(quantityElement.innerText);
            if (currentQuantity + amount > 0) {
                quantityElement.innerText = currentQuantity + amount;
            }
        }

        $(document).ready(function() {
            $(".basket").click(function() {
                const cart = $(this).data('items');
                window.location.href = "cart.php?cart=" + encodeURIComponent(cart);
            });
        });
        if (document.getElementById("login").innerText == "Logout") {
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('.add-to-cart').forEach(button => {
                    button.addEventListener('click', function() {

                        var username = this.getAttribute('data-username');
                        var image = document.getElementById("modal-img").src;
                        var title = document.getElementById("modal-title").innerText;
                        var price = document.getElementById("modal-price").innerText;
                        var quantity = parseInt(document.getElementById("quantity").innerText);
                        var description = document.getElementById("modal-description").innerText;

                        var itemData = {
                            username: username,
                            quantity: quantity,
                            price: price,
                            title: title,
                            description: description,
                            image: image
                        };

                        $.ajax({
                            url: 'cartpp.php', // Change to your server script path
                            method: 'POST',
                            data: itemData,
                            success: function(response) {
                                document.querySelector(".add-to-cart").innerText = "Added!";

                            },
                            error: function(error) {
                                console.error('Error adding item to cart:', error);
                            }
                        });
                    });
                });
            });
        }

        function addtocart() {
            if (document.getElementById("login").innerText !== "Logout") {
                document.querySelector(".add-to-cart").innerText = "You have to login!";
            }

        }
    </script>
</body>

</html>