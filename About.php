<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Indian Railways</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles -->
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        
        .jumbotron {
            background-image: url('https://source.unsplash.com/1600x900/?train,indian-railway');
            background-size: cover;
            background-position: center;
            color: #fff;
            padding: 6rem;
            margin-bottom: 0;
            text-align: center;
        }
       
        h1, h2, h3 {
            color: #007bff;
        }
        .footer {
            background-color: #343a40;
            color: #fff;
            padding: 1rem 0;
        }
        .animated {
            animation-duration: 1s;
            animation-fill-mode: both;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark navbar-sm">
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
<!-- Jumbotron -->
<div class="jumbotron text-center">
    <h2 class="display-3 animated fadeIn text-white">About Indian Railway</h2>
    <p class="lead animated fadeIn delay-1s">India's lifeline connecting millions across the country.</p>
</div>

<!-- About Section -->
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2 class="animated fadeIn delay-2s">Our Mission</h2>
            <p class="animated fadeIn delay-2s">At Indian Railways, our mission is to provide safe, reliable, and efficient transportation services to passengers across the length and breadth of India. We are dedicated to connecting communities, fostering economic growth, and promoting social integration through our vast railway network.
                 With a commitment to excellence, innovation, and sustainability, we strive to exceed the expectations of our passengers while contributing to the nation's development and progress.</p>
        </div>
        <div class="col-md-6">
            <h2 class="animated fadeIn delay-2s">Our Vision</h2>
            <p class="animated fadeIn delay-2s">Our vision at Indian Railways is to be recognized as a world-class railway system, setting benchmarks for safety, efficiency, and customer satisfaction. We aspire to modernize our infrastructure, leverage cutting-edge technology, and implement best practices to enhance the travel experience for our passengers. By prioritizing sustainability, inclusivity, and innovation, we aim to become the preferred mode of transportation for all segments of society, contributing to India's growth story and becoming a global leader in rail transportation.</p>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="footer text-white text-center">
    <p>&copy; 2024 Indian Railways. All rights reserved.</p>
</footer>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
