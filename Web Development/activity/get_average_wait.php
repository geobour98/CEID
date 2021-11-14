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

$mytime="";

$avg_waits=array();

for($i=0;$i<24;$i++)

{
  if($i<10)
  {	  
  $mytime  = "%T0".$i.'%';	
  }
  
  else
	  
  
  {
	    $mytime  = "%T".$i.'%';	

	  
  }
  
 $sql = "SELECT AVG(wait) as mesos FROM entries  WHERE st_date_time LIKE '$mytime' HAVING AVG(wait)>0";
 
 $result = $con->query($sql);
 
 if($result->num_rows >0)

 {
		$row = $result->fetch_assoc();
		array_push($avg_waits, $row['mesos']);


 }
 
 else
	 
	 {
	
	     array_push($avg_waits, 0);
 
		 
	 }
 
}

echo json_encode($avg_waits);


?>