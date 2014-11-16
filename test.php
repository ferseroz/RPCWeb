<?php
include('Net/SSH2.php');
include('config.php');

$ip = "192.168.1.2";

$ssh = new Net_SSH2($ip);
if (!$ssh->login("student", "student")) {
	exit('Login Failed');
}

echo $ssh->exec("cat ~/.ssh/id_rsa.pub");
?>