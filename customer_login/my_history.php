<?php
include('session.php');
?>

<!DOCTYPE html>
<html>

<head>
  <title>Log In</title>
  <link rel="stylesheet" href="../css/styles.css">
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
        <li><a href="home_customer.php">Home</a></li>
        <li><a href="book.php">Book</a></li>
        <li><a href="add_vehicle.php">Add Vehicle</a></li>
        <li class="active"><a href="my_history.php">My History</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="../logout.php"><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>
      </ul>
    </div>
  </nav>

  <div id="sign-up">
    <?php
    //Our select statement. This will retrieve the data that we want.
    $email = $_SESSION["login_gergarage"];

    $sql = "  SELECT *, vehicle.type FROM booking 
              INNER JOIN vehicle ON vehicle.license = booking.vehicle_license
              WHERE vehicle.customer_email = '$email'
              ORDER BY DATE;";
              

    //  $sql = "SELECT * FROM booking where Customer_email = '$email' ORDER BY DATE;";

    if ($result = mysqli_query($conn, $sql)) {
      if (mysqli_num_rows($result) > 0) {
        echo "  <table class='table table-hover'>
        <thead>
        <tr>
        <th>Date</th>
        <th>ID</th>
        <th>Make</th>
        <th>Type</th>
        <th>Engine</th>
        <th>Service Type</th>
        <th>License</th>
        <th>Status</th>
        </tr>
        </thead>
        <tbody>";
        while ($row = $result->fetch_assoc()) {
          echo "<tr><td>" .
            $row["date"] . "</td><td>" .
            $row["id_booking"] . "</td><td>" .
            $row["make"] . "</td><td>" .
            $row["type"] . "</td><td>" .
            $row["engine_type"] . "</td><td>" .
            $row["service_type"] . "</td><td>" .
            $row["license"] . "</td><td>" .
            $row["status"] . "</td><td>" .
            "</td></tr>";
        }
        echo "</tbody>
        </table>";
      } else {
        echo "0 Result";
      }
    }
    ?>
  </div>

</body>

</html>