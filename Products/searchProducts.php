<html lang="en">
<head>
    <title>Resonant With World Product</title>
    <!--CSS-->
    <link rel="stylesheet" type="text/css" href="../Styles/style.css"/>
    <!--Bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!--Fonts and Icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400;700;800&display=swap" rel="stylesheet">
</head>

<?php include('../Menu/menu.php'); ?>
<?php
include('../connection.php');
global $dbh;
$stmt = $dbh->prepare("SELECT * FROM `Product`");
$stmt->execute();
?>

<div class="container">

<form action="" method="get">
    <input class="search" type="text" name="search" placeholder="Search by Product UPC">
    <button class="search-button" type="submit" name="submit"><i class="bi bi-search"></i></button>
</form>

<?php
$search=$_GET['search'];
$sql="Select * from Product where Product_UPC like '%$search%'";
$res=$dbh->query($sql);

while($row=$res->fetch()){
    echo 'Product Name:  '.$row["Product_Name"].', ';
    echo 'Product UPC:  '.$row["Product_UPC"].'</br>';


}
?>

</div>