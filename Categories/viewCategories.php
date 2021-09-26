<html lang="en">
<head>
    <title>Resonant With World Category</title>
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
            <div class="card small-action-card">
                <h5 class="card-header">View Category</h5>
                <div class="card-body action-body">
                    <p class="card-text">
                    <div class="container">
                        <?php
                        if (!empty($_POST)) {
                            // Process to view record request (if a POST form is submitted)
                            $query = "SELECT * FROM `Category` WHERE `Category_ID`=?";
                            $stmt = $dbh->prepare($query);
                            if ($stmt->execute([$_GET['id']])) {
                            } else {
                                die();
                            }
                        } else {
                            // When no POST form is submitted, get the record from database
                            $query = "SELECT * FROM `Category` WHERE `Category_ID`=?";
                            $stmt = $dbh->prepare($query);
                            if ($stmt->execute([$_GET['id']])) {
                                if ($stmt->rowCount() > 0) {
                                    $record = $stmt->fetchObject(); ?>
                                    <form method="post">
                                        <div class="aligned-form">
                                            <div class="row">
                                                <label for="category_id">ID</label>
                                                <input type="number" id="category_id"
                                                       value="<?= $record->Category_ID ?>" disabled/>
                                            </div>
                                            <div class="row">
                                                <label for="firstname">Category Name</label>
                                                <input type="text" id="category_id"
                                                       value="<?= $record->Category_Name ?>" disabled/>
                                            </div>
                                            <br/>
                                            <div class="modal-footer">
                                                <button type="button" class="cancel-button"
                                                        onclick="window.location='/Categories';return false;">Back
                                                </button>
                                            </div>
                                    </form>

                                <?php } else {
                                    header("Location: Categories");
                                }
                            }
                        } ?></div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
