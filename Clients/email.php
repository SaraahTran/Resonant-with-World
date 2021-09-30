<html lang="en">
<head>
    <title>Resonant With World Email</title>
    <!--CSS-->
    <link rel="stylesheet" type="text/css" href="../Styles/style.css"/>
    <!--Bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!--Fonts and Icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400;700;800&display=swap" rel="stylesheet">
</head>
<?php
include('../Menu/menu.php');
global $dbh;
?>
<body>
<div class="container">
    <h1>Emails</h1>


    <form method="post" action="sendEmail.php" id="send-emails">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                Select clients you would like to send emails to
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <?php $client_stmt = $dbh->prepare("SELECT * FROM `client` WHERE `Client_Subscribed` = 1");

                    if ($client_stmt->execute() && $client_stmt->rowCount() > 0): ?>
                        <table class="email-table table" width="100%" cellspacing="0">
                            <thead class="email-head">
                            <tr>
                                <th>Send?</th>
                                <th>First Name</th>
                                <th>Surname</th>
                                <th>Email Address</th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php while ($client = $client_stmt->fetchObject()): ?>
                                <tr>
                                    <td class="table-cell-center">
                                        <input type="checkbox" name="client_ids[]" class="emails-to-send"
                                               value="<?php echo $client->Client_ID; ?>"/>
                                    </td>
                                    <td><?= $client->Client_FirstName ?></td>
                                    <td><?= $client->Client_Surname ?></td>
                                    <td><a class="email-link"
                                           href="mailto:<?= $client->Client_Email ?>"><?= $client->Client_Email ?></a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                            </tbody>
                        </table>

                    <?php else: ?>
                        <p class="mb-4">There's no clients in the database. </p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                Compose the email and send
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="sendmailSubject">Subject</label>
                    <input type="text" class="form-control" id="sendmailSubject" name="subject"
                           placeholder="Latest Newsletter!" required>
                </div>
                <div class="form-group">
                    <label for="sendmailMessage">Message</label>
                    <textarea class="form-control" id="sendmailMessage" name="body" rows="5"
                              placeholder="Dear Resonant With World Clients, &#10;&#10;...&#10;&#10;Kind Regards, Anna Sola"
                              required></textarea>
                </div>
                <button type="submit" class="send-button">Send Email</button>
            </div>
        </div>
    </form>
</div>

<?php include('../Menu/footer.php'); ?>
</body>

</html>
