<?php
include 'connection.php';
session_start();
$done = 'True';
$passError = '';
$userError = '';

if (isset($_POST['submit'])) {
    // Get the submitted form data
    $username = $_POST['UserName'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $passwordRestriction = $_POST['password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $stmt = $conn->prepare("SELECT * FROM `Users` WHERE `UserName` = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $userError = 'Username already exists.';
        $done = 'False';
    }
    if (strlen($passwordRestriction) < 8 || !preg_match("/[A-Za-z]/", $passwordRestriction) || !preg_match("/[0-9]/", $passwordRestriction)) {
        $passError = 'Password must be at least 8 mixed elements ';
        $done = 'False';
    }
    // Prepare the SQL statement
    if ($done == 'True') {
        $stmt = $conn->prepare("INSERT INTO `Users` (`UserName`, `Password`, `Email`, `Phone Number`) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $password, $email, $phone);
        if ($stmt->execute()) {
            $_SESSION['UserName'] = $username;
            echo '<script type="text/javascript">';
            echo 'window.location.href = "login.php";';
            echo '</script>';
        }
    }


    // Close the statement
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="signup.css">
</head>

<body>
    <div class="scroller">
        <div class="wrapper">
            <form action="signup.php" class="signup" method="post">
                <h1 class="signupHeader">Sign Up</h1>
                <div class="input-container">
                    <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                        <path fill="white" d="M12 12q-1.65 0-2.825-1.175T8 8t1.175-2.825T12 4t2.825 1.175T16 8t-1.175 2.825T12 12m-8 8v-2.8q0-.85.438-1.562T5.6 14.55q1.55-.775 3.15-1.162T12 13t3.25.388t3.15 1.162q.725.375 1.163 1.088T20 17.2V20z" />
                    </svg>
                    <input type="text" class="UserName" id="UserName" name="UserName" placeholder="UserName" required>
                    <p class="errorText"> <?php echo $userError ?> </p>
                </div>
                <div class="input-container">
                    <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                        <path fill="white" d="M17 9V7c0-2.8-2.2-5-5-5S7 4.2 7 7v2c-1.7 0-3 1.3-3 3v7c0 1.7 1.3 3 3 3h10c1.7 0 3-1.3 3-3v-7c0-1.7-1.3-3-3-3M9 7c0-1.7 1.3-3 3-3s3 1.3 3 3v2H9z" />
                    </svg>
                    <input type="password" class="Password" id="password" name="password" placeholder="Password" required>
                    <p class="errorText"> <?php echo $passError ?> </p>
                </div>
                <div class="input-container">
                    <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                        <path fill="white" d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2m0 4l-8 5l-8-5V6l8 5l8-5z" />
                    </svg>
                    <input type="email" class="Email" id="email" name="email" placeholder="Email" required>
                </div>
                <div class="input-container">
                    <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                        <path fill="white" d="m16.556 12.906l-.455.453s-1.083 1.076-4.038-1.862s-1.872-4.014-1.872-4.014l.286-.286c.707-.702.774-1.83.157-2.654L9.374 2.86C8.61 1.84 7.135 1.705 6.26 2.575l-1.57 1.56c-.433.432-.723.99-.688 1.61c.09 1.587.808 5 4.812 8.982c4.247 4.222 8.232 4.39 9.861 4.238c.516-.048.964-.31 1.325-.67l1.42-1.412c.96-.953.69-2.588-.538-3.255l-1.91-1.039c-.806-.437-1.787-.309-2.417.317" />
                    </svg>
                    <input type="tel" class="PhoneNumber" id="phone" name="phone" placeholder="Phone Number" required>
                </div>
                <div class="but">
                    <button type="submit" class="signup_but" name="submit">Create Account</button>
                </div>
                <div class="register">
                    <p class="text">Already have an account?</p>
                    <a href="login.php" class="signin">Login!</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>