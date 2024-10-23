<?php
// cartpp.php (assuming this is your server-side script)
include 'connection.php';

// Check if the request is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image = $_POST['image'];

    // Check if the item already exists in the cart
    $stmt = $conn->prepare("SELECT * FROM cus WHERE username = ? AND title = ?");
    $stmt->bind_param("ss", $username, $title);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Item already exists, update the quantity
        $existing_item = $result->fetch_assoc();
        $new_quantity = $existing_item['quantity'] + $quantity;

        // Update the existing item's quantity
        $update_stmt = $conn->prepare("UPDATE cus SET quantity = ? WHERE username = ? AND title = ?");
        $update_stmt->bind_param("iss", $new_quantity, $username, $title);

        if ($update_stmt->execute()) {
            echo "Quantity updated successfully";
        } else {
            echo "Error updating quantity: " . $update_stmt->error;
        }

        $update_stmt->close();
    } else {
        // Item does not exist, insert new item
        $insert_stmt = $conn->prepare("INSERT INTO cus (username, quantity, price, title, description, image) VALUES (?, ?, ?, ?, ?, ?)");
        $insert_stmt->bind_param("sissss", $username, $quantity, $price, $title, $description, $image);

        if ($insert_stmt->execute()) {
            echo "Item inserted successfully";
        } else {
            echo "Error inserting item: " . $insert_stmt->error;
        }

        $insert_stmt->close();
    }

    $stmt->close();
}

$conn->close();
