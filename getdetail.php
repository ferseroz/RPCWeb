<?php
include('config.php');
include('Net/SSH2.php');

$ip = $_GET['ip'];

$query = "SELECT * FROM node WHERE ip='$ip'";
$result = mysql_query($query) or die(mysql_error());
if($row = mysql_fetch_array($result)) {
	echo "<script type='text/javascript'>" . PHP_EOL;
	echo "$(document).ready(function() {". PHP_EOL;
        	//$('#LoadPage').hide();

		echo "var url = 'getcpu.php?ip=' + " . "'" . $row['ip'] . "'" . ";". PHP_EOL;
		echo "$('#img_" . $row['nodename'] . "').show();". PHP_EOL;
		echo "$('#" . $row['nodename'] . "').load(url, function() {". PHP_EOL;
			echo "$('#img_" . $row['nodename'] . "').hide();". PHP_EOL;
			echo "});". PHP_EOL;
           // $("#imgProg").hide();
            //$("#LoadPage").show();
echo "});". PHP_EOL;
echo "</script>". PHP_EOL;
echo "<tr><th>NODE NAME</th>";
echo "<td>" . $row['nodename'] . "</td></tr>";
echo "<tr><th>IP Address</th>";
echo "<td>" . $row['ip'] . "</td></tr>";

$output = array();
$ping = null;

exec("ping -c 1 -s 8 -W 50 " . $ip, $output, $ping);
if($ping == 0) {
	$ssh = new Net_SSH2($ip); 
	if (!$ssh->login($SSH_USERNAME, $SSH_PASSWORD)) {
		echo "Login Failed";
	} else {
		echo "<tr><th>CPU</th>";
		echo "<td><div><div id='" . $row['nodename'] ."' class='cpu'></div><img alt='Progress' src='images/process.gif' id='img_" . $row['nodename'] ."'visible='false' /></div></td>";
				//echo "<td>" . $ssh->exec("top -b -n 10 -d.2 | grep 'Cpu' |  awk 'NR==3{ print($2)}'") . "</td></tr>";
		echo "<tr><th>WORK</th>";
		switch($row['work']){
			case '0':
			echo "<td> No Assigned Task </td>"; break;
			case '1':
			echo "<td> Parallel Programming </td>"; break;
			case '2':
			echo "<td> Hadoop </td>"; break;
			case '3':
			echo "<td> Parallel Programming & Haddop </td>"; break;
		}
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
}

}

?>