<?php
// Assuming connection to database is established
require_once('../db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input
    $existingCategory = $_POST['existingCategory'];
    $categoryToUpdate = $_POST['categorytobeUpdated'];
    $image = $_POST['image']; // Assuming image is a URL or file path

    // Prepare and execute update query
    $stmt = $conn->prepare("UPDATE category SET Category = ?, Image = ? WHERE Category = ?");
    $stmt->bind_param("sss", $categoryToUpdate, $image, $existingCategory);

    if ($stmt->execute()) {
        $response = array(
            'status' => 'success',
            'message' => 'Category updated successfully'
        );
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Error updating category: ' . $stmt->error
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
