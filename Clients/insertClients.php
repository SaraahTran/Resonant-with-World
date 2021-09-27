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
            <div class="card client-action-card">
                <h5 class="card-header">Add New Client</h5>
                <div class="card-body action-body">
                    <p class="card-text">
                        <?php

                        global $dbh;
                        if (!empty($_POST)) {
                        // Check if any of the POST fields are empty (which shouldn't be!)
                        foreach ($_POST as $fieldName => $fieldValue) {
                            if (empty($fieldValue)) {
                                echo("'$fieldName' field is empty. Please fix the issue try again. ");
                                echo "<div class=\"center row\"><button class='justify-content-center back-button' onclick=\"window.history.back()\">Back to previous page</button></div>";
                                die();
                            }
                        }
                        // Process the update record request (if a POST form is submitted)
                        $query = "INSERT INTO `Client`(`Client_FirstName`, `Client_Surname`, `Client_Address`, `Client_Phone`, `Client_Email`, `Client_Subscribed`, `Client_Other_Information` ) 
VALUES (NULLIF('$_POST[client_firstname]', ''), 
        NULLIF('$_POST[client_surname]', ''), 
        NULLIF('$_POST[client_address]', ''), 
        NULLIF('$_POST[client_phone]', ''), 
        NULLIF('$_POST[client_email]', ''), 
        NULLIF('$_POST[client_subscribed]', ''), 
        NULLIF('$_POST[client_other_information]', ''))";

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
                                <input type="text" id="client_id" value="<?= $nextId ?>" disabled/>
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
                    <div class="center row">New client has been added.
                        <button class='justify-content-center back-button' onclick="window.location='/Clients'">Back to
                            the client list
                        </button>
                    </div>
                    <?php } else {
                        echo "New client has been added.";
                        echo "<div class=\"center row\"><button class='justify-content-center back-button'  onclick=\"window.location='/Clients'\">Back to the client list</button></div>";
                    }
                    } else {
                        header("Location: error.html");
                    }
                    } else {
                        header("Location: error.html");
                    }
                    } else {
                        $query = "SELECT `AUTO_INCREMENT` FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'fit2104_assignment2' AND TABLE_NAME='client'";
                        $stmt = $dbh->prepare($query);
                        $nextId = ($stmt->execute() || $stmt->rowCount() > 0) ? $stmt->fetchObject()->AUTO_INCREMENT : "Not available";
                        ?>
                        <form name="clientForm" method="post" enctype="multipart/form-data" onSubmit="return validate()">
                            <div class="aligned-form">
                                <div class="row">
                                    <label for="client_id">ID</label>
                                    <input type="text" id="client_id" value="<?= $nextId ?>" disabled/>
                                </div>
                                <div class="row">
                                    <label for="client_firstname">Client First Name</label>
                                    <input type="text" id="client_firstname" name="client_firstname" maxlength="64" required value="<?= empty($_POST['client_firstname']) ? "" : $_POST['client_firstname'] ?>"/>
                                </div>
                                <div class="row">
                                    <label for="client_surname">Client Surname</label>
                                    <input type="text" id="client_surname" name="client_surname" maxlength="64" required value="<?= empty($_POST['client_surname']) ? "" : $_POST['client_surname'] ?>"/>
                                </div>
                                <div class="row">
                                    <label for="client_address">Client Address</label>
                                    <input type="text" id="client_address" name="client_address" maxlength="64" required value="<?= empty($_POST['name']) ? "" : $_POST['name'] ?>"/>
                                </div>
                                <div class="row">
                                    <label for="client_phone">Client Phone</label>
                                    <input type="tel" pattern="^[0]\d{9}$" id="client_phone" name="client_phone" oninput="client_phone_check(event)" required value="<?= empty($_POST['client_phone']) ? "" : $_POST['client_phone'] ?>"/>
                                </div>
                                <div class="row">
                                    <label for="client_email">Client Email</label>
                                    <input type="text" id="client_email" name="client_email" maxlength="256" oninput="client_email_check(event)"  required value="<?= empty($_POST['client_email']) ? "" : $_POST['client_email'] ?>"/>
                                </div>
                                <div class="row">
                                    <label for="client_subscribed">Subscribed?</label>
                                    <br/>
                                    <select name="client_subscribed" id="client_subscribed" required value="<?= empty($_POST['client_subscribed']) ? "" : $_POST['client_subscribed'] ?>">
                                        <option value="">Select the value</option>
                                            <option value="1">Yes</option>
                                        <option value="0">No</option>
                                    </select>

                                </div>
                                <div class="row">
                                    <label for="client_other_information">Other Information</label>
                                    <input type="text" id="client_other_information" name="client_other_information"  maxlength="256"/>
                                </div>
                            </div>
                            <br/>
                            <div class="modal-footer">
                                <input type="submit" class="submit-button" value="Add"
                                       onclick="submiBtnClick()";/>
                                <button type="button" class="cancel-button"
                                        onclick="window.location='/Clients';return false;">Cancel
                                </button>
                            </div>
                        </form>
                    <?php } ?></div>
            </div>
        </div>
    </div>
</div>

<script>
    function submiBtnClick(){
        var formValid = document.forms["post-form"].checkValidity();
        return formValid;
    }
    // Validate with JS at the time of submission
    $('#productForm').on('submit', function () {
        let client_phone = $('#client_phone').val();
        if (isNaN(client_phone) || client_phone.length !== 10) {
            alert("The phone number must be a number that is 10 digits long");
            return false; // prevent the form to be submitted
        }
    });

    // A callback function as event listener in input attribute (so we can do some validation)

    //phone number validation
    function client_phone_check(event) {

        if (isNaN(event.target.value) || event.target.value.length !== 10) {
            //Set the validation of the field as invalid with error message manually
            event.target.setCustomValidity("The phone number must be a number that is 10 digits long");
        } else {
            //Set the field as valid once met the criterion manually
            event.target.setCustomValidity("");
        }
    }



    }
</script>

</body>


</html>
