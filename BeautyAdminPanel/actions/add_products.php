<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    require_once('../db.php'); // Assuming db.php contains your database connection

    // Prepare and bind parameters
    $stmt = $conn->prepare("INSERT INTO `products` (`Name`, `Description`, `Price`, `Image`, `Category`) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $description, $price, $image, $category);

    // Fetch form data and sanitize inputs (you should validate inputs as needed)
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    $category = $_POST['category'];

    // Execute the statement
    if ($stmt->execute()) {
        // JavaScript alert
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
          title: 'New product added successfully!',
          icon: 'success',
          confirmButtonText: 'OK'
        }).then((result) => {
          if (result.isConfirmed) {
            window.location.href = '../products.php';
          }
        });
        </script>
        </body>
        </html>
        ";
    } else {
        // JavaScript alert with error message
        echo '<script>alert("Error: ' . $stmt->error . '"); window.history.back();</script>';
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    // Redirect or alert if form not submitted properly
    echo '<script>alert("Form not submitted properly"); window.history.back();</script>';
}
