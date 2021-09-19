<html>
<head>
    <title>Resonant With World Product</title>
    <!--CSS-->
    <link rel="stylesheet" type="text/css" href="../Styles/style.css"/>
    <!--Bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!--Fonts and Icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400;700;800&display=swap" rel="stylesheet">
</head>


</table>

<?php include('../Menu/menu.php');?>
<div class="container">

    <div class="row justify-content-center"><div class="col-8">
            <div class="card action-card">
                <h5 class="card-header">View Product</h5>
                <div class="card-body action-body">
                    <p class="card-text">
                    <div class="container">
                        <?php
                        $dbh = new PDO('mysql:host=localhost;dbname=fit2104_assignment2','fit2104','fit2104');
                        include('../connection.php');
                        if (!empty($_POST)) {
                            // Process to view record request (if a POST form is submitted)
                            $query = "SELECT * FROM `Product` WHERE `Product_ID`=?";
                            $stmt = $dbh->prepare($query);
                            if ($stmt->execute([$_GET['id']])) {
                            } else {
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
                                                <input type="number" id="product_id" value="<?= $record->Product_ID ?>" disabled/>
                                            </div>
                                            <div class="row">
                                                <label for="product_name">Product Name</label>
                                                <input type="text" id="product_name" value="<?= $record->Product_Name ?>" disabled/>
                                            </div>
                                            <div class="row">
                                                <label for="product_upc">Product UPC</label>
                                                <input type="text" id="product_upc" value="<?= $record->Product_UPC ?>" disabled/>
                                            </div>
                                            <div class="row">
                                                <label for="product_price">Product Price</label>
                                                <input type="text" id="product_price" value="<?= $record->Product_Price ?>" disabled/>
                                            </div>
                                            <div class="row">
                                                <label for="product_category">Product Category</label>
                                                <input type="text" id="product_category" value="<?= $record->Product_Category ?>" disabled/>
                                            </div>
                                            <br/>
                                            <div class="modal-footer">
                                                <button class="back-button" type="button" onclick="window.location='/Products';return false;">Back</button>
                                                </button>
                                            </div>
                                    </form>

                                <?php } else {
                                    header("Location: Products");
                                }
                            }
                        } ?></div></div></div></div></div></div>
</html>
