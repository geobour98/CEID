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


    $sql_query = "select distinct method from request";
    $result = mysqli_query($con,$sql_query);
	
  
  $option ="<select id = 'method_selected' name = 'method_selected[]' multiple>";
    if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
           $option .= '<option value = "'.$row['method'].'">'.$row['method'].'</option>';
    }
}

$option.="</select>";	
 

echo $option;
$con->close();
  
  

?>