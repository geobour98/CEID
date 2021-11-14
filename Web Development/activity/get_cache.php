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


$sql_stale = "SELECT  COUNT(*) AS mstale FROM header WHERE cache_ctrl LIKE '%max-stale%'";

$sql_fresh = "SELECT  COUNT(*) AS mfresh FROM header WHERE cache_ctrl LIKE '%min-fresh%'";

$sql_public = "SELECT  COUNT(*) AS public FROM header WHERE cache_ctrl LIKE '%public%'";

$sql_private = "SELECT  COUNT(*) AS private FROM header WHERE cache_ctrl LIKE '%private%'";

$sql_no_cache = "SELECT  COUNT(*) AS no_cache  FROM header WHERE cache_ctrl LIKE '%no-cache%'";

$sql_no_store = "SELECT  COUNT(*) AS no_store FROM header WHERE cache_ctrl LIKE '%no-store%'";

$sql_total = "SELECT  COUNT(*) AS total from header";


$result_stale = $con->query($sql_stale);
$row_stale = $result_stale->fetch_assoc();
$stale = intval($row_stale['mstale']);



$result_fresh = $con->query($sql_fresh);
$row_fresh = $result_fresh->fetch_assoc();
$fresh = intval($row_fresh['mfresh']);


$result_public = $con->query($sql_public);
$row_public = $result_public->fetch_assoc();
$public = intval($row_public['public']);

$result_private = $con->query($sql_private);
$row_private = $result_private->fetch_assoc();
$private = intval($row_private['private']);


$result_no_cache = $con->query($sql_no_cache);
$row_no_cache = $result_no_cache->fetch_assoc();
$no_cache = intval($row_no_cache['no_cache']);

$result_no_store = $con->query($sql_no_store);
$row_no_store = $result_no_store->fetch_assoc();
$no_store = intval($row_no_store['no_store']);


$result_total = $con->query($sql_total);
$row_total = $result_total->fetch_assoc();
$total = intval($row_total['total']);

echo "<table>";

echo "<tr>";

echo "<td>";

echo "<table border='1'>";

echo "<tr>";

echo "<th>";
 
echo "Max-Stale";
 
echo "</th>";

echo "</tr>";

echo "<tr>";

echo "<td>";

echo $stale/$total;
echo "</td>";


echo "</tr>";

echo "</table>";

echo "</td>";

echo "<td>";

echo "<table border='1'>";

echo "<tr>";

echo "<th>";
 
echo "Min-Fresh";
 
echo "</th>";

echo "</tr>";

echo "<tr>";

echo "<td>";

echo $fresh/$total;
echo "</td>";


echo "</tr>";

echo "</table>";

echo "</td>";

echo "<td>";
echo "<table border='1'>";

echo "<tr>";

echo "<th>";
 
echo "Public";
 
echo "</th>";

echo "</tr>";

echo "<tr>";

echo "<td>";

echo $public/$total;
echo "</td>";


echo "</tr>";

echo "</table>";

echo "</td>";

echo "</tr>";

echo "<tr>";

echo "<td>";

echo "<table border='1'>";

echo "<tr>";

echo "<th>";
 
echo "Private";
 
echo "</th>";

echo "</tr>";

echo "<tr>";

echo "<td>";

echo $private/$total;
echo "</td>";


echo "</tr>";

echo "</table>";

echo "</td>";

echo "<td>";

echo "<table border='1'>";

echo "<tr>";

echo "<th>";
 
echo "No-Cache";
 
echo "</th>";

echo "</tr>";

echo "<tr>";

echo "<td>";

echo $no_cache/$total;
echo "</td>";


echo "</tr>";

echo "</table>";
echo "</td>";

echo "<td>";
echo "<table border='1'>";

echo "<tr>";

echo "<th>";
 
echo "No-Store";
 
echo "</th>";

echo "</tr>";

echo "<tr>";

echo "<td>";

echo $no_store/$total;
echo "</td>";


echo "</tr>";

echo "</table>";

echo "</td>";

echo "</tr>";

echo "</table>";
?>