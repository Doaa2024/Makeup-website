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


function addToCart() {
    let image = document.getElementById("modal-img").src;
    let title = document.getElementById("modal-title").innerText;
    let price = document.getElementById("modal-price").innerText;
    let quantity = parseInt(document.getElementById("quantity").innerText);
    let description = document.getElementById("modal-description").innerText;
    let event =document.querySelector(".add-to-cart");
    event.innerText = "Added!";
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
    
}
