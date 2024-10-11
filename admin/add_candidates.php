<?php
include '/xampp/htdocs/PTCI/partial/Connection.php'; 
include 'add_delete_cndfnc.php'; 

$candidates = [];
$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cand_no = $_POST['candidateno'] ?? '';
    $fullName = $_POST['fullname'] ?? '';
    $course = $_POST['course'] ?? '';
    $teamId = $_POST['team'] ?? '';
    $gender = $_POST['gender'] ?? '';

    if (isset($_POST['addCandidate'])) {
        $message = addCandidate($conn, $cand_no, $fullName, (int)$course, (int)$teamId, $gender);
    }

    if (isset($_POST['deleteCandidate'])) {
        $id = $_POST['id'] ?? '';
        $message = deleteCandidate($conn, $id);
    }
}

$candidates = fetchCandidates($conn);
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidate Management</title>
    <link rel="stylesheet" href="./src/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h1>Candidate Management</h1>
        
        <?php if ($message): ?>
            <div class="alert <?php echo strpos($message, 'Error') === false ? 'alert-success' : 'alert-danger'; ?>" role="alert">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <form action="add_candidates.php" method="POST">
            <div class="mb-3">
                <label for="candidateno" class="form-label">Candidate No.</label>
                <input type="text" class="form-control" name="candidateno" required>
            </div>
            <div class="mb-3">
                <label for="fullname" class="form-label">Full Name</label>
                <input type="text" class="form-control" name="fullname" required>
            </div>
            <div class="mb-3">
                <label for="course" class="form-label">Course</label>
                <select class="form-select" name="course" required>
                    <option value="" disabled selected>Select Course</option>
                    <option value="1">BSIT</option>
                    <option value="2">BSHM</option>
                    <option value="3">BSIS</option>
                    <option value="4">ACT</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="team" class="form-label">Team</label>
                <select class="form-select" name="team" required>
                    <option value="" disabled selected>Select Team</option>
                    <option value="1">Team 1 - Orange Wolves</option>
                    <option value="2">Team 2 - Yellow Tigers</option>
                    <option value="3">Team 3 - Green Tamaraws</option>
                    <option value="4">Team 4 - Blue Eagles</option>
                    <option value="5">Team 5 - Red Phoenix</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="gender" class="form-label">Gender</label>
                <select class="form-select" name="gender" required>
                    <option value="" disabled selected>Select gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <button type="submit" name="addCandidate" class="btn btn-primary">Add Candidate</button>
            <a href="admin.php" class="btn btn-secondary">Back to Admin</a>
        </form>

        <h2 class="mt-4">Candidates List</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Candidate No.</th>
                    <th>Full Name</th>
                    <th>Course</th>
                    <th>Team</th>
                    <th>Gender</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($candidates as $candidate): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($candidate['cand_no']); ?></td>
                        <td><?php echo htmlspecialchars($candidate['cand_fn']); ?></td>
                        <td><?php echo htmlspecialchars($candidate['cand_course']); ?></td>
                        <td><?php echo htmlspecialchars($candidate['cand_team']); ?></td>
                        <td><?php echo htmlspecialchars($candidate['cand_gender']); ?></td>
                        <td>
                            <a href="edit_candidates.php?id=<?php echo $candidate['cand_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <form action="add_candidates.php" method="POST" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo $candidate['cand_id']; ?>">
                                <button type="submit" name="deleteCandidate" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="./src/js/bootstrap.bundle.min.js"></script>
</body>
</html>
