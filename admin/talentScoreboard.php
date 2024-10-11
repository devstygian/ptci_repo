<?php
session_start();
include '../partial/Connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['scores']) && is_array($_POST['scores'])) {
        foreach ($_POST['scores'] as $candidateNo => $score) {
            $stmt = $conn->prepare("SELECT fullname, course, team FROM managecandidates WHERE candidateno = ?");
            $stmt->bind_param("i", $candidateNo);
            $stmt->execute();
            $result = $stmt->get_result();
            $candidateDetails = $result->fetch_assoc();

            if ($candidateDetails) {
                $totalScore = ($score['mastery'] + $score['performance'] + $score['impression'] + $score['impact']) / 4;
                $totalScoreFormatted = number_format($totalScore, 2);
                
                $stmt = $conn->prepare("INSERT INTO talent (candidate_no, fullname, course, team, mastery, performance, impression, impact, total_score) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("isssiiiii", $candidateNo, $candidateDetails['fullname'], $candidateDetails['course'], $candidateDetails['team'], $score['mastery'], $score['performance'], $score['impression'], $score['impact'], $totalScoreFormatted);
                $stmt->execute();
            }
        }
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => 'No scores submitted.']);
    }
    $conn->close();
    exit(); // Stop further execution after handling POST
}

// Only show the scoreboard when not processing a POST request
?>

<div class="container mt-5">
    <h2>Scoreboard</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Candidate No</th>
                <th>Full Name</th>
                <th>Course</th>
                <th>Team</th>
                <th>Mastery</th>
                <th>Performance</th>
                <th>Impression</th>
                <th>Impact</th>
                <th>Total Score</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $stmt = $conn->prepare("SELECT * FROM talent ORDER BY total_score DESC");
            $stmt->execute();
            $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['candidate_no']}</td>
                    <td>{$row['fullname']}</td>
                    <td>{$row['course']}</td>
                    <td>{$row['team']}</td>
                    <td>{$row['mastery']}</td>
                    <td>{$row['performance']}</td>
                    <td>{$row['impression']}</td>
                    <td>{$row['impact']}</td>
                    <td>{$row['total_score']}</td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<script src="../src/js/bootstrap.bundle.min.js"></script>
