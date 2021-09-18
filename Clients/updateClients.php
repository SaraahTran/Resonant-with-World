<html>
<head>
    <title>Resonant With World Client</title>
    <!--CSS-->
    <link rel="stylesheet" type="text/css" href="../Styles/style.css"/>
    <!--Bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!--Fonts and Icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400;700;800&display=swap" rel="stylesheet">
</head>


<body>


</table>

<?php include('../Menu/menu.php');?>

<h1>Update Client Details</h1>
<div class="container">
    <?php
    $dbh = new PDO('mysql:host=localhost;dbname=fit2104_assignment2','fit2104','fit2104');
    if (!empty($_POST)) {
       foreach ($_POST as $fieldName => $fieldValue){
           if (empty($fieldValue)) {
           echo errorMessage("'$fieldName The field is empty. Please fill in the requirements. '");
           echo "<div class=\"center row\"><button onclick=\"window.history.back()\">Return to previous page</button></div>";
           die();
       }
   }
    // Process the update record request (if a POST form is submitted)
        $query = "UPDATE `Client` SET `Client_FirstName`=:firstname,`Client_Surname`=:surname,`Client_Address`=:address,`Client_Phone`=:phone,`Client_Email`=:email, `Client_Subscribed`=:subscribe, `Client_Other_Information`=:otherinfo WHERE `Client_ID`=:id";
        $stmt = $dbh->prepare($query);
        $parameters = [
            'firstname' => $_POST['firstname'],
            'surname' => $_POST['surname'],
            'address' => $_POST['address'],
            'phone' => $_POST['phone'],
            'email' => $_POST['email'],
            'subscribed' => $_POST['subscribed'],
            'other information' => $_POST['other information'],
            'id' => $_GET['id']
        ];
         if ($stmt->execute($parameters)) {
            header("Location: index.php");
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
                <input type="number" id="client_id" value="<?= $record->Client_ID ?>" disabled/>
            </div>
            <div class="row">
                <label for="firstname">First Name</label>
                <input type="text" id="firstname" name="firstname" value="<?= $record->Client_FirstName ?>"/>
            </div>
            <div class="row">
                <label for="surname">Surname</label>
                <input type="text" id="surname" name="surname" value="<?= $record->Client_Surname ?>"/>
            </div>
            <div class="row">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" value="<?= $record->Client_Address ?>"/>
            </div>
            <div class="row">
                <label for="contact">Phone</label>
                <input type="text" id="contact" name="contact" value="<?= $record->Client_Phone ?>"/>
            </div>
            <div class="row">
                <label for="company">Subscribe</label>
                <input type="text" id="company" name="company" value="<?= $record->Client_Subscribed ?>"/>
            </div>
            <div class="row">
                <label for="company">Other Information</label>
                <input type="text" id="company" name="company" value="<?= $record->Client_Other_Information ?>"/>
            </div>
        </div>
        <br/>
        <div class="modal-footer">
            <input type="submit" value="Update"/>
            <button type="button" onclick="window.location='/Clients';return false;">Cancel</button>
        </div>
    </form>
     <?php } else {
            header("Location: Client");
        }
        } else {
          die(friendlyError($stmt->errorInfo()[2]));
        }
    } ?>
</div>

<?php include('../Menu/footer.php'); ?>
</body>
</html>

