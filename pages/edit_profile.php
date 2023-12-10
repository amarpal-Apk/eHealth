<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

include 'config.php';


$healthid = $_SESSION["username"];

$option = $bgroup = $bgroup_err = $date=$month=$year="";
$name = $mobile = $email = $password = $bgroup = $gender = $dob = "";
 $name_err = $mobile_err = $email_err = $password_err = $bgroup_err =  $gender_err = $dob_err = "";

$sql = "SELECT name, dob, bgroup, gender, mobile,email FROM user WHERE healthid=$healthid";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {

        $name = $row["name"];
        $dob = $row["dob"];
        $bgroup = $row["bgroup"];
        $gender = $row["gender"];
        $mobile = $row["mobile"];
        $email = $row["email"];

        $date=substr($dob,0,2);
        $month=substr($dob,3,2);
        $year=substr($dob,6,4);
    }
} else {
    echo "0 results";
}
$conn->close();


include 'config.php';

// uddating profile
//Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {


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


    //insert data in database

    if (empty($name_err) && empty($dob_err) && empty($bgroup_err) && empty($gender_err) && empty($mobile_err) && empty($email_err) ) {
    
        include 'config.php';

        $amar = "UPDATE user SET name ='$name',dob='$dob',bgroup='$bgroup',gender='$gender',mobile='$mobile',email='$email' WHERE healthid='$healthid'";

        if (mysqli_query($conn, $amar)) {
            header("location: profile.php");
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
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>profile</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">


    <style>
           .error {
            color: red;
            font-size: small;
            
        }
        .red {
            color: red;
        }

        #accordionSidebar li:hover {
            background-color: #42f595;
            border-radius: 17px;
            font-weight: bolder;
            /* margin-left: 7px; */
            /* margin-top: 7px; */
            /* box-shadow: #42f595; */

        }

        .active {
            background-color: #42f595;
            border-radius: 17px;
            font-weight: bolder;
            /* margin-left: 7px; */
            margin-top: 7px;
            margin-bottom: 7px;



        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- sidebar bg change here -->
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-success p-0">
            <div class="container-fluid d-flex flex-column p-0">
                <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <!-- <div class="sidebar-brand-icon rotate-n-15"><img class="border  img-profile" src="assets/img/avatars/logo.jpg"></div> -->
                    <div class="sidebar-brand-text mx-3"><span>AMAR PAL</span></div>
                </a>
                <hr class="sidebar-divider my-0 ">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item "><a class="nav-link" href="profile.php"><i class="fas fa-user"></i><span> My Profile</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="medicine.php"><i class="fas fa-user"></i><span>Current pill schedule</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php"><i class="far fa-user-circle"></i><span>Report Chain</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php"><i class="far fa-user-circle"></i><span>Dctr Appointment</span></a></li>
                    <li class="nav-item active shadow"><a class="nav-link" href="login.php"><i class="far fa-user-circle"></i><span>Update My Profile</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php"><i class="far fa-user-circle"></i><span>Smart card</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php"><i class="far fa-user-circle"></i><span>Login</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="signup.php"><i class="fas fa-user-circle"></i><span>Register</span></a></li>
                </ul>
                <div class="text-center d-none d-md-inline">
                    <button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button>
                </div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3" id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <form class="d-none d-sm-inline-block me-auto ms-md-3 my-2 my-md-0 mw-100 navbar-search">
                            <div class="input-group"><input class="bg-light form-control border-0 small" type="text" placeholder="Search for ..."><button class="btn btn-primary py-0" type="button"><i class="fas fa-search"></i></button></div>
                        </form>
                        <ul class="navbar-nav flex-nowrap ms-auto">
                            <li class="nav-item dropdown d-sm-none no-arrow"><a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#"><i class="fas fa-search"></i></a>
                                <div class="dropdown-menu dropdown-menu-end p-3 animated--grow-in" aria-labelledby="searchDropdown">
                                    <form class="me-auto navbar-search w-100">
                                        <div class="input-group"><input class="bg-light form-control border-0 small" type="text" placeholder="Search for amar pal ...">
                                            <div class="input-group-append"><button class="btn btn-primary py-0" type="button"><i class="fas fa-search"></i></button></div>
                                        </div>
                                    </form>
                                </div>
                            </li>
                            <li class="nav-item dropdown no-arrow mx-1">

                            </li>
                            <li class="nav-item dropdown no-arrow mx-1">
                                <h4 class="mt-3"><?php echo "Hi, " . $name ?></h4>
                                <div class="shadow dropdown-list dropdown-menu dropdown-menu-end" aria-labelledby="alertsDropdown"></div>
                            </li>
                            <div class="d-none d-sm-block topbar-divider"></div>
                            <li class="nav-item dropdown no-arrow">
                                <div class="nav-item dropdown no-arrow">
                                    <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">
                                        <span class="d-none d-lg-inline me-2 text-gray-600 small"><?php echo $healthid ?></span>
                                        <img class="border rounded-circle img-profile" src="img/boypic.jpg"></a>
                                    <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in">
                                        <a class="dropdown-item" href="profile.php"><i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Profile</a>
                                        <!-- <div class="dropdown-divider"></div> -->
                                        <a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout </a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">
                    <!-- main section start here -->
                    <div class="row d-lg-flex justify-content-lg-center" style="margin-top: 40px;margin-bottom: 30px;">
                        <div class="col" style="border-radius: 10px;">
                            <div class="card" style="box-shadow: 0px 0px 11px var(--bs-pink);border-radius: 10px;">
                                <div class="card-body">
                                    <h1 style="color: var(--bs-pink); font-family: Aclonica, sans-serif;text-align: center;margin-bottom: 10px;">
                                        Update profile</h1>
                                       
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
                                                            <option value="<?php echo $date; ?>" selected><?php echo $date; ?></option>
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
                                                            <option value="<?php echo $month; ?>" selected><?php echo $month; ?></option>
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
                                                            <option value="<?php echo $year; ?>" selected><?php echo $year; ?></option>
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
                                                    <select name="bgroup" id="bgroup" class="form-select <?php echo (!empty($bgroup_err)) ? 'is-invalid' : ''; ?>" title="Blood Group" required="">
                                                        <option  value="<?php echo $bgroup; ?>"selected><?php echo $bgroup; ?></option>
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
                                                    <input class="form-check-input <?php echo (!empty($gender_err)) ? 'is-invalid' : ''; ?>" type="radio" id="male" name="gender" value="Male" >
                                                    <label class="form-check-label" for="male">Male:</label>
                                                </div>
                                                <div class="form-check" style="margin-left: 12px;">
                                                    <input class="form-check-input <?php echo (!empty($gender_err)) ? 'is-invalid' : ''; ?>" type="radio" id="female" name="gender" value="Female" >
                                                    <label class="form-check-label" for="female">Female</label>
                                                </div>
                                                <div class="form-check" style="margin-left: 12px;">
                                                    <input class="form-check-input <?php echo (!empty($gender_err)) ? 'is-invalid' : ''; ?>" type="radio" id="other" name="gender" >
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
                                        <div style="margin-bottom: 20px;">
                                            <label class="form-label" style="color: var(--bs-dark);">Email Id:</label>
                                            <!-- <input class="form-control" type="email" name="email" id="email" placeholder="Email Id*" required="" > -->
                                            <input type="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                                            <span class="error"><?php echo $email_err; ?></span>
                                        </div>
                                       
                                        <div style="color: var(--bs-red);height: 60px;text-align: center;">
                                            <input type="submit" class="btn btn-primary w-100" value="Upadte">
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © Brand 2022</span></div>
                </div>
            </footer> -->
            </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
        </div>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/chart.min.js"></script>
        <script src="assets/js/bs-init.js"></script>
        <script src="assets/js/theme.js"></script>
</body>

</html>