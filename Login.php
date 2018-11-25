<?php
error_reporting(0);
session_start();

if(isset($_SESSION['usr_id'])!="") {
    //header("Location: dashboard.php");
}

include_once 'dbconnect.php';
echo "latest";
//check if form is submitted
if (isset($_POST['next'])) {









    
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $result = mysqli_query($con, "SELECT * FROM users WHERE name = '" . $name . "' and password = '" . $password . "'");
    $ownerres = mysqli_query($con, "SELECT * FROM disablelogs WHERE victim = '" . $name . "'");
    $authorisedsession = mysqli_query($con, "SELECT * FROM sessionapproved WHERE name = '" . $_POST['name'] . "'");
    



    if ($row = mysqli_fetch_array($result)) {

       

        $_SESSION['usr_OwnerConfirm'] = $row['OwnerConfirm'];

        if($_SESSION['usr_OwnerConfirm'] == "yes")
        {
           
            $_SESSION['usr_id'] = $row['id'];
            $_SESSION['usr_name'] = $row['name'];
            $_SESSION['usr_perm'] = $row['perm'];
            $_SESSION['usr_online'] = $row['online'];
            $_SESSION['usr_OwnerConfirm'] = $row['OwnerConfirm'];
            $_SESSION['usr_online'] = "yes";
            
            $time = date("h:i a d/m/y");
            $status = "logged in";
    
            $logmessage = $name . " logged in at " . $time;
            if(mysqli_query($con, "INSERT INTO ActivityLogs(name, time, status) VALUES('" . $name . "','" . $time . "', '" . $status . "')")) {
            }
            if(mysqli_query($con, "INSERT INTO activitylogmessage(message) VALUES('" . $logmessage . "')")){
    
            }
            $bans = "0";
            $kicks = "0";
            $warns = "0";
            if(mysqli_query($con, "INSERT INTO onlinestaff(name, since, bans, kicks, warns) VALUES('" . $name . "','" . $time . "','" . $bans . "','" . $kicks . "','" . $warns . "')")){ 
    
            }
            

           
            if ($row['perm'] !== "owner") {
                if(mysqli_query($con, "INSERT INTO sessionapproved(name, since, perm) VALUES('" . $name . "','" . $time . "','" . $test . "')")){ 
    
                }
            }

           

            echo $_SESSION['usr_perm'];
            echo $row['perm'];
            
            $authorisedsession = mysqli_query($con, "SELECT * FROM sessionapproved WHERE name = '" . $_POST['name'] . "'");
            
            if ($row = mysqli_fetch_array($authorisedsession)) {
               // $_SESSION['usr_sessAUTH'] = true;
               if ($row['perm'] !== "owner") {


                   header("location: awaitaccess.php");
               }


                // $_SESSION['usr_sessAUTH'] = false;
                
               
               else 
               {
                   header("location: dash.php");




               }

             
            }
            else 
            {


                header("Location: dash.php");

                
               
                
              
                

            }
            
            

        }
        else 
        {
           
           
           
            if ($row = mysqli_fetch_array($ownerres)) {
                $owner = $row['owner'];
                $reason = $row['reason'];
                $errormsg = "your account has been temporarily disabled by  " . $owner ." for " . $reason . ", please consult him/her about this";
            }
            else
            {
                $errormsg = "sql error";
            }


           
        }


       
    } else {
        $errormsg = "incorrect email and/or password";
    }
}


?>

<!DOCTYPE html>
<embed src="test.mp3" autostart="true" loop="true"
width="2" height="0">
<html>
<head>
    <title>PHP Login Script</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" >
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
</head>
<body>

<nav class="navbar navbar-default" role="navigation">  <!--for smaller screens like mobile-->
    <div class="container-fluid">
        <!-- add header -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php"></span> go back</a>
        </div>
        <!-- menu items -->
        <div class="collapse navbar-collapse" id="navbar1">
            <ul class="nav navbar-nav navbar-right">
               
                
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4 well">
            <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="loginform">
                <fieldset>
                    <legend>next</legend>
                    
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" placeholder="Your username" required class="form-control" />
                    </div>

                    <div class="form-group">
                        <label for="name">Password</label>
                        <input type="password" name="password" placeholder="Your Password" required class="form-control" />
                    </div>

                    <div class="form-group">
                        <input type="submit" name="next" value="next" class="btn btn-primary" />
                    </div>
                </fieldset>
            </form>
            <span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
        </div>
    </div>
    <div class="row">
        </div>
    </div>
</div>
<h6> System made by The4kGamer#8973</h6>

<a href="https://github.com/the4kgamer">GitHub</a>
<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
