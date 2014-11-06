<!DOCTYPE html>
<html>
<head>
	<title>Raspberry Pis Cluster</title>
	<script src="js/jquery-2.1.1.min.js"></script>
	<script src="js/script.js"></script>
	<script src="packaged/javascript/semantic.js"></script>
	<script type="text/javascript">
	function InputChecker()
	{
	    if(document.getElementById('username').value == '' || document.getElementById('password').value == '')  {
	        alert("Please input both username and password");
	        return false;    
	    } else if(document.getElementById('username').value.length < 6) {
	    	alert("Please input more than 6 characters for username");
	        return false; 
	    } else if(document.getElementById('password').value.length < 6 || document.getElementById('password').value.length > 12) {
	    	alert("Please input 6-12 characters for password");
	        return false;
	    } else {
	    	return true;
	    }

	}
	</script>
<link rel="stylesheet" type="text/css" href="css/web.css">
<link rel="stylesheet" type="text/css" href="packaged/css/semantic.css">
</head>
<body>

	<div class = "main"style="clear:both" >

		<div class = "headPane">
			<!--
			<button class="configButton" type="button"><a href="configuration.php">Configuration</a></button>
			
			<form class = "loginForm" action="checklogin.php" method="POST">
				Username: <input type="text" name="username" id="username">
				Password: <input type="password" name="password" id="password">
				<input type="submit" value="Login">
				<br>
				<a style="float:right; color:white"href="requestaccount.php">Request an account</a>
			</form>-->
			
			<div class="ui ribbon label">Raspberry Pi Cluster</div>

			<a href="index.php"><h2 style="color:white; margin-left:80px; font-size:35px"><i class="laptop big icon"></i><ins><em>Cluster For Education</em></ins></h2></a>
			<h3 style="margin-left:80px;margin-top: -35px; padding-bottom:20px; color:#35332e;"><em>An appropriate cluster for study many types of knowledge.</em></h3>
		</div>

		<div class = "requestPane">
			<div class="ui two column stackable grid segment" style="margin-left:50px;">
				<div class="equal height row">
					<div class="ui tertiary inverted segment column" style="padding:30px; padding-bottom: 23px; padding-left:25px">
						<form class = "requestForm" style="color:#35332e;" action="register.php" method="POST" onsubmit='return InputChecker()'>
							<h3 style="color:black; margin-left: 4px; margin-top:-10px; margin-bottom:-10px">Request an Acoount Form</h3></br>
							<div class="ui section divider"></div>
							<p style="margin-top: -12px; margin-left: 4px; color:black">Username: </p><input style="width:100%; height:25px; " type="text" name="username" id="username">
							<p style="margin-left: 4px; color:black">Password: </p><input style="width:100%; height:25px;" type="password" name="password" id="password">
							<br>
							<p>* 6-12 characters minimum for password.</p>

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