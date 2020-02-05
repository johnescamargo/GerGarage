<?php
include('session_admin.php');
?>

<!DOCTYPE html>
<html>

<head>
  <title>Manage</title>
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
      background-image: url("../img/admin.jpg");
      color: black;
    }
  </style>
</head>

<body>

  <nav class="navbar navbar-inverse">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="home_admin.php">Admin</a>
      </div>
      <ul class="nav navbar-nav">
        <li><a href="home_admin.php">Home</a></li>
        <li><a href="booking_admin.php">Print Boookings</a></li>
        <li class="active"><a href="manage_bookings.php">Manage</a></li>
        <li><a href="invoice.php">Invoice</a></li>
        <li><a href="add_staff.php">Add Staff</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="../logout.php"><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>
      </ul>
    </div>
  </nav>

  <div id="sign-up3">
    <form method="get">
      <div class="form-group">
        <label for="id">ID Booking:</label>
        <input name="id-booking" type="text" class="form-control" placeholder="Enter ID" id="id-booking" required>
        <br>
        <div class="form-group">
          <button name="submit1" type="submit" class="btn btn-primary">Search</button>
        </div>
      </div>

    </form>

    <form method="post">
      <div class="form-group">
        <label for="engine_type">Status:</label>
        <select class="form-control" name="status" id="status">
          <option>In Service</option>
          <option>Fixed / Completed</option>
          <option>Collected</option>
          <option>Unrepairable / Scrapped</option>
        </select>
        <br>
        <div class="form-group">
          <label for="license">Mechanic:</label>
          <?php
          //Our select statement. This will retrieve the data that we want.
          // $email = $_SESSION["login_admin"];

          $sql = "SELECT * FROM staff;";


          if ($result = mysqli_query($conn, $sql)) {
            if (mysqli_num_rows($result) > 0) {
              echo "<select class='form-control' id='staff' name='staff' required>";
              echo "<option></option>";
              while ($row = mysqli_fetch_array($result)) {

                echo "<option>" . $row['name'] . "</option>";
              }
              echo "</select>";
              // Free result set
              mysqli_free_result($result);
            } else {
              echo "No records matching your query were found.";
            }
          } else {
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
          }
          ?>

        </div>
        <br>

        <button name="update" type="submit" class="btn btn-primary">Update Information</button>
      </div>

    </form>
  </div>


  <?php

  if (isset($_GET['submit1'])) {
    $id =  $_GET['id-booking'];
    $_SESSION['id-booking'] = $id;

    $sql = "SELECT *, vehicle.type FROM booking 
               INNER JOIN vehicle ON booking.vehicle_license = vehicle.license
               INNER JOIN staff ON staff.id_staff = staff_id_staff
               WHERE id_booking = $id;";

    if ($result = mysqli_query($conn, $sql)) {

      if (mysqli_num_rows($result) > 0) {
        echo "  <div id='sign-up'>
          <table style ='width: -webkit-fill-available;'>
                    <thead>
                    <tr>
                    <th>Date</th>
                    <th>ID</th>
                    <th>Type</th>
                    <th>Engine</th>
                    <th>Make</th>
                    <th>Service Type</th>
                    <th>License</th>
                    <th>Status</th>
                    <th>Mechanic</th>
                    </tr>
                    </thead>
                    <tbody>";
        while ($row = $result->fetch_assoc()) {
          echo "<tr><td>" .
            $row["date"] . "</td><td>" .
            $row["id_booking"] . "</td><td>" .
            $row["type"] . "</td><td>" .
            $row["engine_type"] . "</td><td>" .
            $row["make"] . "</td><td>" .
            $row["service_type"] . "</td><td>" .
            $row["license"] . "</td><td>" .
            $row["status"] . "</td><td>" .
            $row["name"] . "</td><td>" .
            "</td></tr>";
        }
        echo "</tbody>
                  </table></div></br>";
      } else {
        echo "0 Result";
      }
    }


    // Just for Comment
    if ($result = mysqli_query($conn, $sql)) {
      if (mysqli_num_rows($result) > 0) {
        echo " <div id='sign-up'> <table style ='width: -webkit-fill-available;' >
                    <thead>
                    <tr>
                    <th>Comment</th>
                    </tr>
                    </thead>
                    <tbody>";
        while ($row = $result->fetch_assoc()) {
          echo "<tr><td>" .
            $row["comment"] . "</td><td>" .
            "</td></tr>";
        }
        echo "</tbody>
                  </table></div></br>";
      } else {
        echo "0 Result";
      }
    }
  }
  ?>




  <?php
  // update booking
  if (isset($_POST['update'])) {
    $status = $_POST['status'];
    $name_staff = $_POST['staff'];
    $id_book = $_SESSION['id-booking'];

    $sql1 = "SELECT id_staff FROM staff WHERE name = '$name_staff';";

    $result1 = mysqli_query($conn, $sql1);
    $id2 = mysqli_fetch_row($result1); //array
    $id_staff = implode(" ", $id2);

    //Update into Booking Table
    $sql = "UPDATE booking
            SET status='$status', staff_id_staff= $id_staff
            WHERE id_booking = $id_book;";
    $result = mysqli_query($conn, $sql);

    //Update into Invoice Table
    $sql33 = "UPDATE invoice 
              SET staff_id_staff= $id_staff
              WHERE booking_id_booking = $id_book;";
    $result = mysqli_query($conn, $sql33);


    echo "<meta http-equiv='refresh' content='0'>"; //refresh the page after updating values
  }

  ?>



</body>

</html>