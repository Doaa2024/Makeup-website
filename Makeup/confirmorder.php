<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php
// cartpp.php (assuming this is your server-side script)
include 'connection.php';
session_start();
$username = '';
$items[] = '';
if (isset($_COOKIE['UserName'])) {
    $username = $_COOKIE['UserName'];
    if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['submit'])) {
        // Get form data
        $location = htmlspecialchars($_GET['location']);
        $totalPrice = htmlspecialchars($_GET['total_price']);
        // Insert data into orders table
        $stmt = $conn->prepare("INSERT INTO orders (username, location, total_price) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $location, $totalPrice);
        if ($stmt->execute()) {
            // Assuming order processing is successful

            // Output SweetAlert2 script
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
              title: 'Order Placed!',
              text: 'Your Order is on the Way! Thank you for your trust!',
              icon: 'success',
              confirmButtonText: 'OK'
            }).then((result) => {
              if (result.isConfirmed) {
                window.location.href = 'main.php';
              }
            });
            </script>
            </body>
            </html>
            ";
        } else {
            echo "Error: " . $stmt->error;
        }
    }
}

// Close connection
$stmt->close();
$conn->close();
