<?php
	$query = "SELECT * FROM node";
	$result = mysql_query($query) or die(mysql_error());;

	while($row = mysql_fetch_array($result)) {
		echo "<tr>";
		echo "<td>" . $row['nodename'] . "</td>";
		echo "<td>" . $row['ip'] . "</td>";
		echo "<td>" . $ssh->exec("top -b -n 10 -d.2 | grep 'Cpu' |  awk 'NR==3{ print($2)}'") . "</td>";
		echo "<td> N/A </td>";
		echo "<td> N/A </td>";
		echo "<td> N/A </td>";
		echo "</tr>";
	}
?>