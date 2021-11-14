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

$sql = "SELECT AVG(age) as mesi_age, con_type  FROM header  WHERE type='response' AND con_type <> '' GROUP BY con_type ";
$result = $con->query($sql);

echo "<table border='1'><tr><th>Average Age</th><th>Content Type</th></tr>";
while($row = $result->fetch_assoc()) {
   
  echo "<tr>";
  
  echo "<td>";
  
  echo $row['mesi_age'];
  echo "</td>";
  
  echo "<td>";
  
  echo $row['con_type'];
  echo "</td>";
  
  echo "</tr>";
   
  }

echo "</table>";

$con->close();







?>