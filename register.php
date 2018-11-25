<?php
error_reporting(0);
session_start();


include_once 'dbconnect.php';

$error = false;


if (isset($_POST['signup'])) {
    

    
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
    $perm = mysqli_real_escape_string($con, $_POST['perm']);

    $ownerconfirm = "yes";
    $online = "no";
    
    
    
                     
   
 
   
                     

   
    
    
     
    






    if(strlen($password) < 6) {
        $error = true;
        $password_error = "Password must be minimum of 6 characters";
    }
    if($cpassword != $password) {
        $error = true;
        $cpassword_error = "Password and Confirm Password doesn't match";
    }
    
  
    
   
       
    
    
        
    
       
        
    
    if (!$error) {
        if(mysqli_query($con, "INSERT INTO users(password,name,perm,ownerconfirm,online) VALUES('" . $password . "', '" . $name . "', '" . $perm . "', '" . $ownerconfirm . "', '" . $online . "')")) {
            $successmsg =  "Successfully Registered!</a>"; 
        
            
        } else {
            $errormsg = "register error, possible SQL error";
        }
    
    }
    
    
}



  
       

        
    

    
        
    
    
   
        
   
   
 

    
   
        



            

       



        
            
            
        
        

            
    
            
        

    
       
                
    
        
         
            
    
        
    
        
            
        
    
        
        
            
    
            
        
            
        
        
    

        
               
        
        
        
    

        
                
        

        
           

        
    
            
            
    

       
       
        
    


  
?>

<!DOCTYPE html>
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
                <li><a href="login.php">Login</a></li>
                <li class="active"><a href="register.php">Sign Up</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4 well">
            <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="signupform">
                <fieldset>
                    <legend>Register a staff</legend>


                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" placeholder="Enter staff name" required value="<?php if($error) echo $name; ?>" class="form-control" />
                        <span class="text-danger"><?php if (isset($name_error)) echo $name_error; ?></span>
                    </div>

                    

                    <div class="form-group">
                        <label for="name">Password</label>
                        <input type="password" name="password" placeholder="Password" required class="form-control" />
                        <span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
                    </div>

                    <div class="form-group">
                        <label for="name">Confirm Password</label>
                        <input type="password" name="cpassword" placeholder="Confirm Password" required class="form-control" />
                        <span class="text-danger"><?php if (isset($cpassword_error)) echo $cpassword_error; ?></span>
                    </div>
                    <label for="perm">User Permission</label>


                    <select name="perm">
                    <option value="TrialMod">Trial Moderator</option>
                    <option value="Moderator">Moderator</option>
                    <option value="Admin">Administrator</option>
                    <option value="HeadAdmin">Head Administrator</option>
                    <option value="SuperAdmin">Super Administrator</option>
                    <option value="Owner">Owner</option>
                    </select>

                    

                

                    <div class="form-group">
                        <input type="submit" name="signup" value="Sign Up" class="btn btn-primary" />
                    </div>
                </fieldset>
            </form>
            <span class="text-success"><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
            <span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4 text-center">    
        Already Registered? <a href="login.php">Login Here</a>
        </div>
    </div>
</div>
<h6> System made by The4kGamer#8973</h6>

<a href="https://github.com/the4kgamer">GitHub</a>
<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
