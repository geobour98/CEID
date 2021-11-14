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


    $sql_query = "select distinct con_type from header where con_type <>''";
    $result = mysqli_query($con,$sql_query);
	
  
  $option ="<select id = 'contype_selected' name ='contype_selected[]' multiple>";
    if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
           $option .= '<option value = "'.$row['con_type'].'">'.$row['con_type'].'</option>';
    }
}

$option.="</select>";	
 

echo $option;
$con->close();
  
  

?>