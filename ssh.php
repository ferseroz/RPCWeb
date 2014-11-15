<?php
$ip = $_GET['ip'];
$output = array();
$ping = null;

//For Window
//exec("ping -n 4 -w 1000 " . $ip, $output, $result);

//For Mac
exec("ping -c 1 -s 4 -W 500 " . $ip, $output, $result);
if($result == 0) {
	echo "<a href='http://" . $ip . ":4200' id='ssh' target='blank' class='ssh'>Available</a>";
}
?>