<?php
include('Net/SSH2.php');
include('config.php');

	$query = "SELECT * FROM node";
	$result = mysql_query($query);
	
	while($row = mysql_fetch_array($result)) 
	{
		$host = $row['ip'];
		$output = array();
		$ping = null;
		// For Server on Mac/Linux
		//exec("ping -c 1 -s 8 -W 50 " . $host, $output, $ping);
		// For Server on Windows
		//exec("ping -n 4 -w 1000 " . $host, $output, $result);

		//if($ping == 0) {
			echo "<tr>";
			echo "<td><a href='nodedetail.php?ip=". urlencode($row['ip']) . "'>" . $row['nodename'] . "</a></td>";
			echo "<td>" . $row['ip'] . "</td>";
			echo "<td><div><div id='" . $row['nodename'] ."' class='cpu'></div><img alt='Progress' src='images/process.gif' id='img_" . $row['nodename'] ."'visible='false' /></div></td>";
			switch($row['work']){
				case '0':
					echo "<td> Non-working </td>"; break;
				case '1':
					echo "<td> Parallel Programming </td>"; break;
				case '2':
					echo "<td> Hadoop </td>"; break;
				case '3':
					echo "<td> Parallel Programming & Haddop </td>"; break;
			}
			echo "<td><div><div id='ssh_" . $row['nodename'] . "'></div><img alt='Progress' src='images/process.gif' id='sshim_" . $row['nodename'] ."'visible='false' /></div></td>";
			echo "<td> N/A </td>";
		/*} else {
			echo "<tr>";
			echo "<td><a href='nodedetail.php?ip=". urlencode($row['ip']) . "'>" . $row['nodename'] . "</a></td>";
			echo "<td>" . $row['ip'] . "</td>";
			echo "<td>Unavailable</td>";
			//echo "<td> N/A </td>";
			switch($row['work']){
				case '0':
					echo "<td> Non-working </td>"; break;
				case '1':
					echo "<td> Parallel Programming </td>"; break;
				case '2':
					echo "<td> Hadoop </td>"; break;
				case '3':
					echo "<td> Parallel Programming & Haddop </td>"; break;
			}
			echo "<td>Unavailable</td>";
			echo "<td>Unavailable</td>";
		}*/
	}

?>