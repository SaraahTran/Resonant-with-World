<?php
ob_start(); // To allow setting header when there's already page contents rendered

/** @var string $PAGE_ID Identify which page is loading the header, so the active menu item can be correctly recognised */
/** @var string $PAGE_HEADER The page title set in individual pages */
/** @var string $PAGE_USERNAME Username of the current logged in user */
/** @var string $PAGE_ALLOWGUEST If a page allows guest to visit */

?>


<html lang="en">
<head>
    <title>Resonant With World Menu</title>
    <!--CSS-->
    <link rel="stylesheet" type="text/css" href="../Styles/style.css"/>
    <!--Bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!--Fonts and Icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400;500;600;700;800&display=swap"
          rel="stylesheet">
</head>

<body>
<!--Side Bar-->
<div class="sidebar-container">
    <div class="sidebar-logo d-flex justify-content-center">
        <img class="logo " src="../Images/Logo.png"/>
        <br/>
        <h3 class="company-name">Resonant With World</h3>
    </div>

    <div class="hl"></div>


    <ul class="sidebar-navigation">

        <li>
            <a href="/index.php">
                <i class="bi bi-house-door-fill" aria-hidden="true"></i> Home
            </a>
        </li>

        <li>
            <a href="/Clients">
                <i class="bi bi-people-fill" aria-hidden="true"></i> Clients
            </a>
        </li>

        <li>
            <a href="/Products">
                <i class="bi bi-bag-fill" aria-hidden="true"></i> Products
            </a>
        </li>

        <li>
            <a href="/Multiple%20Products/index.php">
                <i class="bi bi-basket3-fill" aria-hidden="true"></i> Multiple Products
            </a>
        </li>


        <li>
            <a href="/Photoshoots">
                <i class="bi bi-camera-fill" aria-hidden="true"></i> Photoshoots
            </a>
        </li>

        <li>
            <a href="/Categories">
                <i class="bi bi-tags-fill" aria-hidden="true"></i> Categories
            </a>
        </li>

        <li>
            <a href="/Images">
                <i class="bi bi-image-fill" aria-hidden="true"></i> Images
            </a>
        </li>

        <li>
            <a href="/Documentation">
                <i class="bi bi-file-earmark-fill" aria-hidden="true"></i> Documentation
            </a>
        </li>
    </ul>
</div>

<!--Top Bar-->

<div class="content-container">
    <nav class="bg-white">

        <div class="navbar-brand d-flex justify-content-end">


            <a href="#" class="nav-link icon"> <i class="bi bi-envelope-fill"></i></a>
            <a href="#" class="nav-link icon"> <i class="bi bi-bell-fill"></i></a>

            <div class="vl"></div>

            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle topbar-text" data-toggle="dropdown"><i
                            class="bi bi-person-circle"></i>Anna Sola</a>
                <div class="dropdown-menu">
                    <a href="#" class="dropdown-item">Profile</a>
                    <a href="#" class="dropdown-item">Settings</a>
                    <div class="dropdown-divider"></div>
                    <a href="../login/logout.php" class="dropdown-item">Log Out</a>
                </div>
            </div>

        </div>
    </nav>

    <!--Start of Page-->
    <div class="container-fluid">


        <!-- Bootstrap JavaScript-->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

