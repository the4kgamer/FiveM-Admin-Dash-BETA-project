<?php
error_reporting(0);
session_start();
include_once 'dbconnect.php';



$name = mysqli_real_escape_string($con, $_SESSION['usr_name']);
    
   
    

if ( $name ==  $null) {
    header("Location: noperms.php");
}



$sql = "SELECT name, deletename, reason, time, action FROM logs";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo $row["name"] . "    " . $row["action"] . "   ". $row["deletename"]. "  for  " . $row["reason"] . " at " . $row["time"] .   "<br>";
    }
} else {
    echo "0 results";
}

$sqlmsg = "SELECT message FROM activitylogmessage";
$resultmsg = mysqli_query($con, $sqlmsg);

if (mysqli_num_rows($resultmsg) > 0) {
    // output data of each row
    while($rowmsg = mysqli_fetch_assoc($resultmsg)) {
        echo "LOGIN/LOGOUT ALERT: " . $rowmsg["message"] . "<br>";
    }
} else {
    echo "0 results";
}






?>

<h6> System made by The4kGamer#8973</h6>

<a href="https://github.com/the4kgamer">GitHub</a>


