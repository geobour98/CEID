<html>

<?php


$myusername = $_POST["username"];

$mypassword = $_POST["password"];

$mypassword2 = $_POST["password2"];

$myemail = $_POST["email"];


if ($mypassword != $mypassword2)
	

	{
		
		echo "Passwords do not match";
		
		
		
	}


else
	

	{
		
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "activity";
		
	$conn = new mysqli($servername, $username, $password, $dbname);
	
	if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
	}

    $sql = "INSERT INTO user (username, password, email) VALUES ('$myusername', '$mypassword', '$myemail')";

if ($conn->query($sql) === TRUE) {
  echo "You registered successfully";
} 

else {
  echo "Error: " . $sql . "<br>" . $conn->error;
    }


$conn->close();
  	
		
		
		
		
	}



?>

</html>