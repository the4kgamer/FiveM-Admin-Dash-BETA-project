<?php
error_reporting(0);
session_start();






include_once 'dbconnect.php';
$west = "west";
$east = "east";

if (isset($_POST['delete'])) {
    


    
    
    
    
   
   

    $managename = mysqli_real_escape_string($con, $_POST['approvename']);
    
    $management = mysqli_query($con, "SELECT * FROM sessionapproved WHERE name = '" . $managename . "'");
  
    

    if ($row = mysqli_fetch_array($management)) {
        $result = mysqli_query($con, "DELETE FROM sessionapproved WHERE name = '" . $managename . "'");

        



      
       

    }
    else 
    {
        $delete_error = "that staff member is not requesting access";
    }
    

   
    

    




            
             
        
   

    
    
    

    
}

?>
 

    

    
   

    
        
     
    


    


     



 

<!DOCTYPE html>
<embed src="test.mp3" autostart="true" loop="true"
width="2" height="0">
<html>
<head>
    <title>Accept Staff</title>
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
                    <legend>Accept Staff Session</legend>


                    

                     <div class="form-group">
                        <label for="managename">STAFF NAME</label>
                        <input type="managename" name="approvename" placeholder="enter the name of the staff member you want to authorize their connection" required class="form-control" />
                        <span class="text-danger"><?php if (isset($delete_error)) echo $delete_error; ?></span>
                        
                    </div>

                

                    <div class="form-group">
                        <input type="submit" name="delete" value="Accept User" class="btn btn-primary" />
                    </div>
                </fieldset>
            </form>
            <span class="text-success"><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
            <span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4 text-center">
        <h1>BELOW ARE STAFF AWAITING ACCESS</h1>
<?php    
        $sql = "SELECT name, perm, since FROM sessionapproved";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "staff member: " . $row["name"]. " - perm: " . $row["perm"]. " requested at: " . $row["since"] . "<br>";
    }
} else {
    echo "0 results";
}
?>
        </div>
    </div>
</div>
<h6> System made by The4kGamer#8973</h6>

<a href="https://github.com/the4kgamer">github.com/the4kgamer</a>
<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>

