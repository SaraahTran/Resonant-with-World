<html>
<head>
    <title>Resonant With World Photoshoot</title>
    <link rel="stylesheet" type="text/css" href="styles/style.css" media=”screen” />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

<?php include('./menu.php');?>

<h1>Photoshoots</h1>
<button onclick="window.location='addphotoshoot.php?id=<?= $row->photo_shoot_id ?>'">Add New Photoshoot</button>

<?php
$dbh = new PDO('mysql:host=localhost;dbname=fit2104_assignment2','fit2104','fit2104');
$stmt = $dbh->prepare("SELECT * FROM `Photo_Shoot`");
$stmt->execute();
?>
<table border="1">

    <tr class ="rows">
        <th>ID</th>
        <th>Client ID</th>
        <th>Photoshoot Name</th>
        <th>Photoshoot Description</th>
        <th>Photoshoot Date and Time</th>
        <th>Photoshoot Quote</th>
        <th>Photoshoot Other Information</th>
        <th>Actions</th>

    </tr>
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
            <button onclick="window.location='viewphotoshoot.php?id=<?= $row->photo_shoot_id ?>'">View</button>
            <button onclick="window.location='updatephotoshoot.php?id=<?= $row->photo_shoot_id ?>'">Update</button>
            <button onclick="window.location='deletephotoshoot.php?id=<?= $row->photo_shoot_id ?>'">Delete</button>
        </td>
        <?php endwhile; ?>

</body>

</html>

