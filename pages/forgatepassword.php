<?php

include 'config.php';


$password = $smg = $err =  $email_send="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $healthid = $_POST['healthid'];

    //validating date of birth

    if (isset($_POST['date'])) {
        $date = input_data($_POST["date"]);
        if ($date == "0") {
            $dob_err = "Please select dob";
        }
    }
    if (isset($_POST['month'])) {
        $month = input_data($_POST["month"]);
        if ($month == "0") {
            $dob_err = "Please select dob";
        }
    }
    if (isset($_POST['year'])) {
        $year = input_data($_POST["year"]);
        if ($year == "0") {
            $dob_err = "Please select dob";
        }
    }

    $dob = $date . "/" . $month . "/" . $year;



    $sql = "select *from user where healthid = '$healthid' and dob= '$dob'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        // echo "<h1><center> Login successful </center></h1>";
        $sql = "SELECT * FROM user where healthid = '$healthid' ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $email=$row["email"];
                $password = $row["password"];
                $smg = "Your Old Password is :- " . $password;

                require 'PHPMailer\PHPMailerAutoload.php';

                $mail = new PHPMailer;

                //$mail->SMTPDebug = 3;                               // Enable verbose debug output

                $mail->isSMTP();                                      // Set mailer to use SMTP
                $mail->Host = 'smtp.gmail.com';                 // Specify main and backup SMTP servers
                $mail->SMTPAuth = true;                               // Enable SMTP authentication
                $mail->Username = 'amarpal50511@gmail.com';                 // SMTP username
                $mail->Password = '#Amarpal=$$$@7782036010';                           // SMTP password
                $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                $mail->Port = 587;                                    // TCP port to connect to

                $mail->setFrom('amarpal50511@gmail.com', 'eHEALTH');
                $mail->addAddress($email, 'user');     // Add a recipient

                $mail->isHTML(true);                                  // Set email format to HTML

                $mail->Subject = 'Password Recovery';
                $mail->Body    = 'This is your old password associated with email id '.$email.' is '.'<b>'. $password.'</b>' ;
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                if (!$mail->send()) {
                    echo 'Message could not be sent.';
                    echo 'Mailer Error: ' . $mail->ErrorInfo;
                } else {
                    echo 'Email has been sent';
                    $email_send="Your Password is sent to resistered email id";
                }



            }
        }
    } else {
        $err = "Invalid Healthid or dob.";
    }
}

