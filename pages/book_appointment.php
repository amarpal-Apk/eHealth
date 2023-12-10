<?php 
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

include 'config.php';

$id=$_GET['id'];

$healthid = $_SESSION["username"];

$dctr=$user="0";

$sql= "SELECT  name,email,time FROM doctor WHERE id=$id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$dname=$row["name"];
$demail=$row["email"];
$time=$row["time"];

$sql1= "SELECT  name,email,mobile,dob FROM user WHERE healthid=$healthid";
$result1 = mysqli_query($conn, $sql1);
$row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);
$uname=$row1["name"];
$uemail=$row1["email"];
$umobile=$row1["mobile"];
$udob=$row1["dob"];

//send maail to doctor

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
$mail->addAddress($demail, "user");     // Add a recipient

$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = "Email Varification";
$mail->Body    = 'Hi!!! '.$dname.''.'<br>'.'You have an appointment at'.$time.'<br>'.'Details: '.'<br>'.'Name: '.$uname.'<br>'.'Dob: '.$udob.'<br>'.'Mobile: '.$umobile.'';

$mail->AltBody = "This is the body in plain text for non-HTML mail clients";

if (!$mail->send()) {
    echo "Message could not be sent to docter.";
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    // echo "Message has been sent";
    $dctr="1";
}


//send maail to user

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
$mail->addAddress($uemail, "user");     // Add a recipient

$mail->isHTML(true);                                  // Set email format to HTML
$link = "<a  href='http://localhost/admin/pages/profile.php'>Click Here</a>";
$mail->Subject = "Email Varification";
$mail->Body    = 'Hi!!! '.$uname.''.'<br>'.'   You have successfully book an appointment to '.'Dr '.$dname.' at '.$time.'<br>'.'For more details '.$link.'';

$mail->AltBody = "This is the body in plain text for non-HTML mail clients";

if (!$mail->send()) {
    echo "Message could not be sent to user.";
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    // echo "Message has been sent";
$user="1";
}




