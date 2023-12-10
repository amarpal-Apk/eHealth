<?php
if (isset($_GET['vkey'])) {
    //  process varification
    $vkey = $_GET['vkey'];

    $smg = $smgb = "";

    include 'config.php';

    // $mysqli = new MySQLi('localhost', 'root', '', 'health');

    $resultset = $mysqli->query("SELECT varified , vkey FROM user WHERE varified=0 AND vkey = '$vkey' LIMIT 1");

    if ($resultset->num_rows == 1) {

        //   validateemail
        $update = $mysqli->query("UPDATE user SET varified = 1 WHERE vkey='$vkey' LIMIT 1");
        if ($update) {
            $smg = "your account has been varified ";
            $smgb = "You may now login";
            
            $sql = "select *from user where vkey= '$vkey'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

            $healthid=$row['healthid'];
            $email=$row['email'];

            require "PHPMailer\PHPMailerAutoload.php";

            $mail = new PHPMailer;

            //$mail->SMTPDebug = 3;                               // Enable verbose debug output

            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = "smtp.gmail.com";                 // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;                               // Enable SMTP authentication
            $mail->Username = "amarpal50511@gmail.com";                 // SMTP username
            $mail->Password = "#Amarpal=$$$@7782036010";                           // SMTP password
            $mail->SMTPSecure = "tls";                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;                                    // TCP port to connect to

            $mail->setFrom("amarpal50511@gmail.com", "eHEALTH");
            $mail->addAddress($email, "user");     // Add a recipient

            $mail->isHTML(true);                                  // Set email format to HTML

            $mail->Subject = "HEALTH ID";
            $mail->Body    = 'This is Your healthid '.$healthid.'';
            $mail->AltBody = "This is the body in plain text for non-HTML mail clients";

            if (!$mail->send()) {
                echo "Message could not be sent.";
                echo "Mailer Error: " . $mail->ErrorInfo;
            } else {
                // echo "Message has been sent";
                // header("location: login.php");
            }


        } else {
            echo $mysqli->error;
        }
    } else {
        $smg = "This Account is invalid or already varified ";
    }
} else {
    die("Somthing went wrong");
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Varified</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Aclonica&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alfa+Slab+One&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/untitled.css">
</head>

<body style="background: var(--bs-gray-200);">
    <div class="container">
        <div class="row d-lg-flex justify-content-lg-center" style="margin-top: 50px;">
            <div class="col-4">
                <div class="card text-center d-lg-flex align-items-lg-center" style="border-radius: 10px;text-shadow: 0px 0px;box-shadow: 0px 0px 10px var(--bs-green);">
                    <div class="card-body" style="text-align: center;">
                        <div>
                            <h4 style=" margin-top:20px;color: var(--bs-teal);"><?php echo $smg; ?></h4>
                            <img src="img/green tick1.png" alt="">
                        </div>
                        <h4 style=" margin-top:20px;color: var(--bs-teal);"><?php echo $smgb; ?></h4>
                        <h4 style=" margin-top:20px;color: var(--bs-teal);"><a href="login.php">Login</a></h4>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
</body>

</html>