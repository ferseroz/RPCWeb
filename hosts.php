<?php
include('config.php');
include('Net/SFTP.php');

$query = "SELECT * FROM node";
$result = mysql_query($query);

$file = fopen("upload/System/hosts", "w") or die("Unable to create file");
	/* For VMWare Ubuntu 14.04 */
	//$content = "127.0.0.1\tlocalhost\n";
	//fwrite($file, $content);
	//$content = "127.0.1.1\thapdoop1-VirtualBox\n\n";
	//fwrite($file, $content);
	$content = "127.0.0.1\tlocalhost\n";
	fwrite($file, $content);
	$content = "::1\tip6-localhost ip6-loopback\n";
	fwrite($file, $content);
	$content = "fe00::0\tip6-localnet\n";
	fwrite($file, $content);
	$content = "ff00::0\tip6-mcastprefix\n";
	fwrite($file, $content);
	$content = "ff02::1\tip6-allnodes\n";
	fwrite($file, $content);
	$content = "ff02::2\tip6-allrouters\n\n";
	fwrite($file, $content);
	//$content = $nodeip[$id-1] . "\t" . $nodename[$id-1] . "\n";
	fwrite($file, $content);
	while($row = mysql_fetch_array($result)){
		$content = $row['ip'] . "\t" . $row['nodename'] . "\n";
		fwrite($file, $content);
	}
	fclose($file);

	while($row = mysql_fetch_array($result)){
		$sftp = new Net_SFTP($row['ip']);
		if (!$sftp->login($hduser, $hdpass)) {
    		exit('Login Failed');
		}
		echo $sftp->put("/etc/hosts", "upload/System/hosts", NET_SFTP_LOCAL_FILE);
	}
?>