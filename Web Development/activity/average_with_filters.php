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



if(isset($_POST['day']))
{  

$condition_day = " and entries.day_request in(";


$flag_cond=0;


foreach ($_POST['day'] as $myday)

{

	if($flag_cond==0)
	{
	
	$condition_day = $condition_day . "'". $myday. "'";
	$flag_cond=1;
	}
	 
	else
		
	{
		$condition_day = $condition_day . ",'". $myday. "'";
	}
	
}

$condition_day = $condition_day . ")";

}

if(isset($_POST['contype_selected']))
{
	
$condition_content = " and header.con_type in(";
$flag_content=0;

foreach ($_POST['contype_selected'] as $mycontent)

{
	
	if($flag_content==0)
	{
	
	$condition_content = $condition_content . "'". $mycontent. "'";
	$flag_content=1;
	}
	
	else
		
	{
		$condition_content = $condition_content . ",'". $mycontent. "'";
	}
	
}

$condition_content = $condition_content . ")";

}


if(isset($_POST['method_selected']))
{

$condition_method = " and request.method in(";
$flag_method=0;

foreach ($_POST['method_selected'] as $mymethod)

{
	
	if($flag_method==0)
	{
	
	$condition_method = $condition_method . "'". $mymethod. "'";
	$flag_method=1;
	}
	
	else
		
	{
		$condition_method = $condition_method . ",'". $mymethod. "'";
	}
	
}

$condition_method = $condition_method . ")";
}

if(isset($_POST['isp_selected']))
{

$condition_isp= " and entries.paroxos in(";
$flag_isp=0;

foreach ($_POST['isp_selected'] as $myisp)

{
	
	if($flag_isp==0)
	{
		
	$condition_isp = $condition_isp . "'". $myisp. "'";
	$flag_isp=1;
	}
	
	else
		
	{
		$condition_isp = $condition_isp . ",'". $myisp. "'";
	}
	
}

$condition_isp = $condition_isp . ")";
}

$condition="";


if(isset($_POST["day"]) && !isset($_POST["contype_selected"])&& !isset($_POST["method_selected"])&& !isset($_POST["isp_selected"]))
	
	{
		$condition = $condition. $condition_day;
	}
	
else if(!isset($_POST["day"]) && isset($_POST["contype_selected"])&& !isset($_POST["method_selected"])&& !isset($_POST["isp_selected"]))
	
	{
		$condition = $condition. $condition_content;
	
	}
	
else if(!isset($_POST["day"]) && !isset($_POST["contype_selected"])&& isset($_POST["method_selected"])&& !isset($_POST["isp_selected"]))
	
	{
	   $condition = $condition. $condition_method;
	}


else if(!isset($_POST["day"]) && !isset($_POST["contype_selected"])&& !isset($_POST["method_selected"])&& isset($_POST["isp_selected"]))
	
	{
		$condition = $condition. $condition_isp;
		
	}
	
else if(isset($_POST["day"]) && isset($_POST["contype_selected"])&& !isset($_POST["method_selected"])&& !isset($_POST["isp_selected"]))
	
	{
	$condition = $condition. $condition_day. $condition_content;
	}	

else if(isset($_POST["day"]) && !isset($_POST["contype_selected"])&& isset($_POST["method_selected"])&& !isset($_POST["isp_selected"]))
	
	{
	$condition = $condition. $condition_day. $condition_method;

	}
	
else if(isset($_POST["day"]) && !isset($_POST["contype_selected"])&& !isset($_POST["method_selected"])&& isset($_POST["isp_selected"]))
	
	{
	
	 $condition = $condition. $condition_day. $condition_isp;

	}	
	
	
else if(!isset($_POST["day"]) && isset($_POST["contype_selected"])&& isset($_POST["method_selected"])&& !isset($_POST["isp_selected"]))
	
	{
	 $condition = $condition. $condition_content. $condition_method;

	}	

else if(!isset($_POST["day"]) && isset($_POST["contype_selected"])&& !isset($_POST["method_selected"])&& isset($_POST["isp_selected"]))
	
	{
	   $condition = $condition. $condition_conent. $condition_isp;
	
	}
	
else if(!isset($_POST["day"]) && !isset($_POST["contype_selected"])&& isset($_POST["method_selected"])&& isset($_POST["isp_selected"]))
	
	{
	 
	 $condition = $condition. $condition_method. $condition_isp;

	}

else if(isset($_POST["day"]) && isset($_POST["contype_selected"])&& isset($_POST["method_selected"])&& !isset($_POST["isp_selected"]))
	
	{
	 $condition = $condition. $condition_day. $condition_content. $condition_method;

	}
	
else if(isset($_POST["day"]) && !isset($_POST["contype_selected"])&& isset($_POST["method_selected"])&& isset($_POST["isp_selected"]))
	
	{
	
	$condition = $condition. $condition_day. $condition_method. $condition_isp;

	}

else if(!isset($_POST["day"]) && isset($_POST["contype_selected"])&& isset($_POST["method_selected"])&& isset($_POST["isp_selected"]))
	
	{
	 
	 $condition = $condition. $condition_content. $condition_method. $condition_isp;

	}


else if(isset($_POST["day"]) && isset($_POST["contype_selected"])&& isset($_POST["method_selected"])&& isset($_POST["isp_selected"]))
	
	{
		
	
	$condition = $condition.$condition_day. $condition_content. $condition_method. $condition_isp;

		
	}

else

{
  $condition = "";

}
 
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
  
  if($condition=="")
	  
	  {
  
 $sql = "SELECT AVG(wait) as mesos FROM entries  WHERE entries.st_date_time LIKE '$mytime'  HAVING AVG(wait)>0";
 
	  }
	  
else


{
  $sql = "SELECT AVG(entries.wait) as mesos FROM entries INNER JOIN request on request.kodikos_entry = entries.kodikos INNER JOIN header ON header.r_id = request.kodikos  WHERE entries.st_date_time LIKE '$mytime' $condition  HAVING AVG(wait)>0";

}

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