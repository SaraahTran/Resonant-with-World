<html>
<head>
    <title>Resonant With World Client </title>
    <!--CSS-->
    <link rel="stylesheet" type="text/css" href="Styles/style.css"/>
    <!--Bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!--Fonts and Icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400;700;800&display=swap" rel="stylesheet">
</head>


<body>


</table>

<?php include('./menu.php');?>

<h1>Clients</h1>
<div class="table-container">
<button class="add-button" onclick="window.location='addclient.php?id=">Add New Client</button>
<?php
$dbh = new PDO('mysql:host=localhost;dbname=fit2104_assignment2','fit2104','fit2104');
$stmt = $dbh->prepare("SELECT * FROM `Client`");
$stmt->execute();
?>

<div class="container table-responsive">
<table class="table table-bordered responsive">
    <thead class="align-self-baseline" >
    <tr>
        <th scope="col">ID</th>
        <th scope="col">First Name</th>
        <th scope="col">Surname</th>
        <th scope="col">Address</th>
        <th scope="col">Phone</th>
        <th scope="col">Email</th>
        <th scope="col">Subscribed?</th>
        <th scope="col">Other Information</th>
        <th scope="col">Actions</th>
    </tr>
    </thead>
    <?php while ($row = $stmt->fetchObject()):?>
<tbody>
    <tr>
        <td><?php echo $row->Client_ID; ?> </td>
        <td><?php echo $row->Client_FirstName; ?> </td>
        <td><?php echo $row->Client_Surname; ?> </td>
        <td><?php echo $row->Client_Address; ?> </td>
        <td><?php echo $row->Client_Phone; ?> </td>
        <td><?php echo $row->Client_Email; ?> </td>
        <td><?php echo $row->Client_Subscribed; ?> </td>
        <td><?php echo $row->Client_Other_Information; ?> </td>
        <td>
            <button class="action-button" onclick="window.location='updateclient.php?id=<?= $row->client_id ?>'">View</button>
            <button class="action-button"  onclick="window.location='updateclient.php?id=<?= $row->client_id ?>'">Update</button>
            <button class="action-button"  onclick="window.location='deleteclient.php?id=<?= $row->client_id ?>'">Delete</button>
        </td>
        <?php endwhile; ?>
    </tr>
</tbody>
</table></div></div>
</body>

</html>

