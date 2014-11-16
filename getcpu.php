<?php

include('Net/SSH2.php');
include('config.php');

$host = $_GET['ip'];

$ssh = new Net_SSH2($host);
if (!$ssh->login($SSH_USERNAME, $SSH_PASSWORD)) {
	echo "Unavailable";
} else {
	echo $ssh->exec("top -b -n 10 -d.2 | grep 'Cpu' |  awk 'NR==3{ print($2)}'");
}


/*
$ip = $_GET['ip'];

echo "test " . $ip;
echo $ssh->exec("top -b -n 10 -d.2 | grep 'Cpu' |  awk 'NR==3{ print($2)}'");*/
?>
