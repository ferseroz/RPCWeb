<?php
include('config.php');
$username = $_POST['username'];
$password = $_POST['password'];

$query = "INSERT INTO user(username, password) VALUES('$username', '$password')";

if(mysql_query($query)){
	echo "Successful";
} else {
	echo mysql_error();
}
?>