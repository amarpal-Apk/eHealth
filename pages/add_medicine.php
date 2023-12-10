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
$uname = "Amar Pal";

?>

<?php
// Define variables and initialize with empty values
$smg = "";
$amt = $amt_err = $unit = $unit_err = "";
$name = $days = $types = $days = $times = $food = $dose = "";
$name_err = $days_err = $types_err = $days_err = $times_err = $food_err = $dose_err = "";
$sun_err = $mon_err = $tues_err = $wed_err = $thrus_err = $fri_err = $sat_err = "";
$sun = $mon = $tues = $wed = $thrus = $fri = $sat = "";

//Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //name Validation  
    if (empty($_POST["name"])) {
        $name_err = "Name is required";
    } else {
        $name = input_data($_POST["name"]);
    }

    //validating med type
    if (isset($_POST['types'])) {
        $types = $_POST['types'];
        if ($types == "") {
            $types_err = "select med type";
        }
    } else {
        $types_err = "select med type";
    }

    // validating days
    if (isset($_POST['sun'])) {
        $sun = $_POST['sun'];
    } else {
        $sun_err = "Select days";
    }
    if (isset($_POST['mon'])) {
        $mon = $_POST['mon'];
    } else {
        $mon_err = "Select days";
    }
    if (isset($_POST['tues'])) {
        $tues =  $_POST['tues'];
    } else {
        $tues_err = "Select days";
    }
    if (isset($_POST['wed'])) {
        $wed =  $_POST['wed'];
    } else {
        $wed_err = "Select days";
    }
    if (isset($_POST['thrus'])) {
        $thrus =  $_POST['thrus'];
    } else {
        $thrus_err = "Select days";
    }
    if (isset($_POST['fri'])) {
        $fri =  $_POST['fri'];
    } else {
        $fri_err = "Select days";
    }
    if (isset($_POST['sat'])) {
        $sat =  $_POST['sat'];
    } else {
        $sat_err = "Select days";
    }


    if (empty($_POST['sun']) && empty($_POST['mon']) && empty($_POST['tues']) && empty($_POST['wed']) && empty($_POST['thrus']) && empty($_POST['fri']) && empty($_POST['sat'])) {
        $days_err = "Select days";
    } else {
        $days = $sun . "+" . $mon . "+" . $tues . "+" . $wed . "+" . $thrus . "+" . $fri . "+" . $sat;
    }

    //validating med times
    if (isset($_POST['times'])) {
        $times = $_POST['times'];
        if ($times == "") {
            $times_err = "select med type";
        }
    } else {
        $times_err = "select med times";
    }

    //validating med meal
    if (isset($_POST['food'])) {
        $food = $_POST['food'];
        if ($food == "") {
            $food_err = "select med type";
        }
    } else {
        $food_err = "select med meal";
    }

    //validating med dose

    if (empty($_POST["amt"])) {
        $amt_err = "Amount is required";
    } else {
        $amt = input_data($_POST["amt"]);
    }

    if (isset($_POST['unit'])) {
        $unit = $_POST['unit'];
        if ($unit == "") {
            $unit_err = "select med unit";
        }
    } else {
        $unit_err = "select med unit";
    }
    // $space="  ";
    $dose = "$amt" . $unit;
    //    $dose_err="$amt_err"." "."$unit_err";

    // insert data in database
    if (empty($name_err) && empty($types_err) && empty($days_err) && empty($times_err) && empty($food_err) && empty($dose_err)) {
        $sql = "INSERT INTO med_schedules (healthid, name,types,days,times, food,dose)
        VALUES ('$healthid','$name','$types','$days','$times','$food' ,'$dose')";

        if (mysqli_query($conn, $sql)) {
            $smg = $name . " added Successfully";
            //  header("location: login.php");
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
    <title>Add medicine</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <style>
        .red {
            color: red;
        }

        #mybrand {
            font-weight: bolder;
            font-style: italic;
            font-size: larger;

        }

        #accordionSidebar li:hover {
            background-color: #42f595;
            border-radius: 17px;
            font-weight: bolder;
            /* margin-left: 7px; */
            /* margin-top: 7px; */

        }

        .active {
            background-color: #42f595;
            border-radius: 17px;
            font-weight: bolder;
            /* margin-left: 7px; */
            margin-top: 7px;
            margin-bottom: 7px;

        }

        #logo {
            height: 50px;
            width: 70px;
        }
    </style>
    <style>
        .error {
            color: red;
            font-size: small;

        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- sidebar bg change here -->
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-success p-0">
            <div class="container-fluid d-flex flex-column p-0">
                <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="profile.php">
                    <!-- <div class="sidebar-brand-icon " ><img  src="img/logo.jpeg" alt="not"></div> -->
                    <div class="sidebar-brand-text mx-3" id="mybrand"><span>AMAR PAL</span></div>
                </a>
                <hr class="sidebar-divider my-0 ">
                <ul class="navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item "><a class="nav-link" href="profile.php"><i class="fas fa-user"></i><span> My Profile</span></a></li>
                    <li class="nav-item active shadow"><a class="nav-link" href="medicine.php"><i class="fas fa-user"></i><span>Current pill schedule</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="pages/login.php"><i class="far fa-user-circle"></i><span>Report Chain</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php"><i class="far fa-user-circle"></i><span>Dctr Appointment</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php"><i class="far fa-user-circle"></i><span>Update My Profile</span></a></li>
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
                                <h4 class="mt-3"><?php echo "Hi, " . $uname ?></h4>
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
                    <div class="container">
                        <div class="row d-lg-flex justify-content-lg-center" style="margin-top: 40px;margin-bottom: 30px;">
                            <div class="col-6" style="border-radius: 10px;">
                                <div class="card" style="box-shadow: 0px 0px 11px var(--bs-pink);border-radius: 10px;">
                                    <div class="card-body">
                                        <h2 class="text-center" style="color: var(--bs-pink);font-weight: bold;margin-top: 10px;">Add Medicine</h2>
                                        <h4 class="bg-success"><?php echo $smg; ?></h4>
                                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                            <div style="margin-top: 15px;">
                                                <div class="row">
                                                    <div class="col ">
                                                        <label class="form-label" for="name">Name of medicine:</label>
                                                        <input class="form-control" type="text" name="name" placeholder="eg.paracitamol">
                                                        <span class="error"><?php echo $name_err; ?></span>
                                                    </div>
                                                    <div class="col ">
                                                        <label class="form-label" for="types">types of medicine:</label>
                                                        <select name="types" class="form-select">
                                                            <option value="" selected>Select types</option>
                                                            <option value="tablet">Tablet</option>
                                                            <option value="capsule">capsule</option>
                                                            <option value="liquid">Liquid</option>
                                                            <option value="injection">Injection</option>
                                                            <option value="drop">Drop</option>
                                                            <option value="inhaler">Inhaler</option>
                                                        </select>
                                                        <span class="error"><?php echo $types_err; ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="margin-top: 15px;">
                                                <label class="form-label">Days:</label>
                                                <div>
                                                    <div class="row justify-content-between">
                                                        <div class="col-1">
                                                            <input type="checkbox" name="sun" value="sun">
                                                            <label class="form-label" for="sun">sun</label>
                                                        </div>
                                                        <div class="col-1">
                                                            <input type="checkbox" name="mon" value="mon">
                                                            <label class="form-label" for="mon">mon</label>
                                                        </div>
                                                        <div class="col-1">
                                                            <input type="checkbox" name="tues" value="tues">
                                                            <label class="form-label" for="tues">tues</label>
                                                        </div>
                                                        <div class="col-1">
                                                            <input type="checkbox" name="wed" value="wed">
                                                            <label class="form-label" for="wed">wes</label>
                                                        </div>
                                                        <div class="col-1">
                                                            <input type="checkbox" name="thrus" value="thrus">
                                                            <label class="form-label" for="thrus">thrus</label>
                                                        </div>
                                                        <div class="col-1">
                                                            <input type="checkbox" name="fri" value="fri">
                                                            <label class="form-label" for="fri">fri</label>
                                                        </div>
                                                        <div class="col-1">
                                                            <input type="checkbox" name="sat" value="sat">
                                                            <label class="form-label" for="sat">sat</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <span class="error"><?php echo $days_err; ?></span>
                                            </div>
                                            <div style="margin-top: 15px;">
                                                <div class="row">
                                                    <div class="col text-center">
                                                        <label class="form-label" for="times">No of times:</label>
                                                        <select class="form-select" name="times">
                                                            <option value="" selected>No of times</option>
                                                            <option value="1">one</option>
                                                            <option value="2">two</option>
                                                            <option value="3">three</option>
                                                        </select>
                                                        <span class="error"><?php echo $times_err; ?></span>
                                                    </div>
                                                    <div class="col text-center">
                                                        <label class="form-label" for="food">After or before</label>
                                                        <select class="form-select" name="food">
                                                            <option value="" selected>After or Before</option>
                                                            <option value="before">before food</option>
                                                            <option value="after">after food</option>
                                                        </select>
                                                        <span class="error"><?php echo $food_err; ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div style="margin-top: 15px;">
                                                <label class="form-label">Dose:</label>
                                                <div class="row">
                                                    <div class="col">
                                                        <input class="form-control" type="text" name="amt">
                                                        <span class="error"><?php echo $amt_err; ?></span>
                                                    </div>
                                                    <div class="col">
                                                        <select class="form-select" name="unit">
                                                            <option value="" selected>Unit</option>
                                                            <option value="mg">mg</option>
                                                            <option value="ml">ml</option>
                                                            <option value="drop">drop</option>
                                                        </select>
                                                        <span class="error"><?php echo $unit_err; ?></span>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="d-lg-flex justify-content-lg-center align-items-lg-center" style="margin-top: 30px;margin-bottom: 30px;">
                                                <!-- <button class="btn btn-primary" type="button">Button</button> -->
                                                <input class="btn btn-primary" type="submit" name="submit" value="Submit">
                                            </div>
                                        </form>
                                    </div>
                                </div>
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