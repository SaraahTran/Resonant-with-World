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

<?php include('../Menu/menu.php');
global $dbh;
?>

<?php
if (empty($_GET['search'])) {
    $search = "";
} else {
    $search = $_GET['search'];
}
$stmt = "Select * from Product where Product_UPC like '%$search%'";
$res = $dbh->query($stmt);


?>


<div class="container">
    <h1>Search</h1>
    <div class="row">
        <div class="col-sm">
            <button class="back-full-button" onclick="window.location='/Products'"><i
                        class="bi bi-arrow-left-circle-fill"></i>Back to Full List
            </button>
        </div>

        <div class="col-sm">
            <button class="delete-selected-button2" onclick="window.location='./searchProducts.php'"><i
                        class="bi bi-x-circle-fill"></i>Reset Search
            </button>
        </div>

    </div>

    <br/>
    <form>

        <div class="input-group mb-3">
            <form id="searchForm" action="" method="get">
                <input type="text" class="search form-control search-input " name="search" id="search"
                       placeholder="Search by Product UPC"
                       aria-label="Search by Product UPC" aria-describedby="basic-addon2">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary search-button" type="submit" name="submit"><i
                                class="bi bi-search"></i>
                    </button>
                </div>
        </div>


    </form>


    <div class=" table-responsive">

        <table class="table table-bordered responsive">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Product Name</th>
                <th scope="col">Product UPC</th>
                <th scope="col">Product Price</th>
                <th scope="col">Product Category</th>

            </tr>
            </thead>

            <tbody>

            <?php if ($res->rowCount() > 0) {
                while ($row = $res->fetch()) {

                    ?>
                    <tr>
                        <?php

                        echo ' <td>  ' . $row["Product_ID"] . ' </td>';
                        echo '<td>' . $row["Product_Name"] . '</td>';
                        echo '<td>' . $row["Product_UPC"] . '</td>';
                        echo '<td>' . $row["Product_Price"] . '</td>';
                        echo '<td>' . $row["Product_Category"] . '</td>';

                        ?>

                    </tr>
                <?php }
            } else {
                ?>


                <tr>
                    <td colspan="5">No records found</td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>

</div>

</html>