<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>


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
<?php
// Check if the 'userid' cookie is set
if (isset($_COOKIE['userid'])) {
    $userid = $_COOKIE['userid'];
    
} else {
    // Handle the case where 'userid' cookie is not set
    echo "User ID not found in the cookie.";
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
    
</body>
</html>

<script>
    function redirectTo(url) {
        window.location.href = url;
    }
</script>

<div class="container mt-5">
    <h2 class="mb-4">Welcome to Indian Railways Booking System</h2>
    <p class="lead">We provide a convenient way to search for trains and book tickets. Please select a station to get started.</p>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="form-inline justify-content-center mb-4">
        <div class="form-group mr-2">
            <label for="Station" class="mr-2">Select Station:</label>
            <select class="form-control" name="Station" id="Station">
                <option value="" disabled selected hidden>Please Choose...</option>
                <?php
                $sql = "SELECT station_id, station_name FROM Stations";
                $result = $mysqli->query($sql);
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<option value='".$row["station_name"]."'>".$row["station_name"]."</option>";
                    }
                } else {
                    echo "<option value=''>No stations available</option>";
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>Train ID</th>
                    <th>Train Name</th>
                    <th>Arrival Time</th>
                    <th>Departure Time</th>
                    <th>Days of Operation</th>
                    <th>Type</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Station'])) {
                    $station=$_POST['Station'];

                    $sql = "SELECT train_id, train_name, arrival_time, departure_time, days_of_operation,type FROM schedule NATURAL JOIN stations NATURAL JOIN trains WHERE STATION_NAME='$station'";
                    $result = $mysqli->query($sql);

                    if ($result && $result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["train_id"] . "</td>";
                            echo "<td>" . $row["train_name"] . "</td>";
                            echo "<td>" . $row["arrival_time"] . "</td>";
                            echo "<td>" . $row["departure_time"] . "</td>";
                            echo "<td>" . $row["days_of_operation"] . "</td>";
                            echo "<td>" . $row["type"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No trains available for the selected station</td></tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Bootstrap JS and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
