<html lang="en">
<head>
    <title>Resonant With World Category</title>
    <!--CSS-->
    <link rel="stylesheet" type="text/css" href="../Styles/style.css"/>
    <!--Bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!--Fonts and Icons-->
    <link rel="icon" type="image/png" href="../Images/Logo.png"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400;700;800&display=swap" rel="stylesheet">
</head>

<?php include('../Menu/menu.php');?>
<div class="container">

    <div class="row justify-content-center"><div class="col-8">
            <div class="card small-action-card">
                <h5 class="card-header">Delete Category</h5>
                <div class="card-body action-body">
                    <p class="card-text">
<div class="container">
    <?php

    global $dbh;
    if (!empty($_POST)) {
        // Process to delete record request (if a POST form is submitted)
        $query = "DELETE FROM `Category` WHERE `Category_ID`=?";
        $stmt = $dbh->prepare($query);
        if ($stmt->execute([$_GET['id']])) {
            echo "Category #" . $_GET['id'] . " has been deleted. ";
            echo "<div class=\"center row\"><button class='justify-content-center back-button'  onclick=\"window.location='/Categories'\">Back To Category </button></div>";
        } else {
            echo friendlyError($stmt->errorInfo()[2]);
            echo "<div class=\"center row\"><button class='justify-content-center back-button'  onclick=\"window.history.back()\">Back to previous page</button></div>";
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
                            <input type="number" id="category_id" value="<?= $record->Category_ID ?>" disabled/>
                        </div>
                        <div class="row">
                            <label for="firstname">Category Name</label>
                            <input type="text" id="category_id" value="<?= $record->Category_Name ?>" disabled/>
                        </div>
                        <br/>
                        <div class="modal-footer">
                                <input class="submit-button button-delete" type="submit" name="action" id="delete-button" value="Delete"/>
                            <button type="button" class="cancel-button"
                                    onclick="window.location='/Categories';return false;">Cancel
                            </button>
                        </div>
                </form>

            <?php } else {
                header("Location: Categories");
            }
        } else {
            die(friendlyError($stmt->errorInfo()[2]));
        }
    } ?></div></div></div></div></div></div>

<script>
    $('input.button-delete').click(function () {
        if (!confirm('Do you really want to delete this category?')) {
            return false;
        }
    });</script>

</html>
