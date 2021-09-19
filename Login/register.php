<?php ob_start();
session_start();
include("connection.php");
/** @var PDO $dbh */ ?>
<html lang="en_AU">
<head>
    <title>User Register</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body class="authentication">
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['fullname'])) {
        //Run some SQL query here to find that user
        $stmt = $dbh->prepare("INSERT INTO `users`(`email`, `username`, `password`) VALUES (:email, :username, SHA2(:password, 0))");
        if ($stmt->execute([
            'fullname' => $_POST['fullname'],
            'username' => $_POST['username'],
            'password' => $_POST['password']  //Or you can hash the password in PHP: hash('sha256', $_POST['password']) - don't hash the password TWICE!
        ])) {
            //Successfully registered, redirect user to login
            header("Location: login.php");
        } else {
            echo "<h1>Cannot register!</h1><div>Error message: " . $stmt->errorInfo()[2] . "</div>";
        }
    }
} else {
    if (isset($_SESSION['user_id'])) {
        $user_stmt = $dbh->prepare("SELECT * FROM `user` WHERE `id` = ?");
        if ($user_stmt->execute([$_SESSION['user_id']]) && $user_stmt->rowCount() == 1) {
            //User already logged in, redirect user to dashboard
            header("Location: ../index.php");
        } else {
            session_destroy();
            header("Location: login.php");
        }
    }
}
?>
<h1>Please Register</h1>
<form method="post">
    <label for="username">Username</label>
    <input type="text" id="username" name="username"/>
    <br>
    <label for="password">Password</label>
    <input type="password" id="password" name="password"/>
    <br>
    <label for="email">Email</label>
    <input type="text" id="email" name="email"/>
    <br>
    <input type="submit" value="Register"/>
</form>
<form>
    <input type="submit" formmethod="get" formaction="login.php" value="Login"/>
</form>
</body>
</html>