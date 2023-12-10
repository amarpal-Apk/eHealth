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
$name = "Amar Pal";

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

        buttom:hover {
            background-color: #8efac0;
            color: white;
        }

        .row {
            border-radius: 18px;
            background-color: #6d9eed;
            color: white;
            margin: 40px 0px 40px 0px;
            padding: 10px;
        }

        .box1 {
            border-radius: 20px;
            background-color: #59e3d5;


        }

        .box2 {
            border-radius: 20px;
            background-color: #81d4f7;
            padding-left: 50px;
            padding-right: 50px;
            padding-top: 8px;
            padding-bottom: 8px;
            margin: 10px;

        }

        .box3 {
            border-radius: 20px;
            background-color: #f774a5;
            padding-top: 30px;

        }

        a {
            text-decoration: none;
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- sidebar bg change here -->
      
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
               
                <div class="container-fluid">
                    <!-- main section start here -->

                    <?php
                    // $conn = mysqli_connect("localhost", "root", "", "health");

                    // Check connection
                    if (!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                    }
                    $sql = "SELECT id, name, degree, exp, spes, address, day, time, email FROM doctor";
                    $result = mysqli_query($conn,  $sql);
                    $i = 1;
                    while ($row = mysqli_fetch_array($result)) {
                    ?>

                        <div class="row" >
                            <div class="col box1">
                                <img class="border rounded-circle " src="img/picboy1.png">
                            </div>
                            <div class="col-6 box2">
                               
                                <h3><?php echo $row["name"]; ?></h3>
                                <div class="dropdown-divider"></div>
                                <h6><?php echo $row["degree"]; ?></h6>
                                <div class="dropdown-divider"></div>
                                <h6><?php echo $row["exp"]; ?></h6>
                                <div class="dropdown-divider"></div>
                                <h6><?php echo $row["spes"]; ?></h6>
                                <div class="dropdown-divider"></div>
                                <h6><?php echo $row["address"]; ?></h6>
                            </div>
                            <div class="col box3">
                                <div class="text-center ">
                                    <h4><?php echo $row["day"]; ?></h4>
                                    <h6><?php echo $row["time"]; ?></h6>
                                    <br>
                                    <button class="btn  buttom" type="button"> <a href="book_appointment.php?id=<?php echo $row['id']; ?>">Book Appointment</a></button>

                                    <!-- <a href="book_appointment.php?id=<?php echo $row['id']; ?>" class="btn"  >book</a> -->
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