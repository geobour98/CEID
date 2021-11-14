<html>

<head>

<title>

Homepage of Admin

</title>

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





</html>