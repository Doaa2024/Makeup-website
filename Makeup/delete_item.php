<?php
// delete_item.php
include 'connection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $title = $_GET['title'];

    // Delete item from database
    $stmt = $conn->prepare("DELETE FROM cus WHERE title = ?");
    $stmt->bind_param("s", $title);

    if ($stmt->execute()) {
        echo json_encode([
            'success' => true
        ]);
    } else {
        echo json_encode([
            'success' => false
        ]);
    }

    $stmt->close();
}

$conn->close();
