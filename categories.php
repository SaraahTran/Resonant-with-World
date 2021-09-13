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


<h1>Categories</h1>
<button onclick="window.location='addcategory.php?id=<?= $row->category_id ?>'">Add New Category</button>

<?php
$dbh = new PDO('mysql:host=localhost;dbname=fit2104_assignment2','fit2104','fit2104');
$stmt = $dbh->prepare("SELECT * FROM `Category`");
$stmt->execute();
?>
<table border="1">

    <tr class ="rows">
        <th>ID</th>
        <th>Category Name</th>
        <th>Actions</th>

    </tr>
    <?php while ($row = $stmt->fetchObject()):?>

    <tr class = "rows">
        <td><?php echo $row->Category_ID; ?> </td>
        <td><?php echo $row->Category_Name; ?> </td>
        <td>
            <button onclick="window.location='viewcategories.php?id=<?= $row->category_id ?>'">View</button>
            <button onclick="window.location='updatecategories.php?id=<?= $row->category_id ?>'">Update</button>
            <button onclick="window.location='deletecategories.php?id=<?= $row->category_id ?>'">Delete</button>
        </td>
        <?php endwhile; ?>

</body>

</html>

