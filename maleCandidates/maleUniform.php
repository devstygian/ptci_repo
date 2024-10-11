<?php
session_start();
include '../partial/Connection.php';
include '../judgeFunction/candidateFunction.php'; 

// Fetch only female candidates
$sql = "SELECT candidateno, fullname, Course, Year, team FROM managecandidates WHERE gender = 'Female'";
$result = $conn->query($sql);

$candidates = $result->num_rows > 0 ? $result->fetch_all(MYSQLI_ASSOC) : [];
$message = "";
$submittedScores = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['scores']) && is_array($_POST['scores'])) {
        foreach ($_POST['scores'] as $candidateNo => $score) {
            $submittedScores[$candidateNo] = $score;
        }
        $_SESSION['message'] = "Scores submitted successfully!";
    } else {
        $_SESSION['message'] = "No scores submitted.";
    }
}

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}

$conn->close();
?>

<h2 class="mt-5">Female Candidates - Uniform</h2>

<?php if (!empty($message)): ?>
    <div class="alert alert-success">
        <?php echo htmlspecialchars($message); ?>
    </div>
<?php endif; ?>

<form id="scoreForm" method="post" action="submitScore.php">
    <table class="table" id="candidatesTable">
        <thead>
            <tr>
                <th>Candidate No</th>
                <th>Full Name</th>
                <th>Course</th>
                <th>Team</th>
                <th>Score</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($candidates)): ?>
                <?php foreach ($candidates as $candidate): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($candidate['candidateno']); ?></td>
                        <td><?php echo htmlspecialchars($candidate['fullname']); ?></td>
                        <td><?php echo htmlspecialchars($candidate['Course']); ?></td>
                        <td><?php echo htmlspecialchars($candidate['team']); ?></td>
                        <td>
                            <select name="scores[<?php echo $candidate['candidateno']; ?>]" class="form-control" required>
                                <option value="" disabled selected>Select Score</option>
                                <?php for ($i = 1; $i <= 10; $i++): ?>
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                <?php endfor; ?>
                            </select>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">No female candidates found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmationModal">Submit Scores</button>
</form>

<div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmationModalLabel">Confirm Submission</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to submit the scores?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirmSubmit">Confirm</button>
            </div>
        </div>
    </div>
</div>

<h3 class="mt-4">Submitted Scores</h3>
<table class="table" id="submittedScoresTable">
    <thead>
        <tr>
            <th>Candidate No</th>
            <th>Full Name</th>
            <th>Course</th>
            <th>Year</th>
            <th>Score</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($submittedScores)): ?>
            <?php foreach ($submittedScores as $candidateNo => $score): ?>
                <?php 
                foreach ($candidates as $candidate) {
                    if ($candidate['candidateno'] == $candidateNo) {
                        $fullname = $candidate['fullname'];
                        $course = $candidate['Course'];
                        $year = $candidate['Year'];
                        break;
                    }
                }
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($candidateNo); ?></td>
                    <td><?php echo htmlspecialchars($fullname); ?></td>
                    <td><?php echo htmlspecialchars($course); ?></td>
                    <td><?php echo htmlspecialchars($year); ?></td>
                    <td><?php echo htmlspecialchars($score); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" class="text-center">No scores submitted yet.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<script>
    document.getElementById('confirmSubmit').onclick = function() {
        document.getElementById('scoreForm').submit();
    };
</script>

<script src="../src/js/bootstrap.min.js"></script>
