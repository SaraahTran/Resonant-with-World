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

<h1>Delete Photoshoot</h1>
<div class="container">
    <?php
    $dbh = new PDO('mysql:host=localhost;dbname=fit2104_assignment2','fit2104','fit2104');
    include('../connection.php');
    if (!empty($_POST)) {
        // Process to delete record request (if a POST form is submitted)
        $query = "DELETE FROM `Photo_Shoot` WHERE `Photo_Shoot_ID`=?";
        $stmt = $dbh->prepare($query);
        if ($stmt->execute([$_GET['id']])) {
            echo "Photoshoot #" . $_GET['id'] . " has been deleted. ";
            echo "<div class=\"center row\"><button onclick=\"window.location='photoshoots.php'\">Back to the photoshoot list</button></div>";
        } else {
            echo friendlyError($stmt->errorInfo()[2]);
            echo "<div class=\"center row\"><button onclick=\"window.history.back()\">Back to previous page</button></div>";
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
                            <input type="number" id="Photo_Shoot_ID" value="<?= $record->Photo_Shoot_ID ?>" disabled/>
                        </div>
                        <div class="row">
                            <label for="client_id">Client ID</label>
                            <input type="text" id="Client_ID" value="<?= $record->Client_ID ?>" disabled/>
                        </div>
                        <div class="row">
                            <label for="name">Photoshoot Name</label>
                            <input type="text" id="Photo_Shoot_Name" value="<?= $record->Photo_Shoot_Name ?>" disabled/>
                        </div>
                        <div class="row">
                            <label for="description">Photoshoot Description</label>
                            <input type="text" id="Photo_Shoot_Description" value="<?= $record->Photo_Shoot_Description ?>" disabled/>
                        </div>
                        <div class="row">
                            <label for="date">Photoshoot Date and Time</label>
                            <input type="text" id="Photo_Shoot_DateTime" value="<?= $record->Photo_Shoot_DateTime ?>" disabled/>
                        </div>
                        <div class="row">
                            <label for="photo_shoot_quote">Quote</label>
                                <input type="text" id="Photo_Shoot_Quote" value="<?= $record->Photo_Shoot_Quote ?>" disabled/>
                        </div>
                        <div class="row">
                            <label for="other information">Other Information</label>
                            <input type="text" id="Photo_Shoot_Other_Information" value="<?= $record->Photo_Shoot_Other_Information ?>" disabled/>
                        </div>
                    </div>
                    <div class="row center">
                        <input type="submit" name="action" id="delete-button" value="Delete"/>
                        <button type="button" onclick="window.location='photoshoots.php';return false;">Cancel</button>
                    </div>
                </form>
            <?php } else {
                header("Location: index.php");
            }
        } else {
            die(friendlyError($stmt->errorInfo()[2]));
        }
    } ?>
</div>
</html>
