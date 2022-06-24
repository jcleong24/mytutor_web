<?php
include_once("dbconnect.php");

if (isset($_SESSION['sessionid'])) {
    $cust_email = $_SESSION['email'];
}else{
    $cust_email = "guest@guest.com";
}

if (isset($_POST['submit'])){
    $trid = $_POST['trid'];
    if ($cust_email == "guest@jcleong.com"){
        echo "<script>alert('Register an account first.');</script>";
        echo "<script> window.location.replace('register.php')</script>";
    }else{
       echo "<script> window.location.replace('tutordetails.php?prid=$trid')</script>";
        echo "<script>alert('Success.');</script>";
    }
}
if (isset($_GET['trid'])) {
    $trid = $_GET['trid'];
    
    $sqltutor = "SELECT * FROM tbl_tutors WHERE tutor_id = '$trid'";
    $stmt = $conn->prepare($sqltutor);
    $stmt->execute();
    $number_of_result = $stmt->rowCount();
    if ($number_of_result > 0) {
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $rows = $stmt->fetchAll();
    } else {
        echo "<script>alert('Tutor not found.');</script>";
        echo "<script> window.location.replace('tutor.php')</script>";
    }
} 
else {
    echo "<script>alert('Page Error.');</script>";
    echo "<script> window.location.replace('tutor.php')</script>";
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../js/main.js" defer></script>
    <link rel="stylesheet" href="../css/style.css">
    <title>Welcome to Mytutor Website</title>
</head>

<header class="w3-container w3-theme w3-padding" id="myHeader">
    <i onclick="w3_open()" class="fa fa-bars w3-xlarge w3-button w3-theme"></i>
    <div class="w3-center">
        <h4>ONLINE TUTOR BOOKING WEB SITES</h4>
        <h1 class="w3-xxxlarge w3-animate-bottom">MY TUTOR</h1>

    </div>
    <div class="w3-bar w3-black w3-quater">
        <a href="tutor.php" class="w3-bar-item w3-button w3-right">Back</a>
    </div>
</header>

<body style="max-width:1200px;margin:0 auto;">
    <div class="w3-sidebar w3-bar-block" style="display:none" id="mySidebar">
        <button onclick="w3_close()" class="w3-bar-item w3-button w3-large">Close &times;</button>
        <a href="course.php" class="w3-bar-item w3-button">Courses</a>
        <a href="tutor.php" class="w3-bar-item w3-button">Tutors</a>
        <a href="#" class="w3-bar-item w3-button">Subscription</a>
        <a href="#" class="w3-bar-item w3-button">Profile</a>
    </div>

    </div>
    <?php
        foreach ($rows as $tutor) {
            $trid = $tutor['tutor_id'];
            $trname = $tutor['tutor_name'];
            $tremail = $tutor['tutor_email'];
            $trphone = $tutor['tutor_phone'];
            $trpass = sha1($tutor['tutor_password']);
            $trdesc = $tutor['tutor_description'];
            $trdate = $tutor['tutor_datereg'];

        }
        echo "<div class='w3-padding w3-center'><img class='w3-image resimg' src=../../mytutor_web/res/tutors/$trid.jpg" .
        " onerror=this.onerror=null;this.src='../../mytutor_web/res/default.jpg'"
        . " ></div><hr>";
        echo "<div class='w3-container w3-padding-large'><h4><b>$trname</b></h4>";
        echo " <div><p><b>Tutor Id: </b>$trid</p><p><b>Description</b><br>$trdesc</p><p><b>Email: </b> $tremail</p><p><b>Price:</b>Phone no: $trphone</p><p><b>Date register:</b> $trdate</p>

        </div></div>";

    ?>
    </div>
    <div class="w3-center w3-bottom w3-black" style="max-width:1200px;margin:0 auto;">MYTutor @ No copyright </div>
</body>

</html>