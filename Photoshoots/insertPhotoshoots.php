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
    <link rel="icon" type="image/png" href="../Images/Logo.png"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400;700;800&display=swap" rel="stylesheet">
</head>

<body>
<?php include('../Menu/menu.php'); ?>

<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['photo_shoot_name']) &&
        !empty($_POST['photo_shoot_description']) &&
        !empty($_POST['photo_shoot_datetime']) &&
        !empty($_POST['photo_shoot_quote'])
    ) {
        $query = "INSERT INTO `Photo_Shoot`(`photo_shoot_name`, `photo_shoot_description`, `photo_shoot_datetime`, `photo_shoot_quote`, `photo_shoot_other_information`, `client_id`) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $dbh->prepare($query);
        $parameters = [
            $_POST['photo_shoot_name'],
            $_POST['photo_shoot_description'],
            $_POST['photo_shoot_datetime'],
            $_POST['photo_shoot_quote'],
            empty($_POST['photo_shoot_other_information']) ? null : $_POST['photo_shoot_other_information'],
            $_POST['client_id']
        ];
        ?>

<div class="container">

    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card photoshoot-action-card">
                <h5 class="card-header">Add New Photoshoot</h5>
                <div class="card-body action-body">
                    <p class="card-text">

                        <?php
        if ($stmt->execute($parameters)) {
            echo "New photoshoot has been added.";
            echo "<div class=\"center row\"><button class='justify-content-center back-button'  onclick=\"window.location='/Photoshoots'\">Back to the product list</button></div>";

            exit();
        } else {
            $ERROR = $stmt->errorInfo()[2];
        }
    }
}
?>

<div class="container">

    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card photoshoot-action-card">
                <h5 class="card-header">Add New Photoshoot</h5>
                <div class="card-body action-body">
                    <p class="card-text">

                        <?php
                        $query = "SELECT `AUTO_INCREMENT` FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'fit2104_assignment2' AND TABLE_NAME='Photo_Shoot'";
                        $stmt = $dbh->prepare($query);
                        $nextId = ($stmt->execute() || $stmt->rowCount() > 0) ? $stmt->fetchObject()->AUTO_INCREMENT : "Not available";
                        ?>
                        <form name="photoshootForm" method="post" enctype="multipart/form-data" onSubmit="return validate()">
                            <div class="aligned-form">
                                <div class="row">
                                    <label for="photo_shoot_id">ID</label>
                                    <input type="text" id="photo_shoot_id" value="<?= $nextId ?>" disabled/>
                                </div>
                                <div class="row">
                                    <label for="client_id">Client ID</label>
                                    <input type="text" id="client_id" name="client_id" value="<?= $nextId ?>"/>
                                </div>
                                <div class="row">
                                    <label for="photo_shoot_name">Photoshoot Name</label>
                                    <input type="text" id="photo_shoot_name" name="photo_shoot_name" maxlength="64" required value="<?= empty($_POST['photo_shoot_name']) ? "" : $_POST['photo_shoot_name'] ?>"/>
                                </div>
                                <div class="row">
                                    <label for="photo_shoot_description">Photoshoot Description</label>
                                    <input type="text" id="photo_shoot_description" name="photo_shoot_description" maxlength="64" required value="<?= empty($_POST['photo_shoot_description']) ? "" : $_POST['photo_shoot_description'] ?>"/>
                                </div>
                                <div class="row">
                                    <label for="photo_shoot_datetime">Photoshoot Date Time</label>
                                    <input type="datetime-local" id="photo_shoot_datetime" name="photo_shoot_datetime" <?= empty($_POST['photo_shoot_datetime']) ? "" : $_POST['photo_shoot_datetime'] ?>/>
                                </div>
                                <div class="row">
                                    <label for="photo_shoot_quote">Photoshoot Quote</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input type="number" class="form-control" id="photo_shoot_quote" name="photo_shoot_quote" required step=".01" max="9999.99" min="0" value="<?= empty($_POST['photo_shoot_quote']) ? "" : $_POST['photo_shoot_quote'] ?>">
                                </div>
                                </div>

                                <div class="row">
                                    <label for="photo_shoot_other_information">Photoshoot Other Information</label>
                                    <input type="text" id="photo_shoot_other_information" name="photo_shoot_other_information" maxlength="256" "/>
                                </div>
                                <br/>
                                <div class="modal-footer">
                                    <input type="submit" class="submit-button" value="Add"
                                           onclick="submiBtnClick()";/>
                                    <button type="button" class="cancel-button"
                                            onclick="window.location='/Photoshoots';return false;">Cancel
                                    </button>
                                </div>
                            </div>
                        </form>
                   </div>
            </div>
        </div>
    </div>
</div>
</div></div>

</body>

<script>

    function submiBtnClick(){
        var formValid = document.forms["post-form"].checkValidity();
        return formValid;
    }
</script>


</html>
