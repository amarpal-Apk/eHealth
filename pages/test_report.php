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
// $name = "Amar Pal";
$sql = "select *from user where healthid = $healthid";
 $result = mysqli_query($conn, $sql);
 $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$name = $row['name'];

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard - Brand</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <style>
        .red {
            color: red;
        }

        #mybrand {
            font-weight: bolder;
            font-style: italic;
            font-size: larger;
            color: #ff14d4;
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


        .buttom {
            background-color: #42f595;
            width: 100%;
            border: 1px solid #42f595;
            font-weight: bolder;
            box-shadow: #8efac0;
        }

        .buttom {
            background-color: #42f595;
            width: 100%;
            border: 1px solid #42f595;
            font-weight: bolder;
            box-shadow: #8efac0;
        }

        .col {
            border-radius: 18px;
            color: white;

        }

        .line {
            color: red;
            margin-top: 35px;
            font-weight: bolder;
            font-size: 20px;
        }

        .vl {
            border-left: 6px solid green;
            height: 120px;
            margin-left: 470px;

        }
        .row{
            margin: 20px 15px 0px 15px;
        }

        .row2 {
            margin-top: -27px;
            margin-bottom: -45px;
        }

        .heading {
            background:#885796;
            color: #fff;
            padding: 14px 25px;
            margin: 15px 0px 15px 0px;
            border-radius: 3px 3px 0 0;
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
                    <li class="nav-item"><a class="nav-link" href="medicine.php"><i class="fas fa-user"></i><span>Current pill schedule</span></a></li>
                    <li class="nav-item active shadow"><a class="nav-link" href="test_report.php"><i class="far fa-user-circle"></i><span>Report Chain</span></a></li>
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
                    <div class="row heading">
                        <div class="col-sm-9">
                            <h2>Report <b> chain</b></h2>
                        </div>
                        <div class="col-sm-3">
                            <a href="add_report.php" class="btn btn-success"><i class="material-icons">&#xE147;</i> <span>Add New report</span></a>
                        </div>
                    </div>

                    <?php
                    // $conn = mysqli_connect("localhost", "root", "", "health");

                    // Check connection
                    if (!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                    }
                    $sql = "SELECT  date, doctor, description, report FROM report_chain WHERE healthid='$healthid'";
                    $result = mysqli_query($conn,  $sql);
                    $i = 1;
                    while ($row = mysqli_fetch_array($result)) {
                    ?>

                        <div class="row" style="height: 70px;">
                            <div class="col text-center d-lg-flex justify-content-lg-center align-items-lg-center" style="background: var(--bs-purple);">
                                <div>
                                    <p><?php echo $row["date"]; ?></p>
                                </div>
                            </div>
                            <div class="col">
                                <!-- <div></div> -->
                                <hr class="line">
                            </div>
                            <div class="col text-center d-lg-flex justify-content-lg-center align-items-lg-center" style="background: var(--bs-cyan);">
                                <div>
                                    <p> <?php echo "Dr ".$row["doctor"]; ?></p>
                                </div>
                            </div>
                            <div class="col">
                                <div>
                                    <hr class="line">
                                </div>
                            </div>
                            <div class="col text-center d-lg-flex justify-content-lg-center align-items-lg-center" style="background: var(--bs-teal);">
                                <div>
                                   
                                    <p> <button class="btn buttom"><a href="descriptions/<?php echo $row["description"]; ?>" target="_blank">Prescription </a></button></p>
                                </div>
                            </div>
                            <div class="col">
                                <div>
                                    <hr class="line">
                                </div>
                            </div>
                            <div class="col text-center d-lg-flex justify-content-lg-center align-items-lg-center" style="background: var(--bs-primary);">
                                <div>
                                    <p> <button class="btn buttom"><a href="reports/<?php echo $row["report"]; ?>" target="_blank">test reports</a></button></p>
                                </div>
                            </div>

                        </div>
                        <div class="row row2">
                            <div class="col text-center">
                                <div class="vl">
                                </div>
                            </div>
                        </div>

                    <?php
                        $i++;
                    }
                    ?>

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