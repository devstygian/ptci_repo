<?php
session_start();
include '../partial/Connection.php';
include '../judgeFunction/candidateFunction.php';

$candidates = getMaleCandidates($conn);
?>

<div class="container">
    <h2 class="mt-5">Male Candidates - Talent</h2>
    <div id="messageContainer"></div>
    <form id="scoreForm" method="post">
        <table class="table" id="candidatesTable">
            <thead>
                <tr>
                    <th>Candidate No</th>
                    <th>Full Name</th>
                    <th>Course</th>
                    <th>Team</th>
                    <th>Mastery</th>
                    <th>Performance/Choreography</th>
                    <th>Overall Impression</th>
                    <th>Audience Impact</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($candidates)): ?>
                    <?php foreach ($candidates as $candidate): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($candidate['cand_no']); ?></td>
                            <td><?php echo htmlspecialchars($candidate['cand_fn'] . ' ' . $candidate['cand_ln']); ?></td>
                            <td><?php echo htmlspecialchars($candidate['cand_course']); ?></td>
                            <td><?php echo htmlspecialchars($candidate['cand_team']); ?></td>
                            <td>
                                <select name="scores[<?php echo $candidate['cand_no']; ?>][mastery]" class="form-control" required>
                                    <option value="" disabled selected>Select Score</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                            </td>
                            <td>
                                <select name="scores[<?php echo $candidate['cand_no']; ?>][performance]" class="form-control" required>
                                    <option value="" disabled selected>Select Score</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                            </td>
                            <td>
                                <select name="scores[<?php echo $candidate['cand_no']; ?>][impression]" class="form-control" required>
                                    <option value="" disabled selected>Select Score</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                            </td>
                            <td>
                                <select name="scores[<?php echo $candidate['cand_no']; ?>][impact]" class="form-control" required>
                                    <option value="" disabled selected>Select Score</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center">No male candidates found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <button type="button" class="btn btn-primary" id="submitButton">Submit Scores</button>
    </form>

    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">Confirm Submission</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-center">Are you sure you want to submit the scores?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="confirmSubmit">Confirm</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#submitButton').on('click', function() {
                $('#confirmationModal').modal('show');
            });

            $('#confirmSubmit').on('click', function() {
                const formData = $('#scoreForm').serialize();
                $.ajax({
                    type: 'POST',
                    url: 'talentFunction.php',
                    data: formData,
                    success: function(response) {
                        try {
                            const result = JSON.parse(response);
                            if (result.success) {
                                $('#messageContainer').html('<div class="alert alert-success">Scores submitted successfully.</div>');
                            } else {
                                $('#messageContainer').html('<div class="alert alert-danger">Error: ' + result.message + '</div>');
                            }
                        } catch (e) {
                            console.error('Error parsing response:', e);
                            $('#messageContainer').html('<div class="alert alert-danger">Invalid response from server.</div>');
                        }
                        $('#confirmationModal').modal('hide');
                    },
                    error: function(jqXHR) {
                        console.error('AJAX Error:', jqXHR);
                        const errorMsg = jqXHR.responseJSON && jqXHR.responseJSON.message ? jqXHR.responseJSON.message : 'An unknown error occurred.';
                        $('#messageContainer').html('<div class="alert alert-danger">An error occurred while submitting the scores: ' + errorMsg + '</div>');
                    }
                });
            });
        });
    </script>
</div>
