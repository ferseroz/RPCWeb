<?php
include('Net/SSH2.php');
include('config.php');

$ip = $_GET['ip'];
//$output = array();
//$ping = null;

//For Windowhttp://localhost/RPCweb/configuration.php

//For Mac
//exec("ping -c 1 -s 4 -W 500 " . $ip, $output, $result);
//if($result == 0) {
	//echo "<a href='http://" . $ip . ":4200' id='ssh' target='blank' class='ssh'>Available</a>";
//}
$ssh = new Net_SSH2($ip);
if (!$ssh->login($SSH_USERNAME, $SSH_PASSWORD)) {
    echo "Unavailable";
} else {
	echo "<a href='http://" . $ip . ":4200' id='ssh' target='blank' class='ssh'>Available</a>";
}
?>