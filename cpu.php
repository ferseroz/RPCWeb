<?php
include('Net/SSH2.php');

$ssh = new Net_SSH2('192.168.1.8');
if (!$ssh->login('hduser', 'ubuntu')) {
    exit('Login Failed');
}

echo $ssh->exec("top -b -n 10 -d.2 | grep 'Cpu' |  awk 'NR==3{ print($2)}'");

?>