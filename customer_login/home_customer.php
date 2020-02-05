<?php
include('session.php');
?>

<!DOCTYPE html>
<html>

<head>
    <title>Home</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="css/mycss.css">
    <script src="../js/javaScript.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        body {
            background-image: url("../img/customer.jpg");
            color: black;
        }
    </style>

</head>

<body>

    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="home_customer.php">Customer</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="home_customer.php">Home</a></li>
                <li><a href="book.php">Book</a></li>
                <li><a href="add_vehicle.php">Add Vehicle</a></li>
                <li><a href="my_history.php">My History</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="../logout.php"><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>
            </ul>
        </div>
    </nav>

    <div id="sign-up"> <?php echo "Welcome " . $_SESSION["login_name"]; ?></div>


    <div id="sign-up">
        <div id="sign-up">
            <h3>Hybrid and Electric Vehicles</h3>
            <p>Need your Hybrid and Electric Vehicle serviced and repaired. We are a fully qualified and trained electric vehicle repair centre. Diagnosing and repairing hybrid and EV faults including high voltage battery repairs, battery cell replacements and programing. We have the diagnostic and maintenance systems in place for Toyota Prius, Yaris EV, Mitsubishi Outlander PHEV, Golf GTE, Audi e-tron, Lexus hybrids including RX models, BMW i3 and i8 models, Mercedes C300 H and Volvo hybrids.</p>
            </br>
        </div>

        <div id="sign-up">
            <h3>Performance Tuning & Custom Remapping</h3>
            <p>And to add another string to our bow we are providing the top class service of Customised Remapping. What this means is that with our UK performance partners, we can upgrade your vehicles software to a more advanced level. The maps used to update the engines software have been extensively tried and tested. Use our website app below to check how much power you can achieve from your car or van.

                We can also add and remove electronic speed limiters and make map corrections. All our custom tunes are developed specifically for your requirements and can be set back to your original file like nothing was every changed with the press of a button. For more information on this great service please call or message us today.</p>
        </div>
    </div>





</body>

</html>