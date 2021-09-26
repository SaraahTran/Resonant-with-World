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
                <h5 class="card-header">Update Category</h5>
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
                                    echo "<div class=\"center row\"><button class='justify-content-center back-button'  onclick=\"window.location='/Categories'\">Back to the category list</button></div>";
                                    die();
                                }
                            }
                            // Process the update record request (if a POST form is submitted)
                            $query = "UPDATE `Category` SET `Category_Name`=:category_name WHERE `Category_ID`=:id";
                            $stmt = $dbh->prepare($query);
                            $parameters = [
                                'category_name' => $_POST['category_name'],
                                'id' => $_GET['id']
                            ];
                            echo("'$fieldValue' has been updated.");
                            echo "<div class=\"center row\"><button class='justify-content-center back-button'  onclick=\"window.location='/Categories'\">Back to the category list</button></div>";
                            if ($stmt->execute($parameters)) {
                            } else {
                                echo friendlyError($stmt->errorInfo()[2]);
                                echo "<div class=\"center row\"><button onclick=\"window.history.back()\">Back to previous page</button></div>";
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
                                                <label for="category_name">Category Name</label>
                                                <input type="text" id="category_name" name="category_name"
                                                       value="<?= $record->Category_Name ?>"/>
                                            </div>
                                            <br/>
                                            <div class="modal-footer">
                                                <input class="submit-button" type="submit" value="Update"/>
                                                <button class="cancel-button" type="button"
                                                        onclick="window.location='/Categories';return false;">Cancel
                                                </button>
                                            </div>
                                    </form>

                                <?php }
                            } else {
                                die($stmt->errorInfo()[2]);
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