<?php
// Assuming connection to database is established
require_once('../db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input
    $id = $_POST['id']; // Assuming id is passed in the POST request
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image = $_POST['image']; // Assuming image is a URL or file path

    // Prepare and execute update query
    $stmt = $conn->prepare("UPDATE general SET Title = ?, Description = ?, Image = ? WHERE ID = ?");
    $stmt->bind_param("sssi", $title, $description, $image, $id);

    if ($stmt->execute()) {
        $response = array(
            'status' => 'success',
            'message' => 'Component updated successfully'
        );
    } else {
        $response = array(
            'status' => 'error',
            'message' => 'Error updating component: ' . $stmt->error
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
