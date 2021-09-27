<?php
ob_start();

/** @var $dbh PDO */
/** @var $db_name string */
?>

<?php


/** @var PDO $dbh Database connection */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // PHP $_FILES error readable references
    $phpFileUploadErrors = array(
        0 => 'There is no error, the file uploaded with success',
        1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
        2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
        3 => 'The uploaded file was only partially uploaded',
        4 => 'No file was uploaded',
        6 => 'Missing a temporary folder',
        7 => 'Failed to write file to disk.',
        8 => 'A PHP extension stopped the file upload.',
    );

    // Allowed MIME types
    $allowedMIME = array(
        'image/jpeg',
        'image/png',
        'image/gif'
    );

    $insertedProductId = 0;

    if (!empty($_POST['Product_Name']) &&
        !empty($_POST['Product_UPC']) &&
        !empty($_POST['Product_Price']) &&
        !empty($_POST['Product_Category'])) {

        $serverSideErrors = [];
        $filenames = [];

        // As we'll need to do multiple queries, and need to check if all files are uploaded correctly
        // Better to do a transaction that allows us to revert if any error occurs
        $dbh->beginTransaction();

        // Insert product
        $query = "INSERT INTO `Products`(`Product_Name`, `Product_UPC`, `Product_Price`,`Product_Category`) VALUES (?, ?, ?, ?, ?)";
        $stmt = $dbh->prepare($query);
        $parameters = [
            $_POST['Product_Name'],
            $_POST['Product_UPC'],
            $_POST['Product_Price'],
            $_POST['Product_Category']
        ];
        if ($stmt->execute($parameters)) {
            $insertedProductId = $dbh->lastInsertId();

            // NOTE: file size validation in this demo code is only implemented in Javascript - see /js/scripts.js file for details

            // If no file is uploaded, then no need to process uploaded files
            if (!(isset($_FILES['images']['error'][0]) && $_FILES['images']['error'][0] == 4)) {
                // Check if any of the files has error during upload
                foreach ($_FILES['images']['error'] as $index => $error) {
                    if ($error != 0) {
                        $serverSideErrors[] = "File '" . $_FILES['images']['name'][$index] . "' did not upload because: " . $phpFileUploadErrors[$error];
                        break;
                    }
                }

                // Check if any of the files is in wrong MIME type
                foreach ($_FILES['images']['type'] as $index => $type) {
                    if (!empty($type) && !in_array($type, $allowedMIME)) {
                        $serverSideErrors[] = "The type of file '" . $_FILES['images']['name'][$index] . "' (" . $type . ") is not allowed";
                        break;
                    }
                }

                // Insert new product images to product_images table
                if (empty($serverSideErrors)) {
                    foreach ($_FILES['images']['name'] as $index => $filename) {
                        $query = "INSERT INTO `Product_Image`(`Product_ID`, `Product_Image_File_name`) VALUES (?, ?)";
                        $stmt = $dbh->prepare($query);
                        $currentFileName = uniqid('product_' . $insertedProductId . '_', true) . "." . pathinfo($filename, PATHINFO_EXTENSION);
                        if ($stmt->execute([$insertedProductId, $currentFileName])) {
                            $filenames[$index] = $currentFileName;
                        } else {
                            $serverSideErrors[] = $stmt->errorInfo()[2];
                            break;
                        }
                    }
                }

                // Finally, move images to its final place
                if (empty($serverSideErrors)) {
                    foreach ($_FILES['images']['tmp_name'] as $index => $tmp_name) {
                        if (!move_uploaded_file($tmp_name, "product_images" . DIRECTORY_SEPARATOR . $filenames[$index])) {
                            $serverSideErrors[] = "Failed to save image files to the filesystem.";
                            break;
                        }
                    }
                }
            }
        } else {
            $serverSideErrors[] = $stmt->errorInfo()[2];
        }

        if (empty($serverSideErrors)) {
            $dbh->commit();
            header("Location: products_detail.php?id=" . $insertedProductId);
            exit();
        } else {
            $dbh->rollBack();
            $ERROR = implode("</li><li>", $serverSideErrors);
        }

    } else {
        $ERROR = "The request is invalid. This may be due to the uploaded files are too large to process.";
    }

}
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
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="number" id="product_price" name="product_price" class="form-control" aria-label="Amount (to the nearest dollar)"  oninput="product_price_checker(event)" pattern="[0-9]+(\\.[0-9][0-9]?)?" required value="<?= empty($_POST['product_price']) ? "" : $_POST['product_price'] ?>">
                                    </div>

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

                                    <div class="row">
                                        <label for="productSalePrice">Product Images</label>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="productProductImages"
                                                   aria-describedby="productProductImagesFeedback" name="images[]" multiple>
                                            <label class="custom-file-label" for="customFile">Choose one or more image
                                                files</label>
                                            <div id="productProductImagesFeedback" class="invalid-feedback"
                                                 id="productProductImagesFeedback">File error</div>
                                        </div>
                                    </div>
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
        if (isNaN(product_price) || product_price.length > 4) {
            alert("The product price must be a price that is less than 4 digits long");
            return false; // prevent the form to be submitted
        }
    });

    // A callback function as event listener in input attribute (so we can do some validation)
        function product_price_checker(event) {
        if (isNaN(event.target.value) || event.target.value.length > 4) {
        //Set the validation of the field as invalid with error message manually
        event.target.setCustomValidity("The product price must be a price that is less than 4 digits long");
    } else {
        //Set the field as valid once met the criterion manually
        event.target.setCustomValidity("");
    }

    }

    // Validate with JS at the time of submission
    $('#productForm').on('submit', function () {
        let product_upc = $('#product_upc').val();
        if (isNaN(product_upc) || product_upc.length !== 10) {
            alert("The product upc must be a number that is than 10 digits long");
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



<script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
<script>
    $(document).ready(function () {
        bsCustomFileInput.init()
    })
</script>


</body>


</html>
