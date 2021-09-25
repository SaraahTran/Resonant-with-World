<?php
$PAGE_ID = "products_add";
$PAGE_HEADER = "Add new product";
?>

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
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;4000;800&display=swap" rel="stylesheet">
</head>


<body>


</table>

<?php include('../Menu/menu.php'); ?>
<div class="container">
    <div class="row">
        <div class="col-sm">
            <h1>Clients</h1>
            <p class="description">You can manage your clients here.</p>
        </div>

        <div class="col-sm">
            <button class="add-button" onclick="window.location='./Clients/insertClients.php'"><span
                        class="icon-button left-align"><i class="bi bi-plus-circle-fill"></i></span>Add New Client
            </button>
            <button class="delete-selected-button" onclick="window.location='./Clients/deleteSelectedClients.php'"><i
                        class="bi bi-trash-fill"></i>Delete Multiple Clients
            </button>
            <br/>
            <button class="delete-selected-button" onclick="window.location='./Clients/email.php'"><i
                        class="bi bi-envelope-fill"></i>Email Clients
            </button>
            <button class="add-button" onclick="window.location='./Clients/pdf.php'"><i class="bi bi-file-earmark-pdf-fill"></i>Generate PDF
            </button>

        </div>

    </div>
    <?php
    include('../connection.php');
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
                <th style="width:5%" scope="col">Sub</th>
                <th style="width:5%" scope="col">Other</th>
                <th style="width:25%" scope="col">Actions</th>
            </tr>
            </thead>
            <?php while ($row = $stmt->fetchObject()): ?>
            <tbody>
            <tr>
                <td style="width:5%" > <?php echo $row->Client_ID; ?> </td>
                <td style="width:5%" ><?php echo $row->Client_FirstName; ?> </td>
                <td><?php echo $row->Client_Surname; ?> </td>
                <td><?php echo $row->Client_Address; ?> </td>
                <td style="width:5%" ><?php echo $row->Client_Phone; ?> </td>
                <td style="width:10%"><?php echo $row->Client_Email; ?> </td>
                <td style="width:5%"><?php echo $row->Client_Subscribed; ?> </td>
                <td style="width:5%"><?php echo $row->Client_Other_Information; ?> </td>
                <td style="width:25%">
                    <button type="button" class="action-button" data-toggle="tooltip" data-placement="top" title="View"
                            onclick="window.location='./Clients/viewClients.php?id=<?= $row->Client_ID ?>'"><i
                                class="center bi bi-eye-fill"></i></button>
                    <button class="action-button" data-toggle="tooltip" data-placement="top" title="Update"
                            onclick="window.location='./Clients/updateClients.php?id=<?= $row->Client_ID ?>'"><i
                                class="center bi bi-pencil-fill"></i></button>
                    <button class="action-button" data-toggle="tooltip" data-placement="top" title="Delete"
                            onclick="window.location='./Clients/deleteClients.php?id=<?= $row->Client_ID ?>'"><i
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

