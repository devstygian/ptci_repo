<?php
session_start();
?>

<div class="container mt-5 d-flex align-items-center" style="min-height: 80vh;">
    <div class="row justify-content-center w-100">
        <div class="col-md-5">
            <h1 class="text-center mb-5">Add Judge Account</h1>

            <div id="message"></div>

            <form id="addJudgeForm" method="POST">
                <div class="mb-3">
                    <label for="jdg_name" class="form-label">Judge Name</label>
                    <input type="text" class="form-control" name="jdg_name" id="jdg_name" required>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" id="username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>
                <button type="submit" class="btn btn-primary">Add Judge</button>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#addJudgeForm').on('submit', function(event) {
        event.preventDefault();

        $.ajax({
            url: 'add_judge_function.php',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    $('#message').html('<div class="alert alert-success" role="alert">' + response.message + '</div>');
                    $('#addJudgeForm')[0].reset();
                } else {
                    $('#message').html('<div class="alert alert-danger" role="alert">' + response.message + '</div>');
                }
            },
            error: function() {
                $('#message').html('<div class="alert alert-danger">An error occurred. Please try again.</div>');
            }
        });
    });
});

</script>
