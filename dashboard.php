<?php
session_start();
if (!isset($_SESSION['userName'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Palawan Technological College Inc.</title>
    <link rel="stylesheet" href="./src/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css//Dashboard.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <nav class="navbar fixed-top">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">Palawan Technological College Inc.</span>
            <form class="d-flex" action="./judgeFunction/logout.php" method="post">
                <button class="btn" type="submit">Logout</button>
            </form>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column mt-2">
                        <li class="nav-item">
                            <a class="nav-link active" href="#" id="homeLink">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" id="rulesLink">Rules</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="mrPtcidDropdown" role="button" data-bs-toggle="collapse" data-bs-target="#mrPtcidItems" aria-expanded="false">
                                Male Candidates
                            </a>
                            <ul class="dropdown-menu" id="mrPtcidItems">
                                <li><a class="dropdown-item" href="#" id="maleTalentLink">Talent</a></li> 
                                <li><a class="dropdown-item" href="#" id="maleUniformLink">Uniform</a></li>
                                <li><a class="dropdown-item" href="#" id="maleSwimwearLink">Swimwear</a></li>
                                <li><a class="dropdown-item" href="#" id="maleFormalWalkLink">Formal Walk</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="msPtcidDropdown" role="button" data-bs-toggle="collapse" data-bs-target="#msPtcidItems" aria-expanded="false">
                                Female Candidates
                            </a>
                            <ul class="dropdown-menu" id="msPtcidItems">
                                <li><a class="dropdown-item" href="#" id="femaleTalentLink">Talent</a></li> 
                                <li><a class="dropdown-item" href="#" id="femaleUniformLink">Uniform</a></li>
                                <li><a class="dropdown-item" href="#" id="femaleSwimwearLink">Swimwear</a></li>
                                <li><a class="dropdown-item" href="#" id="femaleFormalWalkLink">Formal Walk</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content" id="mainContent">
            </main>
        </div>
    </div>

    <script src="./src/js/bootstrap.bundle.min.js"></script>
    <script src="./js/scripts.js"></script>
</body>
</html>
