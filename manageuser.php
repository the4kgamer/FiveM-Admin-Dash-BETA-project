<?php
error_reporting(0);
session_start();


include_once 'dbconnect.php';
$no = "no";
$result = mysqli_query($con, "SELECT * FROM users WHERE name = '" . $_SESSION['usr_nameedit'] . "' and ownerconfirm = '" . $no . "'");

$error = false;
$ownerconfirm = mysqli_real_escape_string($con, $_SESSION['usr_ownerconfirm']);

if ($row = mysqli_fetch_array($result)) {
    $ownerconfirm = "no";
    $_SESSION['usr_ownerconfirm'] = "no";
}
else 
{
    $ownerconfirm = "yes";
    $_SESSION['usr_ownerconfirm'] = "yes";
}
if($ownerconfirm == "no") {
    $userisdisabled = "this user has been disabled for   " . $_SESSION['usr_reason'] . " by " . $_SESSION['usr_owner'] . " at " . $_SESSION['usr_time'];
    $_SESSION['usr_ownerconfirm'] = "no";
}

if(isset($_POST['undisable']))
    {
        $indeed = "yes";
        $errorbigboy = true;
        $result = mysqli_query($con, "UPDATE users set OwnerConfirm = '" . $indeed. "' where name = '" . $_SESSION['usr_nameedit'] . "'");
        $result = mysqli_query($con, "DELETE FROM DisableLogs WHERE name = '" . $_SESSION['usr_nameedit'] . "'");
    }

if (isset($_POST['signup'])) {
    

    //$ownerconfirm = mysqli_real_escape_string($con, $_SESSION['usr_ownerconfirm']);
    
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $perm = mysqli_real_escape_string($con, $_POST['perm']);
    $userperm = mysqli_real_escape_string($con, $_SESSION['usr_permedit']);
    $result = mysqli_query($con, "SELECT * FROM users WHERE name = '" . $_SESSION['usr_nameedit'] . "'");
  
    
    $time = date("h:i a d/m/y");






    if($perm !== "changeme")
    {
        if($perm !== $userperm)
        {
            $errorbigboy = true;
        
            $result = mysqli_query($con, "UPDATE users SET perm = '" . $perm . "' where name = '" . $_SESSION['usr_nameedit'] . "'");


        }
        else 
        {
            $errormsg = "you have tried to change the staff member's role to the one they already have";
        }
        
    }

    if($name !== "")
    {
        $errorbigboy = true;
        $result = mysqli_query($con, "UPDATE users set name = '" . $name . "' where name = '" . $_SESSION['usr_nameedit'] . "'");
    }

    if($password !== "")
    {
        $errorbigboy = true;
        $result = mysqli_query($con, "UPDATE users set password = '" . $password . "' where name = '" . $_SESSION['usr_nameedit'] . "'");
    }

    


    

    if(isset($_POST['disable']))
    {
        $nope = "no";
        $errorbigboy = true;
        $result = mysqli_query($con, "UPDATE users set OwnerConfirm = '" . $nope. "' where name = '" . $_SESSION['usr_nameedit'] . "'");
        $result = mysqli_query($con, "INSERT INTO DisableLogs(owner,victim,reason,time) VALUES('" . $_SESSION['usr_name'] . "', '" .  $_SESSION['usr_nameedit']  . "', '" . $_POST['reason'] . "', '" . $time . "')");
        

        
    }


    
    
    
    
    
                     
   
 
    if(isset($_POST['undisable']))
    {
        $yes = "yes";
        $errorbigboy = true;
        $result = mysqli_query($con, "UPDATE users set OwnerConfirm = '" . $yes . "' where name = '" . $_SESSION['usr_nameedit'] . "'");
        $result = mysqli_query($con, "DELETE FROM disablelogs WHERE name = '" . $_SESSION['usr_name'] . "'");
    }
   
                     

   
    
    
     
    






   
   
       
    
    
        
    
       
   
    
    
    if($errorbigboy == true)
    {
        $successmsg = "changes saved";
        header("Refresh:0");
    }
    else 
    {
        $errormsg = "error";
    }
  
}



  
       

        
    

    
        
    
    
   
        
   
   
 

    
   
        



            

       



        
            
            
        
        

            
    
            
        

    
       
                
    
        
         
            
    
        
    
        
            
        
    
        
        
            
    
            
        
            
        
        
    

        
               
        
        
        
    

        
                
        

        
           

        
    
            
            
    

       
       
        
    


  
?>

