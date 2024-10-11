<?php
include '/xampp/htdocs/PTCI/partial/Connection.php';

$id = "";
$candidateNo = "";
$fullName = "";
$course = "";
$team = "";
$gender = "";

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == 'GET') {
    if (!isset($_GET['id'])) {
        header("location:index.php");
        exit;
    }
    $id = $_GET['id'];
    $sql = "SELECT * FROM candidates WHERE cand_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if (!$row) {
        header("location:index.php");
        exit;
    }

    $candidateNo = $row['cand_no'];
    $fullName = $row['cand_fn'];
    $course = $row['cand_course'];
    $team = $row['cand_team'];
    $gender = $row['cand_gender'];
} else {
    $id = $_POST['id'];
    $candidateNo = $_POST['candidateno'];
    $fullName = $_POST['fullname'];
    $course = $_POST['course'];
    $team = $_POST['team'];
    $gender = $_POST['gender'];

    $sql = "UPDATE candidates SET cand_no = ?, cand_fn = ?, cand_course = ?, cand_team = ?, cand_gender = ? WHERE cand_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssiisi", $candidateNo, $fullName, $course, $team, $gender, $id);

    if ($stmt->execute()) {
        $success = "Candidate updated successfully!";
    } else {
        $error = "Error updating candidate: " . $stmt->error;
    }
}

$conn->close();
?>
