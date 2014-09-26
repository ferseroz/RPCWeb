<?php
	$host = "192.168.1.8";
	$output = array();
	$result = null;
	
	exec("ping -c 4 " . $host, $output, $result);

	if($result == 0) {
		echo "Host is available";
	} else {
		echo "Unavailable";
	}
?>
