<?php
include('session_admin.php');
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
        <a class="navbar-brand" href="home_admin.php">Admin</a>
      </div>
      <ul class="nav navbar-nav">
        <li class="active"><a href="home_admin.php">Home</a></li>
        <li><a href="booking_admin.php">Print Boookings</a></li>
        <li><a href="manage_bookings.php">Manage</a></li>
        <li><a href="invoice.php">Invoice</a></li>
        <li><a href="add_staff.php">Add Staff</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="../logout.php"><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>
      </ul>
    </div>
  </nav>

  <div>


  </div>


  <div id="sign-up">
    <label for="bookings_day">Bookings of the day</label>
    <?php
    //Our select statement. This will retrieve the data that we want.
    $todays_date = date("Y-m-d");
    //echo '<script type="text/javascript">alert("'.$email.'");</script>';//working

    $sql = "SELECT *, vehicle.type FROM booking 
            INNER JOIN vehicle ON booking.vehicle_license = vehicle.license
            INNER JOIN staff ON staff.id_staff = staff_id_staff
            WHERE DATE =  '$todays_date';";

    // $sql = "SELECT * FROM booking where Date = '$todays_date';";

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
                          <th>License</th>
                          <th>Service Type</th>
                          <th>Status</th>
                          <th>Mechanic</th>
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
            $row["license"] . "</td><td>" .
            $row["service_type"] . "</td><td>" .
            $row["status"] . "</td><td>" .
            $row["name"] . "</td><td>" .
            "</td></tr>";
        }
        echo "</tbody>
        </table> </br>";
      } else {
        echo "0 Result";
      }
    }
    ?>

    </br>
    <label for="bookings_week">Bookings of the week</label>
    <?php
    //Our select statement. This will retrieve the data that we want.
    $todays_date = date("Y-m-d");
    $six_days_date = date('Y-m-d', strtotime($todays_date . ' + 6 days'));
    //echo '<script type="text/javascript">alert("'.$email.'");</script>';//working

    $sql = "SELECT *, vehicle.type FROM booking 
            INNER JOIN vehicle ON booking.vehicle_license = vehicle.license
            INNER JOIN staff ON staff.id_staff = staff_id_staff
            WHERE DATE BETWEEN '$todays_date' and '$six_days_date' ORDER BY DATE;";
    //  select * from booking where date BETWEEN '2020-01-26' and '2020-01-31'

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
        <th>License</th>
        <th>Service Type</th>
        <th>Status</th>
        <th>Mechanic</th>
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
            $row["license"] . "</td><td>" .
            $row["service_type"] . "</td><td>" .
            $row["status"] . "</td><td>" .
            $row["name"] . "</td><td>" .
            "</td></tr>";
        }
        echo "</tbody>
        </table> ";
      } else {
        echo "0 Result";
      }
    }
    ?>


  </div>

</body>

</html>