<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Candidate</title>
    <link rel="stylesheet" href="./src/bootstrap.min.css">
</head>
<body>

<?php
include 'edit_cndfnc.php';
?>

<div class="container mt-5">
    <h1>Edit Candidate</h1>
    <?php if ($error): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>
    <?php if ($success): ?>
        <div class="alert alert-success" role="alert">
            <?php echo htmlspecialchars($success); ?>
        </div>
    <?php endif; ?>

    <form action="edit_candidates.php?id=<?php echo htmlspecialchars($id); ?>" method="POST">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
        <div class="mb-3">
            <label for="candidateNo" class="form-label">Candidate No.</label>
            <input type="text" class="form-control" name="candidateno" value="<?php echo htmlspecialchars($candidateNo); ?>" required>
        </div>
        <div class="mb-3">
            <label for="fullName" class="form-label">Full Name</label>
            <input type="text" class="form-control" name="fullname" value="<?php echo htmlspecialchars($fullName); ?>" required>
        </div>
        <div class="mb-3">
            <label for="course" class="form-label">Course</label>
            <select class="form-select" name="course" required>
                <option value="" disabled>Select Course</option>
                <option value="1" <?php echo ($course == "1") ? 'selected' : ''; ?>>BSIT</option>
                <option value="2" <?php echo ($course == "2") ? 'selected' : ''; ?>>BSHM</option>
                <option value="3" <?php echo ($course == "3") ? 'selected' : ''; ?>>BSIS</option>
                <option value="4" <?php echo ($course == "4") ? 'selected' : ''; ?>>ACT</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="team" class="form-label">Team</label>
            <select class="form-select" name="team" required>
                <option value="" disabled>Select Team</option>
                <option value="1" <?php echo ($team == "1") ? 'selected' : ''; ?>>Team 1 - Orange Wolves</option>
                <option value="2" <?php echo ($team == "2") ? 'selected' : ''; ?>>Team 2 - Yellow Tigers</option>
                <option value="3" <?php echo ($team == "3") ? 'selected' : ''; ?>>Team 3 - Green Tamaraws</option>
                <option value="4" <?php echo ($team == "4") ? 'selected' : ''; ?>>Team 4 - Blue Eagles</option>
                <option value="5" <?php echo ($team == "5") ? 'selected' : ''; ?>>Team 5 - Red Phoenix</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="gender" class="form-label">Gender</label>
            <select class="form-select" name="gender" required>
                <option value="" disabled>Select gender</option>
                <option value="Male" <?php echo ($gender == "Male") ? 'selected' : ''; ?>>Male</option>
                <option value="Female" <?php echo ($gender == "Female") ? 'selected' : ''; ?>>Female</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Update Candidate</button>
    </form>

    <a href="add_candidates.php" class="btn btn-secondary mt-3">Back to Add Candidates</a>
</div>

<script src="./src/js/bootstrap.bundle.min.js"></script>
</body>
</html>
