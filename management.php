<?php
error_reporting(0);
session_start();






include_once 'dbconnect.php';
$west = "west";
$east = "east";

if (isset($_POST['delete'])) {
    


    
    
    
    
   
   

    $managename = mysqli_real_escape_string($con, $_POST['managename']);
    $result = mysqli_query($con, "SELECT * FROM users WHERE name = '" . $managename. "'"); 
    $management = mysqli_query($con, "SELECT * FROM disablelogs WHERE victim = '" . $managename. "'");
  

    if ($row = mysqli_fetch_array($management)) {
        $_SESSION['usr_reason'] = $row['reason'];
        $_SESSION['usr_owner'] = $row['owner'];
        $_SESSION['usr_time'] = $row['time'];

    }
    if ($row = mysqli_fetch_array($result)) {

       
       
        $_SESSION['usr_ownerconfirm'] = $row['OwnerConfirm'];
        $_SESSION['usr_permedit'] = $row['perm'];
        $_SESSION['usr_nameedit'] = $row['name'];
        header("Location: manageuser.php");
    } else {
        $errormsg = "this user does not exist";
    }
    

   
    

    




            
             
        
   

    
    
    

    
}

?>
 

    

    
   

    
        
     
    


    


     



 

<!DOCTYPE html>
<embed src="test.mp3" autostart="true" loop="true"
width="2" height="0">
<html>
<head>
    <title>Delete User</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" >
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
</head>
<body>

<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="admindash.php"><span class="" aria-hidden="true"></span> Go back</a>
            <h2>Ignore the warning(s) ^^ above if any<br></h2>
        </div>
        
        <div class="collapse navbar-collapse" id="navbar1">
            <ul class="nav navbar-nav navbar-right">
                
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4 well">
            <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="signupform">
                <fieldset>
                    <legend>manage user</legend>


                    

                     <div class="form-group">
                        <label for="managename">User's Name</label>
                        <input type="managename" name="managename" placeholder="enter the name of the staff member you wish to edit" required class="form-control" />
                        <span class="text-danger"><?php if (isset($delete_error)) echo $delete_error; ?></span>
                        
                    </div>

                

                    <div class="form-group">
                        <input type="submit" name="delete" value="Edit User" class="btn btn-primary" />
                    </div>
                </fieldset>
            </form>
            <span class="text-success"><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
            <span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4 text-center">
        <h1>BELOW ARE THE EXISTING USERS</h1>
<?php    
        $sql = "SELECT name, perm FROM users";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "name: " . $row["name"]. " - perm: " . $row["perm"]. "<br>";
    }
} else {
    echo "0 results";
}
?>
        </div>
    </div>
</div>
<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>

