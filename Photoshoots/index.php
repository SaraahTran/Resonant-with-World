<html>
<head>
    <title>Resonant With World Photshoot </title>
    <!--CSS-->
    <link rel="stylesheet" type="text/css" href="../Styles/style.css"/>
    <!--Bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!--Fonts and Icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400;700;800&display=swap" rel="stylesheet">
</head>

<body>

<?php include('../Menu/menu.php');?>
<div class="container">
<h1>Photoshoots</h1>

<button  class="add-button" onclick="window.location='./Photoshoots/insertPhotoshoots.php'">Add New Photoshoot</button>

<?php
include('../connection.php');
$dsn = "mysql:host=$db_host;dbname=$db_name";
$dbh = new PDO($dsn, $db_username, $db_passwd);
$stmt = $dbh->prepare("SELECT * FROM `Photo_Shoot`");
$stmt->execute();
?>
<div class="table-responsive">
    <table class="table table-bordered responsive">
        <thead>

    <tr >
        <th scope="col">ID</th>
        <th scope="col">Client ID</th>
        <th scope="col">Photoshoot Name</th>
        <th scope="col">Photoshoot Description</th>
        <th scope="col">Photoshoot Date and Time</th>
        <th scope="col">Photoshoot Quote</th>
        <th scope="col">Photoshoot Other Information</th>
        <th scope="col">Actions</th>

    </tr></thead>
    <?php while ($row = $stmt->fetchObject()):?>

    <tr class = "rows">
        <td><?php echo $row->Photo_Shoot_ID; ?> </td>
        <td><?php echo $row->Client_ID; ?> </td>
        <td><?php echo $row->Photo_Shoot_Name; ?> </td>
        <td><?php echo $row->Photo_Shoot_Description; ?> </td>
        <td><?php echo $row->Photo_Shoot_DateTime; ?> </td>
        <td><?php echo $row->Photo_Shoot_Quote; ?> </td>
        <td><?php echo $row->Photo_Shoot_Other_Information; ?> </td>
        <td>
            <button class="action-button" onclick="window.location='Photoshoots/viewPhotoshoots.php?id=<?= $row->Photo_Shoot_ID ?>'">View</button>
            <button class="action-button" onclick="window.location='Photoshoots/updatePhotoshoots.php?id=<?= $row->Photo_Shoot_ID ?>'">Update</button>
            <button class="action-button" onclick="window.location='Photoshoots/deletePhotoshoots.php?id=<?= $row->Photo_Shoot_ID ?>'">Delete</button>
        </td>
        <?php endwhile; ?>
    </tr></table></div></div>
<?php include('../Menu/footer.php'); ?>
</body>

</html>

