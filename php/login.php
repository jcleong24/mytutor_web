<?php

if (isset($_POST['submit'])) {
    include 'dbconnect.php';
    $email = $_POST['email'];
    $pass = $_POST['password'];
    // $name = $_POST['name'];
    // $address = addslashes($_POST['address']);
    // $phone = addslashes($_POST['phone']);
    $sqllogin = "SELECT * FROM mytutor_web WHERE user_email = '$email' AND user_password = '$pass'";
    $stmt = $conn->prepare($sqllogin);
    $stmt->execute();
    $number_of_rows = $stmt->fetchColumn();

    if ($number_of_rows > 0) {
        echo "<script>alert('Login Successful');</script>";
        echo "<script> window.location.replace('index.php')</script>";
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

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
    <title>Login Page</title>
    <script src="../js/login.js"></script>
    <script src="../js/password.js"></script>

</head>
<header class="w3-container w3-theme w3-padding" id="myHeader">
    <div class="w3-xlarge w3-theme"></div>
    <div class="w3-center w3-animate-bottom">
        <h4>ONLINE TUTOR BOOKING WEB SITES</h4>
        <h1 class="w3-xxxlarge w3-animate-bottom">MY TUTOR</h1>
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
                    <input class="w3-input w3-round w3-border w3-blue" type="submit" name="submit" id="submit">
                </p>
                <hr>
                <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>

                <button type="submit" class="registerbtn w3-round w3-blue"><a href="../php/register.php">Register</button>
            </form>
        </div>
    </div>

    <div id="cookieNotice" class="w3-right w3-block" style="display: none;">
        <div class="w3-blue">
            <h4>Cookie Consent</h4>
            <p>This website uses cookies or similar technologies, to enhance your browsing experience and provide personalized recommendations.
                By continuing to use our website, you agree to our
                <a style="color:#115cfa;" href="https://policies.google.com/privacy?hl=en-US">Privacy Policy</a>
            </p>
            <div class="w3-button">
                <button onclick="acceptCookieConsent();">Accept</button>
            </div>
        </div>
    </div>

    <script>
        let cookie_consent = getCookies("user_cookkie_consent");
        if (cookie_consent != "") {
            document.getElementById("cookieNotice").style, display = "none";
        } else {
            documentt.getElementById("cookieNotice").style.display = "block";
        }

        function deleteCookie(cname) {
            const d = new Date();
            d.setTime(d.getTime() + (24 * 60 * 60 * 1000));
            let expires = "expires=" + d.toUTCString();
            document.cookie = cname + "=;" + expires + ";path=/";
        }

        function acceptCookieConsent() {
            deleteCookie('user_cookie_consent');
            setCookies('user_cookie_consent', 1, 30);
            document.getElementById("cookieNotice").style.display = "none";
        }
    </script>


    <footer class="w3-footer w3-center w3-light-grey w3-padding-8 w3-Small">
        <p>Slumbshop No Copyright</p>
        <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" title="W3.CSS" target="_blank" class="w3-hover-text-green">w3.css</a></p>
    </footer>

</body>


</html>