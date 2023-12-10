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

// Define variables and initialize with empty values

$smg = "";
$name = $description = $report = $date = "";
$name_err = $description_err = $report_err = $date_err = "";

//Processing form data when form is submitted

if (isset($_POST['upload'])) {

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
    //date validation  
    if (empty($_POST["date"])) {
        $date_err = "Date is required";
    } else {
        $date = input_data($_POST["date"]);
    }


    $file = rand(1000, 100000) . "-" . $_FILES['description']['name'];
    $file_loc = $_FILES['description']['tmp_name'];
    $file_size = $_FILES['description']['size'];
    $file_type = $_FILES['description']['type'];
    $folder = "descriptions/";

    /* new file size in KB */
    $new_size = $file_size / 1024;
    /* new file size in KB */

    /* make file name in lower case */
    $new_file_name = strtolower($file);
    /* make file name in lower case */

    $final_file = str_replace(' ', '-', $new_file_name);

    move_uploaded_file($file_loc, $folder . $final_file);

    //for other
    $file1 = rand(1000, 100000) . "-" . $_FILES['report']['name'];
    $file_loc1 = $_FILES['report']['tmp_name'];
    $file_size1 = $_FILES['report']['size'];
    $file_type1 = $_FILES['report']['type'];
    $folder1 = "reports/";

    /* new file size in KB */
    $new_size1 = $file_size1 / 1024;
    /* new file size in KB */

    /* make file name in lower case */
    $new_file_name1 = strtolower($file1);
    /* make file name in lower case */

    $final_file1 = str_replace(' ', '-', $new_file_name1);

    move_uploaded_file($file_loc1, $folder1 . $final_file1);


    if (empty($name_err) && empty($date_err)) {
        $sql = "INSERT INTO report_chain(healthid,date,doctor,description,report) VALUES('$healthid','$date','$name','$final_file','$final_file1')";

        if (mysqli_query($conn, $sql)) {
            $smg = "New Report added successfully";

            // header("location: login.php");
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

        .smg {
            background-color: #51f57f;
            color: white;
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            border-radius: 10px;
            /* padding: 5px; */
            margin: 70px 0px;

        }
    </style>
</head>

<body style="color: var(--bs-light);font-style: italic;background: var(--bs-gray-200);">
    <div class="container">
        <div class="row d-lg-flex justify-content-lg-center">
            <div class="col-5">
                <div class="card">
                    <div class="card-body">
                        <h1 style="color: var(--bs-pink);font-weight: bold;font-style: italic;font-family: Aclonica, sans-serif;text-align: center;margin-bottom: 15px;">
                            Add Test Report</h1>
                        <span class="smg"><?php echo $smg; ?></span>
                        <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                            <div style="margin-bottom: 10px;">
                                <label class="form-label"> Doctor Name:</label>
                                <input class="form-control" type="text" name="name" placeholder="Enter doctor name">
                                <span class="error"><?php echo $name_err; ?></span>
                            </div>

                            <div style="margin-bottom: 10px;">
                                <label class="form-label">Prescription:</label>
                                <input class="form-control" type="file" name="description">
                                <span class="error"><?php echo $description_err; ?></span>
                            </div>
                            <div style="margin-bottom: 10px;">
                                <label class="form-label">Test Report:</label>
                                <input class="form-control" type="file" name="report">
                                <span class="error"><?php echo $report_err; ?></span>
                            </div>
                            <div style="margin-bottom: 10px;">
                                <label class="form-label">Date:</label>
                                <input class="form-control" type="date" name="date">
                                <span class="error"><?php echo $date_err; ?></span>
                            </div>

                            <div style="color: var(--bs-red); margin:30px; text-align: center;">
                                <!-- <input type="submit" class="btn btn-primary w-100" value="Submit"> -->
                                <button class="btn btn-primary w-100" type="submit" name="upload">Upload</button>
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