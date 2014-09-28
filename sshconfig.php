<?php
include('config.php');
include('Net/SSH2.php');

$query = "SELECT * FROM node";
$result = mysql_query($query) or die(mysql_error());

while($row = mysql_fetch_array($result)) {
	$host = $row['ip'];
	$output = array();
	$ping = null;
	
	exec("ping -c 1 -s 8 -W 50 " . $host, $output, $ping);

	if($ping == 0) {
		$ssh = new Net_SSH2($row['ip']);
		if (!$ssh->login($SSH_USERNAME, $SSH_PASSWORD)) {
	    	exit('Login Failed');
		}
	}
}
?>