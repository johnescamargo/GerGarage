<?php
include('db_connection.php');
session_start();

$user_check = $_SESSION['login_gergarage'];

$ses_sql = mysqli_query($conn, "select email from customer where email = '$user_check' ");

$row = mysqli_fetch_array($ses_sql, MYSQLI_ASSOC);

$login_session = $row['email'];

if (!isset($_SESSION['login_gergarage'])) {
   header("Location:../index.php");
   die();
}

?>