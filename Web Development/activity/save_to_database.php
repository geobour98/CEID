<?php

error_reporting(E_ERROR | E_PARSE);

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




$mydata = $_POST["dedomena"];

$ip = $_POST["ip"];

$ipinfoAPI = "http://ipinfo.io/{$ip}/json";

$load = file_get_contents($ipinfoAPI);

$return = json_decode($load);

$lat_lng = $return->loc;


$paroxos = $return->org;


$mydata = json_decode($mydata,true);

$user_id = $_SESSION["user_id"];


$sql_max_id = "SELECT MAX(kodikos) as megisto from entries";

$result_max_id = $con->query($sql_max_id);

$row_max_id = $result_max_id->fetch_assoc();

$megisto = $row_max_id['megisto'];



$mydata = $mydata['entries'];

for($i=0;$i<count($mydata);$i++)
	
	{
		
		$st_dt= $mydata[$i]['startedDateTime'];
		
		
	    $srv_ip_addr= $mydata[$i]['serverIPAddress'];
		
		
		$ipinfoAPI_server = "http://ipinfo.io/{$srv_ip_addr}/json";
		$load_server = file_get_contents($ipinfoAPI_server);
		$return_server = json_decode($load_server);
		$lat_lng_server = $return_server->loc;


		$wait= $mydata[$i]['timings']['wait'];
		

		$method= $mydata[$i]['request']['method'];
		

		$url = $mydata[$i]['request']['url'];
		

		$status=$mydata[$i]['response']['status'];
		

        $status_text = $mydata[$i]['response']['statusText'];
		
		$e_id = $megisto + $i+1;
		
		$dt =substr($st_dt, 0, 10);
	
		
		$day = date('l', strtotime($dt));
		
		
		$sql = "INSERT INTO entries (kodikos, st_date_time, srv_ip_address, wait,user_id,lat_lng, paroxos, lat_lng_server,day_request) VALUES ('$e_id','$st_dt', '$srv_ip_addr', '$wait','$user_id','$lat_lng','$paroxos','$lat_lng_server','$day')";

	if ($con->query($sql) === TRUE) 
	{
	} 
	else {
		echo "Error: " . $sql . "<br>" . $con->error;
		}
		
    $sql2 = "INSERT INTO request (kodikos, kodikos_entry, method, url) VALUES ('$e_id','$e_id', '$method', '$url')";

	if ($con->query($sql2) === TRUE) 
	{
	} 
	else {
		echo "Error: " . $sql2 . "<br>" . $con->error;
		}
    $sql3 = "INSERT INTO response (kodikos, kodikos_entry, status, st_text) VALUES ('$e_id','$e_id', '$status', '$status_text')";

	if ($con->query($sql3) === TRUE) 
	{
	} 
	else {
		echo "Error: " . $sql3 . "<br>" . $con->error;
		}

   $headers_request = $mydata[$i]['request']['headers'];
   
   
   $con_type_req="";
   $cache_ctrl_req="";
   $pragma_req="";
   $expires_req="";
   $age_req="";
   $last_mod_req="";
   $host_req="";
   
   $headers_response = $mydata[$i]['response']['headers'];
   

   
   $con_type_res="";
   $cache_ctrl_res="";
   $pragma_res="";
   $expires_res="";
   $age_res="";
   $last_mod_res="";
   $host_res="";
   
   for($j=0;$j<count($headers_request);$j++)
	   
	   {
           if($headers_request[$j]['name'] =="content-type")
			   
			   {
				   $con_type_req = $headers_request[$j]['value'];
			   }
			   
			   
			


            if($headers_request[$j]['name'] =="cache-control")
			   
			   {
				   $cache_ctrl_req = $headers_request[$j]['value'];
			   }
			   
			   
			  			   

            if($headers_request[$j]['name'] =="pragma")
			   
			   {
				   $pragma_req= $headers_request[$j]['value'];
			   }
			   
			   
			
			   
			   
			   
			if($headers_request[$j]['name'] =="expires")
			   
			   {
				   $expires_req = $headers_request[$j]['value'];
			   }
			   
			   
			
            
			
			if($headers_request[$j]['name'] =="age")
			   
			   {
				   $age_req = $headers_request[$j]['value'];
			   }
			   
			   
			

			if($headers_request[$j]['name'] =="last-modified")
			   
			   {
				   $last_mod_req = $headers_request[$j]['value'];
			   }
			   
			   
			
			
			if($headers_request[$j]['name'] =="host")
			   
			   {
				   $host_req = $headers_request[$j]['value'];
			   }
			   
			   
			

	   }
	   
	   
	   
	   
	   
	    for($j=0;$j<count($headers_response);$j++)
	   
	   {
           
			   
			   
			if($headers_response[$j]['name'] =="content-type")
			   
			   {
				   $con_type_res = $headers_response[$j]['value'];
			   }


           
			   
			   
			if($headers_response[$j]['name'] =="cache-control")
			   
			   {
				   $cache_ctrl_res = $headers_response[$j]['value'];
			   }   			   

            
			   
			   
			if($headers_response[$j]['name'] =="pragma")
			   
			   {
				   $pragma_res = $headers_response[$j]['value'];
			   }
			   
			   
			   
			
			   
			   
			if($headers_response[$j]['name'] =="expires")
			   
			   {
				   $expires_res = $headers_response[$j]['value'];
			   }
            
			
			
			   
			   
			if($headers_response[$j]['name'] =="age")
			   
			   {
				   $age_res = $headers_response[$j]['value'];
			   }

			
			   
			   
			if($headers_response[$j]['name'] =="last-modified")
			   
			   {
				   $last_mod_res = $headers_response[$j]['value'];
			   }

			
			   
			   
			if($headers_response[$j]['name'] =="host")
			   
			   {
				   $host_res = $headers_response[$j]['value'];
			   }

			

	   }
	   
	   
	   
	   $sql4 = "INSERT INTO header (id, r_id, type, con_type, cache_ctrl,pragma,expires, age, last_mod, host) VALUES ('$e_id','$e_id', 'request', '$con_type_req','$cache_ctrl_req','$pragma_req','$expires_req', '$age_req', '$last_mod_req','$host_req')";

	if ($con->query($sql4) === TRUE) 
	{
	} 
	else {
		echo "Error: " . $sql4 . "<br>" . $con->error;
		}
	

	 
	$sql5 = "INSERT INTO header (id, r_id, type, con_type, cache_ctrl,pragma,expires, age, last_mod, host) VALUES ('$e_id','$e_id', 'response', '$con_type_res','$cache_ctrl_res','$pragma_res','$expires_res', '$age_res', '$last_mod_res','$host_res')";

	if ($con->query($sql5) === TRUE) 
	{
	} 
	else {
		echo "Error: " . $sql5 . "<br>" . $con->error;
		} 
	 
	 
	
		
  }
  
  $last_upload = date("D M d, Y G:i", time());
  
  $sql_last = "UPDATE user SET last_dt_upload='$last_upload' WHERE id = '$user_id'";
  
  if ($con->query($sql_last) === TRUE) {
 
} else {
  echo "Error updating record: " . $conn->error;
}

  echo "Upload to Database Done";

?>