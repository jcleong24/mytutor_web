<?php
if (isset($_POST['submit'])) {
    include 'dbconnect.php';
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $sqllogin = "SELECT * FROM tbl_user WHERE user_email = '$email' AND user_password = '$pass'";
    $stmt = $conn->prepare($sqllogin);
    $stmt->execute();
    $number_of_rows = $stmt->fetchColumn();


    if ($number_of_rows  > 0) {
        session_start();
        $_SESSION["sessionid"] = session_id();
        $_SESSION["email"] = $email;
        echo "<script>alert('Login Success');</script>";
        echo "<script> window.location.replace('course.php')</script>";
    } else {
        echo "<script>alert('Login Failed');</script>";
        echo "<script> window.location.replace('login.php')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
    <title>Login Page</title>
    <script src="../js/login.js"></script>
    <script src="../js/password.js"></script>

</head>
<header class="w3-container w3-theme w3-padding" id="myHeader">
    <div class="w3-center w3-animate-bottom">
        <h4>ONLINE TUTOR BOOKING WEB SITES</h4>
        <h1>MY TUTOR</h1>
    </div>
</header>

<body onload="loadCookies()">
    <style>
        .registerbtn {
            background-color: #04AA6D;
            color: white;
            padding: 5px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 20%;
            height: 45px;
            opacity: 0.9;
        }
    </style>
    <!-- content -->
    <div style="display:flex; justify-content: center">
        <div class="w3-container w3-card w3-padding w3-margin" style="width: 600px; margin:auto; text-align:left">
            <h2 class="w3-content w3-center">Login Page</h2>
            <form name="loginForm" action="login.php" method="post">
                <p>
                    <label><b>Email</b></label>
                    <input class="w3-input w3-round w3-border" type="email" name="email" id="idemail" placeholder="Your email" required>
                </p>
                <p>
                    <label><b>Password</b></label>
                    <input class="w3-input w3-round w3-border" type="password" name="password" id="idpass" placeholder="Your password" required>
                    <input type="checkbox" onclick="myFunction()">Show Password
                </p>
                <p>
                    <input class="w3-check" name="rememberme" type="checkbox" id="idremember" onclick="rememberMe()">
                    <label> Remember Me</label>
                </p>
                <p>
                    <input class="w3-input w3-round w3-border w3-blue" type="submit" name="submit" id="idsubmit">
                </p>
                <hr>
                <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>

                <button type="register" class="registerbtn w3-round w3-blue"><a href="../php/register.php">Register</button>
            </form>
        </div>
    </div>

    <div id="cookieNotice" class="w3-right w3-block" style="display: none;">
        <div class="w3-red">
            <h4>Cookie Consent</h4>
            <p>This website uses cookies or similar technologies, to enhance your
                browsing experience and provide personalized recommendations.
                By continuing to use our website, you agree to our
                <a style="color:#115cfa;" href="/privacy-policy">Privacy Policy</a>
            </p>
            <div class="w3-button">
                <button onclick="acceptCookieConsent();">Accept</button>
            </div>
        </div>
    </div>
    <footer class="w3-footer w3-center w3-black w3-padding-8 w3-Small">
        <p>MyTutor No Copyright</p>
        <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" title="W3.CSS" target="_blank" class="w3-hover-text-green">Visual Studio</a></p>
        <div class="bg-light py-4">
            <div class="container text-center">
                <p class="text-muted mb-0 py-2">© 2022 MyTutor All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
<script>
    let cookie_consent = getCookie("user_cookie_consent");
    if (cookie_consent != "") {
        document.getElementById("cookieNotice").style.display = "none";
    } else {
        document.getElementById("cookieNotice").style.display = "block";
    }
</script>



</html>