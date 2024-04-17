<?php
session_start();
$host = 'localhost'; // Host name
$username = 'root'; // Mysql username
$password = ''; // Mysql password
$db_name = 'dbmsproject'; // Database name
// Connect to server and select database.
$mysqli = new mysqli($host, $username, $password, $db_name);
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
$flag = 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IRCTC - Indian Railway Catering and Tourism Corporation</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            overflow: auto;
        }

        .container-fluid {
            padding: 20px;
        }

        .irctc-logo {
            width: 10%;
        }

        .irctc-heading {
            font-size: 24px;
            font-weight: bold;
            color: #ebff0f;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .btn-submit {
            width: 100%;
            background-color: #ebff0e;
            color: black;
            font-weight: bold;
            border: none;
        }

        .table-responsive {
            margin-top: 20px;
        }

        th,
        td {
            vertical-align: middle !important;
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
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <div class="form-row">
                        <div class="col-md-4 form-group">
                            <label for="source" >FROM:</label>
                            <select class="form-control" name="source" id="source">
                                <?php
                                $sql = "SELECT station_id, station_name FROM Stations";
                                $result = $mysqli->query($sql);
                                echo "<option value='' disabled selected hidden>Please Choose...</option>";
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value='" . $row["station_name"] . "'>" . $row["station_name"] . "</option>";
                                    }
                                } else {
                                    echo "0 results";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="destination" >TO:</label>
                            <select class="form-control" name="destination" id="destination">
                                <?php
                                $sql = "SELECT station_id, station_name FROM Stations";
                                $result = $mysqli->query($sql);
                                echo "<option value='' disabled selected hidden>Please Choose...</option>";
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<option value='" . $row["station_name"] . "'>" . $row["station_name"] . "</option>";
                                    }
                                } else {
                                    echo "0 results";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="date" >DATE:</label>
                            <input type="date" class="form-control" name="date" id="date" min="<?php echo $currentDateString; ?>" max="<?php echo $maxDateString; ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-submit" style="width: 50%;">SUBMIT</button>
                    </div>
                </form>
            </div>
        </div>
        

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["source"]) && isset($_POST["destination"]) && isset($_POST["date"])) {
            $selectedDate = $_POST["date"];
            $sources = $_POST["source"];
            $destination = $_POST["destination"];
            $today = date('Y-m-d');
            $sixMonthsFromNow = date('Y-m-d', strtotime('+6 months'));
            if ($selectedDate < $today) {
                echo "<script>alert('Please select a date on or after today.');</script>";
            } elseif ($selectedDate > $sixMonthsFromNow) {
                echo "<script>alert('Please select a date within the next 6 months.');</script>";
            } else {
                $sql = "SELECT A.train_id, C.train_name, A.arrival_time as source, B.arrival_time as reach
                        FROM schedule A, schedule B, trains C
                        WHERE A.station_id=(SELECT STATION_ID FROM stations WHERE STATION_NAME='$sources') 
                        AND B.station_id=(SELECT STATION_ID FROM stations WHERE STATION_NAME='$destination') 
                        AND A.train_id=B.train_id
                        AND B.train_id=C.train_id
                        AND A.station_sequence<B.station_sequence 
                        AND FIND_IN_SET(DAYNAME('$selectedDate'), A.days_of_operation) > 0";
                $result = $mysqli->query($sql);
                if ($result && $result->num_rows > 0) {
                    echo "<div class='row'>
                            <div class='col'>
                                <div class='table-responsive'>
                                    <table class='table table-bordered table-striped mt-4'>
                                        <thead class='thead-dark'>
                                            <tr>
                                                <th>TRAIN ID</th>
                                                <th>TRAIN NAME</th>
                                                <th>SOURCE ARRIVAL</th>
                                                <th>DESTINATION ARRIVAL</th>
                                            </tr>
                                        </thead>
                                        <tbody>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr onclick='redirectToTicketPage(" . $row["train_id"] . ", \"" . $selectedDate . "\", \"" . $sources . "\", \"" . $destination . "\")'>";
                        echo "<td>" . $row["train_id"] . "</td>";
                        echo "<td>" . $row["train_name"] . "</td>";
                        echo "<td>" . $row["source"] . "</td>";
                        echo "<td>" . $row["reach"] . "</td>";
                        echo "</tr>";
                    }
                    echo "</tbody>
                            </table>
                        </div>
                    </div>
                </div>";
                } else {
                    echo "<script>alert('No Result Found.');</script>";
                }
            }
        } elseif ($flag == 1) {
            echo "<script>alert('Please provide all parameters.');</script>";
        }
        ?>

    </div>
        
    <!-- Bootstrap JS and jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        function redirectToTicketPage(trainId, selectedDate, sources, destination) {
            document.cookie = "train_id=" + trainId;
            document.cookie = "date=" + selectedDate;
            document.cookie = "source=" + sources;
            document.cookie = "destination=" + destination;
            window.location.href = 'ticketpage.php';
        }
    </script>

</body>

</html>

<?php
$mysqli->close();
?>
