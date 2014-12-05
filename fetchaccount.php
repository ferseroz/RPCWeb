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
			echo "<td><a href='verify.php?userid=" . $row['userid'] . "'><input type='button' value='Confirm'/></a> <a href='deleteaccount.php?userid=" . $row['userid'] . "'><input type='button' value='Deny'/></a></td>";
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
			echo "<td>" . ($row['class'] == 0 ? "Student" : "Administrator") . "</td>";
			echo "<td><a href='deleteaccount.php?userid=" . $row['userid'] . "'><input type='button' value='Delete'/></a> <a href='changeprivilege.php?userid=" . $row['userid'] . "'><input type='button' value='Change Class'/></a></td>";
			echo "</tr>";
	}
}

?>