<?php

// ob_start();
// session_start();
// // Check if the user is already logged in, if yes then redirect him to welcome page
// if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
//     header("location: profile.php");
//     exit;
// }

include 'config.php';

    $vkey = $_GET['vkey'];

    echo $vkey;

$err = $smg = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    
  

    // if ($password == $cpassword) {

    //     $sql = "UPDATE user set password ='$password' WHERE vkey='$vkey' ";
    //     $result = mysqli_query($conn, $sql);
    //     if ($result) {
    //         $smg = "Password Updated Successfully";
    //     } else {
    //         $err = "Your Password not updated";
    //     }
    // } else {
    //     $err = "Password not match";
    // }
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
            background-color: #2eff6d;
            color: white;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            border-radius: 10px;


        }

        .err {
            background-color: #ff1f1f;
            color: white;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            border-radius: 10px;
            /* padding: 5px; */

        }
    </style>
</head>

<body style="background: var(--bs-gray-200);">
    <div class="container">
        <div class="row" style="margin-top: 50px;">
            <div class="col-4 offset-4">
                <div class="card" style="box-shadow: 0px 0px 10px var(--bs-purple);border-radius: 10px;">
                    <div class="card-body">
                        <h4 class="card-title" style="color: var(--bs-pink);font-size: 33.376px;text-align: center;box-shadow: 0px 0px;font-style: italic;font-family: Aclonica, sans-serif;font-weight: bold;">Update Password</h4>
                        <h5 class="smg"><b><?php echo $smg; ?></b></h5>
                        <h5 class="err"><b><?php echo $err; ?></b></h5>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <div style="margin-top: 15px;">
                                <label class="form-label">New Password:</label>
                                <input class="form-control" type="text" id="password" name="password" placeholder="Enter New password*" required>
                            </div>
                            <div style="margin-top: 15px;">
                                <label class="form-label"> Conform Password:</label>
                                <input class="form-control" type="password" id="cpassword" name="cpassword" placeholder="conform Old password*"required />

                            </div>

                    </div>
                    <div class="d-lg-flex justify-content-lg-center" style="margin-top: 20px;">
                        <input class="btn btn-primary" type="submit" id="btn" value="Update Password" />
                    </div>
                    </form>

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