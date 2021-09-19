<html>
<head>
    <title>Resonant With World Products</title>
    <!--CSS-->
    <link rel="stylesheet" type="text/css" href="../Styles/style.css"/>
    <!--Bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!--Fonts and Icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400;700;800&display=swap" rel="stylesheet">
</head>
<?php
include('../Menu/menu.php');
include("../connection.php");
/** @var PDO $dbh */
//Now we'll process the POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['Product_ID'])) {
    //Noticed that we're adding questions marks (parameters) to the query
    //To match number of selected items in POST request
    $query_placeholders = trim(str_repeat("?,", count($_POST['Product_ID'])), ",");
    $query = "DELETE FROM `Product` WHERE `Product_ID` in (" . $query_placeholders . ")";
    $stmt = $dbh->prepare($query);
    if ($stmt->execute($_POST['Product_ID'])) {
        echo "<p class='message'>Selected product have been deleted.</p>";
    } else {
        echo "<p class='message'>Error occurred while deleting product.</p>";
    }
} else {

}

$title_stmt = $dbh->prepare("SELECT * FROM `Product`");
if ($title_stmt->execute() && $title_stmt->rowCount() > 0) { ?>
<div class="container">
    <h1>Categories</h1>
    <div class="row"><div class="col-sm">
            <button class="add-button" onclick="window.location='/Products'"><i class="bi bi-arrow-left-circle-fill"></i>Back to Full List</button>
        </div>
        <div class="col-sm">
            <form method="post">
                <button class="delete-selected-button" type="submit" value="Delete selected products"/><i class="bi bi-trash-fill"></i>Delete selected products

        </div>

    </div>

    <div class="table-responsive">
        <table class="table table-bordered responsive">
            <thead>
            <tr>
                <th>Delete?</th>
                <th>ID</th>
                <th>Product Name</th>
                <th>Product UPC</th>
                <th>Product Price</th>
                <th>Product Category</th>

            </tr>
            </thead>
            <?php while ($row = $title_stmt->fetchObject()) { ?>
            <tbody>
            <tr>
                <td class="col-checkbox">
                    <input type="checkbox" name="Product_ID[]" value="<?php echo $row->Product_ID; ?>"/>
                </td>
                <td><?= $row->Product_ID ?></td>
                <td><?= $row->Product_Name ?></td>
                <td><?= $row->Product_UPC ?></td>
                <td><?= $row->Product_Price ?></td>
                <td><?= $row->Product_Category ?></td>

            </tr>
            <?php } }?>
            </tbody>
        </table></form>
    </div></div>
<?php include('../Menu/footer.php'); ?>    </div>
</body>
</div>

</html>
