<?php
ob_start();

/** @var $dbh PDO */
/** @var $db_name string */
?>
<!doctype html>
<html lang="en">
<head>
    <title>Resonant With World Clients</title>
    <!--CSS-->
    <link rel="stylesheet" type="text/css" href="Styles/style.css"/>
    <!--Bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!--Fonts and Icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400;700;800&display=swap" rel="stylesheet">
</head>

<body>
<?php include('./menu.php');?>

<div class="container">

    <div class="row justify-content-center"><div class="col-8">
            <div class="card action-card">
                <h5 class="card-header">Add New Client</h5>
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
                        $query = "INSERT INTO `Client`(`Client_FirstName`) VALUES (NULLIF('$_POST[client_firstname]', ''))";
                        $stmt = $dbh->prepare($query);
                        if ($stmt->execute())
                        {
                        $newRecordId = $dbh->lastInsertId();
                        // When no POST form is submitted, get the record from database
                        $query = "SELECT * FROM `Client` WHERE `Client_FirstName`=?";
                        $stmt = $dbh->prepare($query);
                        if ($stmt->execute([$newRecordId])) {
                        if ($stmt->rowCount() > 0) {
                        $record = $stmt->fetchObject(); ?>
                    <div class="center row">New Client has been added.</div>
                    <form method="post">
                        <div class="aligned-form">
                            <div class="row">
                                <label for="client_id">ID</label>
                                <input type="text" id="client_id" value="<?=$nextId?>" disabled/>
                            </div>
                            <div class="row">
                                <label for="client_firstname">Client First Name</label>
                                <input type="text" id="client_firstname" name="client_firstname"/>
                            </div>
                            <div class="row">
                                <label for="client_surname">Client Surname</label>
                                <input type="text" id="client_surname" name="client_surname"/>
                            </div>
                            <div class="row">
                                <label for="client_address">Client Address</label>
                                <input type="text" id="client_address" name="client_address"/>
                            </div>
                            <div class="row">
                                <label for="client_phone">Client Phone</label>
                                <input type="text" id="client_phone" name="client_phone"/>
                            </div>
                            <div class="row">
                                <label for="client_email">Client Email</label>
                                <input type="text" id="client_email" name="client_email"/>
                            </div>
                            <div class="row">
                                <label for="client_subscribed">Subscribed?</label>
                                <input type="text" id="client_subscribed" name="client_subscribed"/>
                            </div>
                            <div class="row">
                                <label for="client_other_information">Other Information</label>
                                <input type="text" id="client_other_information" name="client_other_information"/>
                            </div>
                        </div>
                    </form>
                    <div class="center row">New category has been added.
                        <button class='justify-content-center back-button' onclick="window.location='clients.php.php'">Back to the client list</button>
                    </div>
                    <?php } else {
                        echo "New client has been added.";
                        echo "<div class=\"center row\"><button class='justify-content-center back-button'  onclick=\"window.location='clients.php'\">Back to the client list</button></div>";
                    }
                    } else {
                        die(friendlyError($stmt->errorInfo()[2]));
                    }
                    } else {
                        echo friendlyError($stmt->errorInfo()[2]);
                        echo "<div class=\"center row\"><button class='justify-content-center back-button'  onclick=\"window.history.back()\">Back to previous page</button></div>";
                        die();
                    }
                    } else {
                        $query = "SELECT `AUTO_INCREMENT` FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'fit2104_assignment2' AND TABLE_NAME='client'";
                        $stmt = $dbh->prepare($query);
                        $nextId = ($stmt->execute() || $stmt->rowCount() > 0) ? $stmt->fetchObject()->AUTO_INCREMENT : "Not available";
                        ?>
                        <form method="post">
                            <div class="aligned-form">
                                <div class="row">
                                    <label for="client_id">ID</label>
                                    <input type="text" id="client_id" value="<?=$nextId?>" disabled/>
                                </div>
                                <div class="row">
                                    <label for="client_firstname">Client First Name</label>
                                    <input type="text" id="client_firstname" name="client_firstname"/>
                                </div>
                                <div class="row">
                                    <label for="client_surname">Client Surname</label>
                                    <input type="text" id="client_surname" name="client_surname"/>
                                </div>
                                <div class="row">
                                    <label for="client_address">Client Address</label>
                                    <input type="text" id="client_address" name="client_address"/>
                                </div>
                                <div class="row">
                                    <label for="client_phone">Client Phone</label>
                                    <input type="text" id="client_phone" name="client_phone"/>
                                </div>
                                <div class="row">
                                    <label for="client_email">Client Email</label>
                                    <input type="text" id="client_email" name="client_email"/>
                                </div>
                                <div class="row">
                                    <label for="client_subscribed">Subscribed?</label>
                                    <input type="text" id="client_subscribed" name="client_subscribed"/>
                                </div>
                                <div class="row">
                                    <label for="client_other_information">Other Information</label>
                                    <input type="text" id="client_other_information" name="client_other_information"/>
                                </div>
                            </div>
                            <br/>
                            <div class="modal-footer">
                                <input type="submit" class="submit-button" value="Add" onclick="window.location='clients.php'"/>
                                <button type="button" class="cancel-button"  onclick="window.location='clients.php';return false;">Cancel</button>
                            </div>
                        </form>
                    <?php } ?></div></div>
        </div></div></div></div></div>
</body>


</html>