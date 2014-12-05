<?php
include('config.php');

$userid = $_GET['userid'];

$query = "DELETE FROM user WHERE userid='$userid'";

if(mysql_query($query)) {
	header("Location: configuration.php");
} else {
	echo "Unsuccessful";
}
?>