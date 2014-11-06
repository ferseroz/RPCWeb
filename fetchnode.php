<?php
include('config.php');
include('Net/SSH2.php');

$query = "DELETE FROM node";
$result = mysql_query($query) or die(mysql_error());

if(!file_exists("logs/Login_" . date("Ymd") . ".txt")){
        $flog = "logs/Login_" . date("Ymd") . ".txt";
        $handle = fopen($flog, 'w');
    }

for($i = 2 ; $i < 10 ; $i++) {
	$host = "192.168.1." . $i;
	$output = array();
	$result = null;
	$nodestat;
	exec("ping -c 1 -s 8 -W 200 " . $host, $output, $result);
	
	if($result == 0) {
		$ssh = new Net_SSH2($host);
		if (!$ssh->login($SSH_USERNAME, $SSH_PASSWORD)) {
    		exit('Login Failed');
    	}
    	$nodename = explode("%0A", urlencode($ssh->exec("cat /etc/hostname")));
    	$hostname = $nodename[0];
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
		$nodestat = true;
	} else {
		$nodestat = false;
		echo $host . " is unavailable<br>";
	}
	$log  = "Date: " . date("Y-m-d H:i:s") . PHP_EOL.
		"Trying to fetching node IP: ".$host.PHP_EOL.
        "Node Status: ".($nodestat==true?'Available':'Unavailable').PHP_EOL.
        "-------------------------".PHP_EOL;
        file_put_contents("logs/System_" . date("Ymd") . ".txt", $log, FILE_APPEND);
}
?>
