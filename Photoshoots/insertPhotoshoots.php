<?php
ob_start();

/** @var $dbh PDO */
/** @var $db_name string */
?>
<!doctype html>
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
<?php include('../Menu/menu.php');?>

<div class="container">

    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card photoshoot-action-card">
                <h5 class="card-header">Add New Photoshoot</h5>
                <div class="card-body action-body">
                    <p class="card-text">
                        <?php
                        $dbh = new PDO('mysql:host=localhost;dbname=fit2104_assignment2','fit2104','fit2104');
                        if (!empty($_POST)) {
                        // Check if any of the POST fields are empty (which shouldn't be!)
                        foreach ($_POST as $fieldName => $fieldValue) {
                            if (empty($fieldValue)) {
                                echo ("'$fieldName' field is empty. Please fix the issue try again. ");
                                echo "<div class=\"center row\"><button class='justify-content-center back-button' onclick=\"window.history.back()\">Back to previous page</button></div>";
                                die();
                            }
                        }
                        // Process the update record request (if a POST form is submitted)
                        $query = "INSERT INTO `Photo_Shoot`(`Photo_Shoot_Name`,`Photo_Shoot_Description`,`Photo_Shoot_DateTime`,`Photo_Shoot_Quote`,`Photo_Shoot_Other_Information` ) 
VALUES (NULLIF('$_POST[photo_shoot_name]',  
        NULLIF('$_POST[photo_shoot_description]', ''), 
        NULLIF('$_POST[photo_shoot_datetime]', ''), 
        NULLIF('$_POST[photo_shoot_quote]', ''), 
        NULLIF('$_POST[photo_shoot_other_information]', ''))";

                        $stmt = $dbh->prepare($query);
                        if ($stmt->execute())
                        {
                        $newRecordId = $dbh->lastInsertId();
                        // When no POST form is submitted, get the record from database
                        $query = "SELECT * FROM `Photo_Shoot` WHERE `Photo_Shoot_ID`=?";
                        $stmt = $dbh->prepare($query);
                        if ($stmt->execute([$newRecordId])) {
                        if ($stmt->rowCount() > 0) {
                        $record = $stmt->fetchObject(); ?>
                    <div class="center row">New Photoshoot has been added.</div>
                    <form method="post">
                        <div class="aligned-form">
                            <div class="row">
                                <label for="photo_shoot_id">ID</label>
                                <input type="text" id="photo_shoot_id" value="<?=$nextId?>" disabled/>
                            </div>
                            <div class="row">
                                <label for="client_id">Client ID</label>
                                <input type="text" id="client_id" value="<?=$nextId?>" disabled/>
                            </div>
                            <div class="row">
                                <label for="photo_shoot_name">Photoshoot Name</label>
                                <input type="text" id="photo_shoot_name" name="photo_shoot_name"/>
                            </div>
                            <div class="row">
                                <label for="photo_shoot_description">Photoshoot Description</label>
                                <input type="text" id="photo_shoot_description" name="photo_shoot_description"/>
                            </div>
                            <div class="row">
                                <label for="photo_shoot_datetime">Photoshoot Date Time</label>
                                <input type="text" id="photo_shoot_datetime" name="photo_shoot_datetime"/>
                            </div>
                            <div class="row">
                                <label for="photo_shoot_quote">Photoshoot Quote</label>
                                <input type="text" id="photo_shoot_quote" name="photo_shoot_quote"/>
                            </div>
                            <div class="row">
                                <label for="photo_shoot_other_information">Photoshoot Other Information</label>
                                <input type="text" id="photo_shoot_other_information" name="photo_shoot_other_information"/>
                            </div>
                        </div>
                    </form>
                    <div class="center row">New photoshoot has been added.
                        <button class='justify-content-center back-button' onclick="window.location='/Photoshoots'">Back to the photoshoot list</button>
                    </div>
                    <?php } else {
                        echo "New phootshoot has been added.";
                        echo "<div class=\"center row\"><button class='justify-content-center back-button'  onclick=\"window.location='/Photoshoots'\">Back to the photoshoot list</button></div>";
                    }
                    } else {
                        header("Location: error.html");
                    }
                    } else {
                        header("Location: error.html");
                    }
                    } else {
                        $query = "SELECT `AUTO_INCREMENT` FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'fit2104_assignment2' AND TABLE_NAME='Photo_Shoot'";
                        $stmt = $dbh->prepare($query);
                        $nextId = ($stmt->execute() || $stmt->rowCount() > 0) ? $stmt->fetchObject()->AUTO_INCREMENT : "Not available";
                        ?>
                        <form method="post">
                            <div class="aligned-form">
                                <div class="row">
                                    <label for="photo_shoot_id">ID</label>
                                    <input type="text" id="photo_shoot_id" value="<?=$nextId?>" disabled/>
                                </div>
                                <div class="row">
                                    <label for="client_id">Client ID</label>
                                    <input type="text" id="client_id" value="<?=$nextId?>" disabled/>
                                </div>
                                <div class="row">
                                    <label for="photo_shoot_name">Photoshoot Name</label>
                                    <input type="text" id="photo_shoot_name" name="photo_shoot_name"/>
                                </div>
                                <div class="row">
                                    <label for="photo_shoot_description">Photoshoot Description</label>
                                    <input type="text" id="photo_shoot_description" name="photo_shoot_description"/>
                                </div>
                                <div class="row">
                                    <label for="photo_shoot_datetime">Photoshoot Date Time</label>
                                    <input type="text" id="photo_shoot_datetime" name="photo_shoot_datetime"/>
                                </div>
                                <div class="row">
                                    <label for="photo_shoot_quote">Photoshoot Quote</label>
                                    <input type="text" id="photo_shoot_quote" name="photo_shoot_quote"/>
                                </div>
                                <div class="row">
                                    <label for="photo_shoot_other_information">Photoshoot Other Information</label>
                                    <input type="text" id="photo_shoot_other_information" name="photo_shoot_other_information"/>
                                </div>
                                <br/>
                                <div class="modal-footer">
                                    <input type="submit" class="submit-button" value="Add" onclick="window.location='/Photoshoots'"/>
                                    <button type="button" class="cancel-button"  onclick="window.location='/Photoshoots';return false;">Cancel</button>
                                </div>
                            </div>
                        </form>
                    <?php } ?></div></div>
        </div></div></div></div></div>

</body>


</html>