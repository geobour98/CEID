<html>

<head>

<link rel="stylesheet" href="mystyle.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">

$(document).ready(function(){
	
	$.ajax({
                url:'get_user_info.php',

                type:'post',
                
                success:function(response){
                   

                    $("#user_info").html(response);
				   

                }
            });
	
	
    $("#edit").click(function(){
        var username = $("#new_username").val().trim();
        var password = $("#new_password").val().trim();

        if( username != "" && password != "" ){
            $.ajax({
                url:'check_update.php',
                type:'post',
                data:{username:username,password:password},
                success:function(response){
                    var msg = "";
                    if(response == 1){
                        
						msg = "Epityxia";
						
						
                    }else{	

					  msg = "Apotyxia";
						
                    }
                    $("#message").html(msg);
                }
            });
        }
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


<div id = "user_info"> </div>

<div id="form_edit">
        <div id="message"></div>
        <div>
		    Username:
            <input type="text"  id="new_username" name="new_username"/>
			<br>
        </div>
		
        <div>
		  Password:
            <input type="password" id="new_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" name="new_password"/>
			<br>
        </div>
        <div>
            <input type="button" value="Edit Profile" name="edit" id="edit" />
			<br>
        </div>
    </div>




</html>