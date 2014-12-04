<?php
include('config.php');
include('getlist.php');
include('Net/SFTP.php');

$nodenumber = $_POST['numberHead'];
$head = array();

echo "Number of clusters: " . $nodenumber . "<br>";
$counter = 1;
if($nodenumber >= 1){
	foreach($_POST['headnodes'] as $id){
		$ip = $nodeip[$id-1];
		$query = "UPDATE node SET cluster='$counter', role='1' WHERE ip='$ip'";
		$counter++;
		if(mysql_query($query)){
			array_push($head, $nodeip[$id-1]);
			echo "Head: " . $nodeip[$id-1] . " has been updated<br>";
			$slave = array();
			if(isset($_POST['nodecb'])) {
				foreach($_POST['nodecb'] as $slaveid){
					$slaveip = $nodeip[$slaveid-1];
					array_push($slave, $slaveid);
					$query_slave = "UPDATE node SET cluster='$id', role='0' WHERE ip='$slaveip'";
					if(mysql_query($query_slave)) {
						echo "Slave: " . $slave[sizeof($slave)-1] . " $slaveip has been updated<br>";
					}
				}
			}
			configHadoop($id, $slave);
		}	
	}
} else {
	echo "Head: " . $nodeip[$_POST['nodeHead']-1];

}

