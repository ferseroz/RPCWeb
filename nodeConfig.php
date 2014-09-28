<?php
	$query = "SELECT * FROM node";
	$result = mysql_query($query) or die(mysql_error());
	while($row = mysql_fetch_array($result)) {
		$host = $row['nodename'];
		$output = array();
		$ping = null;
		exec("ping -c 1 -s 8 -W 50 " . $host, $output, $ping);

		echo "";
		}
	}
?>