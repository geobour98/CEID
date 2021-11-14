<html>

<head>

<title>

Homepage of Admin

</title>

<link rel="stylesheet" href="mystyle.css">


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>

$( document ).ready(function() {
    
	$.ajax({
                url:'get_users.php',

                type:'post',
                
                success:function(response){
                   

                    $("#users").html(response);
				   

                }
            });
	
	$.ajax({
                url:'get_requests_per_type.php',

                type:'post',
                
                success:function(response){
                   

                    $("#requests").html(response);
				   

                }
            });
	
	$.ajax({
                url:'get_responses_per_status.php',

                type:'post',
                
                success:function(response){
                   

                    $("#responses").html(response);
				   

                }
            });
	
	
	$.ajax({
                url:'get_domains.php',

                type:'post',
                
                success:function(response){
                   

                    $("#domains").html(response);
				   

                }
            });
	
	$.ajax({
                url:'get_isp.php',

                type:'post',
                
                success:function(response){
                   

                    $("#isps").html(response);
				   

                }
            });
	
	$.ajax({
                url:'get_average_age.php',

                type:'post',
                
                success:function(response){
                   

                    $("#ages").html(response);
				   

                }
            });
	
});	



</script>


</head>


<?php

session_start();


if($_SESSION["connected"] ==3)
	
	{
		
		echo "<table border='1'>
		
		<tr>      
		
		<td> <a href ='visualize_info.php'>View Important Info</a> </td>
		
		
		<td><a href ='view_times.php'>View Timings </a> </td>
		
		
		<td><a href ='view_headers.php'>View Headers</a> </td>
		
		
		<td><a href ='view_map.php'>View Map</a> </td>


   		<td><a href ='logout_admin.php'>Logout</a> </td>
	
		
		</tr>
		
		
		
		</table>";
		
		
		
	}




else
	

	{
		
		header("Location: admin_login.php");

		
		
	}


?>



<table>

<tr> 

<td>
<div id = "ages">   </div>
</td>


<td>
<div id ="responses">  </div>
<br>
<br>
<br>
<br>
<br>


<div id="users">     </div>

<br>
<br>
<br>
<br>

<div id ="requests">  </div>

<br>
<br>
<br>
<br>
<br>

<div id ="domains">  </div>

<br>
<br>
<br>
<br>
<br>

<div id = "isps">   </div>

<br>
<br>
<br>
<br>
<br>
</td>

</tr>

</table>

</html>