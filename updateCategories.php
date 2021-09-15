<html>
<head>
    <title>Resonant With World Update Category</title>
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

<h1>Update Category</h1>
<div class="center">
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
    $query = "UPDATE `Category` SET `Category_Name`=:categoryname WHERE `Category_ID`=:id";
    $stmt = $dbh->prepare($query);
    $parameters = [
        'categoryname' => $_POST['categoryname'],
        'id' => $_GET['id']
    ];
    if ($stmt->execute($parameters)) {
    } else {
        echo friendlyError($stmt->errorInfo()[2]);
        echo "<div class=\"center row\"><button onclick=\"window.history.back()\">Back to previous page</button></div>";
        die();
    }
} else {
    // When no POST form is submitted, get the record from database
    $query = "SELECT * FROM `Category` WHERE `Category_ID`=?";
    $stmt = $dbh->prepare($query);
    if ($stmt->execute([$_GET['id']])) {
        if ($stmt->rowCount() > 0) {
            $record = $stmt->fetchObject(); ?>
            <form method="post">
                <div class="aligned-form">
                    <div class="row">
                        <label for="category_id">ID</label>
                        <input type="number" id="category_id" value="<?= $record->Category_ID ?>" disabled/>
                    </div>
                    <div class="row">
                        <label for="firstname">Category Name</label>
                        <input type="text" id="categoryname" name="categoryname" value="<?= $record->Category_Name ?>"/>
                    </div>
                    <div class="row center">
                        <input type="submit" value="Update"/>
                        <button type="button" onclick="window.location='categories.php';return false;">Cancel</button>
                    </div>
            </form>
            </form>
        <?php }
    } else {
        die(friendlyError($stmt->errorInfo()[2]));
    }
} ?>
</div>
</body>
</html>