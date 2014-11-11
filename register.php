<?php
include('config.php');
$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM user WHERE username='$username'";
$result = mysql_query($query);
if(mysql_num_rows($result)>0){  
	echo "<script type='text/javascript'>";
	echo "alert('Username is already exist!');";
	echo "window.location = 'requestAccount.php'";
	echo "</script>";
} else {
	$query = "INSERT INTO user(username, password) VALUES('$username', '$password')";

	if(mysql_query($query)){
		echo "Successful";
	} else {
		echo mysql_error();
	}
}
?>