<?php
include('config.php');

$userid = $_GET['userid'];

$query = "UPDATE user SET activation=1 WHERE userid='$userid'";

if(mysql_query($query)) {
	header("Location: configuration.php");
} else {
	echo "Unsuccessful";
}
?>