<?php
include('config.php');
include('getlist.php');
include('Net/SFTP.php');

$nodenumber = $_POST['numberHead'];
$head = array();

echo "Number of clusters: " . $nodenumber . "<br>";

if($nodenumber >= 1){
	foreach($_POST['head'] as $id){
		$ip = $nodeip[$id-1];
		$query = "UPDATE node SET cluster='$id', role='1' WHERE ip='$ip'";
		if(mysql_query($query)){
			array_push($head, $nodeip[$id-1]);
			echo "Head: " . $nodeip[$id-1] . " has been updated<br>";

			$slave = array();
			foreach($_POST['nodecb'] as $slaveid){
				$slaveip = $nodeip[$slaveid-1];
				array_push($slave, $slaveid);
				$query_slave = "UPDATE node SET cluster='$id', role='0' WHERE ip='$slaveip'";
				if(mysql_query($query_slave)) {
					echo "Slave: " . $slave[sizeof($slave)-1] . " has been updated<br>";
				}
			}
			configHadoop(1, $id, $slave);
		}	
	}
} else {
	echo "Head: " . $nodeip[$_POST['nodeHead']-1];

}

function configHadoop($role, $id, $slaveid){
	include('getlist.php');
	
	$ip = $nodeip[$id];

	$file = fopen("upload/core-site.xml", "w") or die("Unable to create file");
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
	$content = "<value>hdfs://" . $ip . ":54310</value><description></description>\n";
	fwrite($file, $content);
	$content = "</property>\n";
	fwrite($file, $content);
	$content = "</configuration>";
	fwrite($file, $content);
	fclose($file);

	$file = fopen("upload/mapred-site.xml", "w") or die("Unable to create file");
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
	$content = "<value>" . $ip . ":54311</value><description></description>\n";
	fwrite($file, $content);
	$content = "</property>\n";
	fwrite($file, $content);
	$content = "</configuration>";
	fwrite($file, $content);
	fclose($file);

	$file = fopen("upload/hdfs-site.xml", "w") or die("Unable to create file");
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
	$content = "</configuration>";
	fwrite($file, $content);
	fclose($file);

	$file = fopen("upload/masters", "w") or die("Unable to create file");
	$content = $ip;
	fwrite($file, $content);
	fclose($file);

	$file = fopen("upload/slaves", "w") or die("Unable to create file");
	for($i = 0 ; $i < sizeof($slaveid) ; $i++) {
		$content = $nodeip[$slaveid[$i]-1] ;
		fwrite($file, $content);
		$content = "\n";
		fwrite($file, $content);
	}
	fclose($file);

	$file = fopen("upload/hosts", "w") or die("Unable to create file");
	$content = "127.0.0.1\tlocalhost\n";
	fwrite($file, $content);
	$content = "127.0.1.1\thapdoop1-VirtualBox\n\n";
	fwrite($file, $content);
	$content = $nodeip[$id-1] . "\tnode1\n";
	fwrite($file, $content);
	for($i = 0 ; $i < sizeof($slaveid) ; $i++){
		$n = 2 + $i;
		$content = $nodeip[$slaveid[$i]-1] . "\tnode$n";
		fwrite($file, $content);
	}
	$content = "\n\n";
	fwrite($file, $content);
	$content = "# The following lines are desirable for IPv6 capable hosts\n";
	fwrite($file, $content);
	$content = "::1\tip6-localhost ip6-loopback\n";
	fwrite($file, $content);
	$content = "fe00::0\tip6-localnet\n";
	fwrite($file, $content);
	$content = "ff00::0\tip6-mcastprefix\n";
	fwrite($file, $content);
	$content = "ff02::1\tip6-allnodes\n";
	fwrite($file, $content);
	$content = "ff02::2\tip6-allrouters";
	fwrite($file, $content);
	fclose($file);
}
?>