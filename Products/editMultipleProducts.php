<html lang="en">
<head>
    <title>Resonant With World Multiple Product</title>
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
<?php
include('../Menu/menu.php');
/** @var PDO $dbh */
//Now we'll process the POST request
//Execution section where this is the part where it updates the product price
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
//Table part to allow users to select different a bunch of different records
echo "<p class='message'>Please select at least one product to update.</p>";

//running a query to select the products
//generating form using html table with checkboxes as inputs along with button to execute request
//line 75 name="Product_ID[]" is a container that contains multiple value and uses a unique identifier as it gives a specific value for each box
$title_stmt = $dbh->prepare("SELECT * FROM `Product`");
if ($title_stmt->execute() && $title_stmt->rowCount() > 0) { ?>
    <div class="container">
        <h1>Update Multiple Products Prices</h1>
        <div class="row">

            <div class="col-sm">
            <button class="back-full-button" onclick="window.location='multipleProducts.php'"><i
                        class="bi bi-arrow-left-circle-fill"></i>Back to Full List
            </button>
            </div>
            <div class="col-sm">
                <form method="post" id="update-selected-form">
                    <button class="delete-selected-button2 update-selected" type="submit" value="Update the prices of selected products"/>
                    <i class="center bi bi-pencil-fill"></i>Update prices of selected products

            </div>
        </div>
        <div class="table-responsive">
                <table class="table table-bordered responsive">

                        <thead>
                        <tr>
                            <th scope="col">Update?</th>
                            <th scope="col">ID</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Edit Price</th>
                         </tr>
                        </thead><tbody>

                        <?php while ($row = $title_stmt->fetchObject()) { ?>
                            <tr>
                                <td class="col-checkbox">
                                    <input class="to-be-updated" type="checkbox" name="Product_ID[]" value="<?php echo $row->Product_ID; ?>"/>
                                </td>
                                <td><?= $row->Product_ID ?></td>
                                <td><?= $row->Product_Name ?></td>
                                <td><input type="text" name="Product_Price[<?= $row->Product_ID ?>]" value="<?= $row->Product_Price ?>"/></td>
                            </tr>
                        <?php } ?></tbody>
                </table>
            </form>
    </div>

<?php } ?>

        <script>
            $('button.update-selected').click(function (e) {
                e.preventDefault();

                if ($('input.to-be-updated:checked:enabled').length > 0) {
                    if (confirm('Do you really want to update selected products?')) {
                        $('form#update-selected-form').submit();
                    }
                } else {
                    alert("Please select at least one product to be updated. ");
                }
            });
        </script>

</body>
</html>