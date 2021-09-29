<html lang="en">
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
<body>
<?php
include('../Menu/menu.php');

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
    echo "<p class='message'>Please select at least one product to delete.</p>";

}

$title_stmt = $dbh->prepare("SELECT * FROM `Product`");
if ($title_stmt->execute() && $title_stmt->rowCount() > 0) { ?>
<div class="container">
    <h1>Product</h1>
    <div class="row">
        <div class="col-sm">
            <button class="back-full-button" onclick="window.location='/Products'"><i
                        class="bi bi-arrow-left-circle-fill"></i>Back to Full List
            </button>
        </div>
        <div class="col-sm">
            <form id="delete-selected-form" method="post">
                <button class="delete-selected-button2 delete-selected" type="submit" value="Delete selected products"/>
                <i class="bi bi-trash-fill"></i>Delete selected products

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
                    <input type="checkbox" class="to-be-deleted" name="Product_ID[]" value="<?php echo $row->Product_ID; ?>"/>
                </td>
                <td><?= $row->Product_ID ?></td>
                <td><?= $row->Product_Name ?></td>
                <td><?= $row->Product_UPC ?></td>
                <td><?= $row->Product_Price ?></td>
                <td><?= $row->Product_Category ?></td>

            </tr>
            <?php }
            } ?>
            </tbody>
        </table>
    </div>
</div>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['product_ids'])) {
    $query_placeholders = trim(str_repeat("?,", count($_POST['product_ids'])), ",");

    // Delete image files first
    $query = "SELECT * FROM `Product_Image` WHERE `Product_ID` in (" . $query_placeholders . ")";
    $stmt = $dbh->prepare($query);
    $stmt->execute($_POST['product_ids']);
    while ($image = $stmt->fetchObject()) {
        $fileFullPath = "product_images" . DIRECTORY_SEPARATOR . $image->Product_Image_File_name;
        unlink($fileFullPath);
    }

    // Then delete product images
    $query = "DELETE FROM `Product_Image` WHERE `Product_ID` in (" . $query_placeholders . ")";
    $stmt = $dbh->prepare($query);
    $stmt->execute($_POST['product_ids']);

    // Finally delete products
    $query = "DELETE FROM `Product` WHERE `Product_ID` in (" . $query_placeholders . ")";
    $stmt = $dbh->prepare($query);
    $stmt->execute($_POST['product_ids']);
}


?>


<?php include('../Menu/footer.php'); ?>
<script>
    $('button.delete-selected').click(function (e) {
        e.preventDefault();

        if ($('input.to-be-deleted:checked:enabled').length > 0) {
            if (confirm('Do you really want to delete selected product?')) {
                $('form#delete-selected-form').submit();
            }
        } else {
            alert("Please select at least one product to be deleted. ");
        }
    });
</script>


</body>

</html>
