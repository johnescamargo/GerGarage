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
    <title>Sign Up</title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/javaScript.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        body {
            background-image: url("img/signup.jpg");
            color: black;
        }

        /* The Modal (background) */
        .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            padding-top: 100px;
            /* Location of the box */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            overflow: auto;
            /* Enable scroll if needed */
            background-color: rgb(0, 0, 0);
            /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        /* The Close Button */
        .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
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


    <div id="sign-up2">
        <h2>Sign up</h2>
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

            <p><input id="field_terms" onchange="this.setCustomValidity(validity.valueMissing ? 
            'Please indicate that you accept the Terms and Conditions' : '');" type="checkbox" required name="terms"> I accept the <a id="myBtn" href="#">
                    <u>Terms and Conditions</u></a></p>

            <button name="reg_user" type="submit" class="btn btn-primary">Submit</button>

            <div id="myModal" class="modal">

                <!-- Modal content -->
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <p>Terms and Conditions agreements act as a legal 
                        contract between you (the company) who has the 
                        website or mobile app and the user who access your 
                        website and mobile app.</p>
                    <p> Having a Terms and Conditions agreement is completely 
                        optional. No laws require you to have one. Not even the 
                        super-strict and wide-reaching General Data Protection Regulation (GDPR).</p>
                    <p> It's up to you to set the rules and guidelines that
                         the user must agree to. You can think of your Terms 
                         and Conditions agreement as the legal agreement where
                          you maintain your rights to exclude users from your app 
                          in the event that they abuse your app, where you maintain 
                          your legal rights against potential app abusers, and so on.</p>
                    <p> Terms and Conditions are also known as Terms of Service or Terms of Use.</p>
                </div>

            </div>


            <script>
                document.getElementById("field_terms").setCustomValidity("Please indicate that you accept the Terms and Conditions");
            </script>
        </form>
        </br>
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
    <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal 
        btn.onclick = function() {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>


</body>

</html>