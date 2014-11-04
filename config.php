<?php
$host="http://localhost";
$mysql_hostname = "localhost";
$mysql_user = "root";
$mysql_password = "";
$mysql_database = "Raspberrypi";
$SSH_USERNAME = 'hduser';
$SSH_PASSWORD = 'ubuntu';
$hduser = "hduser";
$hdpass = "ubuntu";
$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die(mysql_error());
mysql_select_db($mysql_database, $bd) or die(mysql_error());
date_default_timezone_set('Asia/Bangkok');
?>