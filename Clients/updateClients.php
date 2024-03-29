<html lang="en">
<head>
    <title>Resonant With World Client</title>
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


</table>

<?php include('../Menu/menu.php');


function yesNo($n)
{
    return $n == 1 ? 'Yes' : 'No';
}

?>

<div class="container">

    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card client-action-card">
                <h5 class="card-header">Update Client</h5>
                <div class="card-body action-body">
                    <p class="card-text">

                    <div class="justify-content-center center">
                        <?php
                        $dbh = new PDO('mysql:host=localhost;dbname=fit2104_assignment2', 'fit2104', 'fit2104');
                        if (!empty($_POST)) {
                            foreach ($_POST as $fieldName => $fieldValue) {

                            }
                            // Process the update record request (if a POST form is submitted)
                            // using associative arrays in this as we can use named keys that we assigned
                            $query = "UPDATE `Client` SET `Client_FirstName`=:firstname,`Client_Surname`=:surname,`Client_Address`=:address,`Client_Phone`=:phone,`Client_Email`=:email, `Client_Subscribed`=:subscribe, `Client_Other_Information`=:otherInformation WHERE `Client_ID`=:id";
                            $stmt = $dbh->prepare($query);
                            $parameters = [
                                'firstname' => $_POST['firstname'],
                                'surname' => $_POST['surname'],
                                'address' => $_POST['address'],
                                'phone' => $_POST['phone'],
                                'email' => $_POST['email'],
                                'subscribe' => $_POST['subscribe'],
                                'otherInformation' => $_POST['otherInformation'],
                                'id' => $_GET['id']
                            ];
                            echo("The client information has been updated.");
                            echo "<div class=\"center row\"><button class='justify-content-center back-button'  onclick=\"window.location='/Clients'\">Back to the client list</button></div>";
                            if ($stmt->execute($parameters)) {
                            } else {
                                echo friendlyError($stmt->errorInfo()[2]);
                                echo "<div class=\"center row\"><button onclick=\"window.location='/Clients'\">Back to previous page</button></div>";
                                die();
                            }
                        } else {
                            // When no POST form is submitted, get the record from database
                           //selecting the specific client from the ID and fetches it which allows the users to see the values before they edit it
                            $query = "SELECT * FROM `Client` WHERE `Client_ID`=?";
                            $stmt = $dbh->prepare($query);
                            if ($stmt->execute([$_GET['id']])) {
                                if ($stmt->rowCount() > 0) {
                                    $record = $stmt->fetchObject(); ?>
                                    <form method="post">
                                        <div class="aligned-form">
                                            <div class="row">
                                                <label for="client_id">ID</label>
                                                <input type="number" id="id" value="<?= $record->Client_ID ?>"
                                                       disabled/>
                                            </div>
                                            <div class="row">
                                                <label for="firstname">First Name</label>
                                                <input type="text" id="firstname" name="firstname"
                                                       value="<?= $record->Client_FirstName ?>" maxlength="64" required value="<?= empty($_POST['client_firstname']) ? "" : $_POST['client_firstname'] ?>"/>
                                            </div>
                                            <div class="row">
                                                <label for="surname">Surname</label>
                                                <input type="text" id="surname" name="surname"
                                                       value="<?= $record->Client_Surname ?>" maxlength="64" required value="<?= empty($_POST['client_surname']) ? "" : $_POST['client_surname'] ?>"/>
                                            </div>
                                            <div class="row">
                                                <label for="address">Address</label>
                                                <input type="text" id="address" name="address"
                                                       value="<?= $record->Client_Address ?>" name="client_address" maxlength="64" required value="<?= empty($_POST['name']) ? "" : $_POST['name'] ?>"/>
                                            </div>
                                            <div class="row">
                                                <label for="phone">Phone</label>
                                                <input type="tel" id="phone" name="phone"
                                                       value="<?= $record->Client_Phone ?>" pattern="^[0]\d{9}$" id="client_phone" name="client_phone" oninput="client_phone_check(event)" required value="<?= empty($_POST['client_phone']) ? "" : $_POST['client_phone'] ?>"/>
                                            </div>
                                            <div class="row">
                                                <label for="email">Email</label>
                                                <input type="text" id="email" name="email"
                                                       value="<?= $record->Client_Email ?>" maxlength="256" oninput="client_email_check(event)"  required value="<?= empty($_POST['client_email']) ? "" : $_POST['client_email'] ?>"/>
                                            </div>
                                            <div class="row">
                                                <label for="client_subscribed">Subscribed?</label>

                                                <select name="subscribe" id="subscribe" required value="<?= empty($_POST['client_subscribed']) ? "" : $_POST['client_subscribed'] ?>">
                                                    <option value="1" <?php echo ($record->Client_Subscribed == 1)?"selected":"";?>>Yes</option>
                                                    <option value="0" <?php echo ($record->Client_Subscribed == 0)?"selected":"";?>>No</option>
                                                </select>

                                            </div>
                                            <div class="row">
                                                <label for="otherInformation">Other Information</label>
                                                <input type="text" id="otherInformation" name="otherInformation"
                                                       value="<?= $record->Client_Other_Information ?>" maxlength="256"/>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="modal-footer">
                                            <input class="submit-button" type="submit" value="Update" onclick="submiBtnClick()"/>
                                            <button class="cancel-button" type="button"
                                                    onclick="window.location='/Clients';return false;">Cancel
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

                    <script>

                        function submiBtnClick(){
                            var formValid = document.forms["post-form"].checkValidity();
                            return formValid;
                        }



                    </script>


</body>
</html>

