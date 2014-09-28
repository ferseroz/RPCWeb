<?php
include('config.php');
include('Net/SSH2.php');

$query = "DELETE FROM node";
$result = mysql_query($query) or die(mysql_error());

for($i = 2 ; $i < 21 ; $i++) {
	$host = "192.168.1." . $i;
	$output = array();
	$result = null;
	
	exec("ping -c 1 -s 8 -W 200 " . $host, $output, $result);

	if($result == 0) {
		$ssh = new Net_SSH2($host);
		if (!$ssh->login($SSH_USERNAME, $SSH_PASSWORD)) {
    		exit('Login Failed');
    	}
    	$hostname = $ssh->exec("cat /etc/hostname");
		echo $host . " is available OS: ";

		$ttl = explode("ttl=", $output[1]);
		//$os = "";
		//switch($ttl[1]){
		//	case 54: $os = "FreeBSD and/or another BSD Distribution"; break;
		//	case 64: $os = "Linux"; break;
		//	case 128: $os = "Windows"; break;
		//	case 255: $os = "Cisco or Solaris"; break;
		//}
		//echo $os . " hostname: " . $hostname . "<br>";
		$insert = "INSERT INTO node(nodename, ip) VALUES('$hostname', '$host')";
		$inr = mysql_query($insert) or die(mysql_error());
		if($inr){
			echo $hostname . " has been added";
		}
	} else {
		echo $host . " is unavailable<br>";
	}
}

header('Location: index.php');
?>
