<?php
if (isset($_POST['submit'])) {
    include_once("dbconnect.php");
    $userName = addslashes($_POST['userName']);
    $userPassword = addslashes($_POST['userPassword']);
    $userEmail = addslashes($_POST['userEmail']);
    $userPhone = addslashes($_POST['userPhone']);
    $userAddress = addslashes($_POST['userAddress']);

    $sqlinsertuser = "INSERT INTO `mytutor_web`(`user_name`, `user_email`, `user_password`, `user_address`, `user_phone`)
         VALUES ('$userName','$userEmail','$userPassword','$userAddress','$userPhone')";

    try {
        $conn->exec($sqlinsertuser);
        if (file_exists($_FILES["fileToUpload"]["tmp_name"]) || is_uploaded_file($_FILES["fileToUpload"]["tmp_name"])) {
            $last_id = $conn->lastInsertId();
            uploadImage($last_id);
            echo "<script>alert('Registration Success')</script>";
            echo "<script>window.location.replace('mainpage.php')</script>";
        }
    } catch (PDOException $e) {
        echo "<script>alert('Registration Failed')</script>";
        echo "<script>window.location.replace('register.php')</script>";
    }
}
function uploadImage($filename)
{
    $target_dir = "../res/users/";
    $target_file = $target_dir . $filename . ".png";
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../js/register.js"></script>
    <script src="../js/main.js"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
    <title>Mytutor Registration Page</title>

    <style>
        .icon {
            padding: 10px;
            background: dodgerblue;
            color: white;
            min-width: 50px;
            text-align: center;
        }

        .input-field:focus {
            border: 2px solid dodgerblue;
        }
    </style>

</head>
<header class="w3-container w3-theme w3-padding" id="myHeader">
    <div class="w3-center w3-animate-bottom">
        <h4>ONLINE TUTOR BOOKING WEB SITES</h4>
        <h1 class="w3-xxxlarge w3-animate-bottom">MY TUTOR</h1>
        <div class="w3-padding-18">
            <h1>Registration</h1>
        </div>
    </div>

</header>

<body>
    <div class="w3-bar w3-black w3-box">
        <a href="login.php" class="w3-bar-item w3-button w3-right">LOGIN</a>
        <a href="register.php" class="w3-bar-item w3-button w3-right">REGISTER</a>
    </div>

    <div style="display:flex; justify-content: center">
        <div class="w3-container w3-card w3-padding w3-margin" style="width: 600px; margin:auto; text-align:left">
            <h2 class="w3-content w3-center">Registration Page</h2>

            <form class="w3-container w3-padding" name="registerForm" action="register.php" method="post" enctype="multipart/form-data" onsubmit="return confirm('Are you sure?')">
                <div class="w3-container w3-center">
                    <img class="w3-image w3-margin" src="../res/newUser.png" style="height:200px;width:200px"><br>
                    <input type="file" id="idImages" name="fileToUpload" onchange="previewFile()">
                </div>
                <hr>
                <p>


                <div class="input-container">
                    <i class="fa fa-user icon"><label><b> Username</b></label></i>
                    <input class="w3-input w3-round w3-border" type="username" name="userName" id=idusername placeholder="Your name" required>
                    </p>
                </div>
                <p>

                <div class="input-container">
                    <i class="fa fa-lock icon"><label><b> Password</b></label></i>
                    <input class="w3-input w3-round w3-border" type="password" name="userPassword" id="idpass" placeholder="Your password" required>

                    </p>
                    <p>

                    <div class="input-container">
                        <i class="fa fa-envelope icon"><label><b> Email</b></label></i>
                        <input class="w3-input w3-round w3-border" type="email" name="userEmail" id="idemail" placeholder="Your email" required>
                        </p>
                        <p>

                        <div class="input-container">
                            <i class="fa fa-phone icon"><label><b> Phone</b></label></i>
                            <input class="w3-input w3-round w3-border" type="phone" name="userPhone" id="idphone" placeholder="Your phone" required>
                            </p>
                            <p>
                            <div class="input-container">
                                <i class="fa fa-home icon"><label><b> Address</b></label></i>
                                <textarea class="w3-input w3-round w3-border" rows="4" width="100%" type="address" name="userAddress" id="idaddress" placeholder="Your address" required></textarea>
                                </p>
                                <p>
                                    <input class="w3-input w3-round w3-border w3-teal" type="submit" name="submit" id="submit">
                                </p>
                            </div>
                        </div>
                    </div>
            </form>
        </div>

    </div>
    </div>

</body>
<footer class="w3-black">
    <div class="w3-container w3-content w3-padding-64" style="max-width:800px" id="contact">
        <h2 class="w3-wide w3-center">CONTACT</h2>
        <p class="w3-opacity w3-center"><i>Interested in our service? Contact us</i></p>
        <div class="w3-row w3-padding-32">
            <div class="w3-col m6 w3-large w3-margin-bottom">
                <i class="fa fa-map-marker" style="width:30px"></i> Malaysia, Melacca<br>
                <i class="fa fa-phone" style="width:30px"></i> Phone: +601 6762111<br>
                <i class="fa fa-envelope" style="width:30px"> </i> Email: jcleong@gmail.com<br>
            </div>
            <div class="w3-col m6">
                <form action="/action_page.php" target="_blank">
                    <div class="w3-row-padding" style="margin:0 -16px 8px -16px">
                        <div class="w3-half">
                            <input class="w3-input w3-border" type="text" placeholder="Name" required name="Name">
                        </div>
                        <div class="w3-half">
                            <input class="w3-input w3-border" type="text" placeholder="Email" required name="Email">
                        </div>
                    </div>
                    <input class="w3-input w3-border" type="text" placeholder="Message" required name="Message">
                    <button class="w3-button w3-black w3-section w3-right" type="submit">SEND</button>


                </form>
            </div>
        </div>
    </div>

    <!-- End Page Content -->
    </div>
</footer>

<footer class="w3-container w3-padding-64 w3-center w3-opacity w3-light-grey w3-xlarge">
    <i class="fa fa-facebook-official w3-hover-opacity"></i>
    <i class="fa fa-instagram w3-hover-opacity"></i>
    <i class="fa fa-snapchat w3-hover-opacity"></i>
    <i class="fa fa-pinterest-p w3-hover-opacity"></i>
    <i class="fa fa-twitter w3-hover-opacity"></i>
    <i class="fa fa-linkedin w3-hover-opacity"></i>
    <p class="w3-medium">Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">Visual Studio</a></p>
</footer>

</html>