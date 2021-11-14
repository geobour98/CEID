<html>


<head>

<title>

Registration of User

</title>



</head>


<body>

<form action ="insert_user.php" method  = "post">

Username:

<br>

<input type = "text" name = "username">

<br>

Password:
<br>

<input type ="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" name = "password">

<br>

Repeat Password:
<br>
<input type ="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" name = "password2">

<br>

Email:

<br>

<input type ="email" name = "email">

<br>

<input type ="submit" value ="Register">



</form>


</body>




</html>