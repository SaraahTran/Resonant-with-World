<html lang="en">
<head>
    <title>Resonant With World Product</title>
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

<?php include('../Menu/menu.php'); ?>
<div class="container">
    <div class="row">
        <div class="col-sm">
            <h1>Products</h1>
            <p class="description">You can manage your products here.</p>
        </div>
        <div class="col-sm">
            <button class="add-button" onclick="window.location='./Products/insertProducts.php'"><i
                        class="bi bi-plus-circle-fill"></i>Add New Product
            </button>
            <button class="delete-selected-button" onclick="window.location='./Products/deleteSelectedProducts.php'"><i
                        class="bi bi-trash-fill"></i>Delete Multiple Products
            </button>
            <button class="delete-selected-button" onclick="window.location='./Products/searchProducts.php'"><i class="bi bi-search"></i>Search by Product UPC
            </button>
            <button class="add-button" onclick="window.location='/Products/multipleProducts.php'"><i class="bi bi-basket-fill"></i>Multiple Products
            </button>


        </div>

    </div>
    <?php

    global $dbh;
    $stmt = $dbh->prepare("SELECT * FROM `Product`");
    $stmt->execute();
    ?>

    <div class="table-responsive">
        <table class="table table-bordered responsive">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Product Name</th>
                <th scope="col">Product UPC</th>
                <th scope="col">Product Price</th>
                <th scope="col">Product Category</th>
                <th style="width:20%" scope="col">Actions</th>
            </tr>
            </thead>
            <?php while ($row = $stmt->fetchObject()): ?>
            <tbody>
            <tr>
                <td><?php echo $row->Product_ID; ?> </td>
                <td><?php echo $row->Product_Name; ?> </td>
                <td><?php echo $row->Product_UPC; ?> </td>
                <td>$<?php echo $row->Product_Price; ?> </td>
                <td><?php echo $row->Product_Category; ?> </td>
                <td style="width:20%">
                    <button type="button" class="action-button" data-toggle="tooltip" data-placement="top" title="View"
                            onclick="window.location='./Products/viewProducts.php?id=<?= $row->Product_ID ?>'"><i
                                class="center bi bi-eye-fill"></i></button>
                    <button class="action-button" data-toggle="tooltip" data-placement="top" title="Update"
                            onclick="window.location='./Products/updateProducts.php?id=<?= $row->Product_ID  ?>'"><i
                                class="center bi bi-pencil-fill"></i></button>
                    <button class="action-button" data-toggle="tooltip" data-placement="top" title="Delete"
                            onclick="window.location='./Products/deleteProducts.php?id=<?= $row->Product_ID  ?>'"><i
                                class="center bi bi-trash-fill"></i></button>
                </td>
                <?php endwhile; ?>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<?php include('../Menu/footer.php'); ?>
<script>$(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })</script>
</body>

</html>
