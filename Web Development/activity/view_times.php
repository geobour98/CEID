<html>

<?php

session_start();


?>

<head>

<link rel="stylesheet" href="mystyle.css">



<title>

Homepage of Admin

</title>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js'></script>


<script>

$( document ).ready(function() {
	
	
		avg_wait= new Array();
		
		f_wait = new Array();
		
		
		$.ajax({
                url:'get_average_wait.php',

                type:'post',
                
                success:function(response){
                   

				
					avg_wait = JSON.parse(response);
					
			
					
					const ctx = document.getElementById('histogram').getContext('2d');


const chart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: [0,1, 2, 3, 4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23],
    datasets: [{
      label: 'AVG Response Time',
      data: avg_wait,
      backgroundColor: 'green',
    }]
  },
  options: {
    scales: {
      xAxes: [{
        display: false,
        barPercentage: 1,
        ticks: {
          max: 24,
        }
      }, {
        display: true,
        ticks: {
          autoSkip: false,
          max: 24,
        }
      }],
      yAxes: [{
        ticks: {
          beginAtZero: true
        }
      }]
    }
  }
});
					
					
					
					
					

                }
            });	
		

    
	$.ajax({
                url:'get_web_objects.php',

                type:'post',
                
                success:function(response){
                   

                    $("#contype").html(response);
				   

                }
            });
	
	
	$.ajax({
                url:'get_http_methods.php',

                type:'post',
                
                success:function(response){
                   

                    $("#methodtype").html(response);
				   

                }
            });
	
	
	$.ajax({
                url:'get_isps.php',

                type:'post',
                
                success:function(response){
                   

                    $("#isp").html(response);
				   

                }
            });
	


$("#filter_data").click(function(){
        

            $.ajax({
                url:'average_with_filters.php',
                type:'post',
                data:{day: $( "#day").val(),contype:$( "#contype" ).val() , methodtype:$( "#methodtype" ).val() ,isp:$( "#isp" ).val() },
                success:function(response){
                   
                 document.getElementById("histogram").style.display="none";
					
					f_wait = JSON.parse(response);
					console.log(f_wait);
				
					
					const ctx = document.getElementById('histogram_f').getContext('2d');


const chart = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: [0,1, 2, 3, 4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23],
    datasets: [{
      label: 'AVG Response Time (with filters)',
      data: f_wait,
      backgroundColor: 'orange',
    }]
  },
  options: {
    scales: {
      xAxes: [{
        display: false,
        barPercentage: 1,
        ticks: {
          max: 24,
        }
      }, {
        display: true,
        ticks: {
          autoSkip: false,
          max: 24,
        }
      }],
      yAxes: [{
        ticks: {
          beginAtZero: true
        }
      }]
    }
  }
});
					
					
					
					
					

                }
            });
        
    });



			
	
});	






</script>


</head>


<?php



if($_SESSION["connected"] ==3)
	
	{
		
		echo "<table border='1'>
		
		<tr>      
		
		<td> <a href ='visualize_info.php'>View Important Info</a> </td>
		
		
		<td><a href ='view_times.php'>View Timings </a> </td>
		
		
		<td><a href ='view_headers.php'>View Headers</a> </td>
		
		
		<td><a href ='view_map.php'>View Map</a> </td>


   		<td><a href ='logout_admin.php'>Logout</a> </td>
	
		
		</tr>
		
		
		
		</table>";
		
		
		
	}




else
	

	{
		
		header("Location: admin_login.php");

		
		
	}


?>


<canvas id="histogram" width="50" height="20"></canvas>

<canvas id="histogram_f" width="50" height="20"></canvas>

<br>

<table>

<tr>

<td>
Select Day:
<br>
<select id="day" name="day[]" multiple>
  <option value="Monday">Monday</option>
  <option value="Tuesday">Tuesday</option>
  <option value="Wednesday">Wednesday</option>
  <option value="Thursday">Thursday</option>
  <option value="Friday">Friday</option>
  <option value="Saturday">Saturday</option>
  <option value="Sunday">Sunday</option>

</select>

<br>
</td>

<td>

Select Content Type:
<br>
<div id ="contype" name = "contype"> </div>
<br>

</td>

<td>
Select Method Type:
<br>
<div id ="methodtype" name ="methodtype"> </div>
<br>
</td>

<td>
Select Isp:
<div id ="isp" name = "isp"> </div>
<br>
</td>

</tr>
</table>
<input id = "filter_data" type = "submit" value = "Filter Data">





</html>