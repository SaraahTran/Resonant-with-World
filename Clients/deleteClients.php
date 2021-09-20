<html lang="en">
<head>
    <title>Resonant With World Client</title>
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
</table>

<?php include('../Menu/menu.php'); ?>
<div class="container">

    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card action-card">
                <h5 class="card-header">Delete Client</h5>
                <div class="card-body action-body">
                    <p class="card-text">
                    <div class="container">
                        <?php
                        $dbh = new PDO('mysql:host=localhost;dbname=fit2104_assignment2', 'fit2104', 'fit2104');
                        include('../connection.php');
                        if (!empty($_POST)) {
                            // Process to delete record request (if a POST form is submitted)
                            $query = "DELETE FROM `Client` WHERE `Client_ID`=?";
                            $stmt = $dbh->prepare($query);
                            if ($stmt->execute([$_GET['id']])) {
                                echo "Client #" . $_GET['id'] . " has been deleted. ";
                                echo "<div class=\"center row\"><button class='justify-content-center back-button'  onclick=\"window.location='/Clients'\">Back To Clients </button></div>";
                            } else {
                                echo friendlyError($stmt->errorInfo()[2]);
                                echo "<div class=\"center row\"><button onclick=\"window.history.back()\">Back to previous page</button></div>";
                                die();
                            }
                        } else {
                            // When no POST form is submitted, get the record from database
                            $query = "SELECT * FROM `Client` WHERE `Client_ID`=?";
                            $stmt = $dbh->prepare($query);
                            if ($stmt->execute([$_GET['id']])) {
                                if ($stmt->rowCount() > 0) {
                                    $record = $stmt->fetchObject(); ?>
                                    <form method="post">
                                        <div class="aligned-form">
                                            <div class="row">
                                                <label for="client_id">ID</label>
                                                <input type="number" id="Client_ID" value="<?= $record->Client_ID ?>"
                                                       disabled/>
                                            </div>
                                            <div class="row">
                                                <label for="firstname">First Name</label>
                                                <input type="text" id="Client_FirstName"
                                                       value="<?= $record->Client_FirstName ?>" disabled/>
                                            </div>
                                            <div class="row">
                                                <label for="surname">Surname</label>
                                                <input type="text" id="Client_Surname"
                                                       value="<?= $record->Client_Surname ?>" disabled/>
                                            </div>
                                            <div class="row">
                                                <label for="address">Address</label>
                                                <input type="text" id="Client_Address"
                                                       value="<?= $record->Client_Address ?>" disabled/>
                                            </div>
                                            <div class="row">
                                                <label for="Phone">Phone</label>
                                                <input type="text" id="Client_Phone"
                                                       value="<?= $record->Client_Phone ?>" disabled/>
                                            </div>
                                            <div class="row">
                                                <label for="email">Email</label>
                                                <input type="text" id="Client_Email"
                                                       value="<?= $record->Client_Email ?>" disabled/>
                                            </div>
                                            <div class="row">
                                                <label for="other information">Other Information</label>
                                                <input type="text" id="Client_Other_Information"
                                                       value="<?= $record->Client_Other_Information ?>" disabled/>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <input class="submit-button" type="submit" name="action" id="delete-button"
                                                   value="Delete"/>
                                            <button class="cancel-button" type="button"
                                                    onclick="window.location='/Categories';return false;">Cancel
                                            </button>
                                        </div>
                                    </form>
                                <?php } else {
                                    header("Location: Clients");
                                }
                            } else {
                                die(friendlyError($stmt->errorInfo()[2]));
                            }
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
