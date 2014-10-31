<?php
include('getlist.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Raspberry Pis Cluster</title>
	<script src="js/jquery-2.1.1.min.js"></script>
	<script src="js/script.js"></script>
	<script src="packaged/javascript/semantic.js"></script>
	<link rel="stylesheet" type="text/css" href="css/web.css">
	<link rel="stylesheet" type="text/css" href="packaged/css/semantic.css">
</head>
<body>

	<div class = "main"style="clear:both" >

		<div class = "headPane">
			<button class="configButton" type="button"><a href="configuration.php">Configuration</a></button>
			<form class = "loginForm" action="checklogin.php" method="POST">
				Username: <input type="text" name="username" id="username">
				Password: <input type="password" name="password" id="password">
				<input type="submit" value="Login">
				<br>
				<a style="float:right; color:white" href="requestaccount.php">Request an account</a>
			</form>
			
			<div class="ui ribbon label">Raspberry Pi Cluster</div>
			<a href="index.php"><h2 style="color:white; margin-left:80px; font-size:35px"><i class="laptop big icon"></i><ins><em>Cluster For Education</em></ins></h2></a>
			<h3 style="margin-left:80px;margin-top: -35px; padding-bottom:20px; color:#35332e;"><em>An appropriate cluster for study many types of knowledge.</em></h3>
		</div>

		

		<div class="configPanel">
			<div class="ui inverted segment"><h3 align="center" style="font-size:27px">Configuration</h3></div>
			<ul style="list-style-type:none">

				<li><input type="radio" name="paneSelector" value="0";> Configure Parallel Nodes</li>
				<!-- Node config pane -->
				<div class= "nodeConfig Pane">
					<br>
					<input type="submit" value="Fetch Node" id="create" name="fetchNode" style="margin-left:30px">

					<form action="nodemanagement.php" id="nodeForm" style="margin-left:30px;" method="POST">
						<!-- select how many node will be head node -->
						<br>
						How many head node(s)?
						<select name="numberHead" form="nodeForm">
							<option value="0">-How many head-</option>

							<?
							for($i = 1 ; $i <= sizeof($nodename) ; $i++){
								echo "<option value='" . $i . "'>" . $i . "</option>";
							}
							?>

						</select>
						<br>
						<!-- select head here -->
						<div class ="ui stackable grid nodeConfig">
							<!-- gen start here -->
							<div class="ui three wide column nodeConfig">
								<div class="ui segment clustering"  style="padding-left:30px">
									Select head node :
									<select name="headnodes[]" form="nodeForm">
										<option value="0">-Select head node-</option>
										<?php
										for($i = 1 ; $i <= sizeof($nodeip) ; $i++){
											echo "<option value='" . $i . "'>" . $nodename[$i-1] . "</option>";
										}
										?>

									</select><br>
									<!-- check for slave(s) -->
									<ul style="list-style-type:none">
										<?php
										for($i = 1 ; $i <= sizeof($nodename) ; $i++){
										// EDIT nodecb to nodecb[] as array
											echo "<li><input type='checkbox' name='nodecb[]' value='" . $i . "'>" . $nodename[$i-1] . "</li>";
										}
										?>

									</ul>
								</div>
							</div>
							<!-- gen stop here -->
						</div>
						<input type="submit" value="Create" id="create" name="create">
						<br>
					</form>	
				</div>
				<br>

				<li><input type="radio" name="paneSelector" value="1"> Setup IP address</li>
				<!-- IP config pane -->
				<div class="ipConfig Pane">
					<div class="ui segment ipConfig" style="margin-left:25px; margin-top: 10px; margin-right: 1000px; margin-bottom:5px">
						<form action="ipconfigure.php" id="ipForm" style="" method="POST">
							Select node:
							<select name="node" form="ipForm">
								<?php
								for($i = 0 ; $i < sizeof($nodeip) ; $i++){
									echo "<option value='" . $nodeip[$i] . "'>" . $nodename[$i] . "</option>";
								}
								?>

							</select>
							<br>
							IP: <input style="width:100%" type="text" name="ip"><br>
							Subnet Mask : <input style="width:100%" type="text" name="subnet"><br>
							Gateway: <input style="width:100%" type="text" name="gateway"><br>
							<!--DNS: <input style="width:100%" type="text" name="dns"><br>-->
							Network: <input style="width:100%" type="text" name="network"><br>
							Broadcast: <input style="width:100%" type="text" name="broadcast"><br>
							<input type="submit" value="Create" id="change" name="ipForm">
						</form>
					</div>
				</div>
				<br>

				<li><input type="radio" name="paneSelector" value="2"> Run, stop Clusters</li>
				<!-- Run config pane -->
				<div class="run Pane">
					<div class="ui segment run" style="margin-left:25px; margin-top: 10px; margin-right: 857px; margin-bottom:5px">
						<table class="ui table segment">
							<tr>
								<td>Headnode Name</td>
								<td>Cluster No.</td>
								<td>Run</td>
								<td>Stop</td>
							</tr>
							<?php
							$query = "SELECT * FROM node WHERE role='1'";
							$result = mysql_query($query) or die(mysql_error());
							while($row = mysql_fetch_array($result)) {
								echo "<tr>";
								echo "<td>" . $row['nodename'] . "</td>";
								echo "<td>" . $row['cluster'] . "</td>";
								echo "<td>N/A</td>";
								echo "<td>N/A</td>";
								echo "</tr>";
							}
							?>
						</table>
					</div>
				</div>
				<br>


				<li><input type="radio" name="paneSelector" value="3"> Reboot, shutdown Nodes</li>
				<!-- Reboot, shutdown config pane -->
				<div class="reboot Pane">
					<div class="ui segment reboot"  style="margin-left:25px; margin-top: 10px; margin-right: 857px; margin-bottom:5px">
						<table class="ui table segment">
							<tr>
								<td>Node Name</td>
								<td>Reboot</td>
								<td>Shutdown</td>
							</tr>
							<?php
							for($i = 0 ; $i < sizeof($nodename) ; $i++){
								echo "<tr>";
								echo "<td>" . $nodename[$i] . "</td>";
								echo "<td><a href='reboot.php?ip=" . urlencode($nodeip[$i]) . "'>Reboot</td>";
								echo "<td><a href='halt.php?ip=" . urlencode($nodeip[$i]) . "'>Shutdown</td>";
								echo "</td>";
							}
							?>
						</table>
					</div>
				</div>
				<br>

				<li><input type="radio" name="paneSelector" value="4"> User Management</li>
				<!-- User manage pane -->
				<div class="userManagement Pane">
					<div class="ui segment userManagement"  style="margin-left:25px; margin-top: 10px; margin-right: 857px; margin-bottom:5px">
						<table class="ui table segment">
							<tr>
								<td>Node Name</td>
								<td>Username</td>
								<td>Password</td>
								<td>Verification</td>
							</tr>
							<?php include('fetchaccount.php'); ?>
						</table>
					</div>
				</div>
				<br>
				
				<li><input type="radio" name="paneSelector" value="5"> Resource Management</li>
				<!-- Resource manage pane -->
				<div class="resourceManagement Pane">
					<div class="ui segment resourceManagement"  style="margin-left:25px; margin-top: 10px; margin-right: 857px; margin-bottom:5px">
						<table class="ui table segment">
							<tr>
								<td>UserID</td>
							</tr>
						</table>
					</div>
				</div>
				<br>

				<li><input type="radio" name="paneSelector" value="6"> Log</li>
				<!-- Log pane -->
				<div class="log Pane">
					<div class="ui segment log"  style="margin-left:25px; margin-top: 10px; margin-right: 1045px; margin-bottom:5px">
						<form action="selectLog.php" id="logForm" style="" method="POST">
							Select node:
							<select name="node" form="logForm">
								<?php
								for($i = 0 ; $i < sizeof($nodeip) ; $i++){
									echo "<option value='" . $nodeip[$i] . "'>" . $nodename[$i] . "</option>";
								}
								?>

							</select>
							<br>
							<input type="submit" value="View Log" id="" name="logForm">
						</form>
					</div>
				</div>
				<br>

				<li><input type="radio" name="paneSelector" value="7"> Node Setup</li>
				<!-- node setup pane -->
				<div class="nodeSetup Pane">
					<div class="ui segment nodeSetup"  style="margin-left:25px; margin-top: 10px; margin-right: 857px; margin-bottom:5px">
						<table class="ui table segment">
							<tr>
								<td>Node Name</td>
								<td>Restore</td>
								<td>Setup</td>
							</tr>
						</table>
					</div>
				</div>
			</ul>
		</div>
	</div>
</body>
</head>