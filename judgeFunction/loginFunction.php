<?php
include './partial/Connection.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start(); 
}

$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Prepare the SQL statement
    $sql = "SELECT jdg_pass FROM judge WHERE jdg_username = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($password === $row['jdg_pass']) {
                $_SESSION['userName'] = $username; 
                header("Location: dashboard.php");
                exit();
            } else {
                $error_message = "Invalid username or password.";
            }
        } else {
            $error_message = "Invalid username or password.";
        }

        $stmt->close();
    } else {
        $error_message = "Database query failed.";
    }
}

mysqli_close($conn);
?>
