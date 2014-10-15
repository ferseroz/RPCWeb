<?php
include('Net/SSH2.php');
include('config.php');

$ip = $_GET['ip'];

$ssh = new Net_SSH2($ip);
if (!$ssh->login($SSH_USERNAME, $SSH_PASSWORD)) {
    exit('Login Failed');
}

echo $ssh->exec("/usr/local/hadoop/bin/stop-all.sh");

header('Location: configuration.php');
?>