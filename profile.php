<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
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

$stmt = $conn->prepare("SELECT * FROM passenger WHERE USERNAME = ?");
$stmt->bind_param("s", $email);
$stmt->execute();

$result = $stmt->get_result();
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



<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .profile-card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .profile-header {
            background: #5576ec;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            padding: 30px;
            text-align: center;
        }
        .profile-header img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 5px solid #fff;
        }
        .profile-title {
            color: #fff;
            font-size: 24px;
            margin-top: 20px;
        }
        .profile-body {
            padding: 30px;
        }
        .profile-detail {
            font-size: 18px;
            margin-bottom: 15px;
        }
    </style>
</head>
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

$stmt = $conn->prepare("SELECT * FROM passenger WHERE USERNAME = ?");
$stmt->bind_param("s", $email);
$stmt->execute();

$result = $stmt->get_result();
?>

<body >
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="profile-card">
                    <div class="profile-header">
                        <img src="https://static.vecteezy.com/system/resources/previews/005/544/718/original/profile-icon-design-free-vector.jpg" alt="profile icon">
                        <h3 class="profile-title">Profile</h3>
                    </div>
                    <div class="profile-body">
                        <?php
                        if ($result->num_rows > 0) 
                        {
                            while ($row = $result->fetch_assoc()) 
                            {
                                echo "<div class='profile-detail'><strong>ID:</strong> " . $row['PASSENGER_ID'] . "</div>";
                                echo "<div class='profile-detail'><strong>Name:</strong> " . $row['NAME'] . "</div>";
                                echo "<div class='profile-detail'><strong>DOB:</strong> " . $row['DOB'] . "</div>";
                                echo "<div class='profile-detail'><strong>Email ID:</strong> " . $row['EMAIL_ID'] . "</div>";
                                echo "<div class='profile-detail'><strong>Mobile:</strong> " . $row['MOBILE_NO'] . "</div>";
                            }
                        } 
                        else 
                        {
                            echo "<div class='profile-detail'>No data found</div>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>
