<html>
<head>
    <title>Resonant With World Category</title>
    <!--CSS-->
    <link rel="stylesheet" type="text/css" href="Styles/style.css"/>
    <!--Bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!--Fonts and Icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400;700;800&display=swap" rel="stylesheet">
</head>

<body>
<?php include('./menu.php');?>
<?php
include('./connection.php');
$dsn = "mysql:host=$db_host;dbname=$db_name";
$dbh = new PDO($dsn, $db_username, $db_passwd);
$stmt = $dbh->prepare("SELECT * FROM `Category`");
$stmt->execute();
?>
<div class="container">
<h1>Categories</h1>

<button class="add-button" onclick="window.location='addcategory.php?">Add New Category</button>



<div class="table-responsive">
    <table class="table table-bordered responsive">
        <thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Category Name</th>
        <th scope="col">Actions</th>

    </tr>
        </thead>
    <?php while ($row = $stmt->fetchObject()):?>
        <tbody>
    <tr>
        <td><?php echo $row->Category_ID; ?> </td>
        <td><?php echo $row->Category_Name; ?> </td>
        <td>
            <button class="action-button"  onclick="window.location='viewCategories.php?id=<?= $row->Category_ID ?>'">View</button>
            <button class="action-button"  onclick="window.location='updateCategories.php?id=<?= $row->Category_ID ?>'">Update</button>
            <button class="action-button"  onclick="window.location='deleteCategories.php?id=<?= $row->Category_ID ?>'">Delete</button>
        </td>
        <?php endwhile; ?>
    </tr></tbody></table></div></div>

</body>

</html>

