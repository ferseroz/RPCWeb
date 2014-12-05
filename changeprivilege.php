<?php
include('config.php');

$userid = $_GET['userid'];
$query = "SELECT * FROM USER WHERE userid='$userid'";

$result = mysql_query($query);
$row = mysql_fetch_array($result);
$class = ($row['class'] == 0 ? 1 : 0);

$query = "UPDATE user SET class=$class WHERE userid='$userid'";

if(mysql_query($query)) {
	header("Location: configuration.php");
} else {
	echo "Unsuccessful";
}

?>