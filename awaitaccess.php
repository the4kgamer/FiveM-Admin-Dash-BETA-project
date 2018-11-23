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
               var message = data[a].message;
               var time = data[a].time;
               
               if (name = $name) {

                   document.getElementById("demo").innerHTML = "name detected";

                   

                   

               }
              




                   
              
               
               
               
             
               
           }
           document.getElementById("data").innerHTML = html;
        

           

        }


           
        
        
          
           

    
        

        



        
        
        
    }

   
    
        
        

        
}

    

</script>


        


<!DOCTYPE html>
<h1> please wait for a senior admin or above to approve your access request, please be patiant </h1>




<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>