<?php
include('session.php');
?>

<!DOCTYPE html>
<html>

<head>
    <title>Register Vehicle</title>
    <link rel="stylesheet" href="../css/styles.css">
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
                <li><a href="home_customer.php">Home</a></li>
                <li><a href="book.php">Book</a></li>
                <li class="active"><a href="add_vehicle.php">Add Vehicle</a></li>
                <li><a href="my_history.php">My History</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="../logout.php"><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>
            </ul>
        </div>
    </nav>

    <div id="sign-up3">
        <form method="post" action="add_vehicle.php">
            <div class="form-group">
                <label for="make">Make</label>
                <select class="form-control" id="make" name="make" onchange="ChangeCarList()">
                    <option value="">-- Vehicle --</option>
                    <option value="Audi">Audi</option>
                    <option value="BMW">BMW</option>
                    <option value="Chevrolet">Chevrolet</option>
                    <option value="Citroen">Citroen</option>
                    <option value="Ferrari">Ferrari</option>
                    <option value="Fiat">Fiat</option>
                    <option value="Volkswagen">Volkswagen</option>
                    <option value="Volvo">Volvo</option>

                </select>
                <br>

                <label for="type">Type</label>
                <select class="form-control" name="type" id="type" required>
                </select>
                <br>

                <label for="engine_type">Engine Type</label>
                <select class="form-control" name="engine_type" id="engine_type">
                    <option>Diesel</option>
                    <option>Petrol</option>
                    <option>Hybrid</option>
                    <option>Electric</option>
                </select>
                <br>

                <div class="form-group">
                    <label for="license">License:</label>
                    <input name="license" type="license" class="form-control" placeholder="Enter License" id="license" required>
                </div>
                <br>

                <button name="reg_vehicle" type="submit" class="btn btn-primary">Register Vehicle</button>
            </div>

        </form>
    </div>

    <script>
        var carsAndModels = {};
        carsAndModels['Audi'] = ['A1', 'A2', 'A3', 'A4', 'A5', 'A6', 'A7', 'A8'];
        carsAndModels['BMW'] = ['M6', 'X5', 'Z3'];
        carsAndModels['Chevrolet'] = ['Aveo', 'Blazer', 'C10', 'Captiva', 'Camaro', 'Silverado'];
        carsAndModels['Citroen'] = ['Berlingo', 'C1', 'C2', 'C3', 'C4', 'C5', 'C6', 'C8', 'Picasso', 'Xsara'];
        carsAndModels['Fiat'] = ['Bravo', 'Cinquecento - 500', 'Doblo', 'Idea', 'Palio', 'Punto', 'Siena', 'Uno'];
        carsAndModels['Ferrari'] = ['F50', 'F51', 'F60'];
        carsAndModels['Volkswagen'] = ['Golf', 'Polo', 'Scirocco', 'Touareg'];
        carsAndModels['Volvo'] = ['V70', 'XC60', 'XC90'];




        function ChangeCarList() {
            var carList = document.getElementById("make");
            var modelList = document.getElementById("type");
            var selCar = carList.options[carList.selectedIndex].value;
            while (modelList.options.length) {
                modelList.remove(0);
            }
            var cars = carsAndModels[selCar];
            if (cars) {
                var i;
                for (i = 0; i < cars.length; i++) {
                    var car = new Option(cars[i], carsAndModels[i]);
                    modelList.options.add(car);
                }
            }
        }
    </script>
    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $license = $_POST['license'];
        $type = $_POST['type'];
        $engine_type = $_POST['engine_type'];
        $make = $_POST['make'];
        $cus_email = $_SESSION["login_gergarage"];

        $sql = "INSERT INTO vehicle (license, type, engine_type, make, customer_email) 
                        VALUES('$license', '$type', '$engine_type', '$make', '$cus_email');";
        $result = mysqli_query($conn, $sql);
    }
    ?>

<div id="sign-up">
    <?php
    //Our select statement. This will retrieve the data that we want.
    $email = $_SESSION["login_gergarage"];

    $sql = "SELECT * FROM vehicle WHERE customer_email = '$email'
            ORDER BY make;";


    //  $sql = "SELECT * FROM booking where Customer_email = '$email' ORDER BY DATE;";

    if ($result = mysqli_query($conn, $sql)) {
      if (mysqli_num_rows($result) > 0) {
        echo " <div id='sign-up3'> <table class='table table-hover'>
        <thead>
        <tr>
        <th>Make</th>
        <th>Type</th>
        <th>Engine</th>
        <th>License</th>
        </tr>
        </thead>
        <tbody>";
        while ($row = $result->fetch_assoc()) {
          echo "<tr><td>" .
            $row["make"] . "</td><td>" .
            $row["type"] . "</td><td>" .
            $row["engine_type"] . "</td><td>" .
            $row["license"] . "</td><td>" .
               "</td></tr>";
        }
        echo "</tbody>
        </table></div>";
      } else {
        echo "0 Result";
      }
    }
    ?>
  </div>


</body>

</html>