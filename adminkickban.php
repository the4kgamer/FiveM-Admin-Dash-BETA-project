<?php
error_reporting(0);
session_start();







include_once 'dbconnect.php';
include_once 'serverinfo.php';
$name = mysqli_real_escape_string($con, $_SESSION['usr_name']);

$yeezy = true;
    

if ( $name ==  $null) {
    header("Location: noperms.php");
}




if (isset($_POST['delete'])) {
    
    
    
    
   
    $reason = mysqli_real_escape_string($con, $_POST['reason']);
    $deletename = mysqli_real_escape_string($con, $_POST['deletename']);
    $result = mysqli_query($con, "SELECT * FROM players WHERE name = '" . $deletename . "'"); 
    $yes = "yes";
    $AUTH = mysqli_query($con, "SELECT * FROM users WHERE name = '" . $name . "' and OwnerConfirm = '" . $yes . "'");
    $edittime = date(": i a d/m/y");
    $time = date("h:i a  d/m/y");
    $ban = $_POST['Ban'];
    $kick = $_POST['Kick'];
    $warn = $_POST['Warn'];
    $actionSQL = "null";
   
    $timeuntil = date("h:i") + $_POST['duration'] . " " . $edittime;

    
    $serverinfo = array
       (

        array("0","SinisterRPChicagoLaw","185.249.196.181","32066",""),
	    

           
       );

    foreach ($serverinfo as $server) {

        if($server['0'] == $server_id){

            $con = new q3query($server['2'], $server['3'], $success);
            if (!$success) {
                $delete_error = "error connecting to server, is the server online?";
            }
            $con->setRconpassword($server['4']);
            
        }



    }


    if ($row = mysqli_fetch_array($AUTH)) 
    {


        if($_POST['action'] == "1")
        {
            //what to do if ban is selected


            if(isset($_POST['Discord']) && (isset($_POST['FiveM']) == 'Yes'))

            {
                //Global ban
                $actionSQL = "Global Ban";
                $actionMsg = "Globally banned";
                $delete_error = "user has been globally banned";
                $banmessage = "you have been banned from the server for:  " . $reason . " by the staff member: " . $_SESSION['usr_name'] . " permanatly, if you are found trying to contact this staff member regarding your ban, you will immediately nullify your chances of getting the banned appealed!, this is just so you can reference them when submitting an appeal if you decide to";
                $con->rcon("clientkick $deletename $banmessage");


            }
            else
            {
                if(isset($_POST['Discord']) == 'Yes')
                {
                    //discord ban
                    $actionSQL = "discord ban";
                    $actionMsg = "Banned on discord";

                    $delete_error = "user is getting banned on Discord";
                }
                else
                {
                    if(isset($_POST['FiveM']) == 'Yes')
                    {
                        $actionSQL = "FiveM ban";
                        $actionMsg = "Banned";
                        $delete_error = "user is getting banned on FiveM";
                        $banmessage = "you have been banned from the server for:  " . $reason . " by the staff member: " . $_SESSION['usr_name'] . " permanatly, if you are found trying to contact this staff member regarding your ban, you will immediately nullify your chances of getting the banned appealed!, this is just so you can reference them when submitting an appeal if you decide to";
                        // $con->rcon("clientkick $deletename $banmessage");

                    }
                    else
                    {

                        $delete_error = "no boxes have been selected";

                    }




                }
            }












        }
        else
        {
            if(isset($_POST['Discord']) && (isset($_POST['FiveM']) == 'Yes'))

            {
                //Global ban
                $actionSQL = "Global Kick";
                $delete_error = "user has been globally kicked";
                $actionMsg = "Globally Kicked";

            }
            else
            {
                if(isset($_POST['Discord']) == 'Yes')
                {
                    //discord ban
                    $actionSQL = "discord Kick";
                    $actionMsg = "kicked on discord";

                    $delete_error = "user is getting Kicked on Discord";
                }
                else
                {
                    if(isset($_POST['FiveM']) == 'Yes')
                    {
                        $actionMsg = "kicked";
                        $actionSQL = "FiveM kick";
                        $delete_error = "user is getting kicked on fivem";
                        $kickmessage = "you have been banned from the kicked for:  " . $reason . " by the staff member: " . $_SESSION['usr_name'] . "";
                        //$con->rcon("clientkick $deletename $banmessage");

                    }
                    else
                    {

                        $delete_error = "no boxes have been selected";

                    }




                }
            }

        }

        if($_POST['action'] == "3")
        {

            if(isset($_POST['Discord']) && (isset($_POST['FiveM']) == 'Yes'))

            {
                //Global ban
                $actionSQL = "Global warned";
                $delete_error = "user has been globally warneded";


            }
            else
            {
                if(isset($_POST['Discord']) == 'Yes')
                {
                    //discord ban
                    $actionSQL = "discord warned";

                    $delete_error = "user is getting warneded on Discord";
                }
                else
                {
                    if(isset($_POST['FiveM']) == 'Yes')
                    {
                        $actionSQL = "FiveM warned";
                        $delete_error = "user is getting warneded on fivem";
                        $actionMsg = "warned";

                    }
                    else
                    {

                        $delete_error = "no boxes have been selected";

                    }




                }
            }

        }

        if($_POST['action'] == "4")
        {

            if(isset($_POST['Discord']) && (isset($_POST['FiveM']) == 'Yes'))

            {
                //Global temp ban
                $actionSQL = "Temp banned globally for " . $_POST['duration'] . "  houres";
                $delete_error = "user has been globally banned for " . $_POST['duration'] . "  hours";
                $fivem_message = $_POST['deletename'] . " has been globally banned for " . $_POST['duration'] . "  hours by ". $_SESSION['usr_name'] . " for " . $_POST['reason'];


            }
            else
            {
                if(isset($_POST['Discord']) == 'Yes')
                {
                    //discord temp ban
                    $actionSQL = "Temp Banned on Discord for " . $_POST['duration'] . "  houres";

                    $delete_error = "user is getting temp banned on Discord " . $_POST['duration'] . "  houres";
                }
                else
                {
                    if(isset($_POST['FiveM']) == 'Yes')
                    {
                        //fivem temp ban
                        $actionSQL = "Temp Banned on Fivem for " . $_POST['duration'] . "  houres";
                        $delete_error = "user is getting temp banned on FiveM for " . $_POST['duration'] . "  houres";
                        $actionMsg = "has been banned for " . $_POST['duration'] . " houres";


                        $banmessage = "you have been banned from the server for:  " . $reason . " by the staff member: " . $_SESSION['usr_name'] . " until " . $timeuntil . ", if you are found trying to contact this staff member regarding your ban, you will immediately nullify your chances of getting the banned appealed!, this is just so you can reference them when submitting an appeal if you decide to";
                        // /$con->rcon("clientkick $deletename $banmessage");
                        $delete_error = "user is getting banned until" . $timeuntil;
                        

                    }
                    else
                    {

                        $delete_error = "no boxes have been selected";

                    }




                }
            }

        }





        echo $_POST['action'];



        if($_POST['action'] == "1")
        {
            if($_POST['duration'] !== "")
            {
                $delete_error = "you have selected to ban someone permanatly, but text has been detected in the temp ban duration box, if you were meaning to temp ban, please select that box now!";
                $yeezy = false;
            }
        }






        $message = $_POST['deletename'] . " has been " . $actionMsg . " by " . $_SESSION['usr_name'] . " for " . $_POST['reason'] . "  remember, just don't be dumb!";

        //send message to server
        if(isset($_POST['Discord']) !== 'Yes')
        {

            foreach ($serverinfo as $server) {

                if($server['0'] == $server_id){

                    $con = new q3query($server['2'], $server['3'], $success);
                    if (!$success) {
                        $delete_error = "error connecting to server, is the server online?";
                    }
                    $con->setRconpassword($server['4']);
                    $con->rcon("FiveMChatAnnounce " . $message);
                }



            }








            if ($yeezy == true)
            {
                if(mysqli_query($con, "INSERT INTO adminsyslogs(action, deletename, name, reason, time) VALUES('" . $actionSQL . "','" . $deletename . "', '" . $name . "', '" . $reason . "', '" . $time . "')")) {
                }
                if(mysqli_query($con, "INSERT INTO logs(action, deletename, name, reason, time) VALUES('" . $actionSQL . "','" . $deletename . "', '" . $name . "', '" . $reason . "', '" . $time . "')")) {
                }



                echo $message;


            }






        }







    }
    else
    {
        $delete_error = "your account has been disabled by an owner, please consult them for more details";
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
                        <label for="deletename">User's Name</label>
                        <input type="deletename" name="deletename" placeholder="enter the name of the person's account you want to delete (all correct spelling/casing)" required class="form-control" />
                        <span class="text-danger"><?php if (isset($delete_error)) echo $delete_error; ?></span>
                        
                    </div>

                    <div class="form-group">
                        <label for="reason">reason</label>
                        <input type="reason" name="reason" placeholder="reason" required class="form-control" />
                        <span class="text-danger"></span>
                        
                    </div>

                   

                    <div class="form-group">
                        <label for="reason">Ban or Kick the user on discord?</label>
                        <input type="checkbox" name="Discord" placeholder="Discord" required class="form-control" />
                        <span class="text-danger"></span>
                        
                    </div>

                     <div class="form-group">
                        <label for="reason">Ban or Kick the user on FiveM?</label>
                        <input type="checkbox" name="FiveM" placeholder="FiveM" required class="form-control" />
                        <span class="text-danger"></span>
                        
                    </div>

                     <div class="form-group">
                        <label for="duration">Temp Ban duration (if selected) (in hours)</label>
                        <input type="duration" name="duration" placeholder="duration" required class="form-control" />
                        <span class="text-danger"></span>
                        
                    </div>

                    <span class="text-danger"><?php if (isset($fivem_message)) echo $fivem_message; ?></span>

                    <select name="action">
                    <option value="1">Ban</option>
                    <option value="4">Temp Ban</option>
                    <option value="2">Kick</option>
                    <option value="3">warn</option>
                    </select>

                    

                    
                    

                   
                    
                    


                    



                    

                

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
        
        <h2>BELOW ARE CONNECTED PLAYERS</h2>
<?php    
        $sql = "SELECT name FROM players";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "name: " . $row["name"]. "<br>";
    }
} else {
    echo "0 results";
}
?>
        </div>
    </div>
</div>
<h6> System made by The4kGamer#8973</h6>

<a href="https://github.com/the4kgamer">GitHub</a>
<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>

