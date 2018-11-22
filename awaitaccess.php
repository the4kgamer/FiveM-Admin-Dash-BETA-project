<?php


include_once 'dbconnect.php';


$authed = mysqli_real_escape_string($con, $_SESSION['usr_sessAUTH']);


?>
<!DOCTYPE html>
<h1> please wait for a senior admin or above to approve your access request, please be patiant </h1>




<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>