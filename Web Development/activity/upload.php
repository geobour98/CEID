<html>

<?php

session_start();

if($_SESSION["connected"] ==1)

 {

    echo "<table border = '3'>                    
	
	<tr>
	
	<td> <a href ='upload.php'>Upload Data </a></td>
	<td><a href = 'visualize.php'>Visualize Data </a></td>
	<td> <a href = 'edit_profile.php'>Edit Profile </a>  </td>
	<td><a href ='logout_user.php'>Logout </a></td>
	</tr>
	</table>";


 }
 
 
 else
	 
 
 {
	 
	 header("Location: login_user.php");

	 
	 
 }







?>
<br>
<br>
<input type="file" id="selectFiles" value="Import" /><br />
<br>
<br>
<button id="import">Filter Data</button>

<br>


<div id = "message">   </div>

<br>




<form  id ="database" method="post" action="save_to_database.php">


<input type ="text" name = "dedomena" id ="dedomena" hidden>

<input type ="text" name = "ip"  id = "ip" hidden>

<input type ="submit" value ="Upload to Database">





</form>






<form id ="save_file"  action ="create_file.php" method ="post" >

<input type ="text" name = "dedomena" id ="dedomena" hidden>


<input type ="submit" value ="Save Data to File">


</form>

<script src= 
"https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"> 
    </script>

<script>

$.getJSON("https://api.ipify.org?format=json", 
        function(data) { 
        
		document.getElementById("database").elements["ip"].value = data.ip;

           
        }) 

document.getElementById("database").style.display = "none";

document.getElementById("save_file").style.display = "none";

