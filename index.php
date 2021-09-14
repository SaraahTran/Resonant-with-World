<html>

<head>
    <title>Resonant With World</title>
    <!--CSS-->
    <link rel="stylesheet" type="text/css" href="Styles/style.css"/>
    <!--Bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!--Fonts and Icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400;500;600;700;800&display=swap" rel="stylesheet">
</head>

<body>

<?php include('./menu.php');?>

<h1>Resonant With World</h1>

<div class="row"><div class="col-8">
<div class="card big-card">
    <h5 class="card-header">Calendar</h5>
    <div class="card-body">
        <p class="card-text">
        <div class="calendar">
        <div class="month">
            <ul>
                <li class="prev">&#10094;</li>
                <li class="next">&#10095;</li>
                <li><?php echo date('F Y', mktime(0, 0, 0, date('m'), 1, date('Y')));?> <br/>
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
            <li>1</li><li>2</li><li>3</li><li>4</li><li>5</li><li>6</li><li>7</li><li>8</li><li>9</li><li>10</li>
            <li>11</li><li>12</li><li>13</li><li>14</li><li>15</li><li>16</li><li>17</li><li>18</li><li>19</li>
            <li>21</li><li>22</li><li>23</li><li>24</li><li>25</li><li>26</li><li>27</li></li><li>28</li><li>29</li>

        </ul>
        </p>
    </div></div>
</div></div>
    <div class="col-4">

        <div class="card big-card">
            <h5 class="card-header">Upcoming Photoshoots</h5>
            <div class="card-body">
                <p class="card-text">
                </p>
            </div>
    </div>


</div></div>

    <br/>

    <div class="row d-flex justify-content-center">
        <div class="col">
            <div class="card small-card" >
                <div class="card-body">
                    <h5 class="card-title">Total Clients</h5>
                    <p class="card-text count">20</p>
                </div>
            </div>

        </div>
        <div class="col"><div class="card small-card" >
                <div class="card-body">
                    <h5 class="card-title">Total Products</h5>
                    <p class="card-text count">30</p>
                </div>
            </div></div>
        <div class="col"><div class="card small-card">
                <div class="card-body">
                    <h5 class="card-title">Total Photoshoots</h5>
                    <p class="card-text count">20</p>
                </div>
            </div></div>
        <div class="col"><div class="card small-card" >
                <div class="card-body">
                    <h5 class="card-title">Total Categories</h5>
                    <p class="card-text count">4</p>
                </div>
            </div></div>
    </div>



</body>


</html>