<!DOCTYPE html>
<h1> ALL STAFF MUST LOG OUT WHEN THEIR SHIFT AS A STAFF HAS COME TO AN END, FAILING TO COMPLY TO THIS WILL RESULT IN A DEMOTION!!! </h1>
<embed src="test.mp3" autostart="true" loop="true"
width="2" height="0">
<html>
<head>
    <title>Admin registration</title>
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
            <a class="navbar-brand" href="registerdashboard.php"><span class="" aria-hidden="true"></span> Go back</a>
            
        </div>
        
        <div class="collapse navbar-collapse" id="navbar1">
            <ul class="nav navbar-nav navbar-right">
            <?php if (isset($_SESSION['usr_id'])) { ?>
                <li><p class="navbar-text"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Signed in as <?php echo $_SESSION['usr_name']; ?></p></li>
                <li><a href="logout.php">Log Out</a></li>
                <?php } else { ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="registerdashboard.php">Sign Up</a></li>
                <?php } ?>
               
            </ul>
        </div>
    </div>
    <div class="collapse navbar-collapse" id="navbar1">
            <ul class="nav navbar-nav navbar-right">
                <?php if (isset($_SESSION['usr_id'])) { ?>
                <li><p class="navbar-text"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> your role is <?php echo $_SESSION['usr_perm']; ?></p></li>
                
                <?php } ?>
                </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4 well">
            <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="signupform" novalidate>
                <fieldset>
                    <legend>edit the user: <?php echo $_SESSION['usr_nameedit'] ?></legend>
                    <?php echo $userisdisabled?>


                    <div class="form-group">
                        <label for="name">Change Name</label>
                        <input type="text" name="name" placeholder="Enter staff name" required value="<?php if($error) echo $name; ?>" class="form-control" />
                        <span class="text-danger"><?php if (isset($name_error)) echo $name_error; ?></span>
                    </div>

                    

                    <div class="form-group">
                        <label for="name">Change Password</label>
                        <input type="text" name="password" placeholder="Password" required class="form-control" />
                        <span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
                    </div>

                    
                    <label for="perm">Change Perm</label>


                    <select name="perm">
                    <option value="changeme">User Permission Group</option>
                    <option value="TrialMod">Trial Moderator</option>
                    <option value="Moderator">Moderator</option>
                    <option value="Admin">Administrator</option>
                    <option value="HeadAdmin">Head Administrator</option>
                    <option value="SuperAdmin">Super Administrator</option>
                    <option value="Owner">Owner</option>
                    </select>
                    <?php if ($_SESSION['usr_ownerconfirm'] == "yes") { ?>
                    <div class="form-group">
                        <label for="reason">Disable User: (tick checkbox)</label>
                        <input type="checkbox" name="disable" placeholder="disable" required class="form-control" />
                        <span class="text-danger"></span>
                        
                    </div>
                    <div class="form-group">
                        <label for="reason">Reason if disabling</label>
                        <input type="text" name="reason" placeholder="enter reason" required value="<?php if($error) echo $name; ?>" class="form-control" />
                        <span class="text-danger"><?php if (isset($name_error)) echo $name_error; ?></span>
                    </div>
                    <?php } else { ?>
                        <div class="form-group">
                        <input type="submit" name="undisable" value="undisable user" class="btn btn-primary" />
                    </div>
                    <?php } ?>

                   

                

                    <div class="form-group">
                        <input type="submit" name="signup" value="Save Changes" class="btn btn-primary" />
                    </div>
                </fieldset>
            </form>
            <span class="text-success"><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
            <span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4 text-center">    
        
        </div>
        <h2> User's kick, ban and warn actions: </h2>


       

<?php 
$result = mysqli_query($con, "SELECT * FROM logs WHERE name = '" . $_SESSION['usr_nameedit'] . "'"); 

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo $row["action"] . "   ". $row["deletename"]. "  for  " . $row["reason"] . " at " . $row["time"] .   "<br>";
    }
} else {
    echo "0 results";
}
?>

 <h3> User's login/logout activity: </h3>
 <?php
 $result = mysqli_query($con, "SELECT * FROM activitylogs WHERE name = '" . $_SESSION['usr_nameedit'] . "'"); 

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo $row["status"] . "  at  ". $row["time"]. "<br>";
    }
} else {
    echo "0 results";
}
?>

    </div>
</div>
<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
