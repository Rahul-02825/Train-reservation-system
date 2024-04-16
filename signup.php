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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $name = $_POST["full_name"];
    $email = $_POST["email"];
    $mobile = $_POST["mobile"];
    $aadhar = $_POST["aadhar"];
    $dob = $_POST["dob"];
    $gender = $_POST["gender"];
    $password = $_POST["password"];

    $duplicateQuery = "SELECT * FROM passenger WHERE USERNAME='.$username' OR EMAIL_ID='$email' OR MOBILE_NO='$mobile' OR AADHAR_NO='$aadhar'";
    $result = mysqli_query($mysqli, $duplicateQuery);

    if (mysqli_num_rows($result) > 0) {
        echo "User with the same username, email, mobile, or aadhar already exists.";
    } else {

        $insertQuery = "INSERT INTO passenger (USERNAME, NAME, EMAIL_ID, MOBILE_NO, AADHAR_NO, DOB, GENDER, PASSWORD)
                        VALUES ('$username', '$name', '$email', '$mobile', '$aadhar', '$dob', '$gender', '$password')";

        if (mysqli_query($mysqli, $insertQuery)) {
            echo "Registration successful!";
            $desiredUrl = "home.php";
            echo"<script>alert('Registration Successful');</script>";
            echo "<script>window.location.href = 'home.php';</script>";
            exit;
        } else {
            echo "Error: " . mysqli_error($mysqli);
        }
    }

    mysqli_close($mysqli);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <img src="https://e1.pxfuel.com/desktop-wallpaper/101/88/desktop-wallpaper-indian-railways-logo-indian-government.jpg" alt="logo" class="rounded-circle" style="width: 100px; height: 100px;">
                        <h3 class="mt-3">IRCTC<br>INDIAN RAILWAY CATERING AND TOURISM CORPORATION</h3>
                    </div>
                    <div class="card-body">
                        <form id="signupForm" method="POST">
                            <h4 class="text-center">Sign Up</h4>
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" id="username" name="username" class="form-control" required autocomplete="on">
                            </div>
                            <div class="form-group">
                                <label for="full_name">Full Name:</label>
                                <input type="text" id="full_name" name="full_name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" id="email" name="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="mobile">Mobile:</label>
                                <input type="number" id="mobile" name="mobile" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="aadhar">Aadhar:</label>
                                <input type="number" id="aadhar" name="aadhar" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="dob">Date of Birth:</label>
                                <input type="date" id="dob" name="dob" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="gender">Gender:</label>
                                <div class="form-check">
                                    <input type="radio" id="male" name="gender" value="male" class="form-check-input">
                                    <label for="male" class="form-check-label">Male</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" id="female" name="gender" value="female" class="form-check-input">
                                    <label for="female" class="form-check-label">Female</label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" id="other" name="gender" value="other" class="form-check-input">
                                    <label for="other" class="form-check-label">Other</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" id="password" name="password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
                            </div>
                            <div class="form-group text-danger">
                                <?php
                                if (!empty($error)) {
                                    echo $error;
                                }
                                ?>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <a href="home.php">Back to Home</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
