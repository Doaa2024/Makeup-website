<?php
include 'connection.php';
session_start();
$username = '';
if (isset($_COOKIE['UserName'])) {
    $username = $_COOKIE['UserName'];
}
$product = isset($_GET['item']) ? $_GET['item'] : '';
if ($product === 'All') {

    $stmt = $conn->prepare("SELECT * FROM `products`");
} else {
    $stmt = $conn->prepare("SELECT * FROM `products` where `Category`= ?");
    $stmt->bind_param("s", $product);
}
$stmt->execute();
$result = $stmt->get_result();
$products = [];
while ($row = $result->fetch_assoc()) {
    $products[] = $row;
}
$conn->close();
$stmt->close();
