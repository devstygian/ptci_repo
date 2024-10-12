<?php
session_start();
include './partial/Connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $scores = $_POST['scores'];
    $responses = [];

    foreach ($scores as $cand_no => $score) {
        $mastery = intval($score['mastery']);
        $performance = intval($score['performance']);
        $impression = intval($score['impression']);
        $impact = intval($score['impact']);

        $total_score = ($mastery + $performance + $impression + $impact) * 0.1;

        $stmt = $conn->prepare("INSERT INTO talent (tal_mastery, tal_performance, tal_impression, tal_audience, tal_total_score) VALUES (?, ?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("iiiii", $mastery, $performance, $impression, $impact, $total_score);
            if ($stmt->execute()) {
                $responses[] = ["cand_no" => $cand_no, "success" => true];
            } else {
                $responses[] = ["cand_no" => $cand_no, "success" => false, "message" => $stmt->error];
            }
            $stmt->close();
        } else {
            $responses[] = ["cand_no" => $cand_no, "success" => false, "message" => $conn->error];
        }
    }

    if (empty($responses)) {
        echo json_encode(["success" => false, "message" => "No scores submitted."]);
    } else {
        echo json_encode(["success" => true, "details" => $responses]);
    }
}

$conn->close();
?>