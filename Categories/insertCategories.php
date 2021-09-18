<?php
ob_start();

/** @var $dbh PDO */
/** @var $db_name string */
?>
<!doctype html>
<html lang="en">
<head>
    <title>Resonant With World Category</title>
    <!--CSS-->
    <link rel="stylesheet" type="text/css" href="../Styles/style.css"/>
    <!--Bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!--Fonts and Icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400;700;800&display=swap" rel="stylesheet">
</head>

<body>
<?php include('../Menu/menu.php');?>

<div class="container">

    <div class="row justify-content-center"><div class="col-8">
            <div class="card action-card">
                    <h5 class="card-header">Add New Category</h5>
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
        $query = "INSERT INTO `category`(`category_name`) VALUES (NULLIF('$_POST[category_name]', ''))";
        $stmt = $dbh->prepare($query);
        if ($stmt->execute())
        {
            $newRecordId = $dbh->lastInsertId();
            // When no POST form is submitted, get the record from database
            $query = "SELECT * FROM `Category` WHERE `Category_Name`=?";
            $stmt = $dbh->prepare($query);
            if ($stmt->execute([$newRecordId])) {
                if ($stmt->rowCount() > 0) {
                    $record = $stmt->fetchObject(); ?>
                    <div class="center row">New category has been added.</div>
                    <form method="post">
                        <div class="aligned-form">
                            <div class="row">
                                <label for="category_id">ID</label>
                                <input type="text" id="category_id" value="<?=$nextId?>" disabled/>
                            </div>
                            <div class="row">
                                <label for="category_name">Category Name</label>
                                <input type="text" id="category_name" name="category_name"/>
                            </div>

                        </div>
                    </form>
                    <div class="center row">New category has been added.
                        <button class='justify-content-center back-button' onclick="window.location='/Categories'">Back to the category list</button>
                    </div>
                <?php } else {
                    echo "New category has been added.";
                    echo "<div class=\"center row\"><button class='justify-content-center back-button'  onclick=\"window.location='/Categories'\">Back to the category list</button></div>";
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
        $query = "SELECT `AUTO_INCREMENT` FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'fit2104_assignment2' AND TABLE_NAME='category'";
        $stmt = $dbh->prepare($query);
        $nextId = ($stmt->execute() || $stmt->rowCount() > 0) ? $stmt->fetchObject()->AUTO_INCREMENT : "Not available";
        ?>
        <form method="post">
            <div class="aligned-form">
                <div class="row">
                    <label for="category_id">ID</label>
                    <input type="text" id="category_id" value="<?= $nextId ?>" disabled/>
                </div>
                <div class="row">
                    <label for="category_name">Category Name</label>
                    <input type="text" id="category_name" name="category_name"/>
                </div>

            </div>
            <br/>
            <div class="modal-footer">
                <input type="submit" class="submit-button" value="Add" onclick="window.location='index.php'"/>
                <button type="button" class="cancel-button"  onclick="window.location='index.php';return false;">Cancel</button>
            </div>
        </form>
                <?php } ?></div></div>
            </div></div></div></div></div>
</body>


</html>