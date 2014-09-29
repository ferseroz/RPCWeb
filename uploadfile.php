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

	header('Location: index.php');	
}


?>