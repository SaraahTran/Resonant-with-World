<html lang="en">
<head>
    <title>Resonant With World Photoshoot</title>
    <!--CSS-->
    <link rel="stylesheet" type="text/css" href="../Styles/style.css"/>
    <!--Bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!--Fonts and Icons-->
    <link rel="icon" type="image/png" href="../Images/Logo.png"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400;700;800&display=swap" rel="stylesheet">
</head>
<body>

<?php include('../Menu/menu.php'); ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card photoshoot-action-card">
                <h5 class="card-header">Delete Photshoots</h5>
                <div class="card-body action-body">
                    <p class="card-text">
                    <div class="container">
                        <div class="container">
                            <?php

                            global $dbh;
                            if (!empty($_POST)) {
                                // Process to delete record request (if a POST form is submitted)
                                $query = "DELETE FROM `Photo_Shoot` WHERE `Photo_Shoot_ID`=?";
                                $stmt = $dbh->prepare($query);
                                if ($stmt->execute([$_GET['id']])) {
                                    echo "Photoshoot #" . $_GET['id'] . " has been deleted. ";
                                    echo "<div class=\"center row\"><button class='justify-content-center back-button'  onclick=\"window.location='/Photoshoots'\">Back To Photoshoot </button></div>";
                                } else {
                                    echo friendlyError($stmt->errorInfo()[2]);
                                    echo "<div class=\"center row\"><button class='justify-content-center back-button'  onclick=\"window.history.back()\">Back to previous page</button></div>";
                                    die();
                                }
                            } else {
                                // When no POST form is submitted, get the record from database
                                $query = "SELECT * FROM `Photo_Shoot` WHERE `Photo_Shoot_ID`=?";
                                $stmt = $dbh->prepare($query);
                                if ($stmt->execute([$_GET['id']])) {
                                    if ($stmt->rowCount() > 0) {
                                        $record = $stmt->fetchObject(); ?>
                                        <form method="post">
                                            <div class="aligned-form">
                                                <div class="row">
                                                    <label for="photo_shoot_id">ID</label>
                                                    <input type="number" id="photo_shoot_id"
                                                           value="<?= $record->Photo_Shoot_ID ?>" disabled/>
                                                </div>
                                                <div class="row">
                                                    <label for="client_id">Client ID</label>
                                                    <input type="text" id="client_id" value="<?= $record->Client_ID ?>"
                                                           disabled/>
                                                </div>
                                                <div class="row">
                                                    <label for="photo_shoot_name">Photoshoot Name</label>
                                                    <input type="text" id="photo_shoot_name"
                                                           value="<?= $record->Photo_Shoot_Name ?>" disabled/>
                                                </div>
                                                <div class="row">
                                                    <label for="photo_shoot_description">Photoshoot Description</label>
                                                    <input type="text" id="photo_shoot_description"
                                                           value="<?= $record->Photo_Shoot_Description ?>" disabled/>
                                                </div>
                                                <div class="row">
                                                    <label for="photo_shoot_date_time">Photoshoot Date and Time</label>
                                                    <input type="text" id="photo_shoot_date_time"
                                                           value="<?= $record->Photo_Shoot_DateTime ?>" disabled/>
                                                </div>
                                                <div class="row">
                                                    <label for="photo_shoot_quote">Quote</label>
                                                    <input type="text" id="photo_shoot_quote"
                                                           value="<?= $record->Photo_Shoot_Quote ?>" disabled/>
                                                </div>
                                                <div class="row">
                                                    <label for="photo_shoot_other_information">Other Information</label>
                                                    <input type="text" id="photo_shoot_other_information"
                                                           value="<?= $record->Photo_Shoot_Other_Information ?>"
                                                           disabled/>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <input class="submit-button button-delete" type="submit" name="action"
                                                       id="delete-button" value="Delete"/>
                                                <button class="cancel-button" type="button"
                                                        onclick="window.location='/Photoshoots';return false;">Cancel
                                                </button>
                                            </div>
                                        </form>

                                    <?php } else {
                                        header("Location: Photoshoots");
                                    }
                                } else {
                                    die(friendlyError($stmt->errorInfo()[2]));
                                }
                            } ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('input.button-delete').click(function () {
        if (!confirm('Do you really want to delete this photoshoot?')) {
            return false;
        }
    });</script>
</body>
</html>

