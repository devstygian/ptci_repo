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
                
                $stmt = $conn->prepare("INSERT INTO talent (tal_mastery, tal_performance, tal_impression, tal_audience, tal_total_score) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("iiids", $score['mastery'], $score['performance'], $score['impression'], $score['impact'], $totalScoreFormatted);
                $stmt->execute();
            }
        }
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['error' => 'No scores submitted.']);
    }
    $conn->close();
    exit();
}
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
                <th>Audience</th>
                <th>Total Score</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Fetching all entries from the talent table
            $stmt = $conn->prepare("SELECT * FROM talent");
            $stmt->execute();
            $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>" . ($row['tal_id'] ?? 'N/A') . "</td>
                    <td>" . ($candidateDetails['fullname'] ?? 'N/A') . "</td> <!-- Adjust as needed -->
                    <td>" . ($candidateDetails['course'] ?? 'N/A') . "</td> <!-- Adjust as needed -->
                    <td>" . ($candidateDetails['team'] ?? 'N/A') . "</td> <!-- Adjust as needed -->
                    <td>" . ($row['tal_mastery'] ?? 'N/A') . "</td>
                    <td>" . ($row['tal_performance'] ?? 'N/A') . "</td>
                    <td>" . ($row['tal_impression'] ?? 'N/A') . "</td>
                    <td>" . ($row['tal_audience'] ?? 'N/A') . "</td>
                    <td>" . ($row['tal_total_score'] ?? 'N/A') . "</td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<script src="../src/js/bootstrap.bundle.min.js"></script>
