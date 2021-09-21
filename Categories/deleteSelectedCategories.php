<html lang="en">
<head>
    <title>Resonant With World Category</title>
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
<?php
include('../Menu/menu.php');
include("../connection.php");
/** @var PDO $dbh */
//Now we'll process the POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['Category_ID'])) {
    //Noticed that we're adding questions marks (parameters) to the query
    //To match number of selected items in POST request
    $query_placeholders = trim(str_repeat("?,", count($_POST['Category_ID'])), ",");
    $query = "DELETE FROM `Category` WHERE `Category_ID` in (" . $query_placeholders . ")";
    $stmt = $dbh->prepare($query);
    if ($stmt->execute($_POST['Category_ID'])) {
        echo "<p class='message'>Selected category have been deleted.</p>";
    } else {
        echo "<p class='message'>Error occurred while deleting category.</p>";
    }
} else {
    echo "<p class='message'>Please select at least one category to delete.</p>";

}

$title_stmt = $dbh->prepare("SELECT * FROM `Category`");
if ($title_stmt->execute() && $title_stmt->rowCount() > 0) { ?>
<div class="container">
    <h1>Categories</h1>
    <div class="row">
        <div class="col-sm">
            <button class="add-button" onclick="window.location='/Categories'"><i
                        class="bi bi-arrow-left-circle-fill"></i>Back to Full List
            </button>
        </div>
        <div class="col-sm">
            <form method="post">
                <button class="delete-selected-button" type="submit" value="Delete selected categories"/>
                <i class="bi bi-trash-fill"></i>Delete selected categories

        </div>

    </div>

    <div class="table-responsive">
        <table class="table table-bordered responsive">
            <thead>
            <tr>
                <th>Delete?</th>
                <th>ID</th>
                <th>Name</th>
            </tr>
            </thead>
            <?php while ($row = $title_stmt->fetchObject()) { ?>
            <tbody>
            <tr>
                <td class="col-checkbox">
                    <input type="checkbox" name="Category_ID[]" value="<?php echo $row->Category_ID; ?>"/>
                </td>
                <td><?= $row->Category_ID ?></td>
                <td><?= $row->Category_Name ?></td>

            </tr>
            <?php }
            } ?>
            </tbody>
        </table>
    </div>
</div>
<?php include('../Menu/footer.php'); ?>
</body>

</html>