function configHadoop($id, $slaveid){
	include('getlist.php');
	
	$ip = $nodeip[$id-1];
	$hostname = $nodename[$id-1];
	
	$sftp = new Net_SFTP($ip);
	if (!$sftp->login($SSH_USERNAME, $SSH_PASSWORD)) {
    	exit('Login Failed');
	}
	echo "SFTP $ip" . PHP_EOL;

	for($i = 0 ; $i < sizeof($slaveid) ; $i++) {
		echo "SFTP " . $nodeip[$slaveid[$i]-1] . PHP_EOL;
			$sftpslaves[$i] = new Net_SFTP($nodeip[$slaveid[$i]-1]);
			if (!$sftpslaves[$i]->login($SSH_USERNAME, $SSH_PASSWORD)) {
	    	exit('Login Failed');
		}
		//echo "SFTP " . $nodeip[$slaveid[$i]-1] . PHP_EOL;
	}

	$file = fopen("upload/System/core-site.xml", "w") or die("Unable to create file");
	$content = "<?xml version=\"1.0\"?>\n";
	fwrite($file, $content);
	$content = "<?xml-stylesheet type=\"text/xsl\" href=\"configuration.xsl\"?>\n";
	fwrite($file, $content);
	$content = "<configuration>\n";
	fwrite($file, $content);
	$content = "<property>\n";
	fwrite($file, $content);
	$content = "<name>hadoop.tmp.dir</name>\n";
	fwrite($file, $content);
	$content = "<value>/fs/hadoop/tmp</value>    <description>Sets the operating directory for Hadoop data.</description>\n";
	fwrite($file, $content);
	$content = "</property>\n";
	fwrite($file, $content);
	$content = "<property>\n";
	fwrite($file, $content);
	$content = "<name>fs.default.name</name>\n";
	fwrite($file, $content);
	$content = "<value>hdfs://" . $hostname . ":54310</value><description></description>\n";
	fwrite($file, $content);
	$content = "</property>\n";
	fwrite($file, $content);
	$content = "</configuration>\n";
	fwrite($file, $content);
	fclose($file);

	echo $sftp->put("/usr/local/hadoop/conf/core-site.xml", "upload/System/core-site.xml", NET_SFTP_LOCAL_FILE);

	for($i = 0 ; $i < sizeof($sftpslaves) ; $i++) {
			echo $sftpslaves[$i]->put("/usr/local/hadoop/conf/core-site.xml", "upload/System/core-site.xml", NET_SFTP_LOCAL_FILE);
	}
	
	$file = fopen("upload/System/mapred-site.xml", "w") or die("Unable to create file");
	$content = "<?xml version=\"1.0\"?>\n";
	fwrite($file, $content);
	$content = "<?xml-stylesheet type=\"text/xsl\" href=\"configuration.xsl\"?>\n";
	fwrite($file, $content);
	$content = "<configuration>\n";
	fwrite($file, $content);
	$content = "<property>\n";
	fwrite($file, $content);
	$content = "<name>mapred.job.tracker</name>\n";
	fwrite($file, $content);
	$content = "<value>" . $nodename[$id-1] . ":54311</value><description></description>\n";
	fwrite($file, $content);
	$content = "</property>\n";
	fwrite($file, $content);
	$content = "</configuration>\n";
	fwrite($file, $content);
	fclose($file);

	echo $sftp->put("/usr/local/hadoop/conf/mapred-site.xml", "upload/System/mapred-site.xml", NET_SFTP_LOCAL_FILE);
	for($i = 0 ; $i < sizeof($sftpslaves) ; $i++) {
		echo $sftpslaves[$i]->put("/usr/local/hadoop/conf/mapred-site.xml", "upload/System/mapred-site.xml", NET_SFTP_LOCAL_FILE);
	}

	$file = fopen("upload/System/hdfs-site.xml", "w") or die("Unable to create file");
	$content = "<?xml version=\"1.0\"?>\n";
	fwrite($file, $content);
	$content = "<?xml-stylesheet type=\"text/xsl\" href=\"configuration.xsl\"?>\n";
	fwrite($file, $content);
	$content = "<configuration>\n";
	fwrite($file, $content);
	$content = "<property>\n";
	fwrite($file, $content);
	$content = "<name>dfs.replication</name>\n";
	fwrite($file, $content);
	$content = "<value>2</value><description></description>\n";
	fwrite($file, $content);
	$content = "</property>\n";
	fwrite($file, $content);
	$content = "</configuration>\n";
	fwrite($file, $content);
	fclose($file);

	echo $sftp->put("/usr/local/hadoop/conf/hdfs-site.xml", "upload/System/hdfs-site.xml", NET_SFTP_LOCAL_FILE);
	for($i = 0 ; $i < sizeof($sftpslaves) ; $i++) {
			echo $sftpslaves[$i]->put("/usr/local/hadoop/conf/hdfs-site.xml", "upload/System/hdfs-site.xml", NET_SFTP_LOCAL_FILE);
	}

	$file = fopen("upload/System/masters", "w") or die("Unable to create file");
	$content = $nodeip[$id-1];
	fwrite($file, $content);
	fclose($file);

	echo $sftp->put("/usr/local/hadoop/conf/masters", "upload/System/masters", NET_SFTP_LOCAL_FILE);
	

	$file = fopen("upload/System/slaves", "w") or die("Unable to create file");
	$content = $ip . "\n";
	fwrite($file, $content);
	for($i = 0 ; $i < sizeof($slaveid) ; $i++) {
		$content = $nodeip[$slaveid[$i]-1] . "\n";
		fwrite($file, $content);
	}
	fclose($file);

	echo $sftp->put("/usr/local/hadoop/conf/slaves", "upload/System/slaves", NET_SFTP_LOCAL_FILE);
	

	$file = fopen("upload/System/machinefile", "w") or die("Unable to create file");
	$content = $hostname . PHP_EOL;
	fwrite($file, $content);
	for($i = 0 ; $i < sizeof($slaveid) ; $i++) {
		$content = $nodename[$slaveid[$i]-1] . PHP_EOL;
		fwrite($file, $content);
	}
	fclose($file);

	echo $sftp->put("/home/student/machinefile", "upload/System/machinefile", NET_SFTP_LOCAL_FILE);

	for($i = 0 ; $i < sizeof($sftpslaves) ; $i++) {
			echo $sftpslaves[$i]->put("/home/student/machinefile", "upload/System/machinefile", NET_SFTP_LOCAL_FILE);
	}

	//"java edu.rit.pj2.tracker.Tracker tracker=$ip"
	


	
	header("Location: configuration.php");
}
?>