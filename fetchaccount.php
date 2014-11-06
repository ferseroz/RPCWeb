<?php
include('config.php');

function pendingAccount(){
	$query = "SELECT * FROM USER WHERE activation='0'";

	$result = mysql_query($query);
	while($row = mysql_fetch_array($result)) {
			echo "<tr>";
			echo "<td>" . $row['userid'] . "</td>";
			echo "<td>" . $row['username'] . "</td>";
			echo "<td>" . $row['password'] . "</td>";
			echo "<td><a href='verify.php?userid=" . $row['userid'] . "'>Confirm</a></td>";
			echo "</tr>";
	}
}

function activatedAccount(){
	$query = "SELECT * FROM USER WHERE activation='1'";

	$result = mysql_query($query);
	while($row = mysql_fetch_array($result)) {
			echo "<tr>";
			echo "<td>" . $row['userid'] . "</td>";
			echo "<td>" . $row['username'] . "</td>";
			echo "<td>" . $row['password'] . "</td>";
			echo "</tr>";
	}
}

?>