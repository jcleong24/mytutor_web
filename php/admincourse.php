<?php
session_start();
if(!isset($_SESSION['sessionid'])){
    echo "<script>alert('Session not available. Please Login'); </script>";
    echo "<script> window.location.replace('login.php')</script>";
}
include_once("dbconnect.php");

if(isset($_GET['submit'])){
    $operation = $_GET['submit'];
    if($operation == 'delete'){
        $prid = $_GET['prid'];
        $sqldeletepr = "DELETE FROM `tbl_subjects` WHERE subject_id = '$sbid'";
        $conn->exec($sqldeletepr);
        echo "<script>alert('Subject deleted')</script>";
    }
    if($operation == 'search'){
        $search = $_GET['search'];
        $option = $_GET['option'];      
        }
        if($option == "Select"){
            $sqlsubject = "SELECT * FROM tbl_subjects WHERE subject_name LIKE '%$search%'";
        }
    }  
else{
    $sqlsubject = "SELECT * FROM tbl_subjects";
}

// Pagination
$result_prpage = 20;
if(isset($_GET['pageno'])){
    $pageno = (int) $_GET['pageno'];
    $page_first__result = ($pageno - 1) * $result_prpage;
}else{
    $pageno = 1;
    $page_first__result = 0;
}

$statement = $conn-> prepare($sqlsubject);
$statement -> execute();
$number_of_result = $statement -> rowCount();
$sqlsubject = $sqlsubject . " LIMIT $page_first__result, $result_prpage";
$statement = $conn-> prepare($sqlsubject);
$statement -> execute();
$result = $statement -> setFetchMode(PDO::FETCH_ASSOC);
$rows = $statement -> fetchAll();
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
    
    <script src="../js/main.js" defer></script>
    <title>Document</title>
</head>

<style>

</style>

<header class = "w3-container w3-theme w3-padding" id ="myHeader">
<i onclick="w3_open()" class="fa fa-bars w3-xlarge w3-button w3-theme"></i>
    <div class="w3-center w3-animate-bottom">
        <h1>ONLINE TUTOR BOOKING WEB SITES</h1>
        <h1>MY TUTOR</h1>
    </div>
</header>
<body class="w3-white">
    <div class = "w3-sidebar w3-bar-block" style="display:none" id="mySidebar">
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

<div class="w3-third w3-card w3-container w3-padding w3-margin w3-round">
    <h2>Course search</h2>
    <form>
        <div class="w3-row">
            <div>
                <p><input class="w3-input w3-block w3-round w3-border" type="search" name="search" placeholder="Enter search"/></p>
            </div>
        </div>
        <button class="w3-button w3-black w3-round w3-right" type="submit" name="submit" value="search">Search</button>
    </form>
</div>
<div class="w3-margin w3-border" style="overflow-x:20px;">
        <?php
        $i = 0;
        echo "<table class='w3-table w3-striped w3-bordered' style='width:100%'>
         <tr><th style='width:5%'>No</th><th style='width:30%'>Course Name</th><th style='width:10%'>Tutor id</th><th style='width:10%'>Session</th><th style='width:10%'>Price</th><th Rating</th><th>Description</th></tr>";
        foreach ($rows as $subject) {
            $i++;
            $sbid = $subject['subject_id'];
            $sbname = $subject['subject_name'];
            $sbdesc = $subject['subject_description'];
            $sbprice = number_format((float)$subject['subject_price'], 2, '.', '');
            $trid = $subject['tutor_id'];
            $sbsession = $subject['subject_sessions'];
            $sbrating = $subject['subject_rating'];

            echo "<tr><td>$i</td><td>$sbname</td><td>$trid</td><td>$sbsession</td><td>RM $sbprice</td><td>$sbrating</td><td>$sbdesc</td>
            <td><button class='btn'><a href='admincourse.php?submit=delete&prid=$sbid' class='fa fa-trash' onclick=\"return confirm('Are you sure?')\"></a></button>
            <button class='btn'><a href='admincourse.php?submit=details&prid=$sbid' class='fa fa-edit'></a></button></td></tr>";
        }
        echo "</table>";
        ?>
    </div>

</body>

</html>