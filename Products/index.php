<html lang="en">
<head>
    <title>Resonant With World Product</title>
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
    <h1>Products</h1>
    <div class="row">
        <div class="col-sm">
            <button class="add-button" onclick="window.location='./Products/insertProducts.php'"><i
                        class="bi bi-plus-circle-fill"></i>Add New Product
            </button>

        </div>
        <div class="col-sm">
            <button class="delete-selected-button" onclick="window.location='./Products/deleteSelectedProducts.php'"><i
                        class="bi bi-trash-fill"></i>Delete Multiple Products
            </button>


        </div>

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
                <th scope="col">Product UPC</th>
                <th scope="col">Product Price</th>
                <th scope="col">Product Category</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <?php while ($row = $stmt->fetchObject()): ?>
            <tbody>
            <tr>
                <td><?php echo $row->Product_ID; ?> </td>
                <td><?php echo $row->Product_Name; ?> </td>
                <td><?php echo $row->Product_UPC; ?> </td>
                <td><?php echo $row->Product_Price; ?> </td>
                <td><?php echo $row->Product_Category; ?> </td>
                <td>
                    <button class="action-button"
                            onclick="window.location='./Products/viewProducts.php?id=<?= $row->Product_ID ?>'">View
                    </button>
                    <button class="action-button"
                            onclick="window.location='./Products/updateProducts.php?id=<?= $row->Product_ID ?>'">Update
                    </button>
                    <button class="action-button"
                            onclick="window.location='./Products/deleteProducts.php?id=<?= $row->Product_ID ?>'">Delete
                    </button>
                </td>
                <?php endwhile; ?>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<?php include('../Menu/footer.php'); ?>
</body>

</html>

