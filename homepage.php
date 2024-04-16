<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
    <title>Indian Railways - Home</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card {
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: 0.3s;
            margin-bottom: 30px;
        }

        .card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    <div class=" mb-4 mt-5">
       <h2 class="text-center">Welcome to Indian Railways</h2>
        <p class="lead text-center">Explore our website services below to discover more about Indian Railways.</p>
   </div>
  
    <!-- Main Content -->
    <div class="container my-5">
        <div class="row">
            <!-- Card 1 -->
            <div class="col-md-4">
                <div class="card">
                    <img src="https://www.wallpapertip.com/wmimgs/155-1554570_indian-train-images-hd.jpg" class="card-img-top" alt="Indian Railways Image" width="300px" height="300px">
                    <div class="card-body">
                        <h5 class="card-title">About Indian Railways</h5>
                        <p class="card-text">Learn about the history, infrastructure, and achievements of Indian Railways.</p>
                        <a href="About.php" class="btn btn-primary">Learn More</a>
                    </div>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="col-md-4">
                <div class="card">
                    <img src="https://static.toiimg.com/thumb/msid-74008823,width-748,height-499,resizemode=4,imgsize-128378/Best-Train-Food-in-India.jpg" class="card-img-top" alt="Train Services Image">
                    <div class="card-body">
                        <h5 class="card-title">Train Services</h5>
                        <p class="card-text">Explore the various types of trains and services offered by Indian Railways.</p>
                        <a href="Train_service.php" class="btn btn-primary">Explore Services</a>
                    </div>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="col-md-4">
                <div class="card">
                    <img src="https://sundayguardianlive.com/wp-content/uploads/2018/02/rail-safety.jpg" class="card-img-top" alt="Safety Measures Image">
                    <div class="card-body">
                        <h5 class="card-title">Safety Measures</h5>
                        <p class="card-text">Discover the safety measures and initiatives taken by Indian Railways for passengers' security.</p>
                        <a href="Safety_measure.php" class="btn btn-primary">View Safety</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Why Book with Us Section -->
<div class="container my-5">
    <h2 class="text-center mb-4">Why Book Trains with Us?</h2>

    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4 bg-info text-white">
                <div class="card-body">
                    <h5 class="card-title">Convenience</h5>
                    <p class="card-text">Our user-friendly platform makes it easy to search, book, and manage your train tickets from the comfort of your home.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-4 bg-info text-white">
                <div class="card-body">
                    <h5 class="card-title">Variety of Options</h5>
                    <p class="card-text">Choose from a wide range of train options, classes, and schedules to find the best fit for your travel needs.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-4 bg-info text-white">
                <div class="card-body">
                    <h5 class="card-title">Competitive Pricing</h5>
                    <p class="card-text">We offer competitive prices and special discounts on train tickets to ensure you get the best value for your money.</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-4 bg-info text-white">
                <div class="card-body">
                    <h5 class="card-title">Customer Support</h5>
                    <p class="card-text">Our dedicated customer support team is available 24/7 to assist you with any inquiries or issues regarding your booking.</p>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- FAQ Section -->
<div class="container my-5">
    <h2 class="text-center mb-4">Frequently Asked Questions</h2>

    <div id="accordion">
        <!-- FAQ Item 1 -->
        <div class="card">
            <div class="card-header" id="headingOne">
                <h5 class="mb-0">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        Question 1: What are the different classes of travel available?
                    </button>
                </h5>
            </div>

            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body">
                    Answer 1: Indian Railways offers various classes of travel including Sleeper Class, AC 3 Tier, AC 2 Tier, and AC 1 Tier.
                </div>
            </div>
        </div>

        <!-- FAQ Item 2 -->
        <div class="card">
            <div class="card-header" id="headingTwo">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        Question 2: How can I book tickets online?
                    </button>
                </h5>
            </div>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                <div class="card-body">
                    Answer 2: You can book tickets online through the IRCTC website or mobile app by creating an account and following the booking process.
                </div>
            </div>
        </div>

        <!-- FAQ Item 3 -->
        <div class="card">
            <div class="card-header" id="headingThree">
                <h5 class="mb-0">
                    <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        Question 3: What are the cancellation policies?
                    </button>
                </h5>
            </div>
            <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                <div class="card-body">
                    Answer 3: Cancellation policies vary depending on the type of ticket booked. Please refer to our website for detailed information on cancellation rules and charges.
                </div>
            </div>
        </div>
    </div>
</div>


    <!-- Footer -->
    <footer class="bg-dark text-light text-center py-3">
        <p>&copy; 2024 Indian Railways. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
