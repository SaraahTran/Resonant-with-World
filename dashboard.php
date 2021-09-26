<?php
$PAGE_ID = "dashboard";
$PAGE_HEADER = "Welcome";
$PAGE_ALLOWGUEST = true; // Homepage should allow guest to visit
?>

<html lang="en">

<head>
    <title>Resonant With World</title>
    <!--CSS-->
    <link rel="stylesheet" type="text/css" href="Styles/style.css"/>
    <!--Bootstrap-->
    <link rel="stylesheet" href="https://¬stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!--Fonts and Icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400;500;600;700;800&display=swap"
          rel="stylesheet">
</head>

<body>
<?php include('./Menu/menu.php');
?>
<div class="container">


    <h1>Welcome to Resonant With World</h1>
    <br>
    <p>Please select one of the features from sidebar to manage the business.</p>

    <div class="row">
        <div class="col-sm">

<a class="card-link" href="/Clients">
            <div class="card card-bigger">
                <h5 class="card-header">Manage Clients</h5>
                <i class="big-icon bi bi-people-fill"></i>
                <div class="card-body">
                    <hr>
                    <p class="card-manage">
                        Add and manage your client details.
                    </p>

                </div>

            </div></a>

        </div>


        <div class="col-sm">


            <a class="card-link" href="/Products">
                <div class="card card-bigger">
                    <h5 class="card-header">Manage Products</h5>
                    <i class="big-icon bi bi-bag-fill"></i>
                    <div class="card-body">
                        <hr>
                        <p class="card-manage">
                            Add and manage your product details.
                        </p>

                    </div>

                </div></a>
        </div>

        <div class="col-sm">


            <a class="card-link" href="/Photoshoots">
                <div class="card card-bigger">
                    <h5 class="card-header">Manage Photoshoots</h5>
                    <i class="big-icon bi bi-camera-fill"></i>
                    <div class="card-body">
                        <hr>
                        <p class="card-manage">
                            Add and manage your photoshoot details.
                        </p>

                    </div>

                </div></a>

        </div>

        <div class="col-sm">


            <a class="card-link" href="/Categories">
                <div class="card card-bigger">
                    <h5 class="card-header">Manage Categories</h5>
                    <i class="big-icon bi bi-tags-fill"></i>
                    <div class="card-body">
                        <hr>
                        <p class="card-manage">
                            Add and manage your category details.
                        </p>

                    </div>

                </div></a>

        </div></div>



</div>

<?php include('./Menu/footer.php'); ?>
</body>


</html>


