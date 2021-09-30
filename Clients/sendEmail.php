<html lang="en">
<head>
    <title>Resonant With World Email </title>
    <!--CSS-->
    <link rel="stylesheet" type="text/css" href="../Styles/style.css"/>
    <!--Bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!--Fonts and Icons-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;4000;800&display=swap" rel="stylesheet">
</head>

<?php
include('../Menu/menu.php');
$PAGE_ID = "email";
$PAGE_HEADER = "Sending email to users";

/** @var PDO $dbh Database connection */

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['subject'])) {
        $sendmail_error = true;
        $sendmail_error_message = 'Subject cannot be empty';
    }
    if (empty($_POST['body'])) {
        $sendmail_error = true;
        $sendmail_error_message = 'Message body cannot be empty';
    }
    if (empty($_POST['client_ids'])) {
        $sendmail_error = true;
        $sendmail_error_message = 'You must select at least one user as recipient';
    }

    // Getting emails of selected users
    $query_placeholders = trim(str_repeat("?,", count($_POST['client_ids'])), ",");
    $query = "SELECT * FROM `Client` WHERE `Client_ID` in (" . $query_placeholders . ")";
    $stmt = $dbh->prepare($query);
    if ($stmt->execute($_POST['client_ids'])) {
        if ($stmt->rowCount() != count($_POST['client_ids'])) {
            $sendmail_error = true;
            $sendmail_error_message = 'One of the selected user does not exist';
        } else {
            $email_recipients = [];
            while ($row = $stmt->fetchObject()) $email_recipients[] = $row->Client_FirstName . " <" . $row->Client_Email . ">";
            $email_recipients = implode(",", $email_recipients);
            $email_subject = $_POST['subject'];
            // Process email body when necessary (i.e. on Windows server)
            $email_body = $_POST['body'];
            if (stristr(PHP_OS, 'WIN')) $email_body = str_replace("\n.", "\n..", $_POST['body']);
            // Finally, send the email!
            if (!@mail($email_recipients, $email_subject, $email_body)) {
                $sendmail_error = true;
                $sendmail_error_message = error_get_last()['message'];
            }
        }
    } else {
        $sendmail_error = true;
        $sendmail_error_message = $stmt->errorInfo()[2];
    }

} else {
    $sendmail_invalid = true;
}

?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800 pb-2">Sending email to users</h1>

        <?php if (isset($sendmail_invalid) && $sendmail_invalid): ?>
        <div class="container">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-warning">Invalid request! </h6>
                </div>
                <div class="card-body">
                    <p>It seems the request to send emails is invalid. </p>
                    <p>Please fix any issues or contact the administrator for help. </p>
                    <p>Click the button below to go back to the previous page. </p>
                    <a href="email.php" class="btn btn-warning btn-icon-split">
                        <span class="icon text-white-50"><i class="fas fa-arrow-alt-circle-left"></i></span>
                        <span class="text">Back to send email page</span>
                    </a>
                </div>
            </div></div>

        <?php elseif (isset($sendmail_error) && $sendmail_error): ?>
        <div class="container">
            <div class="col-8">
            <div class="card card-bigger">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-danger">Emails did not sent correctly! </h6>
                </div>
                <div class="card-body">
                    <p>There was an error during the sending process. Here's the error message: </p>
                    <div class="mb-2">
                        <code><?= (isset($sendmail_error_message) && !empty($sendmail_error_message)) ? $sendmail_error_message : "Unknown error. Please contact the administrator. " ?></code>
                    </div>
                    <p>Please fix any issues or contact the administrator for help. </p>
                    <p>Click the button below to go back to the previous page. </p>
                    <a href="email.php" class="btn btn-danger btn-icon-split">
                        <span class="icon text-white-50"><i class="fas fa-arrow-alt-circle-left"></i></span>
                        <span class="text">Back to send email page</span>
                    </a>
                </div></div>
            </div></div>

        <?php else: ?>
        <div class="container">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold">Emails sent successfully! </h6>
                </div>
                <div class="card-body">
                    <p>Your message has been sent successfully. Click the button below to go back to the previous page. </p>
                <br/><br/>
                    <a href="email.php" class="send-email-button">
                        Back to send email page
                    </a>
                </div>
            </div></div>

        <?php endif; ?>
    </div>
    <!-- /.container-fluid -->

<?php include('../Menu/footer.php'); ?>