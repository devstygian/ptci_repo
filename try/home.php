<?php
include '../assets/data.php';
?>

<link rel="stylesheet" href="../css//home.css">
<div class="container mt-5">
    <h1 class="text-center mb-5">Candidates</h1>
    <div class="row">
        <?php
        foreach ($candidates as $candidate) {
            echo '<div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="' . $candidate['image'] . '" class="card-img-top" alt="' . htmlspecialchars($candidate['fullName']) . '">
                        <div class="card-body">
                            <h5 class="card-title">' . htmlspecialchars($candidate['fullName']) . '</h5>
                            <p class="card-text">Candidate No: ' . htmlspecialchars($candidate['candidateNo']) . '</p>
                            <p class="card-text">Course: ' . htmlspecialchars($candidate['course']) . '</p>
                            <p class="card-text">Year: ' . htmlspecialchars($candidate['year']) . '</p>
                        </div>
                    </div>
                  </div>'; }
        ?>
    </div>
</div>
