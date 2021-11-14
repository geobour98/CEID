<html>


<head>

<link rel="stylesheet" href="mystyle.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">

$(document).ready(function(){
    $("#but_submit").click(function(){
        var username = $("#txt_uname").val().trim();
        var password = $("#txt_pwd").val().trim();

        if( username != "" && password != "" ){
            $.ajax({
                url:'check_user.php',
                type:'post',
                data:{username:username,password:password},
                success:function(response){
                    var msg = "";
                    if(response == 1){
                        window.location = "index_user.php";
                    }else{
                        msg = "Invalid username and password!";
						
						window.location = "login_user.php"
						
                    }
                    $("#message").html(msg);
                }
            });
        }
    });
});
</script>


</head>




<body>

<?php


session_start();

?>




Welcome. Please login
<br>
<br>




    <div id="div_login">
        <div id="message"></div>
        <div>
            <input type="text"  id="txt_uname" name="txt_uname" placeholder="Username" />
			<br>
        </div>
        <div>
            <input type="password" id="txt_pwd" name="txt_pwd" placeholder="Password"/>
			<br>
        </div>
        <div>
            <input type="button" value="Submit" name="but_submit" id="but_submit" />
			<br>
        </div>
    </div>



<br>


<br>

<a href ="register.php">Sign UP </a>





</body>

</html>