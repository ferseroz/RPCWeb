<?php
include('Net/SFTP.php');
include('config.php');

$node = $_POST['node'];
$ip = $_POST['ip'];
$subnet = $_POST['subnet'];
$gateway = $_POST['gateway'];
$network = $_POST['network'];
$broadcast = $_POST['broadcast'];
//$dns = $_POST['dns'];

/*
echo "auto lo<br>";
echo "iface lo inet loopback<br><br>";
echo "auto eth0<br>";
echo "iface eth0 inet static<br>";
echo "address $ip<br>";
echo "netmask $subnet<br>";
echo "gateway $gateway<br>";
echo "network 192.168.1.0<br>";
echo "broadcast 192.168.1.255";
echo "dns-nameservers $dns<br>";
*/
$file = fopen("upload/System/interfaces", "w") or die("Unable to create file");
$content = "auto lo\n";
fwrite($file, $content);
$content = "iface lo inet loopback\n\n";
fwrite($file, $content);
//$content = "auto eth0\n";
//fwrite($file, $content);
$content = "iface eth0 inet static\n";
fwrite($file, $content);
$content = "address $ip\n";
fwrite($file, $content);
$content = "netmask $subnet\n";
fwrite($file, $content);
$content = "gateway $gateway\n";
fwrite($file, $content);
$content = "network $network\n";
fwrite($file, $content);
$content = "broadcast $broadcast\n\n";
fwrite($file, $content);
//$content = "dns-nameservers $dns";
//fwrite($file, $content);
$content = "allow-hotplug wlan0\n";
fwrite($file, $content);
$content = "iface wlan0 inet manual\n";
fwrite($file, $content);
$content = "wpa-roam /etc/wpa_supplicant/wpa_supplicant.conf\n";
fwrite($file, $content);
$content = "iface default inet dhcp\n";
fwrite($file, $content);
fclose($file);

$sftp = new Net_SFTP($node);
if (!$sftp->login($SSH_USERNAME, $SSH_PASSWORD)) {
	exit('Login Failed');
}

if($sftp->put("/etc/network/interfaces", "upload/System/interfaces", NET_SFTP_LOCAL_FILE)) {
	$ssh = new Net_SSH2($node);
	if (!$ssh->login($SSH_USERNAME, $SSH_PASSWORD)) {
		exit('Login Failed');
	}

	//$ssh->setTimeout(1);
	$ssh->exec("sudo ifdown eth0; sudo ifup eth0");

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
	$query = "Select * FROM node WHERE ip='$node'";
	$result = mysql_query($query);
	$log = $log . "Configure Node: ". $row['nodename'] . PHP_EOL;
	$log = $log . "Old IP:" . $row['ip'] . PHP_EOL;
	$log = $log . "New IP:" . $ip . PHP_EOL;
	$log = $log . "Subnet Mask:" . $subnet . PHP_EOL;
	$log = $log . "Gateway:" . $gateway . PHP_EOL;
	$log = $log . "Network:" . $network . PHP_EOL;
	$log = $log . "Broadcast:" . $broadcast . PHP_EOL;
	$log = $log . "-------------------------".PHP_EOL;
	file_put_contents("logs/rpi_" . date("Ymd") . ".txt", $log, FILE_APPEND);
	header('Location: fetchnode.php');
}

?>