<?php


include_once 'dbconnect.php';
session_start();

$authed = mysqli_real_escape_string($con, $_SESSION['usr_sessAUTH']);
$name = mysqli_real_escape_string($con, $_SESSION['usr_name']);
echo "latest";
echo $name;
?>
<script>
setInterval(function() { yeet() },1);


function yeet() {
    var ajax = new XMLHttpRequest();
    var method = "GET";
    var url = "checkapproved.php";
    var asynchronous = true;

    ajax.open(method, url, asynchronous);
    ajax.send();
    ajax.onreadystatechange = function()
    {
        if (this.readyState == 4 && this.status == 200)
        {
            var data = JSON.parse(this.responseText);
           console.log(data);
           var html = "";
           for (var a = 0; a < data.length; a++){
               






               var name = data[a].name;
               var awaitname = <?php echo $name ?>
              
              
               
               

               
              
               if (<?php echo $name ?> = name) {

                   header('Location: dash.php');
               }
               

                
               
           
               
               
              




                   
              
               
               
               
             
               
           }
           document.getElementById("data").innerHTML = html;
        

           

        }


           
        
        
          
           

    
        

        



        
        
        
    }

   
    
        
        

        
}

    

</script>


        


<!DOCTYPE html>
<h1> please wait for a senior admin or above to approve your access request, please be patiant </h1>


<img src="loading.gif" width="500" height="500">

<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>