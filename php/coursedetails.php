<?php
include_once("dbconnect.php");

if (isset($_SESSION['sessionid'])) {
    $cust_email = $_SESSION['email'];
}else{
    $cust_email = "guest@userguest.com";
}

if (isset($_POST['submit'])){
    $sbid = $_POST['sbid'];
    if ($cust_email == "guest@userguest.com"){
        echo "<script>alert('Please register first.');</script>";
        echo "<script> window.location.replace('register.php')</script>";
    }else{
       echo "<script> window.location.replace('coursedetails.php?sbid=$sbid')</script>";
        echo "<script>alert('OK.');</script>";
    }
}
if (isset($_GET['sbid'])) {
    $sbid = $_GET['sbid'];
    $sqlsubject = "SELECT * FROM tbl_subjects WHERE subject_id = '$sbid'";
    $stmt = $conn->prepare($sqlsubject);
    $stmt->execute();
    $number_of_result = $stmt->rowCount();
    if ($number_of_result > 0) {
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $rows = $stmt->fetchAll();
    } else {
        echo "<script>alert('No subject found.');</script>";
        echo "<script> window.location.replace('course.php')</script>";
    }
} 
else {
    echo "<script>alert('Course Details Error');</script>";
    echo "<script> window.location.replace('course.php')</script>";
}

?>

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
        <a href="course.php" class="w3-bar-item w3-button w3-right">Back</a>
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
    
    <div class="w3-center w3-card">
    <?php
        foreach ($rows as $subject) {
            $sbid = $subject['subject_id'];
            $sbname = $subject['subject_name'];
            $sbdesc = $subject['subject_description'];
            $sbprice = number_format((float)$subject['subject_price'],2,'.','');
            $tutor_id = $subject['tutor_id'];
            $sbsessions = $subject['subject_sessions'];
            $sbrating = $subject['subject_rating'];
        }
        echo "<div class='w3-padding w3-center'><img class='w3-image resimg' src=../../mytutor_web/res/courses/$sbid.png" .
        " onerror=this.onerror=null;this.src='../../mytutor_web/res/default.jpg'"
        . " ></div><hr>";
        echo "<div class='w3-container w3-padding-large'><h4><b>$sbname</b></h4>";
        echo "<div class='w3-container w3-center'><p class='w3-center'>Price: RM $sbprice</p>Description </br>$sbdesc<hr><br>Tutor id: $tutor_id<br>Subject session: $sbsessions<br>Subject rating: $sbrating</br>
        <br></div>
        </div>";


    ?>
    </div>
    <div class="w3-center w3-bottom w3-black" style="max-width:1200px;margin:0 auto;">MYTutor @ No copyright </div>
</body>

</html>