<?php
ob_start();

/** @var $dbh PDO */
/** @var $db_name string */
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Add new client</title>
    <meta name="description" content="2021 S2 Lab 7 Exercise">
    <meta name="author" content="FIT2104 Web Database Interface">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<h1>Add new category</h1>
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
                    <div class="center row">
                        <button onclick="window.location='index.php'">Back to the client list</button>
                    </div>
                <?php } else {
                    echo "Weird, the client just added has mysteriously disappeared!? ";
                    echo "<div class=\"center row\"><button onclick=\"window.location='categories.php'\">Back to the category list</button></div>";
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
        $query = "SELECT `AUTO_INCREMENT` FROM  INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'fit2104_assignment2' AND TABLE_NAME='category'";
        $stmt = $dbh->prepare($query);
        $nextId = ($stmt->execute() || $stmt->rowCount() > 0) ? $stmt->fetchObject()->AUTO_INCREMENT : "Not available";
        ?>
        <form method="post">
            <div class="aligned-form">
                <div class="row">
                    <label for="category_id">ID</label>
                    <input type="text" id="client_id" value="<?= $nextId ?>" disabled/>
                </div>
                <div class="row">
                    <label for="category_name">Category Name</label>
                    <input type="text" id="category_name" name="category_name"/>
                </div>

            </div>
            <div class="row center">
                <input type="submit" value="Add"/>
                <button type="button" onclick="window.location='categories.php';return false;">Cancel</button>
            </div>
        </form>
    <?php } ?>
</div>
</body>
</html>