<?php
include('Net/SSH2.php');
include('config.php');

$ip = $_GET['ip'];


$ssh = new Net_SSH2($ip);
if (!$ssh->login($hduser, $hdpass)) {
	exit('Login Failed');
}
$ssh->setTimeout(60);
echo $ssh->exec("/usr/local/hadoop/bin/hadoop namenode -format");
echo $ssh->exec("/usr/local/hadoop/bin/start-all.sh");

$query = "Select * FROM node WHERE ip='$ip' AND role='1'";
$result = mysql_query($query);
$row = mysql_fetch_array($result);
$cluster = $row['cluster'];

$uq = "SELECT * FROM node WHERE cluster='$cluster'";
$rs = mysql_query($uq);
while($rw = mysql_fetch_array($rs)){
	if($rw['work'] == 0) {
		$uqe = "UPDATE node SET work=2 WHERE cluster='$cluster'";
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
"Trying to start Hadoop".PHP_EOL.
"Head: ".$row['nodename']. " IP: ".$row['ip'].PHP_EOL;
$query = "Select * FROM node WHERE cluster='$cluster' AND role='0'";
$result = mysql_query($query);
while($row = mysql_fetch_array($result)){
	$log = $log . "Slave: " . $row['nodename']. " IP: ".$row['ip'].PHP_EOL;
}
$log = $log . "-------------------------".PHP_EOL;
file_put_contents("logs/rpi_" . date("Ymd") . ".txt", $log, FILE_APPEND);

if($row['work'] == 0){
	$query2 = "UPDATE user SET work=2 WHERE ip='$ip'";
	mysql_query($query2);
} else {
	$query2 = "UPDATE user SET work=3 WHERE ip='$ip'";
	mysql_query($query2);
}


//header('Location: configuration.php');
?>