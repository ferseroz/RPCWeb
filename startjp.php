<?php
include('Net/SSH2.php');
include('config.php');

$ip = $_GET['ip'];

$ssh = new Net_SSH2($ip);
if (!$ssh->login($hduser, $hdpass)) {
	exit('Login Failed');
}
echo $ssh->exec("java pj2 edu.rit.pj2.tracker.Tracker tracker=$ip");

$query = "Select * FROM node WHERE ip='$ip' AND role='0'";
$result = mysql_query($query);
if($result != null) {
	while($row = mysql_fetch_array($result)){
		$slaveip = $row['ip'];
		$ssh = new Net_SSH2($slaveip);
		if (!$ssh->login($hduser, $hdpass)) {
			exit('Login Failed');
		}
		echo $ssh->exec("java pj2 edu.rit.pj2.tracker.Launcher tracker=$ip");
	}
}

$query = "Select * FROM node WHERE ip='$ip' AND role='1'";
$result = mysql_query($query);
$row = mysql_fetch_array($result);
$cluster = $row['cluster'];

$uq = "SELECT * FROM node WHERE cluster='$cluster'";
$rs = mysql_query($uq);
while($row = mysql_fetch_array($rs)){
	if($rw['work'] == 0) {
		$uqe = "UPDATE node SET work=1 WHERE cluster='$cluster'";
	} else {
		$uqe = "UPDATE node SET work=3 WHERE cluster='$cluster'";
	}
	$re = mysql_query($uqe);
}

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
"Trying to stop Hadoop".PHP_EOL.
"Head: ".$row['nodename']. " IP: ".$row['ip'].PHP_EOL;
$query = "Select * FROM node WHERE cluster='$cluster' AND role='0'";
$result = mysql_query($query);
while($row = mysql_fetch_array($result)){
	$log = $log . "Slave: " . $row['nodename']. " IP: ".$row['ip'].PHP_EOL;
}
$log = $log . "-------------------------".PHP_EOL;
file_put_contents("logs/rpi_" . date("Ymd") . ".txt", $log, FILE_APPEND);

header('Location: configuration.php');
?>