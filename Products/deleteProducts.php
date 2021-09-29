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
                <h5 class="card-header">Delete Product</h5>
                <div class="card-body action-body">
                    <p class="card-text">
                    <div class="container">
                        <?php

                        global $dbh;
                        if (!empty($_POST)) {
                            // Process to delete record request (if a POST form is submitted)
                            $query = "DELETE FROM `Product` WHERE `Product_ID`=?";
                            $stmt = $dbh->prepare($query);
                            if ($stmt->execute([$_GET['id']])) {
                                echo "Product #" . $_GET['id'] . " has been deleted. ";
                                echo "<div class=\"center row\"><button class='justify-content-center back-button'  onclick=\"window.location='/Products'\">Back To Products </button></div>";
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
                                                <label for="product_id">ID</label>
                                                <input type="number" id="product_id" value="<?= $record->Product_ID ?>"
                                                       disabled/>
                                            </div>
                                            <div class="row">
                                                <label for="productname">Product Name</label>
                                                <input type="text" id="productname" value="<?= $record->Product_Name ?>"
                                                       disabled/>
                                            </div>
                                            <div class="row">
                                                <label for="product_upc">Product UPC</label>
                                                <input type="number" id="product_upc"
                                                       value="<?= $record->Product_UPC ?>" disabled/>
                                            </div>
                                            <div class="row">
                                                <label for="productprice">Product Price</label>
                                                <input type="text" id="productprice"
                                                       value="<?= $record->Product_Price ?>" disabled/>
                                            </div>
                                            <div class="row">
                                                <label for="product_category">Product Category</label>
                                                <input type="text" id="product_category"
                                                       value="<?= $record->Product_Category ?>" disabled/>
                                            </div>
                                            <br/>

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


                                            // Fetch product images
                                            $product_images = [];
                                            $stmt = $dbh->prepare("SELECT * FROM `Product_Image` WHERE `Product_ID` = ?");
                                            $stmt->execute([$_GET['id']]);
                                            while ($image = $stmt->fetchObject()) {
                                                $product_images[] = $image;
                                            }

                                            $product_fetched = true;?>
                                            <label for="product_image">Product Image</label>

                                                <div class="row">
                                            <?php if (empty($product_images)): ?>
                                                <p>This product has no images</p>
                                            <?php else:
                                                foreach ($product_images as $image): ?>
                                                    <a href="product_images/<?= $image->Product_Image_File_name ?>" target="_blank"><img src="product_images/<?= $image->Product_Image_File_name ?>" width="200" height="200" class="rounded mb-1 product-image-thumbnail" alt="Product Image"></a>
                                                <?php endforeach;
                                            endif; ?>

                                                </div>
                                            </div>

                                            <br/>

                                            <br/>
                                            <div class="modal-footer">
                                                <input class="submit-button button-delete" type="submit" name="action"
                                                       id="delete-button" value="Delete"/>
                                                <button type="button" class="cancel-button"
                                                        onclick="window.location='/Products';return false;">Cancel
                                                </button>
                                            </div>
                                    </form>
                                <?php } else {
                                    header("Location: Products");
                                }
                            } else {
                                die(friendlyError($stmt->errorInfo()[2]));
                            }
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('input.button-delete').click(function () {
        if (!confirm('Do you really want to delete this product?')) {
            return false;
        }
    });</script>
</body>
</html>
