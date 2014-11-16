<?php
include('config.php');

$ip = $_GET['ip'];

$query = "Select * FROM node WHERE ip='$ip' AND role='1'";
$result = mysql_query($query);
$row = mysql_fetch_array($result);
$cluster = $row['cluster'];

$uq = "SELECT * FROM node WHERE cluster='$cluster'";
$rs = mysql_query($uq);
while($rw = mysql_fetch_array($rs)){
	$sip = $rw['ip'];
	if($rw['work'] == 3) {
		$uqe = "UPDATE node SET work=1 WHERE ip='$sip'";
	} else {
		$uqe = "UPDATE node SET work=0 WHERE ip='$sip'";
	}
	$re = mysql_query($uqe);
}

header('Location: configuration.php');
?>