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
if (isset($_COOKIE['userid'])) 
{
  $userid = $_COOKIE['userid'];
  $email = $_COOKIE['username'];
}

$host = 'localhost'; // Host name 
$username = 'root'; // Mysql username 
$password = ''; // Mysql password 
$database = 'dbmsproject'; // Database name

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT * FROM booking natural join seat_reservation WHERE PASSENGERID = (SELECT PASSENGER_ID FROM passenger WHERE USERNAME=?)");
$stmt->bind_param("s", $email);
$stmt->execute();

$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            color: #fff;
        }
        .card {
            background-color: #333;
            border: none;
            border-radius: 15px;
            box-shadow: 0px 0px 15px 0px rgba(0,0,0,0.75);
        }
        .card-header {
            background-color: #5576ec;
            border-bottom: none;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }
        .card-title {
            color: #fff;
        }
        .table {
            background-color: #333;
            color: #fff;
        }
        th, td {
            border-color: #5576ec;
        }
    </style>
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
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">User Information</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Train Number</th>
                                    <th>Travel Date</th>
                                    <th>Boarding Point</th>
                                    <th>Destination</th>
                                    <th>Passenger Name</th>
                                    <th>Coach</th>
                                    <th>Seat</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row['TrainNumber'] . "</td>";
                                        echo "<td>" . $row['TravelDate'] . "</td>";
                                        echo "<td>" . $row['BoardingPoint'] . "</td>";
                                        echo "<td>" . $row['Destination'] . "</td>";
                                        echo "<td>" . $row['PASSENGERNAME'] . "</td>";
                                        echo "<td>" . $row['COACH_ID'] . "</td>";
                                        echo "<td>" . $row['SEAT_ID'] . "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='7'>No data found</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
