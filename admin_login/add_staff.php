<?php
include('session_admin.php');
?>

<?php

if (isset($_POST['reg_user'])) {
    $Name = $_POST['name1'];
    $Surname = $_POST['surname'];
    $Mob_phone = $_POST['mob_phone'];


    $sql = "INSERT INTO staff (name, surname, mob_phone) 
  			  VALUES('$Name', '$Surname', '$Mob_phone')";
    $result = mysqli_query($conn, $sql);
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Add Staff</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="css/mycss.css">
    <script src="js/javaScript.js"></script>

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
                <li><a href="manage_bookings.php">Manage</a></li>
                <li><a href="invoice.php">Invoice</a></li>
                <li class="active"><a href="add_staff.php">Add Staff</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="../logout.php"><span class="glyphicon glyphicon-log-out"></span> Log out</a></li>
            </ul>
        </div>
    </nav>


    <div id="division">
        <div id="a111">
            <form method="post">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input name="name1" type="name" class="form-control" placeholder="Enter name" id="name" required>
                </div>
                <div class="form-group">
                    <label for="surname">Surname:</label>
                    <input name="surname" type="text" class="form-control" placeholder="Enter surname" id="surname" required>
                </div>

                <div class="form-group">
                    <label for="mobile-phone">Mobile Phone:</label>
                    <input name="mob_phone" type="tel" class="form-control" placeholder="Enter Mobile Phone" id="mobile-phone" required>
                    <!-- <input type="tel" id="phone" name="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required>   pattern="[0-9]{11}" -->
                </div>

                <button name="reg_user" type="submit" class="btn btn-primary">Add Mechanic</button>

            </form>
        </div>




        <div id="a111">


            <?php
            //Our select statement. This will retrieve the data that we want.

            $sql = "SELECT * FROM staff
                    HAVING id_staff > 1;";


            if ($result = mysqli_query($conn, $sql)) {
                if (mysqli_num_rows($result) > 0) {
                    echo "  <label for='mobile-phone'>Mechanics:</label>
                    <table class='table table-hover'>
                            <thead>
                            <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Surname</th>
                            <th>Phone</th>
                            </tr>
                            </thead>
                            <tbody>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr><td>" .
                            $row["id_staff"] . "</td><td>" .
                            $row["name"] . "</td><td>" .
                            $row["surname"] . "</td><td>" .
                            $row["mob_phone"] . "</td><td>" .
                            "</td></tr>";
                    }
                    echo "</tbody>
                                </table> </br> </br></br>";
                } else {
                    echo "0 Result";
                }
            }
            ?>
        </div>
    </div>

    <div id="division">

        <div id="a111">
            <form method="post">
                <div class="form-group">
                    </br></br><br>
                    <label for="delete"> Delete staff by their ID:</label>
                    <input name='delete' type="text" class="form-control" placeholder="Enter Id staff" id="delete" required>
                </div>

                <button name="delete_button" type="submit" class="btn btn-danger">Delete Mechanic</button>


            </form>

        </div>

        <div id="a111">

        </div>
    </div>


    <?php
    //Delete Staff by ID


    if (isset($_POST['delete_button'])) {
        $id = $_POST['delete'];
        $sql = "DELETE FROM staff where id_staff = $id;";

        if ($id == 1) {
        } else {
            $result = mysqli_query($conn, $sql);
        }
    }
    ?>


</body>

</html>