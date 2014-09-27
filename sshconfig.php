<?php
include('config.php');
include('Net/SSH2.php');

$query = "SELECT * FROM node";
$result = mysql_query($query) or die(mysql_error());;

while($row = mysql_fetch_array($result)) {
	$ssh = new Net_SSH2($row['ip']);
	if (!$ssh->login('hduser', 'ubuntu')) {
    	exit('Login Failed');
	}
}
?>