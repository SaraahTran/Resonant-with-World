<?php

require('../Menu/connection.php');


if (session_destroy()){
    echo "<script type='text/javascript'>alert('You have logged out');</script>";
    header("Refresh:0.5; url=login");
}

exit();