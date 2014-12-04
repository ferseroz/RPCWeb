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

$output = array();
$ping = null;

// For server on windows
//exec("ping -n 4 -w 1000 " . $ip, $output, $ping);
//exec("ping -c 1 -s 8 -W 50 " . $ip, $output, $ping);
//if($ping == 0) {
 //else {
		echo "<tr><th>CPU</th>";
		echo "<td><div><div id='node' class='cpu'></div><img alt='Progress' src='images/process.gif' id='img'visible='false' /></div></td>";
		echo "<tr><th>WORK</th>";
		switch($row['work']){
			case '0':
			echo "<td> No Assigned Task </td>"; break;
			case '1':
			echo "<td> Parallel Programming </td>"; break;
			case '2':
			echo "<td> Hadoop </td>"; break;
			case '3':
			echo "<td> Parallel Programming & Haddop </td></tr>"; break;
		}
		echo "<tr><th>Cluster No.</th>";
		echo "<td>" . $row['cluster'] . "</td></tr>";
		echo "<tr><th>Role</th>";
		echo "<td>" . ($row['role'] == 0 ? "Slave" : "Head") . "</td></tr>";
		/*
	}
} else {
	echo "<tr><th>CPU</th>";
		//echo "<td><div><div id='" . $row['nodename'] ."' class='cpu'></div><img alt='Progress' src='images/process.gif' id='img_" . $row['nodename'] ."'visible='false' /></div></td>";
	echo "<td>Host is unavailable</td></tr>";
	echo "<tr><th>WORK</th>";
	switch($row['work']){
		case '0':
		echo "<td> Host is unavailable </td>"; break;
		case '1':
		echo "<td> Parallel Programming </td>"; break;
		case '2':
		echo "<td> Hadoop </td>"; break;
		case '3':
		echo "<td> Parallel Programming & Haddop </td>"; break;
	}
}*/

}
/*
echo "<script type='text/javascript'>" . PHP_EOL;
echo "$(document).ready(function() {". PHP_EOL;
	echo "var url = 'ssh.php?ip=' + " . "'" . $ip . "'" . ";". PHP_EOL;
	echo "$('#sshim_" . $ip . "').show();". PHP_EOL;
	echo "$('#ssh_" . $ip . "').load(url, function() {". PHP_EOL;
		echo "$('#sshim_" . $ip . "').hide();". PHP_EOL;
		echo "});". PHP_EOL;
echo "});". PHP_EOL;
echo "</script>". PHP_EOL;*/
?>