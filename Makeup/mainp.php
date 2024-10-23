<?php
include 'connection.php';
session_start();
$username = '';
if (isset($_COOKIE['UserName'])) {
    $username = $_COOKIE['UserName'];
}
$stmt = $conn->prepare("SELECT * FROM `Category`");
$stmt->execute();
$result = $stmt->get_result();
$category = [];
while ($data = $result->fetch_assoc()) {
    $category[] = $data;
}
$stmt1 = $conn->prepare("Select * From `General`");
$stmt1->execute();
$result1 = $stmt1->get_result();
$general = [];
while ($data = $result1->fetch_assoc()) {
    $general[] = $data;
}
$stmt2 = $conn->prepare("SELECT * FROM `products` ORDER BY RAND() LIMIT 4");
$stmt2->execute();
$result2 = $stmt2->get_result();
$products = [];
while ($data = $result2->fetch_assoc()) {
    $products[] = $data;
}
$stmt2->close();
$stmt1->close();
$stmt->close();
