<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
// if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
//     header("location: login.php");
//     exit;
// }
include 'config.php';
$healthid = $_SESSION["username"];
// Define variables and initialize with empty values


// $sql1 = "select  role FROM user WHERE healthid = '$username' ";
// $result1 = mysqli_query($conn, $sql1);
// $row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);

// if($row1['role']=='admin'){
    $smg = "";
    $name  = $degree = $exp = $day = $time = $spes = $mobile = $email = $address = "";
    $name_err  = $degree_err = $exp_err = $day_err = $time_err = $spes_err = $mobile_err = $email_err = $address_err = "";
    //Processing form data when form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
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
        // Degree Validation  
        if (empty($_POST["degree"])) {
            $degree_err = "degree is required";
        } else {
            $degree = input_data($_POST["degree"]);
        }
    
        //validating exp
    
        if (isset($_POST['exp'])) {
            $exp = $_POST['exp'];
            if ($exp == "0") {
                $exp_err = "Select exp ";
            }
        } else {
            $exp_err = "Seldegreeexp ";
        }
    
        // day Validation  
        if (empty($_POST["day"])) {
            $day_err = "day is required";
        } else {
            $day = input_data($_POST["day"]);
        }
    
    
        //validating time
    
        if (isset($_POST['time'])) {
            $time = $_POST['time'];
            if ($exp == "0") {
                $time_err = "Select time ";
            }
        } else {
            $time_err = "Seldegree time ";
        }
    
    
    
        // spes Validation  
        if (empty($_POST["spes"])) {
            $spes_err = "spes is required";
        } else {
            $spes = input_data($_POST["spes"]);
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
    
    
         // spes Validation  
         if (empty($_POST["address"])) {
            $address_err = "address is required";
        } else {
            $address = input_data($_POST["address"]);
        }
    
    
        //insert data in database
    
        if (empty($name_err) && empty($degree_err) && empty($exp_err) && empty($day_err) && empty($time_err) && empty($spes_err) && empty($mobile_err) && empty($email_err) && empty($address_err)) {
            $sql = "INSERT INTO doctor ( name, degree, exp, day, time, spes, mobile, email, address)
                  VALUES ('$name','$degree','$exp','$day' ,'$time','$spes','$mobile', '$email','$address')";
    
            if (mysqli_query($conn, $sql)) {
                $smg="New doctor added successfully";
     
                // header("location: login.php");
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
    
            mysqli_close($conn);
        }
    }

// }else{
//     header("location: profile.php");
//     exit;
// }



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
    <title>Untitled</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Aclonica&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alfa+Slab+One&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/untitled.css">
    <style>
         .error {
            color: red;
            font-size: small;

        }
        .body {
            /* background-color: whitesmoke; */
            /* color: var(--bs-light); */
            font-style: italic;
            /* background: var(--bs-gray-200);/ */
        }

        .card {
            border-radius: 10px;
            margin-top: 50px;
            box-shadow: 0px 0px 11px var(--bs-pink);
            color: black;
        }
        .smg{
            background-color: #51f57f;
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
        <div class="row d-lg-flex justify-content-lg-center">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <h1 style="color: var(--bs-pink);font-weight: bold;font-style: italic;font-family: Aclonica, sans-serif;text-align: center;margin-bottom: 15px;">
                            Add dctr</h1>
                            <span class="smg"><?php echo $smg; ?></span>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <div style="margin-bottom: 10px;">
                                <label class="form-label">Name:</label>
                                <input class="form-control" type="text" name="name" placeholder="Enter name">
                                <span class="error"><?php echo $name_err; ?></span>
                            </div>
                            <div style="margin-bottom: 10px;">
                                <div class="row">
                                    <div class="col">
                                        <div>
                                            <label class="form-label">Degree:</label>
                                            <input class="form-control" type="text" name="degree">
                                            <span class="error"><?php echo $degree_err; ?></span>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div>
                                            <label class="form-label">Experience:</label>
                                            <select class="form-select" name="exp">
                                                <optgroup label="Select year">
                                                    <option value="0" >Select year</option>
                                                    <option value="1" >1 Year</option>
                                                    <option value="2">2 Year</option>
                                                    <option value="3">3 Year</option>
                                                    <option value="3">3 Year</option>
                                                    <option value="4">4 Year</option>
                                                    <option value="2">5 Year</option>
                                                    <option value="6">6 Year</option>
                                                    <option value="7">7 Year</option>
                                                    <option value="8">8 Year</option>
                                                    <option value="9">9 Year</option>
                                                    <option value="10">10 Year</option>
                                                    <option value="10+">More than 10 Yrs</option>
                                                </optgroup>
                                            </select>
                                            <span class="error"><?php echo $exp_err; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="margin-bottom: 10px;">
                                <div class="row">
                                    <div class="col">
                                        <div>
                                            <label class="form-label">Days:</label>
                                            <input class="form-control" type="text" name="day" placeholder="Like MON - SAT">
                                            <span class="error"><?php echo $day_err; ?></span>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div>
                                            <label class="form-label">Time:</label>
                                            <select class="form-select" name="time">
                                                <optgroup label="select  time">
                                                    <option value="0" >Select  time</option>
                                                    <option value="8:00 AM - 10:00 AM" >8:00 AM - 10:00 AM</option>
                                                    <option value="9:00 AM - 11:00 AM">9:00 AM - 11:00 AM</option>
                                                    <option value="0:00 AM - 12:00 PM">10:00 AM - 12:00 PM</option>
                                                    <option value="9:00 AM - 12:00 PM">9:00 AM - 12:00 PM</option>
                                                    <option value="9:00 AM - 4:00 PM">9:00 AM - 4:00 PM</option>
                                                    <option value="10:00 AM - 5:00 PM">10:00 AM - 5:00 PM</option>
                                                    <option value="4:00 PM - 8:00 PM">4:00 PM - 8:00 PM</option>
                                                    <option value="6:00 PM - 9:00 PM">6:00 PM - 9:00PM</option>
                                                </optgroup>
                                            </select>
                                            <span class="error"><?php echo $time_err; ?></span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div style="margin-bottom: 10px;">
                                <label class="form-label">Specialization:</label>
                                <input class="form-control" type="text" name="spes" placeholder="Specialization">
                                <span class="error"><?php echo $spes_err; ?></span>
                            </div>
                            <div style="margin-bottom: 10px;">
                                <label class="form-label">Mobile no:</label>
                                <input class="form-control" type="text" name="mobile" placeholder="Enter mobile no">
                                <span class="error"><?php echo $mobile_err; ?></span>
                            </div>
                            <div style="margin-bottom: 10px;">
                                <label class="form-label">Email:</label>
                                <input class="form-control" type="email" name="email" placeholder="enter email">
                                <span class="error"><?php echo $email_err; ?></span>
                            </div>
                            <div style="margin-bottom: 10px;">
                                <label class="form-label">Clinic address:</label>
                                <input class="form-control" type="text" name="address" placeholder="enter clinic address">
                                <span class="error"><?php echo $address_err; ?></span>
                            </div>
                            <!-- <div style="margin-bottom: 10px;">
                                <label class="form-label">Upload pic:</label>
                                <input class="form-control" type="file" name="pic" >
                            </div> -->
                            <div style="color: var(--bs-red); margin:30px; text-align: center;">
                                <input type="submit" class="btn btn-primary w-100" value="Submit">
                            </div>
                        </form>
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