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

$user_id = $_SESSION["user_id"];


$sql = "SELECT last_dt_upload as last FROM user WHERE id = '$user_id'";

$sql2 = "SELECT COUNT(*) as plithos FROM entries WHERE user_id = '$user_id'";

$result = $con->query($sql);

$row = $result->fetch_assoc();

$last_upload = $row['last'];

$result2 = $con->query($sql2);

$row2 = $result2->fetch_assoc();

$total = $row2['plithos'];

echo "<br>";

echo "<br>";

echo "<table border='1'>";

echo "<tr>";

echo "<th>";
echo "Last Upload DateTime";
echo "</th>";

echo "<th>";
echo "Entries  Uploaded";
echo "</th>";

echo "</tr>";

echo "<tr>";

echo "<td>";
echo $last_upload;
echo "</td>";

echo "<td>";
echo $total;
echo "</td>";

echo "</tr>";
echo "</table>";

echo "<br>";

echo "<br>";



?>