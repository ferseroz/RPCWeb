<!DOCTYPE html>
<html>
<head>
	<title>Raspberry Pis Cluster</title>
	<script src="js/script.js"></script>
	<script src="packaged/javascript/semantic.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.js"></script>
	<link rel="stylesheet" type="text/css" href="css/web.css">
	<link rel="stylesheet" type="text/css" href="packaged/css/semantic.css">
</head>
<body>


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
		<div class="ui tertiary inverted segment ">
			<form class = "requestForm style="color:#35332e action="register.php" method="POST">
				<h3 style="color:black; margin-left: 50px;"><ins>Verification</ins></h3></br>
				<table class="ui inverted table segment">
				<thead>
				<tr>
					<th>UserID</th>
					<th>Username</th>
					<th>Password</th>
					<th>Verification</th>
				</tr>
				
				</thead>
				<tbody>
				<?php
					include('fetchaccount.php');
					?>
				</tbody>
			</table>
				<br>
				<input style="margin-top: 20px; margin-left:50px; width:100px; height:30px" type="submit" value="Back">
				<input style="margin-top: 20px; margin-left:300px; width:100px; height:30px" type="submit" value="Submit">
				
			</form>
		</div>
	</div>

</body>
</html>