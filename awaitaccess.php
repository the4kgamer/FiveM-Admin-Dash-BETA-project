<?php


include_once 'dbconnect.php';
session_start();
header("Refresh:0");
$authed = mysqli_real_escape_string($con, $_SESSION['usr_sessAUTH']);
$name = mysqli_real_escape_string($con, $_SESSION['usr_name']);
echo "latest";
echo $name;
$authorisedsession = mysqli_query($con, "SELECT * FROM sessionapproved WHERE name = '" . $name . "'");
if ($row = mysqli_fetch_array($authorisedsession)) {

   
}
else
{
    header("location: dash.php");

}
?>

        


<!DOCTYPE html>
<h1> please wait for a senior admin or above to approve your access request, please be patiant </h1>


<img src="loading.gif" width="500" height="500">
<h6> "I tried to get AJAX constant SQL fetching without having to refresh the page to work, but I was never successful, I don't know why, the code should of been right but I guess I am just too lazy" </h6>
<h6> -The4kgamer </h6>
<h6> System made by The4kgamer (2018) </h6>
<a href="https://github.com/the4kgamer">github.com/the4kgamer</a>
<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>