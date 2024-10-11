<?php
include '../partial/Connection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Palawan Technological College Inc.</title>
    <link rel="stylesheet" href="../src/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/Dashboard.css">
    <style>
        #mainContent input {
            max-width: 500px;
        }
    </style>
</head>

<body>
    <nav class="navbar fixed-top">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">Palawan Technological College Inc.</span>
            <form class="d-flex" action="logout.php" method="post">
                <button class="btn" type="submit">Logout</button>
            </form>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="#" id="homeLink">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="addJudge.php" id="addJudgeLink">Add Judge</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="manageCandidatesDropdown" role="button" data-bs-toggle="collapse" data-bs-target="#manageCandidatesItems" aria-expanded="false">
                                Manage Candidates
                            </a>
                            <ul class="dropdown-menu" id="manageCandidatesItems">
                                <li><a class="dropdown-item" href="add_candidates.php" id="addCandidateLink">Add</a></li>
                                <li><a class="dropdown-item" href="#" id="viewAllCandidatesLink">View All</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" id="scoreboardLink">Talent Scoreboard</a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content" id="mainContent"></main>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="../src/js/bootstrap.bundle.min.js"></script>
    <script>
    $(document).ready(function() {
        $("#mainContent").load("home.php");

        $("#addJudgeLink").on("click", function(event) {
            event.preventDefault();
            $("#mainContent").load("add_judge.php");
        });

        $("#homeLink").on("click", function(event) {
            event.preventDefault();
            $("#mainContent").load("home.php");
        });

        $("#viewAllCandidatesLink").on("click", function(event) {
            event.preventDefault();
            $("#mainContent").load("view_candidates.php");
        });

        $("#scoreboardLink").on("click", function(event) {
            event.preventDefault();
            $("#mainContent").load("talent_scoreboard.php");
        });
    });
    </script>
</body>

</html>
