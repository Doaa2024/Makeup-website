document.addEventListener("DOMContentLoaded", () => {
    let cart = JSON.parse(localStorage.getItem("cart")) || [];
    let cartContainer = document.getElementById("cart-container");

    cart.forEach(item => {
        let cartItem = document.createElement("div");
        cartItem.className = "cart-item";
        
        cartItem.innerHTML = `
            <div class="maindiv">
                <div class="imgdiv">
                    <img class="img1" src="${item.image}" alt="Product Image">
                </div>
                <div class="detailsdiv">
                    <h2 class="title">${item.title}: <span class="info">${item.description}</span></h2>
                    <div class="price-quantity">
                        <p class="price">${item.price}</p>
                        <div class="quantity-selector">
                            <button class="quantity-button" onclick="changeCartQuantity(this, -1)">-</button>
                            <span class="quantity">${item.quantity}</span>
                            <button class="quantity-button" onclick="changeCartQuantity(this, 1)">+</button>
                        </div>
                        <button class="delete" onclick="deleteItem('${item.title}')">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" viewBox="0 0 24 24">
                                <path fill="pink" d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6zM19 4h-3.5l-1-1h-5l-1 1H5v2h14z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        `;

        cartContainer.appendChild(cartItem);
    });
});

function changeCartQuantity(button, amount) {
    let quantityElement = button.parentElement.querySelector(".quantity");
    let currentQuantity = parseInt(quantityElement.innerText);
    if (currentQuantity + amount > 0) {
        quantityElement.innerText = currentQuantity + amount;

        // Update localStorage
        let cart = JSON.parse(localStorage.getItem("cart"));
        let title = button.parentElement.parentElement.querySelector("h2").innerText;
        let cartItem = cart.find(item => item.title === title);
        cartItem.quantity = currentQuantity + amount;
        localStorage.setItem("cart", JSON.stringify(cart));
    }
}

function deleteItem(title) {
    let cart = JSON.parse(localStorage.getItem("cart"));
    cart = cart.filter(item => item.title !== title);
    localStorage.setItem("cart", JSON.stringify(cart));

    // Remove the item from the DOM
    let cartItems = document.querySelectorAll(".cart-item");
    cartItems.forEach(item => {
        if (item.querySelector("h2").innerText === title) {
            item.remove();
            refresh();
        }
    });}
    function addToCart() {
        let image = document.getElementById("modal-img").src;
        let title = document.getElementById("modal-title").innerText;
        let price = document.getElementById("modal-price").innerText;
        let quantity = parseInt(document.getElementById("quantity").innerText);
        let description = document.getElementById("modal-description").innerText;
        document.querySelector(".add-to-cart").innerText = "Added!";

        let cartItem = {
            image: image,
            title: title,
            price: price,
            quantity: quantity,
            description: description
        };

        // Retrieve the current cart from localStorage, or initialize an empty array if not found
        let cart = JSON.parse(localStorage.getItem("cart")) || [];

        // Check if the item already exists in the cart
        let itemExists = false;
        for (let i = 0; i < cart.length; i++) {
            if (cart[i].title === title) {
                // Item exists, update its quantity
                cart[i].quantity += quantity;
                itemExists = true;
                break;
            }
        }

        // If the item does not exist, add it to the cart
        if (!itemExists) {
            cart.push(cartItem);
        }

        // Save the updated cart array back to localStorage
        localStorage.setItem("cart", JSON.stringify(cart));

        // Change the button text to indicate the item has been added


        // Close the modal after adding to the cart
    }
    document.getElementById('explore').addEventListener('click', function() {
        document.getElementById('product').scrollIntoView({
            behavior: 'smooth'
        });
    });
    $(document).ready(function() {
        $(".add-to-cart").click(function() {
            let image = document.getElementById("modal-img").src;
            let title = document.getElementById("modal-title").innerText;
            let price = document.getElementById("modal-price").innerText;
            let quantity = parseInt(document.getElementById("quantity").innerText);
            let description = document.getElementById("modal-description").innerText;
            document.querySelector(".add-to-cart").innerText = "Added!";

            let cartItem = {
                image: image,
                title: title,
                price: price,
                quantity: quantity,
                description: description
            };
            window.location.href = "main.php?cartItem=" + encodeURIComponent(cartItem);
        });
    });