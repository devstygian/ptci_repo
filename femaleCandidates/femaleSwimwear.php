<?php
include '../partial/Connection.php';
include '../judgeFunction/candidateFunction.php'; 

$sql = "SELECT candidateno, fullname, Course, Year FROM managecandidates WHERE gender = 'Female'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $candidates = [];
    while ($row = $result->fetch_assoc()) {
        $candidates[] = $row;
    }
} else {
    $candidates = [];
}
$conn->close();
?>

<h2 class="mt-5">Female Candidates - Swimwear</h2>
<form method="post" action="submitScore.php">
    <table class="table">
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
            <?php if (!empty($candidates)): ?>
                <?php foreach ($candidates as $candidate): ?>
                    <tr>
                        <td><?php echo $candidate['candidateno']; ?></td>
                        <td><?php echo $candidate['fullname']; ?></td>
                        <td><?php echo $candidate['Course']; ?></td>
                        <td><?php echo $candidate['Year']; ?></td>
                        <td>
                            <input type="number" 
                                   name="scores[<?php echo $candidate['candidateno']; ?>]" 
                                   min="1" 
                                   max="10" 
                                   step="0.1" 
                                   class="form-control" 
                                   style="width: 100px"
                                   placeholder="Score" 
                                   required>
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
    <button type="submit" class="btn btn-primary">Submit Scores</button>
</form>
