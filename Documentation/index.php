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


<?php
include('../Menu/menu.php');
global $dbh;
?>
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
                <td>35%</td>
                <td>65%</td>
            </tr>
            <tr>
                <td>Products</td>
                <td>35%</td>
                <td>65%</td>
            </tr>
            <tr>
                <td>Multiple Products</td>
                <td>60%</td>
                <td>40%</td>
            </tr>
            <tr>
                <td>Photoshoots</td>
                <td>50%</td>
                <td>50%</td>
            </tr>
            <tr>
                <td>Categories</td>
                <td>35%</td>
                <td>65%</td>
            </tr>
            <tr>
                <td>Images</td>
                <td>65%</td>
                <td>35%</td>
            </tr>
            <tr>
                <td>Documentation</td>
                <td>50%</td>
                <td>50%</td>
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
    <p>Username: Anna</p>
    <p>Password: $ol@nn@</p>
    <br/>

    <h4>Database Scheme and Demo Data SQL</h4>
    <a href="../Schema%20and%20Data/schema.sql">Schema</a>
    <br/>
    <br/>

    <h4>Clients</h4>
    <p><b>Total Number of Clients: </b>
        <?php
        $count1 = $dbh->query("SELECT COUNT(*) FROM Client");
        $count_client = $count1->fetchColumn();
        echo $count_client;
        ?>
    </p>
    <?php
    global $dbh;
    $stmt = $dbh->prepare("SELECT * FROM `Client`");
    $stmt->execute();
    ?>
    <div class=" table-responsive">
        <table class="table table-bordered responsive table-condensed">
            <thead>
            <tr>
                <th style="width:5%"  scope="col">ID</th>
                <th style="width:5%"  scope="col">First Name</th>
                <th scope="col">Surname</th>
                <th scope="col">Address</th>
                <th style="width:5%" scope="col">Phone</th>
                <th style="width:10%"scope="col">Email</th>
                <th style="width:5%" scope="col">Subscribe</th>
                <th style="width:5%" scope="col">Other Information</th>
            </tr>
            </thead>
            <?php
            function yesNo($n)
            {
                return $n == 1 ? 'Yes' : 'No';
            }
            while ($row = $stmt->fetchObject()): ?>
            <tbody>
            <tr>
                <td style="width:5%" > <?php echo $row->Client_ID; ?> </td>
                <td style="width:5%" ><?php echo $row->Client_FirstName; ?> </td>
                <td><?php echo $row->Client_Surname; ?> </td>
                <td><?php echo $row->Client_Address; ?> </td>
                <td style="width:5%" ><?php echo $row->Client_Phone; ?> </td>
                <td style="width:10%"><?php echo $row->Client_Email; ?> </td>
                <td style="width:5%"><?php echo yesNo($row->Client_Subscribed); ?> </td>
                <td style="width:5%"><?php echo $row->Client_Other_Information; ?> </td>
                <?php endwhile;
                ?>
            </tr>
            </tbody>
        </table>
    </div>
    <br/>
    <h4>Products</h4>
<p><b>Total Number of Products: </b>
    <?php
    $count2 = $dbh->query("SELECT COUNT(*) FROM Product");
    $count_product = $count2->fetchColumn();
    echo $count_product; ?>
</p>
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
            <?php endwhile; ?>
        </tr>
        </tbody>
    </table>
</div>
    <br/>
    <h4>Photoshoots</h4>
    <p><b>Total Number of Photoshoots: </b>
        <?php
        $count3 = $dbh->query("SELECT COUNT(*) FROM Photo_Shoot");
        $count_photoshoot = $count3->fetchColumn();
        echo $count_photoshoot;
        ?>
    </p>
<?php
global $dbh;
$stmt = $dbh->prepare("SELECT * FROM `Photo_Shoot`");
$stmt->execute();
?>
<div class="table-responsive">
    <table class="table table-bordered responsive">
        <thead>

        <tr>
            <th scope="col">ID</th>
            <th scope="col">Client ID</th>
            <th scope="col">Photoshoot Name</th>
            <th scope="col">Photoshoot Description</th>
            <th scope="col">Photoshoot Date and Time</th>
            <th scope="col">Photoshoot Quote</th>
            <th scope="col">Photoshoot Other Information</th>

        </tr>
        </thead>
        <?php while ($row = $stmt->fetchObject()): ?>

        <tr class="rows">
            <td><?php echo $row->Photo_Shoot_ID; ?> </td>
            <td><?php echo $row->Client_ID; ?> </td>
            <td><?php echo $row->Photo_Shoot_Name; ?> </td>
            <td><?php echo $row->Photo_Shoot_Description; ?> </td>
            <td><?php echo $row->Photo_Shoot_DateTime; ?> </td>
            <td>$<?php echo $row->Photo_Shoot_Quote; ?> </td>
            <td><?php echo $row->Photo_Shoot_Other_Information; ?> </td>
            <?php endwhile; ?>
        </tr>
    </table>
</div>
    <br/>
    <h4>Categories</h4>
    <p><b>Total Number of Categories: </b>
        <?php
        $count4 = $dbh->query("SELECT COUNT(*) FROM Category");
        $count_category = $count4->fetchColumn();
        echo $count_category;
        ?>
    </p>
<?php
global $dbh;
$stmt = $dbh->prepare("SELECT * FROM `Category`");
$stmt->execute();
?>
<div class="table-responsive">
    <table class="table table-bordered responsive table-condensed">
        <thead>
        <tr>
            <th style="width:33.33%" scope="col">ID</th>
            <th style="width:33.33%" scope="col">Category Name</th>

        </tr>
        </thead>
        <?php while ($row = $stmt->fetchObject()): ?>
        <tbody>
        <tr>
            <td style="width:33.33%"><?php echo $row->Category_ID; ?> </td>
            <td style="width:33.33%"><?php echo $row->Category_Name; ?> </td>
            <?php endwhile; ?>
        </tr>
        </tbody>
    </table>

</div>
    <br/>
    <h4>Images</h4>
    <p><b>Total Number of Images: </b>
        <?php
        $count5 = $dbh->query("SELECT COUNT(*) FROM Product_Image");
        $count_image = $count5->fetchColumn();
        echo $count_image;
        ?>
        <?php
        global $dbh;
        $stmt = $dbh->prepare("SELECT * FROM `Product_Image`");
        $stmt->execute();
        ?>
    <div class="table-responsive">
        <table class="table table-bordered responsive table-condensed">
            <thead>
            <tr>
                <th style="width:5%" scope="col">ID</th>
                <th style="width:5%" scope="col">Product ID</th>
                <th style="width:5%" scope="col">Image File Name</th>
                <th style="width:5%" scope="col">Image</th>


            </tr>
            </thead>
            <?php while ($row = $stmt->fetchObject()): ?>
            <tbody>
            <tr>
                <td style="width:5%"><?php echo $row->Product_Image_ID; ?> </td>
                <td style="width:5%"><?php echo $row->Product_ID; ?> </td>
                <td style="width:5%"><?php echo $row->Product_Image_File_name; ?> </td>
                <td style="width:5%"><?php echo "<img class='image' src='../Products/product_images/$row->Product_Image_File_name' /> ";?> </td>
                <?php endwhile; ?>
            </tr>
            </tbody>
        </table>

    </div>

    <h4>MySQL</h4>
    <?php
    show_source("connection.php");
    echo "<br/> ";
    ?>

    <?php include('../Menu/footer.php'); ?>

</div>


</div>

</body>

</html>