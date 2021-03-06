<?php
include('sshconfig.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Raspberry Pis Cluster</title>
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
			<h2 style="color:white; margin-left:80px; font-size:30px"><i class="laptop big icon"></i><ins>Cluster For Education</ins></h2>
			<h3 style="margin-left:80px;margin-top: -30px; padding-bottom:20px; color:#35332e;">An appropriate cluster for study many types of knowledge.</h3>
		</div>


		<div class = "statusTable">
			<h3>Status</h3>
			<table class="ui inverted table segment">
				<thead>
				<tr>
					<th>NODE NAME</th>
					<th>IP Address</th>
					<th>CPU</th>
					<th>WORK</th>
					<th>Detail</th>
					<th>SSH</th>
				</tr>
				
				</thead>
				<tbody>
				<?php
					include('maintable.php');
					?>
				</tbody>
			</table>


		</div>
		<div class ="uploadPane">
		<div class="ui secondary inverted segment">
			<p><ins>Upload File</ins> <i class="file outline icon"></i></p>
			<form action="uploadfile.php" method="POST" enctype="multipart/form-data">
				<ul style="list-style-type:none">
					Select a file: <input type="file" name="file" id="file">
					<li><input type="radio" name="to" value="all"> All</li>
					<li><input type="radio" name="to" value="spec"> Specify nodes(s)</li>
					<ul class ="uploadNodeList"style="list-style-type:none">
						<li><input type="checkbox" name="node[]" value="192.168.1.9"> Node 1</li>
						<li><input type="checkbox" name="node[]" value="192.168.1.2"> Node 2</li>
						<li><input type="checkbox" name="node[]" value="192.168.1.3"> Node 3</li>
						<li><input type="checkbox" name="node[]" value="192.168.1.4"> Node 4</li>
						<li><input type="checkbox" name="node[]" value="192.168.1.5"> Node 5</li>
						<li><input type="checkbox" name="node[]" value="192.168.1.6"> Node 6</li>
						<li><input type="checkbox" name="node[]" value="192.168.1.7"> Node 7</li>
						<li><input type="checkbox" name="node[]" value="192.168.1.8"> Node 8</li>
						<input type="submit" value="Upload" id="upload" name="upload">
					</ul>
				</ul>
			</form>
			</div>
		</div>
	</div>
</body>
</html>