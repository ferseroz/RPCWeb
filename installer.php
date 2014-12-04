<?php
include('Net/SSH2.php');
include('Net/SFTP.php');
include('config.php');

$ip = $_POST['node'];
$ip = $_GET['ip'];
$ip = $_POST['ip'];
$ssh = new Net_SSH2($ip);
if (!$ssh->login("pi", "raspberry")) {
    exit('Login Failed');
}

$dir = 'upload/System/';
$fileName = 'script.sh';
//$tmpName = $_FILES['file']['tmp_name'];
//$fileSize = $_FILES['file']['size'];
//$fileType = $_FILES['file']['type'];

$path = $dir. $fileName;

	echo "in";
	$sftp = new Net_SFTP($ip);
	if (!$sftp->login("pi", "raspberry")) {
		exit('Login Failed');
	}
		
	$locate = "" . $fileName;
	echo $sftp->put($locate, $path, NET_SFTP_LOCAL_FILE);

	//$query = "Select * FROM node WHERE ip='$ip'";
	//$result = mysql_query($query);
	//$row = mysql_fetch_array($result);
echo $ssh->exec("cd ~; sudo ./script.sh;");

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
"Node: ".$row['nodename']. " IP: ".$row['ip'].PHP_EOL;
"has been installed and configured".PHP_EOL.
$log = $log . "-------------------------".PHP_EOL;
file_put_contents("logs/rpi_" . date("Ymd") . ".txt", $log, FILE_APPEND);

header('Location: configuration.php');

?>