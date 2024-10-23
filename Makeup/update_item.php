<?php
// update_item.php
include 'connection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $quantity = $_POST['quantity'];
    $title = $_POST['title'];

    // Check if the item already exists in the cart
    $stmt = $conn->prepare("SELECT * FROM cus WHERE username = ? AND title = ?");
    $stmt->bind_param("ss", $username, $title);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Item already exists, update the quantity
        $update_stmt = $conn->prepare("UPDATE cus SET quantity = ? WHERE username = ? AND title = ?");
        $update_stmt->bind_param("iss", $quantity, $username, $title);

        if ($update_stmt->execute()) {
            echo "Quantity updated successfully";
        } else {
            echo "Error updating quantity: " . $update_stmt->error;
        }

        $update_stmt->close();
    }

    $stmt->close();
}
$conn->close();
