<?php
include 'connection.php';
session_start();
$username = '';
$items[] = '';
if (isset($_COOKIE['UserName'])) {
    $username = $_COOKIE['UserName'];
    $items = isset($_GET['cart']) ? $_GET['cart'] : '';
    if ($items === 'All') {
        $stmt = $conn->prepare("SELECT * FROM `cus` where `UserName`= ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $items = [];
        while ($row = $result->fetch_assoc()) {
            $items[] = $row;
        }
    }
}
