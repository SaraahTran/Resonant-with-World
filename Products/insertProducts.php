<?php
ob_start();

/** @var $dbh PDO */
/** @var $db_name string */
?>
<!doctype html>
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
<?php include('../Menu/menu.php'); ?>

<div class="container">

    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card client-action-card">
                <h5 class="card-header">Add New Products</h5>
                <div class="card-body action-body">
                    <p class="card-text">
                        <?php

                        global $dbh;
                        if (!empty($_POST)) {
                        // Check if any of the POST fields are empty (which shouldn't be!)
                        foreach ($_POST as $fieldName => $fieldValue) {
                            if (empty($fieldValue)) {
                                echo("'$fieldName' field is empty. Please fix the issue try again. ");
                                echo "<div class=\"center row\"><button class='justify-content-center back-button' onclick=\"window.history.back()\">Back to previous page</button></div>";
                                die();
                            }
                        }
                        // Process the update record request (if a POST form is submitted)
                        $query = "INSERT INTO `Product`(`Product_Name`, `Product_UPC`, `Product_Price`, `Product_Category`) 
VALUES (NULLIF('$_POST[product_name]', ''), 
        NULLIF('$_POST[product_upc]', ''), 
        NULLIF('$_POST[product_price]', ''), 
        NULLIF('$_POST[product_category]',''))";

                        $stmt = $dbh->prepare($query);
                        if ($stmt->execute())
                        {
                        $newRecordId = $dbh->lastInsertId();
                        // When no POST form is submitted, get the record from database
                        $query = "SELECT * FROM `Product` WHERE `Product_Name`=?";
                        $stmt = $dbh->prepare($query);
                        if ($stmt->execute([$newRecordId])) {
                        if ($stmt->rowCount() > 0) {
                        $record = $stmt->fetchObject(); ?>
                    <div class="center row">New Product has been added.</div>
                    <form method="post">
                        <div class="aligned-form">
                            <div class="row">
                                <label for="product_id">ID</label>
                                <input type="text" id="product_id" value="<?= $nextId ?>" disabled/>
                            </div>
                            <div class="row">
                                <label for="product_name">Product Name</label>
                                <input type="text" id="product_name" name="product_name"/>
                            </div>
                            <div class="row">
                                <label for="product_upc">Product UPC</label>
                                <input type="number" id="product_upc" name="product_upc"/>
                            </div>
                            <div class="row">
                                <label for="product_price">Product Price</label>
                                <input type="number" id="product_price" name="product_price"/>
                            </div>
                            <div class="row">
                                <label for="product_category">Product Category</label>
                                <input type="text" id="product_category" name="product_category"/>
                            </div>
                        </div>
                    </form>
                    <div class="center row">New product has been added.
                        <button class='justify-content-center back-button' onclick="window.location='/Products'">Back to
                            the client list
                        </button>
                    </div>
                    <?php } else {
                        echo "New product has been added.";
                        echo "<div class=\"center row\"><button class='justify-content-center back-button'  onclick=\"window.location='/Products'\">Back to the product list</button></div>";
                    }
                    } else {
                        header("Location: error.html");
                    }
                    } else {
                        header("Location: error.html");
                    }
                    } else {
                        $query = "SELECT `AUTO_INCREMENT` FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'fit2104_assignment2' AND TABLE_NAME='product'";
                        $stmt = $dbh->prepare($query);
                        $nextId = ($stmt->execute() || $stmt->rowCount() > 0) ? $stmt->fetchObject()->AUTO_INCREMENT : "Not available";
                        ?>
                        <form name="productForm" method="post" enctype="multipart/form-data" onSubmit="return validate()">
                            <div class="aligned-form">
                                <div class="row">
                                    <label for="product_id">ID</label>
                                    <input type="text" id="product_id" value="<?= $nextId ?>" disabled/>
                                </div>
                                <div class="row">
                                    <label for="product_name">Product Name</label>
                                    <input type="text" id="product_name" name="product_name" maxlength="64" required value="<?= empty($_POST['product_name']) ? "" : $_POST['product_name'] ?>"/>
                                </div>
                                <div class="row">
                                    <label for="product_upc">Product UPC</label>
                                    <input type="number" id="product_upc" name="product_upc" oninput="product_upc_checker(event)" maxlength="11"  required value="<?= empty($_POST['product_upc']) ? "" : $_POST['product_upc'] ?>"/>
                                </div>
                                <div class="row">
                                    <label for="product_price">Product Price</label>
                                    <input type="number" id="product_price" name="product_price" oninput="product_price_checker(event)" maxlength="6"  required value="<?= empty($_POST['product_price']) ? "" : $_POST['product_price'] ?>"/>
                                </div>

                                <div>
                                    <div class="row">
                                    <label for="product_category">Product Category</label>
                                        <?php $category_stmt = $dbh->prepare("SELECT * FROM `Category` ORDER BY `Category_ID`");
                                        if ($category_stmt->execute() && $category_stmt-> rowCount() > 0) { ?>
                                            <select name="product_category" id="product_category" required value="<?= empty($_POST['product_category']) ? "" : $_POST['product_category'] ?>">
                                                <option value="">Select the category</option>
                                                <?php while($row =$category_stmt->fetchObject()): ?>
                                                    <option value="<?= $row->Category_Name?>"  ? "Selected " : "" ?> <?= $row->Category_Name ?></option>
                                                <?php endwhile; ?>
                                            </select>
                                        <?php } ?>
                                    </div>


                                </div>


                            <br/>
                            <div class="modal-footer">
                                <input type="submit" class="submit-button" value="Add"
                                       onclick="submiBtnClick()";/>
                                <button type="button" class="cancel-button"
                                        onclick="window.location='/Products';return false;">Cancel
                                </button>
                            </div>
                        </form>
                    <?php } ?></div>
            </div>
        </div>
    </div>
</div>

<script>
    function submiBtnClick(){
        var formValid = document.forms["post-form"].checkValidity();
        return formValid;
    }

    // Validate with JS at the time of submission
    $('#productForm').on('submit', function () {
        let product_price = $('#product_price').val();
        if (isNaN(product_price) || product_price.length !== 4) {
            alert("The product price must be a price that is less than 4 digits long");
            return false; // prevent the form to be submitted
        }
    });

    // A callback function as event listener in input attribute (so we can do some validation)
        function product_price_checker(event) {
        if (isNaN(event.target.value) || event.target.value.length !== 4) {
        //Set the validation of the field as invalid with error message manually
        event.target.setCustomValidity("The product price must be a price that is 4 digits long");
    } else {
        //Set the field as valid once met the criterion manually
        event.target.setCustomValidity("");
    }

    }

    // Validate with JS at the time of submission
    $('#productForm').on('submit', function () {
        let product_upc = $('#product_upc').val();
        if (isNaN(product_upc) || product_upc.length !== 10) {
            alert("The product upc must be a number that is less than 10 digits long");
            return false; // prevent the form to be submitted
        }
    });

    // A callback function as event listener in input attribute (so we can do some validation)
    function product_upc_checker(event) {
        if (isNaN(event.target.value) || event.target.value.length !== 10) {
            //Set the validation of the field as invalid with error message manually
            event.target.setCustomValidity("The product upc must be a number that is 10 digits long");
        } else {
            //Set the field as valid once met the criterion manually
            event.target.setCustomValidity("");
        }

    }
</script>



</body>


</html>
