<?php
// Assuming connection to database is established
require_once('../db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input
    $category = $_POST['categoryNameToDelete'];
    
    // Prepare and execute delete query
    $stmt = $conn->prepare("DELETE FROM category WHERE Category = ?");
    $stmt->bind_param("s", $category);

    if ($stmt->execute()) {
        $response = array(
            'status' => 'success',
            'message' => 'Category deleted successfully'
        );
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Error deleting category: ' . $stmt->error
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
