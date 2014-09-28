<?php
include('config.php');
include('Net/SSH2.php');

$ip = $_GET['ip'];

$query = "SELECT * FROM node WHERE ip='$ip'";
	$result = mysql_query($query) or die(mysql_error());
	if($row = mysql_fetch_array($result)) {
		echo "<tr><th>NODE NAME</th>";
		echo "<td>" . $row['nodename'] . "</td></tr>";
		echo "<tr><th>IP Address</th>";
		echo "<td>" . $row['ip'] . "</td></tr>";
		
		try {
			$ssh = new Net_SSH2($ip); 
			if (!$ssh->login($SSH_USERNAME, $SSH_PASSWORD)) {
		    	echo "<tr><th>CPU</th>";
				echo "<td>N/A</td></tr>";
				echo "<tr><th>WORK</th>";
				echo "<td>N/A</td></tr>";
			} else {
				echo "<tr><th>CPU</th>";
				echo "<td>" . $ssh->exec("top -b -n 10 -d.2 | grep 'Cpu' |  awk 'NR==3{ print($2)}'") . "</td></tr>";
				echo "<tr><th>WORK</th>";
				echo "<td>N/A</td></tr>";
			}
		} catch (Exception $e) {
			echo "None";
		}
	}

?>