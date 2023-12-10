<?php

include 'config.php';
$my_otp="123";
$otp = $otp_err="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 

    // header("location:varify_successfull.php");
   
   if (empty($_POST["otp"])) {
       $otp_err = "Enter otp";
   } else {
      $otp=$_POST["otp"];
   }

 

}
if($otp==$my_otp){
    header(" location: varify_successfull.php");
 //  header("Refresh: 4; location: varify_successfull.php");
  exit;
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
    </style>
</head>

<body style="background: var(--bs-gray-200);">
    <div class="container">
        <div class="row d-lg-flex justify-content-lg-center" style="margin-top: 50px;">
            <div class="col-4">
                <div class="card text-center d-lg-flex align-items-lg-center" style="border-radius: 10px;text-shadow: 0px 0px;box-shadow: 0px 0px 10px var(--bs-indigo);">
                    <div class="card-body">
                        <h5 style="margin-top:17px; color: rgb(11, 252, 103);">OTP is sent to your email </h5>
                        <!-- <h1><?php echo $otp; ?></h1> -->
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <div style="margin-top: 31px;">
                                <input class="form-control" type="text" name="otp" required="" placeholder="One Time Password">
                                <!-- <span class="error"><?php echo $otp_err; ?></span> -->
                            </div>
                            <div class="d-lg-flex justify-content-lg-center" style="text-align: center;margin-top: 25px; margin-bottom: 25px;">
                                <!-- <button class="btn btn-primary" type="submit" value="submit">Varify OTP</button> -->
                                <input type="submit" class="btn btn-primary" value="Submit">
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