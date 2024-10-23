<?php
include 'connection.php';
session_start();
$username = '';
if (isset($_COOKIE['UserName'])) {
    $username = $_COOKIE['UserName'];
}
$query = isset($_GET['query']) ? trim($_GET['query']) : '';
if ($query === '') {
    echo "Please enter a search term.";
    exit;
}

// Use prepared statements to prevent SQL injection
$sql = "SELECT * FROM `products` WHERE `Name` LIKE ? OR `Description` LIKE ?";
$stmt = $conn->prepare($sql);
$searchTerm = "%" . $query . "%";
$stmt->bind_param("ss", $searchTerm, $searchTerm);
$stmt->execute();
$result = $stmt->get_result();
$products = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    echo '<div class="main">';
    echo '<header>';
    echo '<div class="container">';
    echo '<div class="logo">';
    echo '<a href="main.php">';
    echo '<img src="image1.png">';
    echo '</a>';
    echo '</div>';
    echo '<div class="search-bar">';
    echo '<form action="search.php" method="GET">';
    echo '<input type="text" name="query" placeholder="Search for products..." style="color: #e671a3;">';
    echo '<button type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 32 32">
                                <path fill="none" stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m5 27l7.5-7.5M28 13a9 9 0 1 1-18 0a9 9 0 0 1 18 0" />
                            </svg></button>';
    echo '</form>';
    if (isset($_COOKIE['UserName'])) {
        echo '<button class="login" onclick="window.location.href = \'logout.php\'" id="login">Logout</button>';
    } else {
        echo '<button class="login" onclick="window.location.href = \'login.php\'" id="login">Login</button>';
    }
    echo '<button class="basket" data-items="All"><svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24"><path class="basket" fill="white" d="M0 1h4.764l.545 2h18.078l-3.666 11H7.78l-.5 2H22v2H4.72l1.246-4.989L3.236 3H0zm7.764 11h10.515l2.334-7H5.855zM4 21a2 2 0 1 1 4 0a2 2 0 0 1-4 0m14 0a2 2 0 1 1 4 0a2 2 0 0 1-4 0" /></svg></button>';
    echo '</div>';
    echo '</div>';
    echo '</header>';
    echo '</div>';
    echo '<div class="product-grid" id="containerproduct">';
    foreach ($products as $info) {
        echo '<div class="product-card">';
        echo '<div class="product-image">';
        echo '<img src="' . htmlspecialchars($info['Image']) . '" alt="Lipstick">';
        echo '</div>';
        echo '<div class="product-info">';
        echo '<h2>' . htmlspecialchars($info['Name']) . '</h2>';
        echo '<p>' . htmlspecialchars($info['Description']) . '</p>';
        echo '<a class="product-button" onclick="openModal(\'' . htmlspecialchars($info['Name']) . '\', \'' . htmlspecialchars($info['Description']) . '\', \'' . htmlspecialchars($info['Price']) . '\', \'' . htmlspecialchars($info['Image']) . '\')">View Details</a>';
        echo '</div>';
        echo '</div>';
    }
    echo '</div>';
    echo '<div id="product-modal" class="modal">';
    echo '<div class="modal-content">';
    echo '<span class="close" onclick="closeModal()">&times;</span>';
    echo '<img src="" alt="Product Image" id="modal-img">';
    echo '<div class="product-inf">';
    echo '<h2 id="modal-title">Product Title</h2>';
    echo '<p id="modal-description">Product Description</p>';
    echo '<p class="price" id="modal-price">$0</p>';
    echo '<div class="quantity-selector">';
    echo '<button onclick="changeQuantity(-1)" class="quantity-button">-</button>';
    echo '<span id="quantity" class="quantity">1</span>';
    echo '<button onclick="changeQuantity(1)" class="quantity-button">+</button>';
    echo '</div>';
    echo '<button class="add-to-cart" onclick="addtocart()" data-username="' . htmlspecialchars($username) . '">Add to Cart</button>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beauty E-commerce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</head>

<body>
</body>

</html>
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
    $(document).ready(function() {
        $(".basket").click(function() {
            const cart = $(this).data('items');
            window.location.href = "cart.php?cart=" + encodeURIComponent(cart);
        });
    });
</script>