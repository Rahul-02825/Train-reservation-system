<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

</head>
<?php
if (isset($_COOKIE['userid'])) {
    $userid = $_COOKIE['userid'];
    $train_id = $_COOKIE['train_id'];
    $selectedDate = date('Y-m-d', strtotime($_COOKIE['date']));
    $destination = $_COOKIE['destination'];
    $sources = $_COOKIE['source'];
    $Class=$_COOKIE['selectedClass'];
    $Coach=($_COOKIE['selectedCoach']);

} else {
    // Handle the case where 'userid' cookie is not set
    echo "User ID not found in the cookie.";
}
?>

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
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</html>

<script>
    function redirectTo(url) {
        window.location.href = url;
    }
</script>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $inputCount = isset($_POST['inputCount']) ? intval($_POST['inputCount']) : 0;
    $host = 'localhost'; // Host name
    $username = 'root'; // Mysql username
    $password = ''; // Mysql password
    $db_name = 'dbmsproject'; // Database name

// Connect to server and select database.
  $mysqli = new mysqli($host, $username, $password, $db_name);


    if ($mysqli->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    else{
    $inputCount = $_POST["inputCount"];
    $passengerData = array();


  for ($i = 1; $i <= $inputCount; $i++) {
      $name = $_POST["name_$i"];
      $gender = $_POST["gender_$i"];
      $age = $_POST["age_$i"];

      // Store the data in an array
      $passengerData[] = array("name" => $name, "gender" => $gender, "age" => $age);
  }

  $sql="Insert Into booking(PassengerID,TrainNumber,DateOfBooking,TravelDate,NO_OF_PASSENGERS,BoardingPoint,Destination) VALUES ($userid, $train_id, CURDATE(), '$selectedDate', $inputCount, '$sources', '$destination')";
  if ($mysqli->query($sql) === TRUE) {
    $booking_id = $mysqli->insert_id; // Retrieve the last inserted booking ID
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$query = "SELECT SEAT_ID FROM
  (
      SELECT SEAT_ID FROM assigned_to_train
      WHERE train_ID = '$train_id' AND coach_ID = '$Coach'
      
      EXCEPT
      
      SELECT SEAT_ID FROM booking
      JOIN seat_reservation ON booking.BookingID = seat_reservation.BookingID
      WHERE TravelDate = '$selectedDate' AND TrainNumber = '$train_id' AND Coach_ID = '$Coach'
  ) AS SeatDifference
  LIMIT $inputCount";

$result = $mysqli->query($query);

if ($result) {
    $seatIDs = array();

    while ($row = $result->fetch_assoc()) {
        $seatIDs[] = $row['SEAT_ID'];
    }

    foreach ($passengerData as $passenger) {
        $name = $passenger["name"];
        $gender = $passenger["gender"];
        $age = $passenger["age"];

        // Use the retrieved $seatID in the INSERT query
        if (!empty($seatIDs)) {
            $seatID = array_shift($seatIDs); // Take the next available seat ID

            $insertQuery = "INSERT INTO seat_reservation (BookingID, PASSENGERNAME, GENDER, AGE, TRAIN_ID, COACH_ID, SEAT_ID) VALUES ($booking_id, '$name', '$gender', $age, $train_id, '$Coach', $seatID)";

            if ($mysqli->query($insertQuery)) {
            } else {
                echo "Error in insertion with SEAT_ID: " . $seatID . ": " . $mysqli->error . "<br>";
            }
        } else {
            echo "No available seat IDs for this passenger.<br>";
        }
    }

    $result->close();
} else {
    echo "Error in the query: " . $mysqli->error;
}

    }
    $mysqli->close();
}
?>

<div
  style="
      width: 10%;
      height: 0%;
      left: 45%;
      top: 50%;
      position: absolute;
      text-align: center;
      color: black;
      font-size: x-large;
      font-family: Inter;
      font-weight: 800;
      word-wrap: break-word;
      "
  >
    BOOKING SUCCESS
  </div>