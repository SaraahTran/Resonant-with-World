<html>
<head>
    <title>Resonant With World Insert New Client</title>
    <!--CSS-->
    <link rel="stylesheet" type="text/css" href="Styles/style.css"/>
    <!--Bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!--Fonts and Icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400;700;800&display=swap" rel="stylesheet">
</head>


</table>

<?php include('./menu.php');?>

<h1>Insert New Client</h1>
<div class="container">
    <?php
    $dbh = new PDO('mysql:host=localhost;dbname=fit2104_assignment2','fit2104','fit2104');
    if (!empty($_POST)) {
    // Check if any of the POST fields are empty (which shouldn't be!)
    foreach ($_POST as $fieldName => $fieldValue) {
        if (empty($fieldValue)) {
            echo friendlyError("'$fieldName' field is empty. Please fix the issue try again. ");
            echo "<div class=\"center row\"><button onclick=\"window.history.back()\">Back to previous page</button></div>";
            die();
        }
    }

        // Process the update record request (if a POST form is submitted)
        $query = "INSERT INTO `Client`(`Client_FirstName`, `Client_Surname`, `Client_Address`, `Client_Phone`, `Client_Email`, `Client_Subscribed`, `Client_Other_Information`) VALUES(:firstname, :surname,:address,:phone,:email,:subscribed,:other information)";
        $stmt = $dbh->prepare($query);
        $parameters = [
            'firstname' => $_POST['firstname'],
            'surname' => $_POST['surname'],
            'address' => $_POST['address'],
            'phone' => $_POST['phone'],
            'email' => $_POST['email'],
            'subscribed' => $_POST['subscribed'],
            'other information' => $_POST['other information'],
        ];
        if ($stmt->execute($parameters)) {
            $newRecordId = $dbh->lastInsertId();
            // When no POST form is submitted, get the record from database
            $query = "SELECT * FROM `Client` WHERE `Client_ID`=?";
            $stmt = $dbh->prepare($query);
            if ($stmt->execute([$newRecordId])) {
                if ($stmt->rowCount() > 0) {
                    $record = $stmt->fetchObject(); ?>
                    <div class="center row">New Client Has Been Created.</div>
                    <form method="post">
                        <div class="aligned-form">
                            <div class="row">
                                <label for="client_id">ID</label>
                                <input type="number" id="Client_ID" value="<?= $record->Client_ID ?>" disabled/>
                            </div>
                            <div class="row">
                                <label for="firstname">First Name</label>
                                <input type="text" id="Client_FirstName" value="<?= $record->Client_FirstName ?>" disabled/>
                            </div>
                            <div class="row">
                                <label for="surname">Surname</label>
                                <input type="text" id="Client_Surname" value="<?= $record->Client_Surname ?>" disabled/>
                            </div>
                            <div class="row">
                                <label for="address">Address</label>
                                <input type="text" id="Client_Address" value="<?= $record->Client_Address ?>" disabled/>
                            </div>
                            <div class="row">
                                <label for="contact">Phone</label>
                                <input type="text" id="Client_Phone" value="<?= $record->Client_Phone ?>" disabled/>
                            </div>
                            <div class="row">
                                <label for="company">Email</label>
                                <input type="text" id="Client_Email" value="<?= $record->Client_Email ?>" disabled/>
                            </div>
                            <div class="row">
                                <label for="company">Subscribed</label>
                                <input type="text" id="Client_Subscribed" value="<?= $record->Client_Subscribed ?>" disabled/>
                            </div>
                            <div class="row">
                                <label for="company">Other Information</label>
                                <input type="text" id="Client_Other_Information" value="<?= $record->Client_Other_Information ?>" disabled/>
                            </div>
                        </div>
                    </form>
                    <div class="center row">
                        <button onclick="window.location='clients.php'">Back to the client list</button>
                    </div>
                <?php } else {
                    echo "Weird, the client just added has mysteriously disappeared!? ";
                    echo "<div class=\"center row\"><button onclick=\"window.location='clients.php'\">Back to the client list</button></div>";
                }
            } else {
                die(friendlyError($stmt->errorInfo()[2]));
            }
        } else {
            echo friendlyError($stmt->errorInfo()[2]);
            echo "<div class=\"center row\"><button onclick=\"window.history.back()\">Back to previous page</button></div>";
            die();
        }
    } else {
        $query = "SELECT `AUTO_INCREMENT` FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'fit2104_assignment2' AND TABLE_NAME='Client'";
        $stmt = $dbh->prepare($query);
        $nextId = ($stmt->execute() || $stmt->rowCount() > 0) ? $stmt->fetchObject()->AUTO_INCREMENT : "Not available";
        ?>
        <form method="post">
            <div class="aligned-form">
                <div class="row">
                    <label for="client_id">ID</label>
                    <input type="number" id="Client_ID" value="<?= $record->Client_ID ?>" disabled/>
                </div>
                <div class="row">
                    <label for="firstname">First Name</label>
                    <input type="text" id="Client_FirstName" value="<?= $record->Client_FirstName ?>" disabled/>
                </div>
                <div class="row">
                    <label for="surname">Surname</label>
                    <input type="text" id="Client_Surname" value="<?= $record->Client_Surname ?>" disabled/>
                </div>
                <div class="row">
                    <label for="address">Address</label>
                    <input type="text" id="Client_Address" value="<?= $record->Client_Address ?>" disabled/>
                </div>
                <div class="row">
                    <label for="contact">Phone</label>
                    <input type="text" id="Client_Phone" value="<?= $record->Client_Phone ?>" disabled/>
                </div>
                <div class="row">
                    <label for="company">Email</label>
                    <input type="text" id="Client_Email" value="<?= $record->Client_Email ?>" disabled/>
                </div>
                <div class="row">
                    <label for="company">Subscribed</label>
                    <input type="text" id="Client_Subscribed" value="<?= $record->Client_Subscribed ?>" disabled/>
                </div>
                <div class="row">
                    <label for="company">Other Information</label>
                    <input type="text" id="Client_Other_Information" value="<?= $record->Client_Other_Information ?>" disabled/>
                </div>

            </div>
            <div class="row center">
                <input type="submit" value="Add"/>
                <button type="button" onclick="window.location='clients.php';return false;">Cancel</button>
            </div>
        </form>
    <?php } ?>
</div>
</body>
</html>