<html lang="en">
<head>
    <title>Resonant With World Client </title>
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

    <h1>Documentation</h1>

    <div class=" table-responsive">
        <table class="table table-bordered responsive">
            <thead>
            <tr>
                <th>Tasks</th>
                <th>Martin Li 30584280</th>
                <th>Sarah Tran 30584930</th>
            </tr>
            <tr>
                <td>Clients</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Products</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Multiple Products</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Photoshoots</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Categories</td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td>Images</td>
                <td></td>
                <td></td>
            </tr>
            </thead>
        </table>
    </div>

    <h3>GitLab Repository</h3>
    <p><a href="https://git.infotech.monash.edu/fit2104-cl/fit2104-2021-s2/pair_lab01_manzur_02/fit2104_assignment_2"><a
                    href="https://git.infotech.monash.edu/fit2104-cl/fit2104-2021-s2/pair_lab01_manzur_02/fit2104_assignment_2">GitLab
                Repository</a></p>
    <br/>
    <h4>Credentials</h4>
    <p>Username: </p>
    <p>Password: </p>
    <br/>

    <h4>Database Scheme and Demo Data SQL</h4>
    <br/>

    <h4>Clients</h4>
    <br/>
    <h4>Products</h4>
    <br/>
    <h4>Photoshoots</h4>
    <br/>
    <h4>Categories</h4>
    <br/>


    <h4>MySQL</h4>
    <?php
    show_source("../connection.php");
    echo "<br/> ";
    ?>

    <?php include('../Menu/footer.php'); ?></div>
</body>

</html>