
<html>
<head>
	<title>Raspberry Pis Cluster</title>
	<script src="js/jquery-2.1.1.min.js"></script>
	<script src="js/script.js"></script>
	<script src="packaged/javascript/semantic.js"></script>
	<?php
	include('getlist.php');
	for($i = 0 ; $i < sizeof($nodeip) ; $i++){
		echo "<script type='text/javascript'>" . PHP_EOL;
		echo "$(document).ready(function() {". PHP_EOL;
    	echo "var url = 'getcpu.php?ip=' + " . "'" . $nodeip[$i] . "'" . ";". PHP_EOL;
        echo "$('#img_" . $nodename[$i] . "').show();". PHP_EOL;
        echo "$('#" . $nodename[$i] . "').load(url, function() {". PHP_EOL;
        echo "$('#img_" . $nodename[$i] . "').hide();". PHP_EOL;
        echo "});". PHP_EOL;
        echo "});". PHP_EOL;
		echo "</script>". PHP_EOL;
		echo "<script type='text/javascript'>" . PHP_EOL;
		echo "$(document).ready(function() {". PHP_EOL;
    	echo "var url = 'ssh.php?ip=' + " . "'" . $nodeip[$i] . "'" . ";". PHP_EOL;
        echo "$('#sshim_" . $nodename[$i] . "').show();". PHP_EOL;
        echo "$('#ssh_" . $nodename[$i] . "').load(url, function() {". PHP_EOL;
        echo "$('#sshim_" . $nodename[$i] . "').hide();". PHP_EOL;
        echo "});". PHP_EOL;
        echo "});". PHP_EOL;
		echo "</script>". PHP_EOL;
	}
	?>
	<script type="text/javascript">
	function InputChecker()
	{
	    if(document.getElementById('username').value == '' || document.getElementById('password').value == '')  { // not empty
	        alert("Please input both username and password"); // Pop an alert
	        return false; // Prevent form from submitting
	    }
	}
	</script>
	<link rel="stylesheet" type="text/css" href="css/web.css">
	<link rel="stylesheet" type="text/css" href="packaged/css/semantic.css">
	
</head>
<body>

	<div class = "main"style="clear:both" >

		<div class = "headPane">
			<?php
			include('loggedin.php');
			if(check() && $_SESSION['class'] == 1) {
				echo "<button class='configButton' type='button'><a href='logout.php'>Logout</a></button>";
				echo "<button class='configButton' type='button'><a href='configuration.php'>Configuration</a></button>";
				echo "<p class='loggedin'>You are logged in as: " . $_SESSION['username'] . "</p>";
			} 
			else if(check() && $_SESSION['class'] == 0){
				echo "<button class='configButton' type='button'><a href='logout.php'>Logout</a></button>";
				echo "<p class='loggedin'>You are logged in as: " . $_SESSION['username'] . "</p>";
			}
			else {
				echo "<form class = 'loginForm' action='checklogin.php' onsubmit='InputChecker()' method='POST'>";
				echo "Username: <input type='text' name='username' id='username'>";
				echo "Password: <input type='password' name='password' id='password'>";
				echo "<input type='submit' value='Login'>";
				echo "<br>";
				echo "<a style='float:right; color:white' href='requestaccount.php'>Request an account</a>";
				echo "</form>";
			}
			?>
			
			
			<div class="ui ribbon label">Raspberry Pi Cluster</div>
			<a href="index.php"> <h2 style="color:white; margin-left:80px; font-size:35px"><i class="laptop big icon"></i><ins><em>Cluster For Education</em></ins></h2></a>
			<h3 style="margin-left:80px;margin-top: -35px; padding-bottom:20px; color:#35332e;"><em>An appropriate cluster for study many types of knowledge.</em></h3>
		</div>


		<div class = "statusTable">
			<div class="ui segment">
				<div class="ui tertiary inverted segment"><h3 align="center" style="color:black">The Status of each node in the Raspberry Pi Cluster.</h3></div>
				<table class="ui secondary inverted table segment">
					<thead>
						<tr>
							<th>NODE NAME</th>
							<th>IP</th>
							<th>CPU</th>
							<th>WORK</th>
							<!--<th>Detail</th>-->
							<th>SSH</th>
							<!--<th>SSH with GUI</th>-->
						</tr>
					</thead>
					<tbody>
						<?php
						include('maintable.php');
						?>
					</tbody>
				</table>
			</div>
		</div>
		<div class ="uploadPane">
			<div class="ui inverted segment">
				<h3><ins>Upload File</ins> <i class="file outline icon"></i></h3>
				<form action="uploadfile.php" method="POST" enctype="multipart/form-data">
					<ul style="list-style-type:none">
							<!--Generate Selection-->
							<?php
							include('getlist.php');
							if(check()){
								echo "Select a file: <input type='file' name='file' id='file'>";
								echo "<li><input type='radio' name='to' value='all'> All</li>";
								echo "<li><input type='radio' name='to' value='spec' class = 'specNode'> Specify nodes(s)</li>";
								echo "<ul style='list-style-type:none'>";
								for($i = 0 ; $i < sizeof($nodeip) ; $i++){
									echo "<li><input type='checkbox' name='node[]' value='" . $nodeip[$i] . "'>" . $nodename[$i] . "</li>";
								} 
								echo "<input type='submit' value='Upload' id='upload' name='upload'>";
							}	else {
									echo "You have no permission to upload! Please Login";
								}

							?>
						</ul>
					</ul>
				</form>
			</div>
		</div>
	</div>
</body>
</html>

