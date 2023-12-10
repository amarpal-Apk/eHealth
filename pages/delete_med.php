<?php 
include 'config.php';

$id=$_GET['id'];

$sql= "DELETE FROM med_schedules WHERE id= $id";


if (mysqli_query($conn, $sql)) {

    header('location:medicine.php');

} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}


?>