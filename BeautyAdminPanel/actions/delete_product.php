<?php
// Assuming connection to database is established
require_once('../db.php');
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['product_id'])) {
    // Sanitize input
    $product_id = $_POST['product_id'];
    
    // Prepare and execute delete query

    $stmt = $conn->prepare("DELETE FROM products WHERE ID = ?");
    $stmt->bind_param("i", $product_id);
    if ($stmt->execute()) {
        $response = array(
            'status' => 'success',
            'message' => 'Product Deleted successfully'
        );
    } else {
        // Error deleting product
        $response = array(
            'status' => 'error',
            'message' => 'Error'
        );
    }

    $stmt->close();
} else {
    // Invalid request
    $response = array(
        'status' => 'error',
        'message' => 'Errorr'
    );
}
header('Content-Type: application/json');
echo json_encode($response);
?>