document.getElementById('import').onclick = function() {
    var files = document.getElementById('selectFiles').files;
  if (files.length <= 0) {
    return false;
  }

  var fr = new FileReader();

  fr.onload = function(e) { 
    var result = JSON.parse(e.target.result);
	
		
	var mydata = result['log']['entries'];
	
	var res = "{";
	
	res =res +  "\"entries\": [";
	
	for(var i=0;i<mydata.length;i++)
	{
		res = res + "{";
		
		res = res + "\"startedDateTime\":";
		
		res = res+ "\"";
		res = res + mydata[i]['startedDateTime'];
		res = res+ "\"";

		res = res + ",";
		
		res = res + "\"serverIPAddress\":";
		
	    res = res+ "\"";
	
		res = res + mydata[i]['serverIPAddress'];
		
		res = res+ "\"";

        res = res + ",";

        res = res + "\"timings\":{"	;
         
		 res = res + "\"wait\":";
		 res = res + mydata[i]['timings']['wait'];

        res  = res + "}";		
	   
	   res = res + ",";
	   
	   res = res + "\"request\":{";
	   
	   res = res + "\"method\":";
	   
	   res = res + "\"";
	   
	   res = res + mydata[i]['request']['method'];
	   
	   res = res + "\"";
	   
	   res = res + ",";
	   
	   res = res + "\"url\":";
	   
	   res = res + "\"";
	   
	   var urlParts = mydata[i]['request']['url'].replace('http://','').replace('https://','').split(/[/?#]/);
       
	   var domain = urlParts[0];
	   
	   res = res + domain;
	   
	   res = res + "\"";
	   
	   res = res + ",";
	   
	   
	  var headers_req = mydata[i]['request']['headers'];
	  
	  
	  res = res + "\"headers\":[";

	   
	   headers_counter = 0;
	   for (var j = 0; j<headers_req.length;j++)
	   
	   {
		   
	   
	    if(headers_req[j]['name'].toLowerCase()=="content-type")
		
		{
		   if(headers_counter>0)

           {
              res = res + ",";

           }

           headers_counter++;		   
		   res = res + "{";
            
		   res = res + "\"name\":";
		   
		   res  = res + "\"";
		   
		   res = res  + headers_req[j]['name'].toLowerCase();
		   
		    res  = res + "\"";

		   
		   res = res + ",";
		   
		   res = res + "\"value\":";
		   
		   res  = res + "\"";
		   
		   res = res  + headers_req[j]['value'];
		   
		   res  = res + "\"";

           res = res + "}";		   
		
		}
	   
	     
		if(headers_req[j]['name'].toLowerCase()=="cache-control")
		
		{
		
if(headers_counter>0)

           {
              res = res + ",";

           }

           headers_counter++;		   
		   res = res + "{";
            
		   res = res + "\"name\":";
		   
		   res  = res + "\"";
		   
		   res = res  + headers_req[j]['name'].toLowerCase();
		   
		    res  = res + "\"";

		   
		   res = res + ",";
		   
		   res = res + "\"value\":";
		   
		   res  = res + "\"";
		   
		   res = res  + headers_req[j]['value'];
		   
		   res  = res + "\"";

           res = res + "}";			}
	   
	   
	    if(headers_req[j]['name'].toLowerCase()=="pragma")
		
		{
			
			if(headers_counter>0)

           {
              res = res + ",";

           }

           headers_counter++;		   
		   res = res + "{";
            
		   res = res + "\"name\":";
		   
		   res  = res + "\"";
		   
		   res = res  + headers_req[j]['name'].toLowerCase();
		   
		    res  = res + "\"";

		   
		   res = res + ",";
		   
		   res = res + "\"value\":";
		   
		   res  = res + "\"";
		   
		   res = res  + headers_req[j]['value'];
		   
		   res  = res + "\"";

           res = res + "}";	
		
		}
		
		if(headers_req[j]['name'].toLowerCase()=="expires")
		
		{
		   
		   if(headers_counter>0)

           {
              res = res + ",";

           }

           headers_counter++;		   
		   res = res + "{";
            
		   res = res + "\"name\":";
		   
		   res  = res + "\"";
		   
		   res = res  + headers_req[j]['name'].toLowerCase();
		   
		    res  = res + "\"";

		   
		   res = res + ",";
		   
		   res = res + "\"value\":";
		   
		   res  = res + "\"";
		   
		   res = res  + headers_req[j]['value'];
		   
		   res  = res + "\"";

           res = res + "}";	
		
		}
		
		if(headers_req[j]['name'].toLowerCase()=="age")
		
		{
		if(headers_counter>0)

           {
              res = res + ",";

           }

           headers_counter++;		   
		   res = res + "{";
            
		   res = res + "\"name\":";
		   
		   res  = res + "\"";
		   
		   res = res  + headers_req[j]['name'].toLowerCase();
		   
		    res  = res + "\"";

		   
		   res = res + ",";
		   
		   res = res + "\"value\":";
		   
		   res  = res + "\"";
		   
		   res = res  + headers_req[j]['value'];
		   
		   res  = res + "\"";

           res = res + "}";	
		
		}
		
		if(headers_req[j]['name'].toLowerCase()=="last-modified")
		
		{
		
if(headers_counter>0)

           {
              res = res + ",";

           }

           headers_counter++;		   
		   res = res + "{";
            
		   res = res + "\"name\":";
		   
		   res  = res + "\"";
		   
		   res = res  + headers_req[j]['name'].toLowerCase();
		   
		    res  = res + "\"";

		   
		   res = res + ",";
		   
		   res = res + "\"value\":";
		   
		   res  = res + "\"";
		   
		   res = res  + headers_req[j]['value'];
		   
		   res  = res + "\"";

           res = res + "}";			}
		
		if(headers_req[j]['name'].toLowerCase()=="host")
		
		{
		
if(headers_counter>0)

           {
              res = res + ",";

           }

           headers_counter++;		   
		   res = res + "{";
            
		   res = res + "\"name\":";
		   
		   res  = res + "\"";
		   
		   res = res  + headers_req[j]['name'].toLowerCase();
		   
		    res  = res + "\"";

		   
		   res = res + ",";
		   
		   res = res + "\"value\":";
		   
		   res  = res + "\"";
		   
		   res = res  + headers_req[j]['value'];
		   
		   res  = res + "\"";

           res = res + "}";			}
	   
	   }
	   
	  res = res + "]";

	   res = res + "},";

	   
	   
	   res = res + "\"response\":{";
	   
	   res = res + "\"status\":";
	   
	   res = res + "\"";
	   
	   res = res + mydata[i]['response']['status'];
	   
	   res = res + "\"";
	   
	   res = res + ",";
	   
	   res = res + "\"statusText\":";
	   
	   res = res + "\"";
	   
	   res = res + mydata[i]['response']['statusText'];
	   
	   res = res + "\"";
	   
	   res = res + ",";
	   
	   
	   res = res + "\"headers\":[";

	      
	var headers_res = mydata[i]['response']['headers'];

     headers_counter_res = 0;
	 
	   for (var m = 0; m<headers_res.length;m++)
	   
	   {
		   
	   
	    if(headers_res[m]['name'].toLowerCase()=="content-type")
		
		{
		   if(headers_counter_res>0)

           {
              res = res + ",";

           }

           headers_counter_res++;		   
		   res = res + "{";
            
		   res = res + "\"name\":";
		   
		   res  = res + "\"";
		   
		   res = res  + headers_res[m]['name'].toLowerCase();
		   
		    res  = res + "\"";

		   
		   res = res + ",";
		   
		   res = res + "\"value\":";
		   
		   res  = res + "\"";
		   
		   res = res  + headers_res[m]['value'];
		   
		   res  = res + "\"";

           res = res + "}";		   
		
		}
	   
	     
		if(headers_res[m]['name'].toLowerCase()=="cache-control")
		
		{
		
if(headers_counter_res>0)

           {
              res = res + ",";

           }

           headers_counter_res++;		   
		   res = res + "{";
            
		   res = res + "\"name\":";
		   
		   res  = res + "\"";
		   
		   res = res  + headers_res[m]['name'].toLowerCase();
		   
		    res  = res + "\"";

		   
		   res = res + ",";
		   
		   res = res + "\"value\":";
		   
		   res  = res + "\"";
		   
		   res = res  + headers_res[m]['value'];
		   
		   res  = res + "\"";

           res = res + "}";			}
	   
	   
	    if(headers_res[m]['name'].toLowerCase()=="pragma")
		
		{
			
			if(headers_counter_res>0)

           {
              res = res + ",";

           }

           headers_counter_res++;		   
		   res = res + "{";
            
		   res = res + "\"name\":";
		   
		   res  = res + "\"";
		   
		   res = res  + headers_res[m]['name'].toLowerCase();
		   
		    res  = res + "\"";

		   
		   res = res + ",";
		   
		   res = res + "\"value\":";
		   
		   res  = res + "\"";
		   
		   res = res  + headers_res[m]['value'];
		   
		   res  = res + "\"";

           res = res + "}";	
		
		}
		
		if(headers_res[m]['name'].toLowerCase()=="expires")
		
		{
		   
		   if(headers_counter_res>0)

           {
              res = res + ",";

           }

           headers_counter_res++;		   
		   res = res + "{";
            
		   res = res + "\"name\":";
		   
		   res  = res + "\"";
		   
		   res = res  + headers_res[m]['name'].toLowerCase();
		   
		    res  = res + "\"";

		   
		   res = res + ",";
		   
		   res = res + "\"value\":";
		   
		   res  = res + "\"";
		   
		   res = res  + headers_res[m]['value'];
		   
		   res  = res + "\"";

           res = res + "}";	
		
		}
		
		if(headers_res[m]['name'].toLowerCase()=="age")
		
		{
		if(headers_counter_res>0)

           {
              res = res + ",";

           }

           headers_counter_res++;		   
		   res = res + "{";
            
		   res = res + "\"name\":";
		   
		   res  = res + "\"";
		   
		   res = res  + headers_res[m]['name'].toLowerCase();
		   
		    res  = res + "\"";

		   
		   res = res + ",";
		   
		   res = res + "\"value\":";
		   
		   res  = res + "\"";
		   
		   res = res  + headers_res[m]['value'];
		   
		   res  = res + "\"";

           res = res + "}";	
		
		}
		
		if(headers_res[m]['name'].toLowerCase()=="last-modified")
		
		{
		
if(headers_counter_res>0)

           {
              res = res + ",";

           }

           headers_counter_res++;		   
		   res = res + "{";
            
		   res = res + "\"name\":";
		   
		   res  = res + "\"";
		   
		   res = res  + headers_res[m]['name'].toLowerCase();
		   
		    res  = res + "\"";

		   
		   res = res + ",";
		   
		   res = res + "\"value\":";
		   
		   res  = res + "\"";
		   
		   res = res  + headers_res[m]['value'];
		   
		   res  = res + "\"";

           res = res + "}";			}
		
		if(headers_res[m]['name'].toLowerCase()=="host")
		
		{
		
if(headers_counter_res>0)

           {
              res = res + ",";

           }

           headers_counter_res++;		   
		   res = res + "{";
            
		   res = res + "\"name\":";
		   
		   res  = res + "\"";
		   
		   res = res  + headers_res[m]['name'].toLowerCase();
		   
		    res  = res + "\"";

		   
		   res = res + ",";
		   
		   res = res + "\"value\":";
		   
		   res  = res + "\"";
		   
		   res = res  + headers_res[m]['value'];
		   
		   res  = res + "\"";

           res = res + "}";			}
	   
	   }
	   
	   res = res + "]";
	   
	   res = res + "}";
	   
		res = res + "}";
		
		
	   if(i!= mydata.length-1)
	   {
		   res = res + ",";
	   }
	   
	   
	}
	
    res = res + "]";

	
	res = res + "}";
	
	console.log(res);
    
   document.getElementById("message").innerHTML = "Data Filtered!";
   
   document.getElementById("database").elements["dedomena"].value = res;
   
  document.getElementById("save_file").elements["dedomena"].value = res;

   
 document.getElementById("database").style.display = "block";

document.getElementById("save_file").style.display = "block";
  }

  fr.readAsText(files.item(0));
};


</script>





</html>