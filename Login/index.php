<?php
ob_start(); // To allow setting header when there's already page contents rendered
$PAGE_ID = "login";

// Database connection
require('../connection.php');

/** @var PDO $dbh Database connection */

// Process login request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['Username']) && !empty($_POST['Password'])) {
        //Run some SQL query here to find that user
        $stmt = $dbh->prepare("SELECT * FROM `user` WHERE `Username` = ? AND `Password` = ?");
        if ($stmt->execute([
                $_POST['Username'],
                hash('sha256', $_POST['Password'])
            ]) && $stmt->rowCount() == 1) {
            $row = $stmt->fetchObject();
            $_SESSION['user_id'] = $row->User_ID;
            //Successfully logged in, redirect user to referer, or index page
            if (empty($_SESSION['referer'])) {
                echo "hello";
            } else {
                echo "hello";
            }
        } else {
            echo "Your username and/or password is incorrect. Please try again!";
        }
        exit();
    } else {
        echo "Please enter both username and password to login!";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>

    <!--CSS-->
    <link rel="stylesheet" type="text/css" href="Styles/style.css"/>
    <!--Bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!--Fonts and Icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400;500;600;700;800&display=swap" rel="stylesheet">

</head>
<body class="login white-bg">

<div class="container">

    <!-- Outer Row -->
    <div class="mt-4 row justify-content-center">

        <div class="mt-5 col-sm">

            <div class="login-card  o-hidden border-0  my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                </div>
                                <img class="small-image" src="../Images/login-photos.svg">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-sm mt-5">

            <div class="login-card card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Please login</h1>
                                </div>
                                <form class="user" method="post">
                                    <div class="form-group">
                                        <input type="text"  id="loginUsername" name="username" aria-describedby="emailHelp" placeholder="Username">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" id="loginUserPassword" name="password" placeholder="Password">
                                    </div>
                                    <button type="submit" class="add-button">Login</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </div>


    </div>

</div>


</body>

</html>