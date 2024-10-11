<?php
include '../partial/Connection.php';

$sql = "SELECT * FROM candidates";
$result = $conn->query($sql);
?>

<div class="container mt-5">
    <h1>View Candidates</h1>

    <?php if ($result->num_rows > 0): ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Candidate No.</th>
                    <th>Full Name</th>
                    <th>Course</th>
                    <th>Team</th>
                    <th>Gender</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['cand_no']); ?></td>
                        <td><?php echo htmlspecialchars($row['cand_fn']); ?></td>
                        <td><?php echo htmlspecialchars($row['cand_course']); ?></td>
                        <td><?php echo htmlspecialchars($row['cand_team']); ?></td>
                        <td><?php echo htmlspecialchars($row['cand_gender']); ?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No candidates found.</p>
    <?php endif; ?>

    <div class="text-end">
        <a href="admin.php" class="btn btn-primary">Back to Admin</a>
    </div>
</div>

<script src="../src/js/bootstrap.bundle.min.js"></script>

<?php
$conn->close();
?>
