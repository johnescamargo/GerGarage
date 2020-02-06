<?php
include('session.php');
?>

<!DOCTYPE html>
<html lang="en-us">

<head>
  <title>Booking</title>
  <link rel="stylesheet" href="../css/styles.css">
  <script src="js/javaScript.js"></script>

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
        <li class="active"><a href="book.php">Book</a></li>
        <li><a href="add_vehicle.php">Add Vehicle</a></li>
        <li><a href="my_history.php">My History</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="../logout.php"><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>
      </ul>
    </div>
  </nav>


  <div id="sign-up3">
    <form method="post" action="book.php">
      <div class="form-group">
        <label for="sel1">Select Your Vehicle: </label>
        <?php
        //Our select statement. This will retrieve the data that we want.
        $email = $_SESSION["login_gergarage"];

        $sql = "SELECT * FROM vehicle where customer_email = '$email';";

        if ($result = mysqli_query($conn, $sql)) {
          if (mysqli_num_rows($result) > 0) {
            echo "<select class='form-control' id='vehicle_license' name='vehicle_license' required>";
            echo "<option></option>";
            while ($row = mysqli_fetch_array($result)) {

              echo "<option>" . $row['type'] . "</option>";
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
        <br>

        <label for="service_type">Service Type</label>
        <select class="form-control" name="service_type" id="service_type" required>
          <option></option>
          <option value="Annual Service">Annual Service</option>
          <option value="Major Service">Major Service</option>
          <option value="Repair / Fault">Repair / Fault</option>
          <option value="Major Repair">Major Repair</option>
        </select>
        <br>

        <div class="form-group">
          <label for="comment">Comment:</label>
          <textarea class="form-control" name="comment" rows="3" placeholder="Tell us what is going on." id="comment" required></textarea>
        </div>

        <div class="bootstrap-iso">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-12">

                <!-- Form code begins -->
                <form method="post">
                  <div class="form-group">
                    <!-- Date input -->
                    <label class="control-label" for="date">Date</label>
                    <input class="form-control" id="date" name="date" placeholder="YYYY-MM-DD" type="text" required />
                  </div>
                  <div class="form-group">
                    <!-- Submit button -->
                    <button class="btn btn-primary " id="submit" name="submit" onclick="ChangeCarList()" type="submit">Book</button>

                    <?php

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                      $service_type = $_POST['service_type'];
                      $comment = $_POST['comment'];
                      $date = $_POST['date'];
                      $cus_email = $_SESSION["login_gergarage"];
                      $vehicle_name = $_POST['vehicle_license'];
                      // echo '<script type="text/javascript">alert("'.$vehicle_name.'");</script>';//working

                      // Count bookings per day in list of bookings
                      $sql = "SELECT COUNT(date) FROM booking 
                      where date = '$date';";

                      $result = mysqli_query($conn, $sql);
                      $count1 = mysqli_fetch_row($result);
                      $count = implode(" ", $count1);
                      // echo '<script type="text/javascript">alert("' . $count . '");</script>'; //working

                      if ($count < 16) {
                        //Insert into booking =====================================================  e essa mano
                        $sql2 = "SELECT license FROM vehicle 
                        where customer_email = '$cus_email' and type = '$vehicle_name';";

                        $result1 = mysqli_query($conn, $sql2);
                        $vehicle_license1 = mysqli_fetch_row($result1); //array
                        $vehicle_license11 = implode(" ", $vehicle_license1);

                        //Insert into BOOKING Table
                        $sql3 = "INSERT INTO `booking` ( `service_type`, `comment`, `date`, `customer_email`, `vehicle_license`, `status`, `staff_id_staff`) 
                        VALUES('$service_type', '$comment', '$date','$cus_email', '$vehicle_license11', 'Booked', 1);";
                        $result = mysqli_query($conn, $sql3);

                        //Insert into BOOKING Table
                        $sql4 = "SELECT * from booking  
                        where date = '$date'
                        and vehicle_license = '$vehicle_license11';";
                        $result2 = mysqli_query($conn, $sql4);
                        $row = mysqli_fetch_assoc($result2);
                        $id_booking = $row['id_booking'];

                        //Insert into Invoice Table
                        $sql33 = "INSERT INTO invoice (id_invoice, total_price, date, booking_id_booking, vehicle_license, customer_email) 
                                  VALUES($id_booking, 0, '$date',  $id_booking, '$vehicle_license11','$cus_email');";
                        $result = mysqli_query($conn, $sql33);

                        // Save Major Repair
                        if ($service_type === "Major Repair") {
                          //Update into Invoice Table
                          $sql34 = "UPDATE invoice 
                                    SET total_price= 160
                                    WHERE booking_id_booking = $id_booking;";
                          $result2 = mysqli_query($conn, $sql34);

                          //save value to Services table
                          $sql5 = "INSERT INTO services (`service_name`, `service_price`, `invoice_id_invoice`)
                          VALUES ('Major Repair', 160 ,$id_booking);";

                          $result5 = mysqli_query($conn, $sql5);
                        } else 
                        // Save Annual Service
                        if ($service_type === "Annual Service") {
                          //Update into Invoice Table
                          $sql34 = "UPDATE invoice 
                          SET total_price= 235
                          WHERE booking_id_booking = $id_booking;";
                          $result22 = mysqli_query($conn, $sql34);

                          //save value to Services table
                          $sql5 = "INSERT INTO services (`service_name`, `service_price`, `invoice_id_invoice`)
                          VALUES ('Annual Service', 160 ,$id_booking);";

                          $result5 = mysqli_query($conn, $sql5);
                        } else

                        // Save Major Service
                        if ($service_type === "Major Service") {
                          //Update into Invoice Table
                          $sql344 = "UPDATE invoice 
                          SET total_price= 235
                          WHERE booking_id_booking = $id_booking;";
                          $result26 = mysqli_query($conn, $sql344);

                          //save value to Services table
                          $sql5 = "INSERT INTO services (`service_name`, `service_price`, `invoice_id_invoice`)
                          VALUES ('Major Service', 150, $id_booking);";

                          $result5 = mysqli_query($conn, $sql5);
                        } else

                        // Save Repair / Fault
                        if ($service_type === "Repair / Fault") {
                          //Update into Invoice Table
                          $sql34 = "UPDATE invoice 
                          SET total_price= 235
                          WHERE booking_id_booking = $id_booking;";
                          $result2 = mysqli_query($conn, $sql34);

                          //save value to Services table
                          $sql5 = "INSERT INTO services (`service_name`, `service_price`, `invoice_id_invoice`)
                         VALUES ('Repair / Fault', 240, $id_booking);";

                          $result5 = mysqli_query($conn, $sql5);
                        }


                      } else {
                        echo '<script>alert("There is no available time")</script>';
                      }
                    }
                    ?>

                  </div>
                </form>
                <!-- Form code ends -->

              </div>
            </div>
          </div>
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

      </div>
    </form>

  </div>



</body>

</html>