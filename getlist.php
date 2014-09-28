<?php
include('config.php');

$query = "SELECT ip FROM node";
$result = mysql_query($query) or die(mysql_error());
$node = array();

while($row = mysql_fetch_array($result)) {
	array_push($node, $row['ip']);
}
?>