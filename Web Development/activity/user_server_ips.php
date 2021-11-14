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


$sql = "SELECT COUNT(*) as plithos, lat_lng_server as sintetagmenes FROM entries  WHERE user_id = '$user_id' and lat_lng_server <>'' GROUP BY lat_lng_server";  


$result = $con->query($sql);

$heatmap_array = array();

while($row = $result->fetch_assoc()) {
	
$record = array();	

$pinakas = explode(",", $row['sintetagmenes']);

$lat = floatval($pinakas[0]);


$lng = floatval($pinakas[1]);

$plithos =intval($row['plithos']);

array_push($record,$lat);
array_push($record,$lng);
array_push($record,$plithos);


array_push($heatmap_array, $record);

}

echo json_encode($heatmap_array);


?>