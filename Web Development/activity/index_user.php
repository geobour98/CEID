<html>

<head>

<link rel="stylesheet" href="mystyle.css">


<title>

Homepage of User

</title>

</head>

<body style="background-image: url('back.jpg');">

<?php


session_start();


 if($_SESSION["connected"] ==1)

 {

    echo "<table border = '3'>                    
	
	<tr>
	
	<td> <a href ='upload.php'>Upload Data </a></td>
	<td><a href = 'visualize.php'>Visualize Data </a></td>
	<td> <a href = 'edit_profile.php'>Edit Profile </a>  </td>
	<td><a href ='logout_user.php'>Logout </a></td>
	</tr>
	</table>";


 }
 
 
 else
	 
 
 {
	 
	 header("Location: login_user.php");

	 
	 
 }


?>


</body>


</html>