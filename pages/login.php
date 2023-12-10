<?php

ob_start();
session_start();
// Check if the user is already logged in, if yes then redirect him to welcome page
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: profile.php");
    exit;
}

include 'config.php';

$err = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = $_POST['user'];
    $password = $_POST['password'];

    //to prevent from mysqli injection  
    $username = stripcslashes($username);
    $password = stripcslashes($password);
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    $sql = "select *from user where healthid = '$username' and password = '$password'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

    $sql1 = "select *from user  where mobile = '$username' and password = '$password'";
    $result1 = mysqli_query($conn, $sql1);
    $row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);
    $count1 = mysqli_num_rows($result1);

    if ($count == 1 or $count1 == 1) {
        // echo "<h1><center> Login successful </center></h1>";
        //process login
        // $varified = $row['varified'];
        // if ($varified == 1) {
        //  continue processing
        // Password is correct, so start a new session
        session_start();
        // Store data in session variables
        $_SESSION["loggedin"] = true;
        $_SESSION["username"] = $username;
        header("location: profile.php");
        // } else {
        // $error = "This account has not been varified";
        // }
    } else {
        // echo "<h1> Login failed. Invalid username or password.</h1>";
        $err = "Invalid username or password.";
    }

    if ($count1 > 1) {
        $err = "mobile no is link with multiple account";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>login</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <style>
        .smg {
            background-color: #ff1f1f;
            color: white;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            border-radius: 10px;
            /* padding: 5px; */

        }

        .err {
            background-color: #ff1f1f;
            color: white;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            border-radius: 10px;
            padding: 5px;

        }
    </style>
</head>

<body style="background: var(--bs-gray-200);">
    <div class="container">
        <div class="row" style="margin-top: 50px;">
            <div class="col-4 offset-4">
                <div class="card" style="box-shadow: 0px 0px 10px var(--bs-purple);border-radius: 10px;">
                    <div class="card-body">
                        <h4 class="card-title" style="color: var(--bs-pink);font-size: 33.376px;text-align: center;box-shadow: 0px 0px;font-style: italic;font-family: Aclonica, sans-serif;font-weight: bold;">Login</h4>
                        <h5 class="err"><b><?php echo $err; ?></b></h5>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <div>
                                <label class="form-label">Health ID:</label>
                                <input class="form-control" type="text" id="user" name="user" placeholder="Enter Healthid or Mobile no*">
                            </div>
                            <div>
                                <label class="form-label">password</label>
                                <input class="form-control" type="password" id="password" name="password" placeholder="Enter password*" />
                                <!-- <div class="d-lg-flex align-items-lg-center">
                                    <input class="form-control" type="password" name="password" id="password"  >
                                    <i class="bi bi-eye-slash" id="togglePassword"
                                        style="margin-left: -30px; cursor: pointer; color:black;"></i>
                                </div> -->
                            </div>
                            <div class="d-lg-flex align-items-lg-start" style="margin-top: 21px;height: 30px;">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="formCheck" checked="">
                                    <label class="form-check-label" for="formCheck">Remember me</label>
                                </div>
                            </div>
                            <div class="d-lg-flex justify-content-lg-center" style="margin-top: 20px;">
                                <input class="btn btn-primary w-100" type="submit" id="btn" value="Login" />
                            </div>
                        </form>
                        <div style="margin-top: 25px;">
                            <div class="row">
                                <div class="col" style="text-align: left;"><a href="forgatepassword.php">Forgate
                                        password ?</a>
                                </div>
                                <div class="col-4" style="text-align: center;"><a href="signup.php">SignUp</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <!-- code for eye password -->
    <script>
        const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#password");

        togglePassword.addEventListener("click", function() {
            // toggle the type attribute
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);

            // toggle the icon
            this.classList.toggle("bi-eye");
        });

        // prevent form submit
        const form = document.querySelector("form");
        form.addEventListener('submit', function(e) {
            e.preventDefault();
        });
    </script>
</body>

</html>