<html lang="en">
<head>
    <title>Resonant With World Photoshoot</title>
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
            <div class="card photoshoot-action-card">
                <h5 class="card-header">Update Photoshoot</h5>
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
                                    echo "<div class=\"center row\"><button class='justify-content-center back-button'  onclick=\"window.location='/Photoshoots'\">Back to the photoshoot list</button></div>";
                                    die();
                                }
                            }
                            // Process the update record request (if a POST form is submitted)
                            $query = "UPDATE `Photo_Shoot` SET `Photo_Shoot_Name`=:name, `Photo_Shoot_Description`=:description, `Photo_Shoot_DateTime`=:date, `Photo_Shoot_Quote`=:quote, `Photo_Shoot_Other_Information`=:otherInformation WHERE `Photo_Shoot_ID`=:id";
                            $stmt = $dbh->prepare($query);
                            $parameters = [
                                'name' => $_POST['name'],
                                'description' => $_POST['description'],
                                'date' => $_POST['date'],
                                'quote' => $_POST['quote'],
                                'otherInformation' => $_POST['otherInformation'],
                                'id' => $_GET['id']
                            ];
                            echo("Photoshoot information has been updated.");
                            echo "<div class=\"center row\"><button class='justify-content-center back-button'  onclick=\"window.location='/Photoshoots'\">Back to the photoshoot list</button></div>";
                            if ($stmt->execute($parameters)) {
                            } else {
                                echo friendlyError($stmt->errorInfo()[2]);
                                echo "<div class=\"center row\"><button onclick=\"window.history.back()\">Back to previous page</button></div>";
                                die();
                            }
                        } else {
                            // When no POST form is submitted, get the record from database
                            $query = "SELECT * FROM `Photo_Shoot` WHERE `Photo_Shoot_id`=?";
                            $stmt = $dbh->prepare($query);
                            if ($stmt->execute([$_GET['id']])) {
                                if ($stmt->rowCount() > 0) {
                                    $record = $stmt->fetchObject(); ?>
                                    <form name="photoshootForm" method="post" enctype="multipart/form-data" onSubmit="return validate()">
                                        <div class="aligned-form">
                                            <div class="row">
                                                <label for="photo_shoot_id">ID</label>
                                                <input type="number" id="photo_shoot_id"
                                                       value="<?= $record->Photo_Shoot_ID ?>" disabled/>
                                            </div>
                                            <div class="row">
                                                <label for="client_id">Client ID</label>
                                                <input type="text" id="client_id" name="client_id"
                                                       value="<?= $record->Client_ID ?>" disabled/>
                                            </div>
                                            <div class="row">
                                                <label for="name">Photoshoot Name</label>
                                                <input type="text" id="name" name="name"
                                                       value="<?= $record->Photo_Shoot_Name ?>" maxlength="64" required value="<?= empty($_POST['name']) ? "" : $_POST['name'] ?>"/>
                                            </div>
                                            <div class="row">
                                                <label for="description">Photoshoot Description</label>
                                                <input type="text" id="description" name="description"
                                                       value="<?= $record->Photo_Shoot_Description ?>" maxlength="256" required value="<?= empty($_POST['description']) ? "" : $_POST['description'] ?>"/>
                                            </div>
                                            <div class="row">
                                                <label for="date">Photoshoot Date and Time</label>
                                                <input type="datetime-local" id="date" name="date"
                                                       value="<?= $record->Photo_Shoot_DateTime ?>" required value="<?= empty($_POST['date']) ? "" : $_POST['date'] ?>/>
                                            </div>
                                            <div class="row">
                                                <label for="quote">Photoshoot Quote</label>
                                                <input type="number" id="quote" name="quote" required step=".01" max="9999.99" min="0" value="<?= empty($_POST['quote']) ? $record->Photo_Shoot_Quote : $_POST['quote'] ?>">
                                            </div>
                                            <div class="row">
                                                <label for="otherInformation">Photoshoot Other Information</label>
                                                <input type="text" id="otherInformation" name="otherInformation"
                                                       value="<?= $record->Photo_Shoot_Other_Information ?>" maxlength="256" required value="<?= empty($_POST['otherInformation']) ? "" : $_POST['otherInformation'] ?>"/>
                                            </div>
                                            <br/>
                                            <div class="modal-footer">
                                                <input class="submit-button" type="submit" value="Update"
                                                       onclick="submiBtnClick()";/>
                                                <button class="cancel-button" type="button"
                                                        onclick="window.location='/Photoshoots';return false;">Cancel
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

<script>
    function submiBtnClick(){
        var formValid = document.forms["post-form"].checkValidity();
        return formValid;
    }
</script>

</body>
</html>