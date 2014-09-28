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

		<div class = "requestPane">
			<div class="ui two column stackable grid segment" style="margin-left:50px;">
				<div class="equal height row">
					<div class="ui tertiary inverted segment column" style="padding:30px; padding-bottom: 23px; padding-left:25px">
						<form class = "requestForm" style="color:#35332e;" action="checklogin.php" method="POST">
							<h3 style="color:black; margin-left: 4px; margin-top:-10px; margin-bottom:-10px">Request an Acoount Form</h3></br>
							<div class="ui section divider"></div>
							<p style="margin-top: -12px; margin-left: 4px; color:black">Username: </p><input style="width:100%; height:25px; " type="text" name="username" id="username">
							<p style="margin-left: 4px; color:black">Password: </p><input style="width:100%; height:25px;" type="password" name="password" id="password">
							<br>
							<p>x-character minimum fror password.</p>
						
							<input style="margin-top: 10px; margin-left:4px; width:100px; height:30px" type="submit" value="Back">
							<input style="margin-top: 10px; float:right; width:100px; height:30px" type="submit" value="Submit">
						</form>
					</div>
					<div class="column" style="background-color:#b2d0cc;">
						<i class="massive circular user icon" style="margin-top:40px; margin-left:170px; width:100%;"></i>
					</div>
				</div>

			</div>
		</div>
	</div>

</body>
</html>