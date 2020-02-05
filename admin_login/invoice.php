<?php
include('session_admin.php');
?>

<!DOCTYPE html>
<html>

<head>
  <title>Invoice</title>
  <link rel="stylesheet" href="../css/styles.css">
  <link rel="stylesheet" href="css/mycss.css">
  <script src="../js/javaScript.js"></script>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
        <li><a href="manage_bookings.php">Manage</a></li>
        <li class="active"><a href="invoice.php">Invoice</a></li>
        <li><a href="add_staff.php">Add Staff</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="../logout.php"><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>
      </ul>
    </div>
  </nav>

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
      <form method="post">
        <label for="id">Services: </label>
        <select class="form-control" id="service" name="service">
          <option>Air Filter Replacement</option>
          <option>Battery</option>
          <option>Brake Pads</option>
          <option>Brake Fluid</option>
          <option>Cambelt</option>
          <option>Clutch replacements</option>
          <option>Coolant Change</option>
          <option>Diagnostic health check</option>
          <option>Gearbox Repair</option>
          <option>Exhaust replacements</option>
          <option>Shocks</option>
          <option>Suspension Repair</option>
          <option>Steering Repair</option>
          <option>Tracking</option>
          <option>Tyre Punctures</option>
          <option>Wheel Alignment</option>
          <option>Wiper blades replacement</option>

        </select>


        <div class="form-group">
          <button name="add-service" type="submit" class="btn btn-primary">Add Service</button>
        </div>
      </form>
    </div>


    <div id="a111">

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

    </div>

  </div>


  <?php

  if (isset($_GET['search'])) {
    $id =  $_GET['id-invoice'];
    $_SESSION['id-invoice'] = $id;
    $todays_date = date("Y-m-d");

    $sql = "SELECT * FROM invoice 
            INNER JOIN vehicle ON vehicle.license = invoice.vehicle_license
            INNER JOIN customer ON customer.email = invoice.customer_email
            INNER JOIN booking ON booking.id_booking = invoice.id_invoice
            WHERE id_invoice = $id;";


    if ($result = mysqli_query($conn, $sql)) {
      if (mysqli_num_rows($result) > 0) {

        echo "<div id='divisionInvoice'>
                   <div id='a111'> 
                       <img src='img/ger.jpg' style='width: 170px;' alt='Ger's logo'>
                   </div>

                   <div id='a111'> 
                       <label>Id Invoice : </label>
                       <label>" . $id . "</label>
                       </br>
                       <label>Date of withdrawal: </label>
                       <label>" . $todays_date . "</label>                  
                   </div>
              </div> ";

        echo " <div id='divisionInvoice'>
           <div id='a112'> 
            <label>Customer </label>
            <table id='table-invoice' class='table table-hover' style ='width: -webkit-fill-available;'>
                          <thead>
                          <tr>
                          <th>Name</th>
                          <th>Surname</th>
                          <th>Phone</th>
                          <th>Email</th>
                          </tr>
                          </thead>
                          <tbody>";
        while ($row = $result->fetch_assoc()) {
          echo "<tr><td>" .
            $row["name"] . "</td><td>" .
            $row["surname"] . "</td><td>" .
            $row["mob_phone"] . "</td><td>" .
            $row["email"] . "</td><td>" .
            "</td></tr>";
        }
        echo "</tbody>
                        </table></div>";
      } else {
        echo "0 Result";
      }
    }



    if ($result = mysqli_query($conn, $sql)) {
      if (mysqli_num_rows($result) > 0) {
        echo "  <div id='a112'> 
            <label>Vehicle </label>
            <table id='table-invoice' class='table table-hover' style ='width: -webkit-fill-available;'>
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
                        </table> </div></div>";
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

    //Collumns Service and Price 
    $id_invoice =  $_GET['id-invoice'];
    $sql66 = "SELECT * FROM services WHERE invoice_id_invoice = $id_invoice;";

    if ($result = mysqli_query($conn, $sql66)) {
      if (mysqli_num_rows($result) > 0) {
        echo " <div id='divisionInvoice'>
           <div id='a112'>
      <table id='table-invoice' class='table table-hover' style ='width: -webkit-fill-available;' >
                        <thead>
                        <tr>
                        <th>Service</th>
                        <th>Price</th>
                        </tr>
                        </thead>
                        <tbody>";
        while ($row = $result->fetch_assoc()) {
          echo "<tr><td>" .
            $row["service_name"] . "</td><td>" .
            $row["service_price"] . "</td><td>" .
            "</td></tr>";
        }
        echo "</tbody>
                      </table></div></div>";
      } else {
        echo "0 Result";
      }



      //Sum prices and save into invoice
      $sql9 = "SELECT SUM(service_price)
              FROM services
              WHERE invoice_id_invoice =  $id_invoice;";

      $sum_total1 = mysqli_query($conn, $sql9);
      $sum_total2 = mysqli_fetch_row($sum_total1); //array
      $sum_total3 = implode(" ", $sum_total2);

      //Update into Invoice Table
      $todays_date = date("Y-m-d");
      $sql33 = "UPDATE invoice 
                SET total_price= $sum_total3
                SET date= $todays_date
                WHERE id_invoice = $id_invoice;";

      $result = mysqli_query($conn, $sql33);


      //Collumns Service and Price 
      $id_invoice =  $_GET['id-invoice'];
      $sql662 = "SELECT * FROM invoice WHERE id_invoice = $id_invoice;";

      if ($result62 = mysqli_query($conn, $sql662)) {
        if (mysqli_num_rows($result62) > 0) {
          while ($row = $result62->fetch_assoc()) {
            echo " <div id='divisionInvoice'>
               <div id='a112'>
               <table id='table-invoice' class='table table-hover' style ='width: -webkit-fill-available;' >
                 <thead>
                 <tr>
                 <th>Total  _______ €</th>
                 <th>" .
              $row["total_price"] . "</th>
                 </tr>
                 </thead>
                 <tbody>";
          }
          echo "</tbody>
                 </table></div></div>";
        } else {
          echo "0 Result";
        }
      }
    }
  }

  ?>



  <?php

  if (isset($_POST['add-service'])) {

    $id_invoice = $_SESSION['id-invoice'];
    $name_service =  $_POST['service'];
    $sql = "SELECT * FROM service_cost where name_service = '$name_service';";

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $price = $row['cost_service'];


    $sql5 = "INSERT INTO services (`service_name`, `service_price`, `invoice_id_invoice`)
            VALUES ('$name_service', $price, $id_invoice);";

    $result5 = mysqli_query($conn, $sql5);

    //refresh the page after updating values
    echo "<meta http-equiv='refresh' content='0'>";
  }

  ?>



</body>

</html>