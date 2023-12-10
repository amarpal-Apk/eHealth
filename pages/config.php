<?php 
$host = "localhost";
$user = "root";
$password = '';
$db_name = "health";

$conn = mysqli_connect($host, $user, $password, $db_name);

$mysqli = new MySQLi('localhost', 'root', '', 'health');

if (mysqli_connect_errno()) {
    die("Failed to connect with MySQL: " . mysqli_connect_error());
}
?>