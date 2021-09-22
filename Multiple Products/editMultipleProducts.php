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

<?php include('../Menu/menu.php'); ?>
<div class="container">
    <h1>Multiple Products</h1>
    <div class="row">
        <div class="col-sm">
        </div>
        <button class="add-button" onclick="window.location='/Multiple%20Products'"><i
                    class="bi bi-arrow-left-circle-fill"></i>Back to Full List
        </button>



    </div>
    <?php
    include('../connection.php');
    global $dbh;
    $stmt = $dbh->prepare("SELECT * FROM `Product`");
    $stmt->execute();
    ?>

    <div class=" table-responsive">
        <table class="table table-bordered responsive">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Product Name</th>
            </tr>
            </thead>
            <?php while ($row = $stmt->fetchObject()): ?>
            <tbody>
            <tr>
                <td><?php echo $row->Product_ID; ?> </td>
                <td><?php echo $row->Product_Name; ?> </td>
                <?php endwhile; ?>
            </tr>
            </tbody>
        </table>
    </div>

    <div class="row">
        <label for="productprice">Product Price</label>
        <input type="text" id="productprice" name="productprice"
               value="<?= $record->Product_Price ?>"/>
    </div>

</div>
<?php include('../Menu/footer.php'); ?>
<script>$(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })</script>
</body>

</html>

