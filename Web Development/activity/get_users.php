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

$sql = "SELECT COUNT(*) as plithos  FROM user";
$result = $con->query($sql);

$row = $result->fetch_assoc();

$plithos = $row['plithos'];



$con->close();



echo "<table border='1'> <tr> <th> Number of Users </th></tr> <tr><td>$plithos </td></tr></table>";






?>