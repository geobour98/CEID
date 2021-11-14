<html>

<head>

<link rel = "stylesheet" href = "http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css"/>
<script src = "http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.js"></script>
<script src="https://cdn.jsdelivr.net/npm/heatmapjs@2.0.2/heatmap.js"> </script>
<script src="leaflet-heatmap.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script type="text/javascript">


$(document).ready(function(){
	
	        var map_properties = {
            center: [38.212534, 21.852972],
            zoom: 7
         }
		 
		 let heatmap_properties = {"radius": 40,
			"maxOpacity": 2,
			"scaleRadius": false,
			"useLocalExtrema": false,
			latField: 'lat',
			lngField: 'lng',
			valueField: 'count'};	
	     
		 let heatmapLayer = new HeatmapOverlay(heatmap_properties);

         var map = new L.map('map', map_properties);
         var layer = new L.TileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png');
         map.addLayer(layer);
         map.addLayer(heatmapLayer);
	
	
$( document ).ready(function() {
    
	  $.ajax({
                url:'user_server_ips.php',
			
               type:'post',

                
                success:function(response){
					
					 var myresult = JSON.parse(response);
					 
					 var finals = myresult.map(function(x) { 
                        return {							
						lat:x[0], 
						lng: x[1],
						count: x[2]
                       }; 
                       });

               
				let new_data = {
				max: 10, data: finals};
        heatmapLayer.setData(new_data);

                }
            });
	
	
	
	
});	



	

});







</script>



</head>


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


 <div id = "map" style = "width: 100%; height: 100%"></div>



</html>