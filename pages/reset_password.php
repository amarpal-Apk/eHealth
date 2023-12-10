<?php

// ob_start();
// session_start();
// // Check if the user is already logged in, if yes then redirect him to welcome page
// if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
//     header("location: profile.php");
//     exit;
// }


include 'config.php';

$err = $smg ="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email= $_POST['email'];


    $sql = "select *from user  where email= '$email' ";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);

    if ($count == 1 ) {
        //now send token to email with link
        $vkey = $row['vkey'];
        
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

    //   $link = "<a  href='http://localhost/admin/pages/update_password.php?vkey=$vkey'>Click Here</a>";

      $mail->Subject = "Reset Password";
      $mail->Body    = "Hi! We have got a Request to Reset Your Password
                    http://localhost/admin/pages/update_password.php?vkey=$vkey";
      
      $mail->AltBody = "This is the body in plain text for non-HTML mail clients";

      if (!$mail->send()) {
          echo "Message could not be sent.";
          echo "Mailer Error: " . $mail->ErrorInfo;
      } else {
          echo "Message has been sent";
          $smg="Please Check Your Mail TO Reset Passwors";
          
      }



    } else {
        // echo "<h1> Login failed. Invalid username or password.</h1>";
        $err = "Email not found.";
    }

   
}

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Reset Password</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <style>
         
         .smg{
            background-color: #2eff6d;
            color: white;
            text-align: center;
            font-size: 20px;
            font-weight:bold;
            border-radius: 10px;
            /* padding: 5px; */
           
        }
        .err{
            background-color: #ff1f1f;
            color: white;
            text-align: center;
            font-size: 20px;
            font-weight:bold;
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
                        <h4 class="card-title" style="color: var(--bs-pink);font-size: 33.376px;text-align: center;box-shadow: 0px 0px;font-style: italic;font-family: Aclonica, sans-serif;font-weight: bold;">Reset Password</h4>
                        <h5 class="smg"><b><?php echo $smg; ?></b></h5>
                        <h5 class="err"><b><?php echo $err; ?></b></h5>
                        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <div>
                                <label class="form-label">Email Id:</label>
                                <input class="form-control" type="text" id="email" name="email" placeholder="Enter email Id*" required>
                            </div>
                          
                            <div class="d-lg-flex justify-content-lg-center" style="margin-top: 20px;">
                                <input class="btn btn-primary" type="submit" value="Send Email" />
                            </div>
                        </form>
                        <div style="margin-top: 25px;">
                            <div class="row">
                                <div class="col" style="text-align: left;"><a href="forgatepassword.php">Forgate
                                        password ?</a>
                                </div>
                                <div class="col-4" style="text-align: center;"><a href="login.php">Login</a>
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