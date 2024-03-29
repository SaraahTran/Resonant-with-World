
<html lang="en">
<head>
    <title>Resonant With World Category</title>
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
<?php
$PAGE_ID = "category_index";

global $dbh;
$stmt = $dbh->prepare("SELECT * FROM `Category`");
$stmt->execute();
?>
<div class="container">
    <div class="row">
        <div class="col-sm">

                <h1>Categories</h1>
                <p class="description">You can manage your categories here.</p>

        </div>
        <div class="col-sm">
            <button class="add-button" onclick="window.location='./Categories/insertCategories.php'"><i
                        class="bi bi-plus-circle-fill"></i>Add New Category
            </button>
            <button class="delete-selected-button"
                    onclick="window.location='./Categories/deleteSelectedCategories.php'"><i
                        class="bi bi-trash-fill"></i>Delete Multiple Categories
            </button>


        </div>

    </div>

    <div class="table-responsive">
        <table class="table table-bordered responsive table-condensed">
            <thead>
            <tr>
                <th style="width:33.33%" scope="col">ID</th>
                <th style="width:33.33%" scope="col">Category Name</th>
                <th style="width:33.33%" scope="col">Actions</th>

            </tr>
            </thead>
            <?php while ($row = $stmt->fetchObject()): ?>
            <tbody>
            <tr>
                <td style="width:33.33%"><?php echo $row->Category_ID; ?> </td>
                <td style="width:33.33%"><?php echo $row->Category_Name; ?> </td>
                <td style="width:33.33%">
                    <button type="button" class="action-button" data-toggle="tooltip" data-placement="top" title="View"
                            onclick="window.location='./Categories/viewCategories.php?id=<?= $row->Category_ID ?>'"><i
                                class="center bi bi-eye-fill"></i></button>
                    <button class="action-button" data-toggle="tooltip" data-placement="top" title="Update"
                            onclick="window.location='./Categories/updateCategories.php?id=<?= $row->Category_ID ?>'"><i
                                class="center bi bi-pencil-fill"></i></button>
                    <button class="action-button" data-toggle="tooltip" data-placement="top" title="Delete"
                            onclick="window.location='./Categories/deleteCategories.php?id=<?= $row->Category_ID ?>'"><i
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
