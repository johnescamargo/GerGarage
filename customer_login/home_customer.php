<?php
include('session.php');
?>

<!DOCTYPE html>
<html>

<head>
    <title>Customer</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="css/mycss.css">
    <script src="../js/javaScript.js"></script>

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


    <div id="division">
        <div id="a111">
            <form method="get">
                <label for="id">ID Invoice / Booking: </label>
                <input name="id-invoice" type="text" class="form-control" placeholder="Enter ID Invoice" id="id-invoice" required>
                <br>
                <div class="form-group">
                    <button name="search" type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>
        </div>


        <div id="a111">
            <form method="get">
                <label for="id">ID Invoice / Booking: </label>
                <input name="id-invoice" type="text" class="form-control" placeholder="Enter ID Invoice" id="id-invoice" required>
                <br>
                <div class="form-group">
                    <button name="search" type="submit" class="btn btn-primary">Search</button>
                </div>
            </form>
        </div>


        <div id="a111">
        <form method="get">
                <label for="id">Print Invoice: </label>
            
            </br>
            <div class="form-group">
                <button onclick='myFunction()' class='btn btn-primary'>Print this page</button>
            </div>
            <script>
                function myFunction() {
                    window.print();
                }
            </script>
            </form>
        </div>


    </div>

</body>

</html>