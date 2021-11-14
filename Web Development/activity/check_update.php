<?php
session_start();
$host = "localhost"; /* Host name */
$user = "root"; /* User */
$password = ""; /* Password */
$dbname = "activity"; /* Database name */

$con = mysqli_connect($host, $user, $password,$dbname);
// Check connection
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}


$myusername = mysqli_real_escape_string($con,$_POST['username']);
$mypassword = mysqli_real_escape_string($con,$_POST['password']);



if ($myusername != "" && $mypassword != ""){

    $sql_query = "select count(*) as mycount from user where username='$myusername'";
    $result = mysqli_query($con,$sql_query);
    $row = mysqli_fetch_array($result);

    $count = $row['mycount'];

    if($count > 0){
		
        echo  0;
    }else{
 
 
      $user_id = $_SESSION["user_id"];
	  
	  
	  $sql_update = "update user set username = '$myusername',password='$mypassword' where id = '$user_id'";
	  
	  $result = mysqli_query($con,$sql_update);

 
      echo 1;
 
    }

}