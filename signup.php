<?php
//
session_start();
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST")
//if(isset($_POST['login_button']))
{
    $email = $_POST['email'];
    $Name = $_POST['name1'];
    $Surname = $_POST['surname'];
    $Mob_phone = $_POST['mob_phone'];
    $Gender = $_POST['gender'];
    $password = $_POST['password'];

    $sql = "INSERT INTO customer (email, name, surname, mob_phone, gender, password) 
  			  VALUES('$email', '$Name', '$Surname', '$Mob_phone', '$Gender', '$password')";
    $result = mysqli_query($conn, $sql);

}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Ger's Garage</title>
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
        <form method="post" action="signup.php" onsubmit="return checkForm(this);">
            <div class="form-group">
                <label for="email">Email address:</label>
                <input name="email" type="email" class="form-control" placeholder="Enter email" id="email" required>
            </div>
            <div class="form-group">
                <label for="gender">Gender:</label>
                <label class="radio-inline"><input value="F" type="radio" name="gender" checked>Female</label>
                <label class="radio-inline"><input value="M" type="radio" name="gender">Male</label>
                <label class="radio-inline"><input value="N" type="radio" name="gender">I'd rather not say</label>
            </div>

            <div class="form-group">
                <label for="name">Name:</label>
                <input name="name1" type="name" class="form-control" placeholder="Enter name" id="name" required>
            </div>
            <div class="form-group">
                <label for="surname">Surname:</label>
                <input name="surname" type="surname" class="form-control" placeholder="Enter surname" id="surname" required>
            </div>

            <div class="form-group">
                <label for="mobile-phone">Mobile Phone:</label>
                <input name="mob_phone" type="tel" pattern="[0-9]{10}" class="form-control" placeholder="Enter Mobile Phone" id="mobile-phone" required>

                <!-- <input type="tel" id="phone" name="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required> -->
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input name="password" type="password" minlength="8" class="form-control" placeholder="Enter password" id="password" required>
            </div>

            <p><input id="field_terms" onchange="this.setCustomValidity(validity.valueMissing ? 'Please indicate that you accept the Terms and Conditions' : '');" type="checkbox" required name="terms"> I accept the <a href="#"><u>Terms and Conditions</u></a></p>

            <button name="reg_user" type="submit" class="btn btn-primary">Submit</button>

            <script>
                document.getElementById("field_terms").setCustomValidity("Please indicate that you accept the Terms and Conditions");
            </script>
        </form>
    </div>

</body>

</html>