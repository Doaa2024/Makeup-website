<?php
// Assuming connection to database is established
require_once('../db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input
    $id = $_POST['id'];
    $name = $_POST['nametbu'];
    $description = $_POST['descriptiontbu'];
    $price = $_POST['pricetbu'];
    $image = $_POST['imagetbu']; // Assuming image is a URL or file path
    $category = $_POST['categorytbu'];

    // Prepare and execute update query
    $stmt = $conn->prepare("UPDATE products SET Name = ?, Description = ?, Price = ?, Image = ?, Category = ? WHERE ID = ?");
    $stmt->bind_param("ssdssi", $name, $description, $price, $image, $category, $id);

    if ($stmt->execute()) {
        $response = array(
            'status' => 'success',
            'message' => 'Product updated successfully'
        );
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Error updating product: ' . $stmt->error
        );
    }

    $stmt->close();
} else {
    $response = array(
        'status' => 'error',
        'message' => 'Invalid request'
    );
}

header('Content-Type: application/json');
echo json_encode($response);

$conn->close();
?>
