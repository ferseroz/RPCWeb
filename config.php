<?php
$host="http://localhost";
$mysql_hostname = "localhost";
$mysql_user = "root2";
$mysql_password = "root";
$mysql_database = "Raspberrypi";
$SSH_USERNAME = 'root';
$SSH_PASSWORD = 'root';
$hduser = "student";
$hdpass = "student";
ini_set('max_execution_time', 7200); //300 seconds = 5 minutes
$bd = mysql_connect($mysql_hostname, $mysql_user, $mysql_password) or die(mysql_error());
mysql_select_db($mysql_database, $bd) or die(mysql_error());
date_default_timezone_set('Asia/Bangkok');
?>