<?php
session_start();
if (!isset($_SESSION['sessionid'])) {
    echo "<script>alert('Session not available. Please login');</script>";
    echo "<script>window.location.replace('login.php')</script>";
}
?>
<?php
include_once("dbconnect.php");

if (isset($_GET['submit'])) {
    $operation = $_GET['submit'];
    if ($operation == 'delete') {
        $sbid = $_GET['sbid'];
        $sqldeletepr = "DELETE FROM `tbl_subjects` WHERE subject_id = '$sbid'";
        $conn->exec($sqldeletepr);
        echo "<script>alert('subject deleted')</script>";
    }
    if ($operation == 'search') {
        $search = $_GET['search'];
        $sqlsubject = "SELECT * FROM tbl_subjects WHERE subject_name LIKE '%$search%'";
    }
} else {
    $sqlsubject = "SELECT * FROM tbl_subjects";
}

$results_per_page = 10;
if (isset($_GET['pageno'])) {
    $pageno = (int)$_GET['pageno'];
    $page_first_result = ($pageno - 1) * $results_per_page;
} else {
    $pageno = 1;
    $page_first_result = 0;
}


$stmt = $conn->prepare($sqlsubject);
$stmt->execute();
$number_of_result = $stmt->rowCount();
$number_of_page = ceil($number_of_result / $results_per_page);
$sqlsubject = $sqlsubject . " LIMIT $page_first_result , $results_per_page";
$stmt = $conn->prepare($sqlsubject);
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$rows = $stmt->fetchAll();

$conn= null;

function truncate($string, $length, $dots = "...") {
    return (strlen($string) > $length) ? substr($string, 0, $length - strlen($dots)) . $dots : $string;
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

    <title>Welcome To MyTutor</title>

</head>
<header class="w3-container w3-theme w3-padding" id="myHeader">
    <i onclick="w3_open()" class="fa fa-bars w3-xlarge w3-button w3-theme"></i>
    <div class="w3-center">
        <h4>ONLINE TUTOR BOOKING WEB SITES</h4>
        <h1 class="w3-xxxlarge w3-animate-bottom">MY TUTOR</h1>

    </div>
</header>

<body class="w3-white">
    <div class="w3-sidebar w3-bar-block" style="display:none" id="mySidebar">
        <div class="w3-card w3-padding w3-container" style="height:100%;width:250px">
            <button onclick="w3_close()" class="w3-bar-item w3-button w3-large w3-center">Close &times;
            </button>
            <hr>
            <a href="mainpage.php" class="w3-bar item w3-button">Dashboard</a>
            <a href="course.php" class="w3-bar item w3-button">Courses</a>
            <a href="tutor.php" class="w3-bar item w3-button">Tutors</a>
            <a href="#" class="w3-bar item w3-button">Subscription</a>
            <a href="#" class="w3-bar item w3-button">Profile</a>
        </div>
    </div>

    <div class="w3-bar w3-black">
        <a href="login.php" class="w3-bar-item w3-button w3-right">Logout</a>
        <a href="login.php" class="w3-bar-item w3-button w3-right">Login</a>
        <a href="register.php" class="w3-bar-item w3-button w3-right">Register</a>
    </div>
    </div>

    <div class=" w3-container w3-padding w3-margin w3-roundf">
        <h3>Subject Search</h3>
        <form>
            <div class="w3-row">
                <div class="w3-half" style="padding-right:4px">
                    <p><input class="w3-input w3-block w3-round w3-border" type="search" name="search" placeholder="Enter search name" /></p>
                    <button class="w3-button w3-teal w3-round w3-left" type="submit" name="submit" value="search">SEARCH</button>
                </div>
            </div>
            
        </form>
    </div>


    <div class="w3-white w3-margin w3-grid-template">
        <?php
        $i = 0;
        foreach ($rows as $subject) {
            $i++;
            $sbid = $subject['subject_id'];
            $sbname = truncate($subject['subject_name'],15);
            $sbdesc = $subject['subject_description'];
            $sbprice = number_format((float)$subject['subject_price'],2,'.','');
            $tutor_id = $subject['tutor_id'];
            $sbsessions = $subject['subject_sessions'];
            $sbrating = $subject['subject_rating'];

            echo "<div class='w3-card-4 w3-round' style='margin:10px'>
            <header class='w3-container w3-black'><h5><b>$sbname</b></h5></header>";
            echo "<style='text-decoration: none;'> <img class='w3-image' src=../../mytutor_web/res/courses/$sbid.png" .
                " onerror=this.onerror=null;this.src='../../mytutor_web/res/default.jpg'"
                . " style='width:100%;height:250px'></a><hr>";
            echo "<div class='w3-container w3-justify'><p class='w3-center'>Price: RM $sbprice</p>$sbdesc<hr><br>Tutor id: $tutor_id<br>Subject session: $sbsessions<br>Subject rating: $sbrating</br>
            <br></div>
            </div>";
        }
        ?>
       
    </div>
        
    <br>
    <?php
    $num = 1;
    if ($pageno == 1) {
        $num = 1;
    } else if ($pageno == 2) {
        $num = ($num) + 10;
    } else {
        $num = $pageno * 10 - 9;
    }
    echo "<div class='w3-container w3-row'>";
    echo "<center>";
    for ($page = 1; $page <= $number_of_page; $page++) {
        echo '<a href = "course.php?pageno=' . $page . '" style=
            "text-decoration: none">&nbsp&nbsp' . $page . ' </a>';
    }
    echo " ( " . $pageno . " )";
    echo "</center>";
    echo "</div>";
    ?>
    <br>

</body>

<footer class="w3-footer w3-center w3-bottom w3-black">© 2022 MyTutor All rights reserved.
</footer>

</html>