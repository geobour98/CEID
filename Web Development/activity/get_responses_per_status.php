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

$sql = "SELECT COUNT(*) as plithos, status  FROM response GROUP BY status";
$result = $con->query($sql);

echo "<table border='1'><tr><th>Count </th><th>Response Type</th></tr>";
while($row = $result->fetch_assoc()) {
   
  echo "<tr>";
  
  echo "<td>";
  
  echo $row['plithos'];
  echo "</td>";
  
  echo "<td>";
  
  echo $row['status'];
  echo "</td>";
  
  echo "</tr>";
   
  }

echo "</table>";

$con->close();







?>