<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php
// Check if the 'userid' cookie is set
if (isset($_COOKIE['userid'])) {
    $userid = $_COOKIE['userid'];

} else {
    // Handle the case where 'userid' cookie is not set
    echo "User ID not found in the cookie.";
}
?>


<?php
$host = 'localhost'; // Host name 
$username = 'root'; // Mysql username 
$password = ''; // Mysql password 
$db_name = 'dbmsproject'; // Database name 

// Connect to server and select database.
$mysqli = new mysqli($host, $username, $password, $db_name);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
          <div class="container">
          <img src="https://e1.pxfuel.com/desktop-wallpaper/101/88/desktop-wallpaper-indian-railways-logo-indian-government.jpg" class="irctc-logo rounded-circle mr-5" alt="IRCTC Logo" style="height: 70px;">

              <a class="navbar-brand mr-auto" href="#">IRCTC</a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
              </button>

              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav ml-auto">
                      <li class="nav-item">
                          <a class="nav-link" href="#" onclick="redirectTo('homepage.php')">Home</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="#" onclick="redirectTo('bookingpage.php')">Book Tickets</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="#" onclick="redirectTo('station_info.php')">Station Info</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="#" onclick="redirectTo('train_info.php')">Train Info</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="#" onclick="redirectTo('cancelpage.php')">History</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" href="#" onclick="redirectTo('profile.php')">Profile</a>
                      </li>
                  </ul>
              </div>
          </div>
      </nav>
      

  <script>
      function redirectTo(url) {
          window.location.href = url;
      }
  </script>
   
<div class="container-fluid">
    <h2 class="mb-4 mt-5 ml-5">Welcome to Indian Railways Booking System</h2>
    <p class="lead ml-5">We provide a convenient way to search for trains and book tickets. Please select a train to get started.</p>

    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="form-group">
                    <label for="Train" >TRAIN NAME:</label>
                    <select class="form-control" name="Train" id="Train">
                        <?php
                        $sql = "SELECT train_name FROM trains";
                        $result = $mysqli->query($sql);
                        echo "<option value='' disabled selected hidden>Please Choose...</option>";

                        if ($result->num_rows > 0) {
                            // output data of each row
                            while($row = $result->fetch_assoc()) {
                                echo "<option value='".$row["train_name"]."'>".$row["train_name"]."</option>";
                            }
                        } else {
                            echo "0 results";
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Train'])) {
               $train=$_POST['Train'];
                
               $sql = "SELECT station_id,arrival_time, departure_time, station_name ,days_of_operation
               FROM schedule 
               NATURAL JOIN trains 
               NATURAL JOIN stations 
               WHERE train_name = '$train'
               order by station_sequence";
              $result = $mysqli->query($sql);

                if ($result && $result->num_rows > 0) {
                    echo"<div class='table-responsive'>
                            <table class='table table-striped'>
                                <thead class='thead-dark'>
                                    <tr>
                                        <th>STATION ID</th>
                                        <th>STATION NAME</th>
                                        <th>ARRIVAL</th>
                                        <th>DEPARTURE</th>
                                        <th>DAYS OF OPERATION</th>
                                    </tr>
                                </thead>
                                <tbody>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["station_id"] . "</td>";
                        echo "<td>" . $row["station_name"] . "</td>";
                        echo "<td>" . $row["arrival_time"] . "</td>";
                        echo "<td>" . $row["departure_time"] . "</td>";
                        echo "<td>" . $row["days_of_operation"] . "</td>";
                        echo "</tr>";
                    }
                    echo "</tbody>
                        </table>
                    </div>";
                } else {
                    echo "No results found.";
                }
            }
            ?>
        </div>
    </div>
</div>

<!-- Bootstrap JS and jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$mysqli->close();
?>
