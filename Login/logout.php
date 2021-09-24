<?php
session_start();
if (session_destroy()){
    $message = "You have logged out";
    echo "<script type='text/javascript'>alert('$message');</script>";
    header("Refresh:0.5; url=index.php");
}

exit();