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
$dbh = new PDO('mysql:host=localhost;dbname=fit2104_assignment2','fit2104','fit2104');
$stmt = $dbh->prepare("SELECT * FROM `Category`");
$stmt->execute();
?>

<h1>Categories</h1>
<div class="table-container">
<button class="add-button" onclick="window.location='addcategory.php?">Add New Category</button>



<div class="container table-responsive">
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
            <button class="action-button"  onclick="window.location='viewcategories.php?id=<?= $row->category_id ?>'">View</button>
            <button class="action-button"  onclick="window.location='updatecategories.php?id=<?= $row->category_id ?>'">Update</button>
            <button class="action-button"  onclick="window.location='deletecategories.php?id=<?= $row->category_id ?>'">Delete</button>
        </td>
        <?php endwhile; ?>
    </tr></tbody></table></div></div>

</body>

</html>

