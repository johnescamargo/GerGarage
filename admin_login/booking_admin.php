<?php
include('session_admin.php');
?>

<!DOCTYPE html>
<html>

<head>
  <title>Print Bookings</title>
  <link rel="stylesheet" href="../css/styles.css">
  <script src="../js/javaScript.js"></script>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <!--  jQuery -->
  <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

  <!-- Isolated Version of Bootstrap, not needed if your site already uses Bootstrap -->
  <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />

  <!-- Bootstrap Date-Picker Plugin -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" />

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
        <li class="active"><a href="booking_admin.php">Print Boookings</a></li>
        <li><a href="manage_bookings.php">Manage</a></li>
        <li><a href="invoice.php">Invoice</a></li>
        <li><a href="add_staff.php">Add Staff</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="../logout.php"><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>
      </ul>
    </div>
  </nav>

  <div id="sign-up" class="bootstrap-iso">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">

          <!-- Form code begins -->
          <form method="get">
            <div class="form-group">
              <label class="control-label" for="date">Choose a day</label>
              </br>

              <!-- Date input -->
              <label class="control-label" for="date">Date</label>
              <input class="form-control" id="date" name="date" placeholder="YYYY-MM-DD" type="text" required />
            </div>
            <div class="form-group">
              <!-- Submit button -->
              <button class="btn btn-primary" id="submit" name="submit" type="submit">Select</button>
            </div>
          </form>
          <!-- Form code ends -->

        </div>
      </div>
    </div>
  </div>

  <div id="sign-up">
    <?php
    //Our select statement. This will retrieve the data that we want.

    //echo '<script type="text/javascript">alert("'.$email.'");</script>';//working

    if (isset($_GET['submit'])) {
      $date_chosen =  $_GET['date'];

      $sql = "SELECT *, vehicle.type FROM booking 
              INNER JOIN vehicle ON booking.vehicle_license = vehicle.license
              INNER JOIN staff ON staff.id_staff = staff_id_staff
              WHERE DATE = ' $date_chosen'
              ORDER BY id_booking;";

      // $sql = "SELECT * FROM booking where Date = '$todays_date';";

      echo "<p>Click the button to print the current page.</p>

      <button onclick='myFunction()' class='btn btn-primary'>Print this page</button>
      
      <script>
      function myFunction() {
        window.print();
      }
      </script>";

      if ($result = mysqli_query($conn, $sql)) {
        if (mysqli_num_rows($result) > 0) {
          echo "  <table class='table table-hover'>
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
                        </table> </br>";
        } else {
          echo "0 Result";
        }
      }

      if ($result = mysqli_query($conn, $sql)) {
        if (mysqli_num_rows($result) > 0) {
          echo " <div id='divisionInvoice' >
            <div id='a112'>
            <table id='table-invoice' class='table table-hover' style ='width: -webkit-fill-available;' >
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
                            </table></div></div>";
        } else {
          echo "0 Result";
        }
      }
    }
    ?>

  </div>


  <script>
    $(document).ready(function() {
      var date_input = $('input[name="date"]'); //our date input has the name "date"
      var container = $('.bootstrap-iso form').length > 0 ? $('.bootstrap-iso form').parent() : "body";
      var options = {
        format: 'yyyy-mm-dd',
        container: container,
        todayHighlight: true,
        autoclose: true,
        daysOfWeekDisabled: [0],
      };
      date_input.datepicker(options);
    })
  </script>

</body>

</html>