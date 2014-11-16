<?php
include('Net/SFTP.php');
include('getlist.php');

$node = array();

if($_POST['to'] == "all") {
	$node = $nodeip;
} else {
	foreach($_POST['node'] as $ip){
		array_push($node, $ip);
	}
}

$dir = 'upload/';
$fileName = $_FILES['file']['name'];
$tmpName = $_FILES['file']['tmp_name'];
$fileSize = $_FILES['file']['size'];
$fileType = $_FILES['file']['type'];

$path = $dir. $fileName;

if(move_uploaded_file($tmpName, $path)){
	
	for($i = 0 ; $i < sizeof($node) ; $i++) {
		$sftp = new Net_SFTP($node[$i]);

		if (!$sftp->login($SSH_USERNAME, $SSH_PASSWORD)) {
			exit('Login Failed');
		}
		
		$locate = "Desktop/" . $fileName;
		$sftp->put($locate, $path, NET_SFTP_LOCAL_FILE);
	}

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
	"Upload File: " . $fileName . PHP_EOL;
	for($i = 0 ; $i < sizeof($node) ; $i++) {
		$ip = $node[$i];
		$query = "Select * FROM node WHERE ip='$ip'";
		$result = mysql_query($query);
		$row = mysql_fetch_array($result);
		$log = $log . "Node: ".$row['nodename']. " IP: ".$row['ip'].PHP_EOL;
	}
	$log = $log . "-------------------------".PHP_EOL;
	file_put_contents("logs/rpi_" . date("Ymd") . ".txt", $log, FILE_APPEND);

	header('Location: index.php');	
}


?>