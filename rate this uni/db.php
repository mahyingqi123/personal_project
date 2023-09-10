<?php 
$server = "localhost";
$username = "root";
$password = "";
$database = "com&rate";

$con = mysqli_connect($server, $username, $password, $database);
mysqli_query($con, "SET SESSION time_zone = '+8:00'");
?>