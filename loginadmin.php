<?php
//
session_start();
include 'admin_login/db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST")
//if(isset($_POST['login_button']))
{
  $email = $_POST['email'];
  $password = $_POST['password'];
  $sql = "SELECT * FROM useradmin WHERE email='$email' && Password='$password'";
  $sqlName = "SELECT name FROM useradmin WHERE email='$email' && Password='$password'";

  $result = mysqli_query($conn, $sql);
  $resultName = mysqli_query($conn, $sqlName);
  $row = mysqli_fetch_assoc($result);

  $count = mysqli_num_rows($result);

  // If result matched $myusername and $mypassword, table row must be 1 row
  if ($count == 1) {
    $_SESSION['login_admin'] = $row['email'];
    $_SESSION['login_name'] = $row['name'];
    header('Location: success.html');
    header('Location: admin_login/home_admin.php');
  } else {
    echo '<script>alert("Your Login Name or Password is invalid!")</script>';
  }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin</title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/javaScript.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

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

    <div id="sign-up">
    <form method="post">
        <div class="form-group">
          <label for="email">Email address Admin:</label>
          <input name="email" type="text" class="form-control" id="email">
        </div>
        <div class="form-group">
          <label for="pwd">Password:</label>
          <input name="password" type="password" class="form-control" id="pwd">
        </div>
        <div class="checkbox">
          <label><input type="checkbox"> Remember me</label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>

</body>

</html>