<?php
session_start();

$db_host = "localhost";
$db_username = "fit2104";
$db_passwd = "fit2104";
$db_name = "fit2104_assignment2";
$dsn = "mysql:host=$db_host;dbname=$db_name";
$dbh = new PDO($dsn, $db_username, $db_passwd);


// Allow-guest option should have a default value of false (so only page set this value to true is allowed for guests)
$PAGE_ALLOWGUEST = isset($PAGE_ALLOWGUEST) ? $PAGE_ALLOWGUEST : false;

// We don't need to check if the user is logged in or not on login page
if (!isset($PAGE_ID) || $PAGE_ID !== 'login') {
    // Check if a user is logged in, and if the account in the session is valid
    if (!isset($_SESSION['user_id'])) {
        $_SESSION['referer'] = $_SERVER['PHP_SELF'];
        // User did not logged in, and visited a restricted page
        if (!$PAGE_ALLOWGUEST) {
            // Record the current page location
            // Redirect user to login page
            header("Location: /Login");
            exit();
        }
    } else {
        // User logged in already, check if the user is valid
        $user_stmt = $dbh->prepare("SELECT * FROM `User` WHERE `User_ID` = ?");
        if ($user_stmt->execute([$_SESSION['user_id']]) && $user_stmt->rowCount() == 1) {
            // Get user information so it can be displayed on the interface
            $user = $user_stmt->fetchObject();
            $PAGE_USERNAME = $user->Username;
        } else {
            //User is invalid in the system (deleted from the users table)
            session_destroy();
            header("Location: login.php?action=error&message=" . urlencode('It seems your account is being invalidated. Please contact administrator for more information.'));
            exit();
        }
    }
}
?>


