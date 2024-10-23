<?php
include 'connection.php';
session_start();
$nameError = '               ';
if (isset($_POST['submit'])) {
    // Get the submitted form data
    $username = $_POST['UserName'];
    $password = $_POST['password'];
    if ($username === 'admin' && $password === 'admin') {
        echo '<script type="text/javascript">';
        echo 'window.location.href = "http://localhost/BeautyAdminPanel/index.php";';
        echo '</script>';
    } else {
        // Fetch the user data from the database
        $stmt = $conn->prepare("SELECT `UserName`, `Password` FROM `Users` WHERE `UserName` = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();

        // Verify the hashed password
        if ($data && password_verify($password, $data['Password'])) {
            // Bind the result
            setcookie("UserName", $data['UserName'], time() + (86400 * 30), "/");
            echo '<script type="text/javascript">';
            echo 'window.location.href = "main.php";';
            echo '</script>';
        } else {
            $nameError = 'Invalid UserName or Password!';
        }
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <div class="maindiv">
        <div class="wrapper">
            <form action="login.php" class="login" method="post">
                <h1 class="loginHeader">Login</h1>
                <div class="userName">
                    <svg class="svg0" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                        <path fill="white" d="M12 12q-1.65 0-2.825-1.175T8 8t1.175-2.825T12 4t2.825 1.175T16 8t-1.175 2.825T12 12m-8 8v-2.8q0-.85.438-1.562T5.6 14.55q1.55-.775 3.15-1.162T12 13t3.25.388t3.15 1.162q.725.375 1.163 1.088T20 17.2V20z" />
                    </svg>
                    <input type="text" class="UserName" id="UserName" name="UserName" placeholder="UserName" required>
                </div>
                <div class="password">
                    <svg class="svg1" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                        <path fill="white" d="M17 9V7c0-2.8-2.2-5-5-5S7 4.2 7 7v2c-1.7 0-3 1.3-3 3v7c0 1.7 1.3 3 3 3h10c1.7 0 3-1.3 3-3v-7c0-1.7-1.3-3-3-3M9 7c0-1.7 1.3-3 3-3s3 1.3 3 3v2H9z" />
                    </svg>
                    <input type="password" class="Password" id="password" name="password" placeholder="Password" required>
                </div>
                <p class="errorText"> <?php echo $nameError ?> </p>
                <a href="signup.php" class="forgetPassword">Forgot Password?</a>
                <div class="but">
                    <button type="submit" class="login_but" name="submit">Login</button>
                </div>
                <div class="register">
                    <p class="text">Don't have an account?</p>
                    <a href="signup.php" class="signin">Sign up!</a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>