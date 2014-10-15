<?php
include('Net/SSH2.php');
include('config.php');

	$query = "SELECT * FROM node";
	$result = mysql_query($query) or die(mysql_error());

	while($row = mysql_fetch_array($result)) {
		$host = $row['ip'];
		$output = array();
		$ping = null;
		exec("ping -c 1 -s 8 -W 50 " . $host, $output, $ping);

		if($ping == 0) {
			$ssh = new Net_SSH2($host);
			if (!$ssh->login($SSH_USERNAME, $SSH_PASSWORD)) {
	    		exit('Login Failed');
			}
			echo "<tr>";
			echo "<td><a href='nodedetail.php?ip=". urlencode($row['ip']) . "'>" . $row['nodename'] . "</a></td>";
			echo "<td>" . $row['ip'] . "</td>";
			echo "<td class='cpu cell'>" . $ssh->exec("top -b -n 10 -d.2 | grep 'Cpu' |  awk 'NR==3{ print($2)}'") . "</td>";
			echo "<td> N/A </td>";
			echo "<td><a href='http://" . $row['ip'] . ":4200' target='_blank'>" . $row['ip'] . "</a></td>";
		} else {
			echo "<tr>";
			echo "<td><a href='nodedetail.php?ip=". urlencode($row['ip']) . "'>" . $row['nodename'] . "</a></td>";
			echo "<td>" . $row['ip'] . "</td>";
			echo "<td> N/A </td>";
			echo "<td> N/A </td>";
			echo "<td>Unavailable</td>";
		}
	}
?>