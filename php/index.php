<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
    <script src="../js/main.js" defer></script>
    <title>Welcome To MyTutor</title>

</head>
<header class="w3-container w3-theme w3-padding" id="myHeader">
    <i onclick="w3_open()" class="fa fa-bars w3-xlarge w3-button w3-theme"></i>
    <div class="w3-center">
        <h4>ONLINE TUTOR BOOKING WEB SITES</h4>
        <h1 class="w3-xxxlarge w3-animate-bottom">MY TUTOR</h1>

    </div>
</header>

<body>

    <div class="w3-sidebar w3-bar-block" style="display:none" id="mySidebar">


        <div class="w3-card w3-padding w3-container" style="height:100%;width:250px">
            <button onclick="w3_close()" class="w3-bar-item w3-button w3-large w3-center">Close &times;
            </button>
            <hr>
            <a href="index.php" class="w3-bar item w3-button">Profile</a>
            <a href="login.php" class="w3-bar item w3-button">Login</a>
            <a href="register.php" class="w3-bar item w3-button">Register</a>
            <a href="login.php" class="w3-bar item w3-button">Logout</a>
            
        </div>
    </div>

    <div class="w3-bar w3-teal">
        <a href="login.php" class="w3-bar-item w3-button w3-right">Logout</a>
        <a href="login.php" class="w3-bar-item w3-button w3-right">Login</a>
        <a href="register.php" class="w3-bar-item w3-button w3-right">Register</a>

    </div>
    </div>

</body>

<footer class="w3-footer w3-center w3-bottom w3-teal">MyTutor</footer>

</html>