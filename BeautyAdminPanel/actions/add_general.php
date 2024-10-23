<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize inputs (you should add more validation as needed)
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image = $_POST['image']; // Assuming image is a URL or file path

    require_once('../db.php'); // Ensure your database connection is included properly

    // Prepare and bind SQL statement to insert data
    $stmt = $conn->prepare("INSERT INTO `general` (`Title`, `Description`, `Image`) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $title, $description, $image);

    // Execute the statement
    if ($stmt->execute()) {
        // Success message (you can redirect or display a message as needed)
        echo "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Order Confirmation</title>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        </head>
        <body>
        <script>
        Swal.fire({
          title: 'New general component added successfully!',
          icon: 'success',
          confirmButtonText: 'OK'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = '../general.php';
          }
        });
        </script>
        </body>
        </html>
        ";
    } else {
        // Error message
        echo '<script>alert("Error: ' . $stmt->error . '"); window.history.back();</script>';
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    // If the form was not submitted properly
    echo '<script>alert("Form submission error"); window.history.back();</script>';
}
