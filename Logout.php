<?php
error_reporting(0);
session_start();
include_once 'dbconnect.php';
$time = date("h:i a d/m/y");
$status = "logged out";
$name = mysqli_real_escape_string($con, $_SESSION['usr_name']);
$logmessage = $name . " logged out at " . $time;
if(mysqli_query($con, "INSERT INTO ActivityLogs(name, time, status) VALUES('" . $name . "','" . $time . "', '" . $status . "')")) {
}
if(mysqli_query($con, "INSERT INTO ActivityLogMessage(message) VALUES('" . $logmessage . "')")){
    
}
$result = mysqli_query($con, "DELETE FROM onlinestaff WHERE name = '" . $_SESSION['usr_name'] . "'");
$_SESSION['usr_online'] = "no";

if(isset($_SESSION['usr_id'])) {
    session_destroy();
    unset($_SESSION['usr_id']);
    unset($_SESSION['usr_name']);
    header("Location: login.php");
} else {
    header("Location: login.php");
}



?>

