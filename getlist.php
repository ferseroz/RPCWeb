<?php
include('config.php');

$query = "SELECT * FROM node";
$result = mysql_query($query) or die(mysql_error());
$nodeip = array();
$nodename = array();

while($row = mysql_fetch_array($result)) {
	array_push($nodename, $row['nodename']);
	array_push($nodeip, $row['ip']);
}
?>