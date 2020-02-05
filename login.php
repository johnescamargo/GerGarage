<?php
//
session_start();
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST")
//if(isset($_POST['login_button']))
{
  $email = $_POST['email'];
  $password = $_POST['password'];
  $sql = "SELECT * FROM customer WHERE email='$email' && Password='$password'";
  $sqlName = "SELECT name FROM customer WHERE email='$email' && Password='$password'";

  $result = mysqli_query($conn, $sql);
  // $resultName = mysqli_query($conn, $sqlName);
  $row = mysqli_fetch_assoc($result);

  $count = mysqli_num_rows($result);

  // If result matched $myusername and $mypassword, table row must be 1 row
  if ($count == 1) {
    $_SESSION['login_gergarage'] = $row['email'];
    $_SESSION['login_name'] = $row['name'];
    header('Location: success.html');
    header('Location: customer_login/home_customer.php');
  } else {
    echo '<script>alert("Your Login Name or Password is invalid!")</script>';
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>Customer - Login</title>
  <link rel="stylesheet" href="css/styles.css">
  <script src="js/javaScript.js"></script>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    body {
      background-image: url("img/login.jpg");
      color: white;
    }
  </style>

</head>

<body>

  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="index.php">Ger's Garage</a>
      </div>
      <ul class="nav navbar-nav">
        <!-- <li class="active"><a href="signup.html">Sign Up</a></li> -->
      </ul>

    </div>
  </nav>

  <div id="login">
    <!-- <form action="customer_login/home_customer.php"> -->
    <form method="post">
      <div class="form-group">
        <h3>Customer Login</h3>
        </br>
        <label for="email">Email address:</label>
        <input name="email" type="email" class="form-control" id="email">
      </div>
      <div class="form-group">
        <label for="pwd">Password:</label>
        <input name="password" type="password" class="form-control" id="pwd">
      </div>
      <div class="checkbox">
        <label><input type="checkbox"> Remember me</label>
      </div>
      <button type="submit" class="btn btn-danger">Log In</button>
    </form>
  </div>

  <div class="footer1">
    <a href="#">
      <img src="img/linkedin.png" alt="linkedin" width="30" height="30">
    </a>
    <a href="#">
      <img src="img/instagram.png" alt="instagram" width="30" height="30">
    </a>
    <a href="#">
      <img src="img/facebook.png" alt="facebook" width="30" height="30">
    </a>
  </div>



</body>

</html>