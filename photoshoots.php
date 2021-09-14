<html>
<head>
    <title>Resonant With World Photoshoot</title>
    <link rel="stylesheet" type="text/css" href="styles/style.css" media=”screen” />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

<?php include('./menu.php');?>

<h1>Photoshoots</h1>
<div class="table-container">
<button  class="add-button" onclick="window.location='addphotoshoot.php?id='">Add New Photoshoot</button>

<?php
include('./connection.php');
$dsn = "mysql:host=$db_host;dbname=$db_name";
$dbh = new PDO($dsn, $db_username, $db_passwd);
$stmt = $dbh->prepare("SELECT * FROM `Photo_Shoot`");
$stmt->execute();
?>
<div class="container table-responsive">
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
            <button class="action-button" onclick="window.location='viewphotoshoot.php?id=<?= $row->photo_shoot_id ?>'">View</button>
            <button class="action-button" onclick="window.location='updatephotoshoot.php?id=<?= $row->photo_shoot_id ?>'">Update</button>
            <button class="action-button" onclick="window.location='deletephotoshoot.php?id=<?= $row->photo_shoot_id ?>'">Delete</button>
        </td>
        <?php endwhile; ?>
    </tr></table></div></div>
</body>

</html>

