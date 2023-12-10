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
$name = $dob = $name = $bgroup = $gender = $mobile = $email = "";

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
    }
} else {
    echo "0 results";
}
$conn->close();

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
        .red {
            color: red;
        }
        #accordionSidebar li:hover {
            background-color: #42f595;
            border-radius: 17px;
            font-weight: bolder;
        }
        .active {
            background-color: #42f595;
            border-radius: 17px;
            font-weight: bolder;
            /* margin-left: 7px; */
            margin-top: 7px;
            margin-bottom: 7px;
        }
        .card-title {
            padding: 10px;
            background: #ff7171;
            color: white;
            border-radius: 10px;
            /* box-shadow: 3px 4px #fce3de; */
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
                    <li class="nav-item active shadow"><a class="nav-link" href="profile.php"><i class="fas fa-user"></i><span> My Profile</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="medicine.php"><i class="fas fa-user"></i><span>Current pill schedule</span></a></li>
                    <li class="nav-item"><a class="nav-link" href="test_report.php"><i class="far fa-user-circle"></i><span>Report Chain</span></a></li>
                    <li class="nav-item "><a class="nav-link" href="dctr_list.php"><i class="far fa-user-circle"></i><span>Dctr Appointment</span></a></li>
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
                    <h3 class="text-dark mb-1">user details:</h3>

                    <div class="row justify-content-around">
                        <div class="col-7">
                            <div class="card" style="box-shadow: 5px 5px 8px var(--bs-cyan);border-radius: 10px;">
                                <div class="card-body">
                                    <h4 class="card-title">Persional Detail:</h4>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr></tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center">NAME :-</td>
                                                    <td><?php echo $name; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">DOB :-</td>
                                                    <td><?php echo $dob; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">BLOOD GROUP :-</td>
                                                    <td><?php echo $bgroup; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">GENDER :-</td>
                                                    <td><?php echo $gender; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">MOBILE NO :-</td>
                                                    <td><?php echo $mobile; ?></td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">EMAIL :-</td>
                                                    <td><?php echo $email; ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <a href="edit_profile.php"><button class="btn btn-primary" type="button">Edit</button></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-4" style="padding-top: 20px;">
                            <div class="card">
                                <div class="card-body" style="--bs-success-rgb: 27,204,140;box-shadow: 5px 5px 7px var(--bs-cyan);border-radius: 10px;">
                                    <h4 class="card-title">Title</h4>
                                    <!-- <h6 class="text-muted card-subtitle mb-2">Subtitle</h6> -->
                                    <p class="card-text">Nullam id dolor id nibh ultricies vehicula ut id elit. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus.</p>
                                    <!-- <a class="card-link" href="#">Link</a><a class="card-link" href="#">Link</a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/chart.min.js"></script>
    <script src="assets/js/bs-init.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>