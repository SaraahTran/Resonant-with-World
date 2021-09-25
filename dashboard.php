<?php
$PAGE_ID = "dashboard";
$PAGE_HEADER = "Welcome";
$PAGE_ALLOWGUEST = true; // Homepage should allow guest to visit
?>

<html lang="en">

<head>
    <title>Resonant With World</title>
    <!--CSS-->
    <link rel="stylesheet" type="text/css" href="Styles/style.css"/>
    <!--Bootstrap-->
    <link rel="stylesheet" href="https://¬stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!--Fonts and Icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400;500;600;700;800&display=swap"
          rel="stylesheet">
</head>

<body>
<?php include('./Menu/menu.php'); ?>
<?php
include('./connection.php');
global $dbh;
?>
<div class="container">



    <h1>Welcome to Resonant With World</h1>
    <br>
    <p>Please select one of the features from sidebar to manage the business.</p>

</div>

<?php include('./Menu/footer.php'); ?>
</body>


</html>


