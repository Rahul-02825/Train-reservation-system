<?php
// Establish a database connection (Replace with your database details)
$host = 'localhost'; // Host name 
$username = 'root'; // Mysql username 
$password = ''; // Mysql password 
$db_name = 'dbmsproject'; // Database name 

// Connect to server and select database.
$mysqli = new mysqli($host, $username, $password, $db_name);
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Query the database to check the username and password
    $query = "SELECT * FROM passenger WHERE USERNAME='$username' AND PASSWORD='$password'";
    $result = mysqli_query($mysqli, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        
            $userid = $row["PASSENGER_ID"];
            
            // Set a cookie with the userid
            setcookie("userid", $userid, time() + 3600, "/"); // Cookie expires in 1 hour
            setcookie("username",$username,time()+3600,"/");
            // Redirect to homepage.php
            header("Location: homepage.php");
            exit;
    } else {
        $error = "Invalid username or password.";
    }
    mysqli_close($mysqli);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        .login-image {
            width: 400px;
            height: 600px;
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            animation: loginAnimation 2s infinite alternate;
        }

        @keyframes loginAnimation {
            0% { transform: translateY(-50%); }
            100% { transform: translateY(-45%); }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center" style="height: 100vh;">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header text-center">
                        <img src="https://e1.pxfuel.com/desktop-wallpaper/101/88/desktop-wallpaper-indian-railways-logo-indian-government.jpg" alt="logo" class="rounded-circle" style="width: 100px; height: 100px;">
                        <h3 class="mt-3">IRCTC<br>INDIAN RAILWAY CATERING AND TOURISM CORPORATION</h3>
                    </div>
                    <div class="card-body">
                        <form id="loginForm" method="POST">
                            <h4 class="text-center">Login</h4>
                            <div class="form-group">
                                <label for="username">Username:</label>
                                <input type="text" id="username" name="username" class="form-control" required autocomplete="on">
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" id="password" name="password" class="form-control" required>
                            </div>
                            <div class="form-group text-danger">
                                <?php
                                if (!empty($error)) {
                                    echo $error;
                                }
                                ?>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </form>
                        <div class="text-center mt-3">
                            <a href="reset.php">Forgot Password?</a>
                            <span class="mx-2">|</span>
                            <a href="signup.php">Sign up</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <img src="https://res.cloudinary.com/practicaldev/image/fetch/s--DJTjT7lf--/c_limit%2Cf_auto%2Cfl_progressive%2Cq_66%2Cw_880/https://cdn-images-1.medium.com/max/2800/1*TjXUGjDSTAR-H3O2M9M50A.gif" alt="Login Animation" class="login-image">
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
