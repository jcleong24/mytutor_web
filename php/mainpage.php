<?php
session_start();
if (!isset($_SESSION['sessionid'])) {
    echo "<script>alert('Session not available. Please login');</script>";
    echo "<script>window.location.replace('login.php')</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
    <title>Dashboard Page</title>
    <script src="../js/main.js" defer></script>

</head>
<header class="w3-container w3-theme w3-padding" id="myHeader">
    <i onclick="w3_open()" class="fa fa-bars w3-xlarge w3-button w3-theme"></i>
    <div class="w3-center">
        <h4>ONLINE TUTOR BOOKING WEB SITES</h4>
        <h1 class="w3-xxxlarge w3-animate-bottom">MY TUTOR</h1>

    </div>
</header>

<body>
<body class="w3-white">
    <div class="w3-sidebar w3-bar-block" style="display:none" id="mySidebar">
        <div class="w3-card w3-padding w3-container" style="height:100%;width:250px">
            <button onclick="w3_close()" class="w3-bar-item w3-button w3-large w3-center">Close &times;
            </button>
            <hr>
            <a href="course.php" class="w3-bar item w3-button">Courses</a>
            <a href="tutor.php" class="w3-bar item w3-button">Tutors</a>
            <a href="login.php" class="w3-bar item w3-button">Subscription</a>
            <a href="login.php" class="w3-bar item w3-button">Profile</a>
        </div>
    </div>

    <div class="w3-bar w3-black">
        <a href="login.php" class="w3-bar-item w3-button w3-right">Logout</a>
        <a href="login.php" class="w3-bar-item w3-button w3-right">Login</a>
        <a href="register.php" class="w3-bar-item w3-button w3-right">Register</a>
    </div>
    </div>
</body>

<footer class="w3-footer w3-center w3-bottom w3-black">MyTutor No copyright
<!-- <div class="bg-light py-4">
      <div class="container text-center">
        <p class="text-muted mb-0 py-2">© 2022 MyTutor All rights reserved.</p>
      </div>
    </div> -->
</footer>

</html>