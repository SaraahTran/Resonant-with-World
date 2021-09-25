<html lang="en">
<head>
    <title>Resonant With World Multiple Product</title>
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
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['Product_ID'])) {
    foreach ($_POST['Product_ID'] as $Product_ID) {
        if (isset($_POST['Product_Price'][$Product_ID])) {
            $query = "UPDATE `Product` SET `Product_Price`=:Product_Price WHERE `Product_ID` = :Product_ID";
            $stmt = $dbh->prepare($query);
            if (!$stmt->execute([
                'Product_Price' => $_POST['Product_Price'][$Product_ID],
                'Product_ID' => $Product_ID
            ])) {
                echo "<p class='message'>Error occurred while updating product.</p>";
            }
        } else {
            echo "<p>The price of the product does not exist.</p>";
        }
    }
}
echo "<p class='message'>Please select at least one product to update.</p>";


$title_stmt = $dbh->prepare("SELECT * FROM `Product`");
if ($title_stmt->execute() && $title_stmt->rowCount() > 0) { ?>
    <div class="container">
        <h1>Update Multiple Products Price</h1>
        <div class="row">
            <div class="col-sm">
            </div>
            <button class="add-button" onclick="window.location='/Multiple%20Products'"><i
                        class="bi bi-arrow-left-circle-fill"></i>Back to Full List
            </button>
        </div>
            <form method ="post">
                <input type="submit" value="Update the prices of selected titles"/>
                <table class="table table-bordered responsive">
                    <div class="table-responsive">
                        <thead>
                        <tr>
                            <th>Update</th>
                            <th>ID</th>
                            <th>Product Name</th>
                            <th>Edit Price</th>
                         </tr>

                        <?php while ($row = $title_stmt->fetchObject()) { ?>
                            <tr>
                                <td class="col-checkbox">
                                    <input type="checkbox" name="Product_ID[]" value="<?php echo $row->Product_ID; ?>"/>
                                </td>
                                <td><?= $row->Product_ID ?></td>
                                <td><?= $row->Product_Name ?></td>
                                <td><input type="text" name="Product_Price[<?= $row->Product_ID ?>]" value="<?= $row->Product_Price ?>"/></td>
                            </tr>
                        <?php } ?>
                </table>
            </form>
    </div>

<?php } ?>

</body>
</html>