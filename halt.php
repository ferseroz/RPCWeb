<?php
include('Net/SSH2.php');
include('config.php');

$ip = $_GET['ip'];

$ssh = new Net_SSH2($ip);
if (!$ssh->login($SSH_USERNAME, $SSH_PASSWORD)) {
    exit('Login Failed');
}

echo $ssh->exec("sudo halt");

$query = "Select * FROM node WHERE ip='$ip'";
$result = mysql_query($query);
$row = mysql_fetch_array($result);


if(!file_exists("logs/rpi_" . date("Ymd") . ".txt")){
	$flog = "logs/rpi_" . date("Ymd") . ".txt";
	$handle = fopen($flog, 'w');
}

$clientip = '';
if (getenv('HTTP_CLIENT_IP'))
	$clientip = getenv('HTTP_CLIENT_IP');
else if(getenv('HTTP_X_FORWARDED_FOR'))
	$clientip = getenv('HTTP_X_FORWARDED_FOR');
else if(getenv('HTTP_X_FORWARDED'))
	$clientip = getenv('HTTP_X_FORWARDED');
else if(getenv('HTTP_FORWARDED_FOR'))
	$clientip = getenv('HTTP_FORWARDED_FOR');
else if(getenv('HTTP_FORWARDED'))
	$clientip = getenv('HTTP_FORWARDED');
else if(getenv('REMOTE_ADDR'))
	$clientip = getenv('REMOTE_ADDR');
else
	$clientip = 'UNKNOWN';

$log  = "IP: ".$clientip.' - '.date("F j, Y, g:i a").PHP_EOL.
"Shutdown RaspberryPI(Halt)".PHP_EOL.
"Node: ".$row['nodename']. " IP: ".$row['ip'].PHP_EOL;
$log = $log . "-------------------------".PHP_EOL;
file_put_contents("logs/rpi_" . date("Ymd") . ".txt", $log, FILE_APPEND);

header('Location: configuration.php');

?>