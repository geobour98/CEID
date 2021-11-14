<html>


<?php


session_start();

$myusername =  $_POST["username"];

$mypassword = $_POST["password"];

 


if($myusername=="admin" && $mypassword =="test")
	

	{
		$_SESSION["connected"] = 3;


		header("Location: index_admin.php");
		
		
		
	}



?>



</html>