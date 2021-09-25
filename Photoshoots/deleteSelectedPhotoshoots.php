<html lang="en">
<head>
    <title>Resonant With World Photoshoots</title>
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
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['Photo_Shoot_ID'])) {
    //Noticed that we're adding questions marks (parameters) to the query
    //To match number of selected items in POST request
    $query_placeholders = trim(str_repeat("?,", count($_POST['Photo_Shoot_ID'])), ",");
    $query = "DELETE FROM `Photo_Shoot` WHERE `Photo_Shoot_ID` in (" . $query_placeholders . ")";
    $stmt = $dbh->prepare($query);
    if ($stmt->execute($_POST['Photo_Shoot_ID'])) {
        echo "<p class='message'>Selected photoshoot have been deleted.</p>";
    } else {
        echo "<p class='message'>Error occurred while deleting photoshoot.</p>";
    }
} else {
    echo "<p class='message'>Please select at least one photoshoot to delete.</p>";

}

$title_stmt = $dbh->prepare("SELECT * FROM `Photo_Shoot`");
if ($title_stmt->execute() && $title_stmt->rowCount() > 0) { ?>
<div class="container">
    <h1>Photoshoots</h1>
    <div class="row">
        <div class="col-sm">
            <button class="back-full-button" onclick="window.location='/Photoshoots'"><i
                        class="bi bi-arrow-left-circle-fill"></i>Back to Full List
            </button>
        </div>
        <div class="col-sm">
            <form method="post">
                <button class="delete-selected-button2" type="submit"/>
                <i class="bi bi-trash-fill"></i>Delete selected photoshoots

        </div>

    </div>

    <div class="table-responsive">
        <table class="table table-bordered responsive">
            <thead>
            <tr>
                <th>Delete</th>
                <th>ID</th>
                <th>Client ID</th>
                <th>Photoshoot Name</th>
                <th>Photoshoot Description</th>
                <th>Photoshoot Date and Time</th>
                <th>Photoshoot Quote</th>
                <th>Photoshoot Other Information</th>
            </tr>
            </thead>
            <?php while ($row = $title_stmt->fetchObject()) { ?>
            <tbody>
            <tr>
                <td class="col-checkbox">
                    <input type="checkbox" name="Photo_Shoot_ID[]" value="<?php echo $row->Photo_Shoot_ID; ?>"/>
                </td>
                <td><?= $row->Photo_Shoot_ID; ?> </td>
                <td><?= $row->Client_ID; ?> </td>
                <td><?= $row->Photo_Shoot_Name; ?> </td>
                <td><?= $row->Photo_Shoot_Description; ?> </td>
                <td><?= $row->Photo_Shoot_DateTime; ?> </td>
                <td><?= $row->Photo_Shoot_Quote; ?> </td>
                <td><?= $row->Photo_Shoot_Other_Information; ?> </td>

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
