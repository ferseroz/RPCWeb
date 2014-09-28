<?php
include('Net/SFTP.php');

$SSH_USERNAME = 'hduser';
$SSH_PASSWORD = 'ubuntu';

$node = array();

if($_POST['to'] == "all") {
	for($i=0 ; $i < 8 ; $i++) {
		array_push($node, "192.168.1." . $i);
	}
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

	header('Location: index.php');	
}


?>