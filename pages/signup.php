<?php

include 'config.php';

// Define variables and initialize with empty values
$smg = "";
$option = $bgroup = $bgroup_err = "";
$healthid = $name = $mobile = $email = $password = $bgroup = $gender = $dob = "";
$healthid_err = $name_err = $mobile_err = $email_err = $password_err = $bgroup_err =  $gender_err = $dob_err = "";

//Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //generating random healthid
    $healthid = rand(1000000000, 9999999999);

    $select = mysqli_query($conn, "SELECT * FROM user WHERE healthid = ' $healthid'");
    if (mysqli_num_rows($select)) {
        exit('This health id exist');
    }

    //validating bgroup

    if (isset($_POST['bgroup'])) {
        $bgroup = $_POST['bgroup'];
        if ($bgroup == "0") {
            $bgroup_err = "Select blood ";
        }
    } else {
        $bgroup_err = "Select blood ";
    }


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

    if (empty($dob)) {
        $dob_err = "Please select dob";
    } else {
        $dob = $dob;
    }



    //name Validation  
    if (empty($_POST["name"])) {
        $name_err = "Name is required";
    } else {
        $name = input_data($_POST["name"]);
        // check if name only contains letters and whitespace  
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $name_err = "Only alphabets and white space are allowed";
        }
    }

    //gender validation
    if (empty($_POST["gender"])) {
        $gender_err = "Gender is required";
    } else {
        $gender = ($_POST["gender"]);
    }

    //Email Validation   
    if (empty($_POST["email"])) {
        $email_err = "Email is required";
    } else {
        $email = input_data($_POST["email"]);
        // check that the e-mail address is well-formed  
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailerr = "Invalid email format";
        }
    }

    //Number Validation  
    if (empty($_POST["mobile"])) {
        $mobile_err = "Mobile no is required";
    } else {
        $mobile = input_data($_POST["mobile"]);
        // check if mobile no is well-formed  
        if (!preg_match("/^[0-9]*$/", $mobile)) {
            $mobile_err = "Only numeric value is allowed.";
        }
        // check if mobile no atart with 6,7,8,9  
        // if (!preg_match("[789][0-9]{9}", $mobile)) {
        //     $mobile_err = "Mobile should start with 6,7,8,9 .";
        // }
        //check mobile no length should not be less and greator than 10  
        if (strlen($mobile) != 10) {
            $mobile_err = "Mobile no must contain 10 digits.";
        }
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have atleast 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    // generate Vkey
    $vkey = md5(time() . $email);


    //insert data in database

    if (empty($name_err) && empty($dob_err) && empty($bgroup_err) && empty($gender_err) && empty($mobile_err) && empty($email_err) && empty($password_err)) {
        $sql = "INSERT INTO user (healthid, name,dob, bgroup, gender,mobile, email, password,vkey)
              VALUES ('$healthid','$name','$dob','$bgroup','$gender' ,'$mobile', '$email','$password','$vkey')";

        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
            $smg = "Sign UP Successfull";
            //send maail

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

            $link = "<a  href='http://localhost/admin/pages/varify.php?vkey=" . $vkey . "'>Click Here</a>";

            $mail->Subject = "Email Varification";
            // $mail->Body    = "<a href='http://localhost/admin/pages/varify.php?vkey=1233455'>Resister Account</a>";
            $mail->Body    = 'Click On This Link to Verify Email ' . $link . '';

            $mail->AltBody = "This is the body in plain text for non-HTML mail clients";

            if (!$mail->send()) {
                echo "Message could not be sent.";
                echo "Mailer Error: " . $mail->ErrorInfo;
            } else {
                // echo "Message has been sent";
                header("location: thankyou.php");
            }



            // header("location: login.php");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        mysqli_close($conn);
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
    <title>signup</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <style>
        .error {
            color: red;
            font-size: small;

        }
         
       .smg{
            background-color:  #2eff6d;
            color: white;
            text-align: center;
            font-size: 20px;
            font-weight:bold;
            border-radius: 10px;
            /* padding: 5px; */
           
        }
    </style>
</head>

<body style="color: var(--bs-light);font-style: italic;background: var(--bs-gray-200);">
    <div class="container">
        <div class="row d-lg-flex justify-content-lg-center" style="margin-top: 40px;margin-bottom: 30px;">
            <div class="col-5" style="border-radius: 10px;">
                <div class="card" style="box-shadow: 0px 0px 11px var(--bs-pink);border-radius: 10px;">
                    <div class="card-body">
                        <h1 style="color: var(--bs-pink);font-weight: bold;font-style: italic;font-family: Aclonica, sans-serif;text-align: center;margin-bottom: 15px;">
                            Signup Form </h1>
                            <span class="smg"> <?php echo $smg; ?></span>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <div style="margin-bottom: 13px;">
                                <label class="form-label" style="color: var(--bs-dark);">Full Name:</label>
                                <!-- <input class="form-control" type="text" name="name" id="name" placeholder="Full Name*" required="" > -->
                                <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                                <span class="error"><?php echo $name_err; ?></span>
                            </div>
                            <div style="margin-bottom: 13px;background: var(--bs-body-bg);color: var(--bs-body-color);">
                                <div class="row">
                                    <div class="col-8">
                                        <label class="form-label">Date of Birth:</label>
                                        <div class="d-lg-flex align-items-lg-center">
                                            <select class="form-select" name="date" id="date" style="margin-right: 5px;" required="" title="Day">
                                                <option value="0" selected>Date</option>
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
                                            <select class="form-select" name="month" id="month" style="margin-right: 5px;" required="" title="Month">
                                                <option value="0" selected>Month</option>
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
                                            <select class="form-select" name="year" id="year" required="" title="Year">
                                                <option value="0" selected>Year</option>
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
                                                <option value="1992">1993</option>
                                                <option value="1994">1994</option>
                                                <option value="1995">1995</option>
                                                <option value="2096">1996</option>
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
                                        <div>
                                            <span class="error"><?php echo $dob_err; ?></span>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <label class="form-label" for="bloodgroup">Blood Group:</label>
                                        <select name="bgroup" id="bgroup" class="form-select <?php echo (!empty($bgroup_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $bgroup; ?>" title="Blood Group" required="">
                                            <option value="0" selected>Blood</option>
                                            <option value="A+">A+</option>
                                            <option value="B+">B+</option>
                                            <option value="O+">O+</option>
                                            <option value="AB+">AB+</option>
                                            <option value="A-">A-</option>
                                            <option value="B-">B-</option>
                                            <option value="O-">O-</option>
                                            <option value="AB-">AB-</option>
                                        </select>
                                        <div>
                                            <span class="error"><?php echo $bgroup_err; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="margin-bottom: 10px;background: var(--bs-body-bg);color: var(--bs-body-color);">
                                <div class="d-lg-flex justify-content-lg-start align-items-lg-start">
                                    <label class="form-label" style="color: var(--bs-dark);">Gender:</label>
                                    <div class="form-check" style="margin-left: 12px;">
                                        <input class="form-check-input <?php echo (!empty($gender_err)) ? 'is-invalid' : ''; ?>" type="radio" id="male" name="gender" value="Male">
                                        <label class="form-check-label" for="male">Male:</label>
                                    </div>
                                    <div class="form-check" style="margin-left: 12px;">
                                        <input class="form-check-input <?php echo (!empty($gender_err)) ? 'is-invalid' : ''; ?>" type="radio" id="female" name="gender" value="Female">
                                        <label class="form-check-label" for="female">Female</label>
                                    </div>
                                    <div class="form-check" style="margin-left: 12px;">
                                        <input class="form-check-input <?php echo (!empty($gender_err)) ? 'is-invalid' : ''; ?>" type="radio" id="other" name="gender" value="Other">
                                        <label class="form-check-label" for="other">Other</label>
                                    </div>
                                </div>
                                <div>
                                    <span class="error"><?php echo $gender_err; ?></span>
                                </div>
                            </div>

                            <div style="margin-bottom: 10px;">
                                <label class="form-label" style="color: var(--bs-dark);">Mobile No:</label>
                                <!-- <input class="form-control" type="tel" name="mobile" id="mobile"  placeholder="monile no*" required="" > -->
                                <input type="text" name="mobile" class="form-control <?php echo (!empty($mobile_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $mobile; ?>">
                                <span class="error"><?php echo $mobile_err; ?></span>
                            </div>
                            <div style="margin-bottom: 10px;">
                                <label class="form-label" style="color: var(--bs-dark);">Email Id:</label>
                                <!-- <input class="form-control" type="email" name="email" id="email" placeholder="Email Id*" required="" > -->
                                <input type="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                                <span class="error"><?php echo $email_err; ?></span>
                            </div>
                            <div style="margin-bottom: 10px;">
                                <label class="form-label" style="color: var(--bs-dark);">Password:</label>
                                <div class="d-lg-flex align-items-lg-center">
                                    <!-- <input class="form-control" type="password" name="password" id="password" placeholder="Password*"> -->
                                    <input type="text" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                                    <i class="bi bi-eye-slash" id="togglePassword" style="margin-left: -45px; cursor: pointer; color:black;"></i>

                                </div>
                                <div>
                                    <span class="error"><?php echo $password_err; ?></span>
                                </div>

                            </div>
                            <div style="color: var(--bs-red); margin:30px; text-align: center;">
                                <input type="submit" class="btn btn-primary w-100" value="Submit">
                            </div>
                            <div style="color: var(--bs-red); text-align: center;">
                                <h6 style="color: var(--bs-body-color);"><br>Already have an account?&nbsp;<a href="login.php">Sign In</a><br></h6>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>


</body>

</html>