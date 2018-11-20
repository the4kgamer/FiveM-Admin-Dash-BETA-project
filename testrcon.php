<?php
error_reporting(0);
session_start();


$serverinfo = array
       (

        array("0","SinisterRPChicagoLaw","185.249.196.181","32066","6f96d22e18"),
	    

           
       );


include_once 'dbconnect.php';

$name = mysqli_real_escape_string($con, $_SESSION['usr_name']);

$yeezy = true;
    
$command = mysqli_real_escape_string($con, $_POST['command']);
if ( $name ==  $null) {
    header("Location: noperms.php");
}
require("q3query.class.php");

if (isset($_POST['delete'])) {

    foreach ($serverinfo as $server) {
        

        if($server['0'] == $server_id){
				
            $con = new q3query($server['2'], $server['3'], $success);
            if (!$success) {
                die ("Fehler bei der Verbindungherstellung");
            }
            $con->setRconpassword($server['4']);
            $con->rcon("say hi");
        }
            
           

    }

    
   

  
             
        
   

    
    
    

    
}
echo $time;
echo $name;
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
            <a class="navbar-brand" href="dash.php"><span class="" aria-hidden="true"></span> Go back</a>
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
            <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="signupform" novalidate>
                <fieldset>
                    <legend>Kick, Ban or warn a player</legend>


                    

                     <div class="form-group">
                        <label for="command">rcon command</label>
                        <input type="command" name="command" placeholder="enter rcon command" required class="form-control" />
                        <span class="text-danger"><?php if (isset($delete_error)) echo $delete_error; ?></span>
                        
                    </div>


                    
                    
                    


                    



                    

                

                    <div class="form-group">
                        <input type="submit" name="delete" value="Delete User" class="btn btn-primary" />
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

        </div>
    </div>
</div>
<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>

