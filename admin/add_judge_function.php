<?php
session_start();
include '../partial/Connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $jdg_name = $_POST['jdg_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("INSERT INTO judge (jdg_name, jdg_username, jdg_pass) VALUES (?, ?, ?)");
    
    if (!$stmt) {
        echo json_encode(['status' => 'error', 'message' => 'Statement preparation failed: ' . $conn->error]);
        exit();
    }

    $stmt->bind_param("sss", $jdg_name, $username, $password);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'New judge added successfully.']);
    } else {
        if ($conn->errno == 1062) {
            echo json_encode(['status' => 'error', 'message' => 'Error: Username already exists.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error: ' . $stmt->error]);
        }
    }

    $stmt->close();
    $conn->close();
    exit();
}
