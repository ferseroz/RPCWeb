<?php
$ip = $_GET['ip'];
$output = array();
$ping = null;

exec("ping -n 4 -w 1000 " . $ip, $output, $result);
if($result == 0) {
	echo "<a href='http://'" . $ip . ":4200' id='ssh'>Available</a>";
}
?>