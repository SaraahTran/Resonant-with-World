<?php
$PAGE_ID = "home";
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
<?php include('./Menu/menu.php'); ?>
<?php
include('./connection.php');
global $dbh;
$stmt = $dbh->prepare("SELECT * FROM `Photo_Shoot`");
$stmt->execute();
?>
<div class="container">



    <h1>Resonant With World</h1>

    <div class="row">
        <div class="col-8">
            <div class="card big-card">
                <h5 class="card-header">Calendar</h5>
                <div class="card-body">
                    <p class="card-text">
                    <div class="calendar">
                        <div class="month">
                            <ul>
                                <li class="prev">&#10094;</li>
                                <li class="next">&#10095;</li>
                                <li><?php echo date('F Y', mktime(0, 0, 0, date('m'), 1, date('Y'))); ?> <br/>
                                    <span class="today"><?php
                                        echo "Today is " . date("d/m/Y") ?></span></li>
                            </ul>
                        </div>

                        <ul class="weekdays">
                            <li>Mon</li>
                            <li>Tue</li>
                            <li>Wed</li>
                            <li>Thu</li>
                            <li>Fri</li>
                            <li>Sat</li>
                            <li>Sun</li>
                        </ul>

                        <ul class="days">
                            <li>1</li>
                            <li>2</li>
                            <li>3</li>
                            <li>4</li>
                            <li>5</li>
                            <li>6</li>
                            <li>7</li>
                            <li>8</li>
                            <li>9</li>
                            <li>10</li>
                            <li>11</li>
                            <li>12</li>
                            <li>13</li>
                            <li>14</li>
                            <li>15</li>
                            <li>16</li>
                            <li>17</li>
                            <li>18</li>
                            <li>19</li>
                            <li>21</li>
                            <li>22</li>
                            <li>23</li>
                            <li>24</li>
                            <li>25</li>
                            <li>26</li>
                            <li>27</li>
                            <li>28</li>
                            <li>29</li>

                        </ul>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">

            <div class="card big-card">
                <h5 class="card-header">Upcoming Photoshoots</h5>
                <div class="card-body">
                    <p class="card-photoshoot">
                        <?php
                        $photoshoot_stmt = $dbh->prepare("SELECT * FROM PHOTO_SHOOT ORDER BY PHOTO_SHOOT_DATETIME DESC LIMIT 5");
                        $photoshoot_stmt->execute();
                        while ($row = $photoshoot_stmt->fetch()): ?>
                    <div>
                        <li class=photoshoot-list><input type="checkbox"> <?php echo $row["Photo_Shoot_Name"] ?></li>
                        <div class="flex-row-reverse">
                            <div class=photoshoot-date><?php echo $row["Photo_Shoot_DateTime"]; ?>
                                <br/><br/></div>
                        </div>
                    </div>

                    <?php endwhile;
                    ?>


                </div>
            </div>


        </div>
    </div>

    <br/>

    <div class="row d-flex justify-content-center">
        <div class="col">
            <div class="card small-card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm">
                            <h5 class="card-title">Total Clients</h5>
                            <p class="card-text count">
                                <?php
                                $count1 = $dbh->query("SELECT COUNT(*) FROM Client");
                                $count_client = $count1->fetchColumn();
                                echo $count_client;
                                ?>
                            </p>
                        </div>

                        <div class="col-sm">

                            <i class="card-icon bi bi-people-fill"></i>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col">
            <div class="card small-card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm">
                            <h5 class="card-title">Total Products</h5>
                            <p class="card-text count">
                                <?php
                                $count2 = $dbh->query("SELECT COUNT(*) FROM Product");
                                $count_product = $count2->fetchColumn();
                                echo $count_product; ?>
                            </p>
                        </div>

                        <div class="col-sm">

                            <i class="card-icon bi bi-bag-fill"></i>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <div class="col">
            <div class="card small-card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm">
                            <h5 class="card-title">Total Photoshoots</h5>
                            <p class="card-text count">
                                <?php
                                $count3 = $dbh->query("SELECT COUNT(*) FROM Photo_Shoot");
                                $count_photoshoot = $count3->fetchColumn();
                                echo $count_photoshoot;
                                ?>
                            </p>
                        </div>

                        <div class="col-sm">

                            <i class="card-icon bi bi-camera-fill"></i>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        <div class="col">
            <div class="card small-card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm">
                            <h5 class="card-title">Total Categories</h5>
                            <p class="card-text count">
                                <?php
                                $count4 = $dbh->query("SELECT COUNT(*) FROM Category");
                                $count_category = $count4->fetchColumn();
                                echo $count_category;
                                ?>
                            </p>
                        </div>

                        <div class="col-sm">

                            <i class="card-icon bi bi-tags-fill"></i>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>


</div>
<

<?php include('./Menu/footer.php'); ?>
</body>


</html>