function input_data($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Forgate Password</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Aclonica&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alfa+Slab+One&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/untitled.css">
    <style>
           .smg{
            background-color: #2eff6d;
            color: white;
            text-align: center;
            font-size: 20px;
            font-weight:bold;
            border-radius: 10px;
           
        }
        .err{
            background-color: #ff1f1f;
            color: white;
            text-align: center;
            font-size: 20px;
            font-weight:bold;
            border-radius: 10px;
           
        }
    </style>
</head>

<body style="background: var(--bs-gray-200);">
    <div class="container">
        <div class="row d-lg-flex justify-content-lg-center" style="border-color: var(--bs-purple);border-left-color: var(--bs-pink);">
            <div class="col-4" style="height: 300px;">
                <div class="card" style="margin-top: 30px;background: var(--bs-white);box-shadow: 0px 0px 9px var(--bs-indigo);border-radius: 10px;">
                    <div class="card-body">
                        <h4 class="text-center card-title" style="font-family: Aclonica, sans-serif;color: var(--bs-pink);font-weight: bold;font-style: italic;">Forgate Password?</h4>
                        <h5 class="smg"><?php echo $smg; ?></h5>
                        <h5 class="err"><?php echo $err; ?></h5>
                        <h5 class="smg"><?php echo $email_send; ?></h5>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <div style="margin-bottom: 10px;">
                                <label class="form-label">Health Id:</label>
                                <input class="form-control" type="text" name="healthid" required="" placeholder="Enter Health Id*">
                            </div>
                            <div style="margin-bottom: 10px;">
                                <label class="form-label">Date of Birth:</label>
                                <div class="d-lg-flex align-items-lg-center">
                                    <select class="form-select" name="date" style="padding: 5px 36px 6px 11px;" required="">
                                        <option value="0" selected="">day</option>
                                        <option value="01">01</option>
                                        <option value="02">02</option>
                                        <option value="03">03</option>
                                        <option value="04">04</option>
                                        <option value="05">05</option>
                                        <option value="06">06</option>
                                        <option value="07">07</option>
                                        <option value="08">08</option>
                                        <option value="09">09</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                        <option value="15">15</option>
                                        <option value="16">16</option>
                                        <option value="17">17</option>
                                        <option value="18">18</option>
                                        <option value="19">19</option>
                                        <option value="20">20</option>
                                        <option value="21">21</option>
                                        <option value="22">22</option>
                                        <option value="23">23</option>
                                        <option value="24">24</option>
                                        <option value="25">25</option>
                                        <option value="26">26</option>
                                        <option value="27">27</option>
                                        <option value="28">28</option>
                                        <option value="29">29</option>
                                        <option value="30">30</option>
                                        <option value="31">31</option>
                                    </select>
                                    <select class="form-select" name="month" style="margin-right: 8px;margin-left: 8px;" required="">
                                        <option value="0" selected="">month</option>
                                        <option value="01"> 01</option>
                                        <option value="02"> 02</option>
                                        <option value="03"> 03</option>
                                        <option value="04"> 04</option>
                                        <option value="05"> 05</option>
                                        <option value="06"> 06</option>
                                        <option value="07"> 07</option>
                                        <option value="08"> 08</option>
                                        <option value="09"> 09</option>
                                        <option value="10"> 10</option>
                                        <option value="11"> 11</option>
                                        <option value="12"> 12</option>
                                    </select>
                                    <select class="form-select" name="year" required="">
                                        <option value="0" selected="">year</option>
                                        <option value="1980">1980</option>
                                        <option value="1981">1981</option>
                                        <option value="1982">1982</option>
                                        <option value="1983">1983</option>
                                        <option value="1984">1984</option>
                                        <option value="1985">1985</option>
                                        <option value="1986">1986</option>
                                        <option value="1987">1987</option>
                                        <option value="1988">1988</option>
                                        <option value="1989">1989</option>
                                        <option value="1990">1990</option>
                                        <option value="1991">1991</option>
                                        <option value="1992">1992</option>
                                        <option value="1993">1993</option>
                                        <option value="1994">1994</option>
                                        <option value="1995">1995</option>
                                        <option value="1996">1996</option>
                                        <option value="1997">1997</option>
                                        <option value="1998">1998</option>
                                        <option value="1999">1999</option>
                                        <option value="2000">2000</option>
                                        <option value="2001">2001</option>
                                        <option value="2002">2002</option>
                                        <option value="2003">2003</option>
                                        <option value="2004">2004</option>
                                        <option value="2005">2005</option>
                                        <option value="2006">2006</option>
                                        <option value="2007">2007</option>
                                        <option value="2008">2008</option>
                                        <option value="2009">2009</option>
                                        <option value="2010">2010</option>
                                        <option value="2011">2011</option>
                                        <option value="2012">2012</option>
                                        <option value="2013">2013</option>
                                        <option value="2014">2014</option>
                                        <option value="2015">2015</option>
                                        <option value="2016">2016</option>
                                        <option value="2017">2017</option>
                                        <option value="2018">2018</option>
                                        <option value="2000">2019</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                        <option value="2022">2022</option>
                                    </select>
                                </div>
                            </div>
                            <div class="text-center" style="margin-top: 20px;">
                                <input type="submit" class="btn btn-primary w-100" value="Submit">
                            </div>
                            <div style="margin-top: 25px;">
                                <div class="row">
                                    <div class="col" style="text-align: left;"><a href="forgatehealthid.php">Forgate
                                            Healthid ?</a>
                                    </div>
                                    <div class="col" style="text-align: center;"><a href="login.php">Back to Login</a>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>