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
			<button class="configButton" type="button">Configuration</button>
			<form class = "loginForm" action="checklogin.php" method="POST">
				Username: <input type="text" name="username" id="username">
				Password: <input type="password" name="password" id="password">
				<input type="submit" value="Login">
				<br>
				<a style="float:right; color:white"href="">Request an account</a>
			</form>
			
			<div class="ui ribbon label">Raspberry Pi CLuster</div>
			<a href="file:///C:/Users/nbutterbutter/Documents/GitHub/RPCWeb/index.html"><h2 style="color:white; margin-left:80px; font-size:35px"><i class="laptop big icon"></i><ins><em>Cluster For Education</em></ins></h2></a>
			<h3 style="margin-left:80px;margin-top: -35px; padding-bottom:20px; color:#35332e;"><em>An appropriate cluster for study many types of knowledge.</em></h3>
		</div>

		

		<div class="configPanel">
		<div class="ui inverted segment"><h3 align="center" style="font-size:27px">Configuration</h3></div>
			<ul style="list-style-type:none">

				<li><input type="radio" name="paneSelector" value="0";> Node</li>
				<!-- Node config pane -->
				<div class= "nodeConfig Pane">
					<form id="nodeForm" style="margin-left:30px;">
						<!-- select how many node will be head node -->
						How many head node(s)?
						<select name="node" form="nodeForm">
							<option value="node1">Node 1</option>
							<option value="node2">Node 2</option>
							<option value="node3">Node 3</option>
							<option value="node4">Node 4</option>
						</select>
						<br>
						<!-- select head here -->
						<div class ="ui stackable grid">
						<div class="ui three wide column">
						<div class="ui segment clustering"  style="padding-left:30px">
							Select head node :<select name="node" form="nodeForm">
							<option value="node1">Node 1</option>
							<option value="node2">Node 2</option>
							<option value="node3">Node 3</option>
							<option value="node4">Node 4</option>
						</select><br>
						<!-- check for slave(s) -->
						<ul style="list-style-type:none">
							<li><input type="checkbox" name="node[]" value="192.168.1.9"> Node 1</li>
							<li><input type="checkbox" name="node[]" value="192.168.1.2"> Node 2</li>
							<li><input type="checkbox" name="node[]" value="192.168.1.3"> Node 3</li>
							<li><input type="checkbox" name="node[]" value="192.168.1.4"> Node 4</li>
							<li><input type="checkbox" name="node[]" value="192.168.1.5"> Node 5</li>
							<li><input type="checkbox" name="node[]" value="192.168.1.6"> Node 6</li>
							<li><input type="checkbox" name="node[]" value="192.168.1.7"> Node 7</li>
							<li><input type="checkbox" name="node[]" value="192.168.1.8"> Node 8</li>
							<input type="submit" value="Create" id="create" name="create">
						</ul>
						</div>
						</div>
						</div>
					</form>

			</div>
			<li><input type="radio" name="paneSelector" value="1"> IP</li>
			<!-- IP config pane -->
			<div class="ipConfig Pane">
				<div class="ui segment ipConfig" style="margin-left:25px; margin-top: 10px; margin-right: 1000px; margin-bottom:5px">
					<form id="ipForm" style="margin-left:10px;">
						Select node:
						<select name="node" form="ipForm">
							<option value="192.168.1.9">Node 1</option>
							<option value="192.168.1.2">Node 2</option>
							<option value="192.168.1.3">Node 3</option>
							<option value="192.168.1.4">Node 4</option>
						</select>
						<br>
						IP: <input style="width:190px" type="text" name="ip"><br>
						Subnet Mask : <input style="width:117px" type="text" name="subnet"><br>
						Router: <input style="width:161px" type="text" name="router"><br>
						DNS: <input style="width:173px" type="text" name="dns"><br>

					</form>
				</div>
			</div>
			<li><input type="radio" name="paneSelector" value="2"> Run node</li>
			<!-- Run config pane -->
			<div class="run Pane">

			</div>
			<li><input type="radio" name="paneSelector" value="3"> Reboot, shutdown</li>
			<!-- Reboot, shutdown config pane -->
			<div class="reboot Pane">
			<div class="ui segment reboot"  style="margin-left:25px; margin-top: 10px; margin-right: 857px; margin-bottom:5px">
				<table class="ui inverted table segment">
					<tr>
						<td>Node Name</td>
						<td>Reboot</td>
						<td>Halt</td>
					</tr>
				</table>
			</div>

			</div>
			<li><input type="radio" name="paneSelector" value="4"> User Manage</li>
			<!-- User manage pane -->
			<div class="userManagement Pane">
			<div class="ui segment userManagement"  style="margin-left:25px; margin-top: 10px; margin-right: 857px; margin-bottom:5px">
				<h3><ins>User management</ins></h3>
				<table class="ui inverted table segment">
					<tr>
						<td>UserID</td>
						<td>Username</td>
						<td>Password</td>
						<td>Verification</td>
					</tr>
					<?php include('fetchaccount.php'); ?>
				</table>
			</div>
		</ul>
	</div>
</div>
</body>
</head>