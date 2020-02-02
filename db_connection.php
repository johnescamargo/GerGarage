<?php
//MAMP and phpMyAdmin
$servername = "localhost:3306";
$username = "root";
$password = "";
$database = "gergarage";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if(!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected successfully";
?>