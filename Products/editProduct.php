
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

<?php

/** @var PDO $dbh Database connection */
/** @var object $product Product details */
/** @var object $product_images Product images */

if (isset($_GET['id'])) {
    $stmt = $dbh->prepare("SELECT * FROM `Product` WHERE `Product_ID` = ?");
    if ($stmt->execute([$_GET['id']])) {
        if ($stmt->rowCount() == 1) {
            $product = $stmt->fetchObject();

            // Fetch product images
            $product_images = [];
            $stmt = $dbh->prepare("SELECT * FROM `Product_Image` WHERE `Product_ID` = ?");
            $stmt->execute([$_GET['id']]);
            while ($image = $stmt->fetchObject()) {
                $product_images[] = $image;
            }

            $product_fetched = true;
        }
    }
}

// Something goes wrong, send user back to product list page
if (!(isset($product_fetched) && $product_fetched)) {
    header("Location: Products");
    exit;
}

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

    if (!empty($_POST['product_name']) &&
        !empty($_POST['product_upc']) &&
        !empty($_POST['product_price']) &&
        !empty($_POST['product_category'])) {

        $serverSideErrors = [];
        $filenames = [];

        // As we'll need to do multiple queries, and need to check if all files are uploaded correctly
        // Better to do a transaction that allows us to revert if any error occurs
        $dbh->beginTransaction();

        // Update product details
        $query = "UPDATE `Product` SET `Product_Name`=:productname, `Product_Price`=:productprice,`Product_Category`=:productcategory WHERE `Product_ID`=:id";
        $stmt = $dbh->prepare($query);
        $parameters = [
            'productname' => $_POST['productname'],
            'productprice' => $_POST['productprice'],
            'productcategory' => $_POST['productcategory'],
            'id' => $_GET['id'],
        ];
        if ($stmt->execute($parameters)) {
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
                        $currentFileName = uniqid('product_' . $modifiedProductId . '_', true) . "." . pathinfo($filename, PATHINFO_EXTENSION);
                        if ($stmt->execute([$modifiedProductId, $currentFileName])) {
                            $filenames[$index] = $currentFileName;
                        } else {
                            $serverSideErrors[] = $stmt->errorInfo()[2];
                            break;
                        }
                    }
                }

                // Move images to its final place
                if (empty($serverSideErrors)) {
                    foreach ($_FILES['images']['tmp_name'] as $index => $tmp_name) {
                        if (!move_uploaded_file($tmp_name, "product_images" . DIRECTORY_SEPARATOR . $filenames[$index])) {
                            $serverSideErrors[] = "Failed to save image files to the filesystem.";
                            break;
                        }
                    }
                }
            }

            // Delete selected files from both database and filesystem
            if (empty($serverSideErrors)) {
                if (isset($_POST['delete_images']) && !empty($_POST['delete_images'])) {
                    $query_placeholders = trim(str_repeat("?,", count($_POST['delete_images'])), ",");
                    $query = "DELETE FROM `Product_Image` WHERE `Product_Image_ID` in (" . $query_placeholders . ")";
                    $stmt = $dbh->prepare($query);
                    if (!$stmt->execute($_POST['delete_images'])) {
                        $serverSideErrors[] = $stmt->errorInfo()[2];
                    }
                }
            }
            if (empty($serverSideErrors)) {
                $filenames = [];
                foreach ($product_images as $image) {
                    $filenames[$image->id] = $image->filename;
                }
                foreach ($_POST['delete_images'] as $delete_image_id) {
                    $fileFullPath = "product_images" . DIRECTORY_SEPARATOR . $filenames[$delete_image_id];
                    if (!unlink($fileFullPath)) {
                        $serverSideErrors[] = "File '" . $filenames[$delete_image_id] . "' cannot be deleted";
                        break;
                    }
                }
            }
        } else {
            $serverSideErrors[] = $stmt->errorInfo()[2];
        }

        if (empty($serverSideErrors)) {
            $dbh->commit();
            header("Location: viewProducts.php?id=" . $modifiedProductId);
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
<div class="container">

    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card product-action-card">
                <h5 class="card-header">Update Product</h5>
                <div class="card-body action-body">
                    <p class="card-text">

                    <div class="justify-content-center center">
                        <?php

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
                            $query = "UPDATE `Product` SET `Product_Name`=:productname, `Product_Price`=:productprice,`Product_Category`=:productcategory WHERE `Product_ID`=:id";
                            $stmt = $dbh->prepare($query);
                            $parameters = [
                                'productname' => $_POST['productname'],
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
                                    $record = $stmt->fetchObject();
                                    // Fetch product images
                                    $product_images = [];
                                    $stmt = $dbh->prepare("SELECT * FROM `Product_Image` WHERE `Product_ID` = ?");
                                    $stmt->execute([$_GET['id']]);
                                    while ($image = $stmt->fetchObject()) {
                                        $product_images[] = $image;
                                    }

                                    $product_fetched = true;
                                    ?>
                                    <form name="productForm" method="post" enctype="multipart/form-data" onSubmit="return validate()">
                                        <div class="aligned-form">
                                            <div class="row">
                                                <label for="id">ID</label>
                                                <input type="number" id="id" value="<?= $record->Product_ID ?>"
                                                       disabled/>
                                            </div>
                                            <div class="row">
                                                <label for="productname">Product Name</label>
                                                <input type="text" id="productname" name="productname" maxlength="64" required value="<?= empty($_POST['productname']) ? $record->Product_Name: $_POST['productname'] ?>">
                                            </div>
                                            <div class="row">
                                                <label for="productupc">Product UPC</label>
                                                <input type="number"
                                                       value="<?= $record->Product_UPC ?>" disabled/>
                                            </div>

                                            <div class="row">
                                                <label for="product_price">Product Price</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">$</span>
                                                    </div>
                                                    <input type="number" class="form-control" id="productprice" name="productprice" required step=".01" max="9999.99" min="0" value="<?= empty($_POST['Product_Price']) ? $record->Product_Price : $_POST['Product_Price'] ?>"">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <label for="product_category">Product Category</label>
                                                <input type="text" id="productcategory" name="productcategory"
                                                       value="<?= $record->Product_Category ?>"/>
                                            </div>

                                            <div class="row">
                                                <label for="productSalePrice">Product Images</label>
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="productProductImages" aria-describedby="productProductImagesFeedback" name="images[]" multiple>
                                                    <label class="custom-file-label" for="customFile">Add more images to this product</label>
                                                    <div id="productProductImagesFeedback" class="invalid-feedback" id="productProductImagesFeedback">File error</div>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <?php if (empty($product_images)): ?>
                                                        <p>This product has no images</p>
                                                    <?php else: ?>
                                                        <p>Tick the box in front of each image to delete that image</p>
                                                        <?php foreach ($product_images as $image): ?>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="checkbox" id="productProductImageDelete-<?= $image->Product_Image_ID ?>" name="delete_images[]" value="<?= $image->Product_Image_ID ?>" <?= (isset($_POST['delete_images']) && in_array($image->Product_Image_ID, $_POST['delete_images'])?"checked":"") ?>>
                                                                <label class="form-check-label" for="productProductImageDelete-<?= $image->Product_Image_ID ?>"><img src="product_images/<?= $image->Product_Image_File_name ?>" width="200" height="200" class="rounded mb-1 product-image-thumbnail" alt="Product Image"></label>
                                                            </div>
                                                        <?php endforeach;
                                                    endif; ?>
                                                </div>
                                            </div>

                                            <br/>
                                            <div class="modal-footer">
                                                <input class="submit-button" type="submit" value="Update"
                                                       onclick="submiBtnClick()";/>
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

<script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.js"></script>
<script>
    $(document).ready(function () {
        bsCustomFileInput.init()
    })
</script>
</body>
</html>