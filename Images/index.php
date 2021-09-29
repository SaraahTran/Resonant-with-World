
<html lang="en">
<head>
    <title>Resonant With World Image</title>
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
<?php
$PAGE_ID = "image_index";

global $dbh;
$stmt = $dbh->prepare("SELECT * FROM `Product_Image`");
$stmt->execute();
?>
<div class="container">
    <div class="row">
        <div class="col-sm">

            <h1>Images</h1>
            <p class="description">You can manage your images here.</p>

        </div>
        <div class="col-sm">
            <button class="delete-selected-button"
                    onclick="window.location='./Images/deleteSelectedImages.php'"><i
                        class="bi bi-trash-fill"></i>Delete Multiple Images
            </button>


        </div>

    </div>

    <div class="table-responsive">
        <table class="table table-bordered responsive table-condensed">
            <thead>
            <tr>
                <th style="width:5%" scope="col">ID</th>
                <th style="width:5%" scope="col">Product ID</th>
                <th style="width:5%" scope="col">Image File Name</th>

            </tr>
            </thead>
            <?php while ($row = $stmt->fetchObject()): ?>
            <tbody>
            <tr>
                <td style="width:5%"><?php echo $row->Product_Image_ID; ?> </td>
                <td style="width:5%"><?php echo $row->Product_ID; ?> </td>
                <td style="width:5%"><?php echo $row->Product_Image_File_name; ?> </td>

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
