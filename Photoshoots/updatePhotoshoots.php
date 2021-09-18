<html>
<head>
    <title>Resonant With World Photoshoot</title>
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
                <h5 class="card-header">Update Photoshoot</h5>
                <div class="card-body action-body">
                    <p class="card-text">

                    <div class="justify-content-center center">
                        <?php
                        $dbh = new PDO('mysql:host=localhost;dbname=fit2104_assignment2','fit2104','fit2104');
                        if (!empty($_POST)) {
                            // Check if any of the POST fields are empty (which shouldn't be!)
                            foreach ($_POST as $fieldName => $fieldValue) {
                                if (empty($fieldValue)) {
                                    echo ("'$fieldName' field is empty. Please fix the issue try again. ");
                                    echo "<div class=\"center row\"><button class='justify-content-center back-button'  onclick=\"window.location='/Categories'\">Back to the category list</button></div>";
                                    die();
                                }
                            }
                            // Process the update record request (if a POST form is submitted)
                            $query = "UPDATE `Photo_Shoot` SET `Photo_Shoot_Name`=:photoshootname WHERE `Photo_Shoot_ID`=:id";
                            $stmt = $dbh->prepare($query);
                            $parameters = [
                                'photoshootname' => $_POST['photoshootname'],
                                'description' => $_POST['description'],
                                'date' => $_POST['date'],
                                'quote' => $_POST['quote'],
                                'other information' => $_POST['other information'],
                                'id' => $_GET['id']
                            ];
                            echo ("'$fieldValue' has been updated.");
                            echo "<div class=\"center row\"><button class='justify-content-center back-button'  onclick=\"window.location='/Photoshoots'\">Back to the category list</button></div>";
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
                                    <form method="post">
                                        <div class="aligned-form">
                                            <div class="row">
                                                <label for="photo_shoot_id">ID</label>
                                                <input type="number" id="photo_shoot_id" value="<?= $record->Photo_Shoot_ID ?>" disabled/>
                                            </div>
                                            <div class="row">
                                                <label for="client_id">Client ID</label>
                                                <input type="text" id="client_id" name="client_id" value="<?= $record->Client_ID ?>"/>
                                            </div>
                                            <div class="row">
                                                <label for="photoshootname">Photoshoot Name</label>
                                                <input type="text" id="photoshootname" name="photoshootname" value="<?= $record->Photo_Shoot_Name ?>"/>
                                            </div>
                                            <div class="row">
                                                <label for="photoshootdescription">Photoshoot Description</label>
                                                <input type="text" id="photoshootdescription" name="photoshootdescription" value="<?= $record->Photo_Shoot_Description ?>"/>
                                            </div>
                                            <div class="row">
                                                <label for="photoshootquote">Photoshoot Quote</label>
                                                <input type="text" id="photoshootquote" name="photoshootquote" value="<?= $record->Photo_Shoot_Quote ?>"/>
                                            </div>
                                            <div class="row">
                                                <label for="photoshootinformation">Photoshoot Other Information</label>
                                                <input type="text" id="photoshootinformation" name="photoshootinformation" value="<?= $record->Photo_Shoot_Other_Information ?>"/>
                                            </div>
                                            <br/>
                                            <div class="modal-footer">
                                                <input class="submit-button" type="submit" value="Update"/>
                                                <button class="cancel-button" type="button" onclick="window.location='/Photoshoots';return false;">Cancel</button>
                                            </div>
                                    </form>

                                <?php }
                            } else {
                                die(friendlyError($stmt->errorInfo()[2]));
                                echo "<div class=\"center row\"><button class='justify-content-center back-button' onclick=\"window.history.back()\">Back to previous page</button></div>";
                            }
                        } ?>
                    </div></div></div></div></div></div>
</body>
</html>