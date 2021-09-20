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
<body>

<?php include('../Menu/menu.php'); ?>
<div class="container">

    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card product-action-card">
                <h5 class="card-header">Update Product</h5>
                <div class="card-body action-body">
                    <p class="card-text">

                    <div class="justify-content-center center">
                        <?php
                        include('../connection.php');
                        global $dbh;
                        if (!empty($_POST)) {
                            // Check if any of the POST fields are empty (which shouldn't be!)
                            foreach ($_POST as $fieldName => $fieldValue) {
                                if (empty($fieldValue)) {
                                    echo("'$fieldName' field is empty. Please fix the issue try again. ");
                                    echo "<div class=\"center row\"><button class='justify-content-center back-button'  onclick=\"window.location='/Products'\">Back to the product list</button></div>";
                                    die();
                                }
                            }
                            // Process the update record request (if a POST form is submitted)
                            $query = "UPDATE `Product` SET `Product_Name`=:productname, `Product_UPC`=:productupc, `Product_Price`=:productprice,`Product_Category`=:productcategory WHERE `Product_ID`=:id";
                            $stmt = $dbh->prepare($query);
                            $parameters = [
                                'productname' => $_POST['productname'],
                                'productupc' => $_POST['productupc'],
                                'productprice' => $_POST['productprice'],
                                'productcategory' => $_POST['productcategory'],
                                    'id' => $_GET['id']
                            ];
                            echo("The product information has been updated.");
                            echo "<div class=\"center row\"><button class='justify-content-center back-button'  onclick=\"window.location='/Products'\">Back to the product list</button></div>";
                            if ($stmt->execute($parameters)) {
                            } else {
                                echo friendlyError($stmt->errorInfo()[2]);
                                echo "<div class=\"center row\"><button onclick=\"window.history.back()\">Back to previous page</button></div>";
                                die();
                            }
                        } else {
                            // When no POST form is submitted, get the record from database
                            $query = "SELECT * FROM `Product` WHERE `Product_ID`=?";
                            $stmt = $dbh->prepare($query);
                            if ($stmt->execute([$_GET['id']])) {
                                if ($stmt->rowCount() > 0) {
                                    $record = $stmt->fetchObject(); ?>
                                    <form method="post">
                                        <div class="aligned-form">
                                            <div class="row">
                                                <label for="id">ID</label>
                                                <input type="number" id="id" value="<?= $record->Product_ID ?>"
                                                       disabled/>
                                            </div>
                                            <div class="row">
                                                <label for="productname">Product Name</label>
                                                <input type="text" id="productname" name="productname"
                                                       value="<?= $record->Product_Name ?>"/>
                                            </div>
                                            <div class="row">
                                                <label for="productupc">Product UPC</label>
                                                <input type="number" id="productupc" name="productupc"
                                                       value="<?= $record->Product_UPC ?>"/>
                                            </div>
                                            <div class="row">
                                                <label for="productprice">Product Price</label>
                                                <input type="text" id="productprice" name="productprice"
                                                       value="<?= $record->Product_Price ?>"/>
                                            </div>
                                            <div class="row">
                                                <label for="product_category">Product Category</label>
                                                <input type="text" id="productcategory" name="productcategory"
                                                       value="<?= $record->Product_Category ?>"/>
                                            </div>
                                            <br/>
                                            <div cldass="modal-footer">
                                                <input class="submit-button" type="submit" value="Update"/>
                                                <button class="cancel-button" type="button"
                                                        onclick="window.location='/Products';return false;">Cancel
                                                </button>
                                            </div>
                                    </form>

                                <?php }
                            } else {
                                die(friendlyError($stmt->errorInfo()[2]));
                                echo "<div class=\"center row\"><button class='justify-content-center back-button' onclick=\"window.history.back()\">Back to previous page</button></div>";
                            }
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>