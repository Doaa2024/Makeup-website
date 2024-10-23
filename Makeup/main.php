<?php
include 'mainp.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beauty E-commerce</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                    <div class="search-bar">
                        <form action="search.php" method="GET">
                            <input type="text" name="query" placeholder="Search for products..." style="color: #e671a3;">
                            <button type="submit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 32 32">
                                    <path fill="none" stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m5 27l7.5-7.5M28 13a9 9 0 1 1-18 0a9 9 0 0 1 18 0" />
                                </svg>
                            </button>
                        </form>
                    </div>

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
    <div class="target">
        <main>
            <div class="parent">
                <div class="container1">
                    <div class="overlay">
                        <div class="welcome-message">
                            <h1>Welcome <?php echo htmlspecialchars($username) ?>!</h1>
                            <p>Your one-stop destination for all things beauty</p>
                            <a id="explore" class="explore-button">Explore Now</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php if ($result1->num_rows > 0) : ?>
                <div class="features">
                    <?php foreach ($general as $General) : ?>
                        <div class="feature">
                            <img src="<?= $General['Image'] ?>" alt="Feature 1">
                            <h2><?= $General['Title'] ?></h2>
                            <p><?= $General['Description'] ?> </p><br>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </main>
        </header>
        <?php if ($result->num_rows > 0) : ?>
            <header class="header1">Pick your needs!</header>
            <div class="category-container">
                <div style="background:url('image12.png') no-repeat center center/cover;" class="category-card" data-product="All">
                    <h2 class="h11">All items</h2>
                </div>
                <?php foreach ($category as $datainfo) : ?>
                    <div style="background:url('<?php echo $datainfo['Image'] ?>') no-repeat center center/cover;" class="category-card" data-product="<?php echo $datainfo['Category'] ?>">
                        <h2 class="h11"><?php echo $datainfo['Category'] ?></h2>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        <div class="container21">
            <h1 class="Explore" id="product">Explore Our Recent Products</h1>
            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">

                <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" viewBox="0 0 36 36">
                    <path fill="white" d="M22 33V19.5L33.47 8A1.8 1.8 0 0 0 34 6.7V5a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1.67a1.8 1.8 0 0 0 .53 1.27L14 19.58v10.2Z" class="clr-i-solid clr-i-solid-path-1" />
                    <path fill="white" d="M33.48 4h-31a.52.52 0 0 0-.48.52v1.72a1.33 1.33 0 0 0 .39.95l12 12v10l7.25 3.61V19.17l12-12a1.35 1.35 0 0 0 .36-.91V4.52a.52.52 0 0 0-.52-.52" class="clr-i-solid clr-i-solid-path-1" />
                    <path fill="none" d="M0 0h36v36H0z" />
                </svg>
                <label style="font-size: medium;">Filter</label>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#" data-filter="recent">Recent Items</a></li>
                    <li><a class="dropdown-item" href="#" data-filter="highest_price">Highest Price</a></li>
                    <li><a class="dropdown-item" href="#" data-filter="lowest_price">Lowest Price</a></li>
                </ul>
            </button>
        </div>
        <div class="container products" id="containerproduct">
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
                            <button class="add-to-cart" data-username="<?php echo htmlspecialchars($username) ?>" onclick="addtocart()">Add to Cart</button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <footer class="footer">
            <div class="social-media">
                <a href="https://www.facebook.com " target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 256 256">
                        <path fill="#1877f2" d="M256 128C256 57.308 198.692 0 128 0S0 57.308 0 128c0 63.888 46.808 116.843 108 126.445V165H75.5v-37H108V99.8c0-32.08 19.11-49.8 48.348-49.8C170.352 50 185 52.5 185 52.5V84h-16.14C152.959 84 148 93.867 148 103.99V128h35.5l-5.675 37H148v89.445c61.192-9.602 108-62.556 108-126.445" />
                        <path fill="#fff" d="m177.825 165l5.675-37H148v-24.01C148 93.866 152.959 84 168.86 84H185V52.5S170.352 50 156.347 50C127.11 50 108 67.72 108 99.8V128H75.5v37H108v89.445A129 129 0 0 0 128 256a129 129 0 0 0 20-1.555V165z" />
                    </svg></a>
                <a href=" https://www.instagram.com" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 256 256">
                        <g fill="none">
                            <rect width="256" height="256" fill="url(#skillIconsInstagram0)" rx="60" />
                            <rect width="256" height="256" fill="url(#skillIconsInstagram1)" rx="60" />
                            <path fill="#fff" d="M128.009 28c-27.158 0-30.567.119-41.233.604c-10.646.488-17.913 2.173-24.271 4.646c-6.578 2.554-12.157 5.971-17.715 11.531c-5.563 5.559-8.98 11.138-11.542 17.713c-2.48 6.36-4.167 13.63-4.646 24.271c-.477 10.667-.602 14.077-.602 41.236s.12 30.557.604 41.223c.49 10.646 2.175 17.913 4.646 24.271c2.556 6.578 5.973 12.157 11.533 17.715c5.557 5.563 11.136 8.988 17.709 11.542c6.363 2.473 13.631 4.158 24.275 4.646c10.667.485 14.073.604 41.23.604c27.161 0 30.559-.119 41.225-.604c10.646-.488 17.921-2.173 24.284-4.646c6.575-2.554 12.146-5.979 17.702-11.542c5.563-5.558 8.979-11.137 11.542-17.712c2.458-6.361 4.146-13.63 4.646-24.272c.479-10.666.604-14.066.604-41.225s-.125-30.567-.604-41.234c-.5-10.646-2.188-17.912-4.646-24.27c-2.563-6.578-5.979-12.157-11.542-17.716c-5.562-5.562-11.125-8.979-17.708-11.53c-6.375-2.474-13.646-4.16-24.292-4.647c-10.667-.485-14.063-.604-41.23-.604zm-8.971 18.021c2.663-.004 5.634 0 8.971 0c26.701 0 29.865.096 40.409.575c9.75.446 15.042 2.075 18.567 3.444c4.667 1.812 7.994 3.979 11.492 7.48c3.5 3.5 5.666 6.833 7.483 11.5c1.369 3.52 3 8.812 3.444 18.562c.479 10.542.583 13.708.583 40.396c0 26.688-.104 29.855-.583 40.396c-.446 9.75-2.075 15.042-3.444 18.563c-1.812 4.667-3.983 7.99-7.483 11.488c-3.5 3.5-6.823 5.666-11.492 7.479c-3.521 1.375-8.817 3-18.567 3.446c-10.542.479-13.708.583-40.409.583c-26.702 0-29.867-.104-40.408-.583c-9.75-.45-15.042-2.079-18.57-3.448c-4.666-1.813-8-3.979-11.5-7.479s-5.666-6.825-7.483-11.494c-1.369-3.521-3-8.813-3.444-18.563c-.479-10.542-.575-13.708-.575-40.413c0-26.704.096-29.854.575-40.396c.446-9.75 2.075-15.042 3.444-18.567c1.813-4.667 3.983-8 7.484-11.5c3.5-3.5 6.833-5.667 11.5-7.483c3.525-1.375 8.819-3 18.569-3.448c9.225-.417 12.8-.542 31.437-.563zm62.351 16.604c-6.625 0-12 5.37-12 11.996c0 6.625 5.375 12 12 12s12-5.375 12-12s-5.375-12-12-12zm-53.38 14.021c-28.36 0-51.354 22.994-51.354 51.355c0 28.361 22.994 51.344 51.354 51.344c28.361 0 51.347-22.983 51.347-51.344c0-28.36-22.988-51.355-51.349-51.355zm0 18.021c18.409 0 33.334 14.923 33.334 33.334c0 18.409-14.925 33.334-33.334 33.334c-18.41 0-33.333-14.925-33.333-33.334c0-18.411 14.923-33.334 33.333-33.334" />
                            <defs>
                                <radialGradient id="skillIconsInstagram0" cx="0" cy="0" r="1" gradientTransform="matrix(0 -253.715 235.975 0 68 275.717)" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#fd5" />
                                    <stop offset=".1" stop-color="#fd5" />
                                    <stop offset=".5" stop-color="#ff543e" />
                                    <stop offset="1" stop-color="#c837ab" />
                                </radialGradient>
                                <radialGradient id="skillIconsInstagram1" cx="0" cy="0" r="1" gradientTransform="matrix(22.25952 111.2061 -458.39518 91.75449 -42.881 18.441)" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#3771c8" />
                                    <stop offset=".128" stop-color="#3771c8" />
                                    <stop offset="1" stop-color="#60f" stop-opacity="0" />
                                </radialGradient>
                            </defs>
                        </g>
                    </svg></a>
                <a href="https://www.twitter.com" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="1.23em" height="1em" viewBox="0 0 256 209">
                        <path fill="#55acee" d="M256 25.45a105 105 0 0 1-30.166 8.27c10.845-6.5 19.172-16.793 23.093-29.057a105.2 105.2 0 0 1-33.351 12.745C205.995 7.201 192.346.822 177.239.822c-29.006 0-52.523 23.516-52.523 52.52c0 4.117.465 8.125 1.36 11.97c-43.65-2.191-82.35-23.1-108.255-54.876c-4.52 7.757-7.11 16.78-7.11 26.404c0 18.222 9.273 34.297 23.365 43.716a52.3 52.3 0 0 1-23.79-6.57q-.004.33-.003.661c0 25.447 18.104 46.675 42.13 51.5a52.6 52.6 0 0 1-23.718.9c6.683 20.866 26.08 36.05 49.062 36.475c-17.975 14.086-40.622 22.483-65.228 22.483c-4.24 0-8.42-.249-12.529-.734c23.243 14.902 50.85 23.597 80.51 23.597c96.607 0 149.434-80.031 149.434-149.435q0-3.417-.152-6.795A106.8 106.8 0 0 0 256 25.45" />
                    </svg></a>
            </div>
            <div class="contact-info">
                <a>Phone: (123) 456-7890</a>
                <a>Email: info@makeup.com</a>
            </div>
            <div class="footer-note">
                <p>© 2024 Makeup Project. All rights reserved.</p>
            </div>
        </footer>
    </div>
</body>

</html>
<script>
    $(document).ready(function() {
        $(".dropdown-item").click(function() {
            const filter = $(this).data('filter');

            $("#containerproduct").load("mainpp.php", {
                filter: filter
            });
        });
    });

    $(document).ready(function() {
        $(".category-card").click(function() {
            const item = $(this).data('product');
            window.location.href = "items.php?item=" + encodeURIComponent(item);
        });
    });
    $(document).ready(function() {
        $(".basket").click(function() {
            const cart = $(this).data('items');
            window.location.href = "cart.php?cart=" + encodeURIComponent(cart);
        });
    });




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

    document.getElementById('explore').addEventListener('click', function() {
        document.getElementById('product').scrollIntoView({
            behavior: 'smooth'
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