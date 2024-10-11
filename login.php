<?php
session_start();
include './judgeFunction/loginFunction.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Palawan Technological College Inc.</title>
    <link rel="stylesheet" href="./src/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/Login.css">
</head>

<body>

    <div class="login-container">
        <div class="login-header">
            LOGIN
        </div>
        <div class="login-form">
            <?php
            if (isset($error_message) && !empty($error_message)) {
                echo "<div class='alert alert-danger mt-3'>$error_message</div>";
            }
            ?>
            <form method="POST" action="">
                <div class="mb-3">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="rememberMe" name="rememberMe">
                    <label class="form-check-label" for="rememberMe">Remember me</label>
                </div>
                <button type="submit" class="btn btn-login w-100">Login</button>
            </form>
        </div>
    </div>

    <script src="./src/js/bootstrap.bundle.min.js"></script>
</body>

</html>
