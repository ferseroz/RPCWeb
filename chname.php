<?php
include('config.php');
include('Net/SSH2.php');
include('Net/SFTP.php');

$ip = $_POST['nodename'];
$newName = $_POST['newname'];

$file = fopen("upload/System/hostname", "w") or die("Unable to create file");
$content = $newName;
fwrite($file, $content);
fclose($file);
$sftp = new Net_SFTP($ip);

if (!$sftp->login($SSH_USERNAME, $SSH_PASSWORD)) {
	exit('Login Failed');
}

$sftp->put("/etc/hostname", "upload/System/hostname", NET_SFTP_LOCAL_FILE);

$ssh2 = new Net_SSH2($ip);
if (!$ssh2->login($hduser, $hdpass)) {
	exit('Login Failed');
}
echo $ssh2->exec("echo -e 'y\\n'|ssh-keygen -q -t rsa -N \"\" -f ~/.ssh/id_rsa");
header('Location: fetchnode.php');
?>