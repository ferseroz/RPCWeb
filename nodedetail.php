<!DOCTYPE html>
<html>
<head>
	<title>Raspberry Pis Cluster</title>
	<script src="js/jquery-2.1.1.min.js"></script>
	<script src="js/script.js"></script>
	<script src="packaged/javascript/semantic.js"></script>
	<?php
	$ip = $_GET['ip'];
	echo "<script type='text/javascript'>" . PHP_EOL;
	echo "$(document).ready(function() {". PHP_EOL;
	echo "var url = 'getcpu.php?ip=' + " . "'" . $ip . "'" . ";". PHP_EOL;
	echo "$('#img').show();". PHP_EOL;
	echo "$('#node').load(url, function() {". PHP_EOL;
	echo "$('#img').hide();". PHP_EOL;
	echo "});". PHP_EOL;
	echo "});". PHP_EOL;
	echo "</script>". PHP_EOL;
	echo "<script type='text/javascript'>" . PHP_EOL;
	echo "$(document).ready(function() {". PHP_EOL;
	echo "var url = 'ssh.php?ip=' + " . "'" . $ip . "'" . ";". PHP_EOL;
	echo "$('#sshimg').show();". PHP_EOL;
	echo "$('#ssh').load(url, function() {". PHP_EOL;
	echo "$('#sshimg').hide();". PHP_EOL;
	echo "});". PHP_EOL;
	echo "});". PHP_EOL;
	echo "</script>". PHP_EOL;
	?>
	<script type='text/javascript'>
	$(document).ready(function() {
		$('#frameNode').hide();
		$('#ui segment').hide();
		$('#frame').hide();
	});
	</script>
	<script type='text/javascript'>
	$(document).ready(function(){
  		$('#ssh').click(function(){
  			document.getElementById('frame').innerHTML = "<iframe src='<?php echo 'http://' . $ip . ':4200'; ?>' frameborder='0' width='800px' height='450px' visible='false'>";
			$('#frameNode').show();
			$('#ui segment').show();
			$('#frame').show();
  		});
	});
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
				echo "<script language='javascript' type='text/javascript'>";
				echo "alert('You have not logged in!');";
				echo "window.location = 'index.php';";
				echo "</script>";
				//header("location: index.php");
			}
			?>
			
			<div class="ui ribbon label">Raspberry Pi CLuster</div>
			<a href="index.php"><h2 style="color:white; margin-left:80px; font-size:35px"><i class="laptop big icon"></i><ins><em>Cluster For Education</em></ins></h2></a>
			<h3 style="margin-left:80px;margin-top: -35px; padding-bottom:20px; color:#35332e;"><em>An appropriate cluster for study many types of knowledge.</em></h3>
		</div>

		<div class="ui two column grid segment">
			<div class="equal height row">
				<div class="column" style="background-color:#b2d0cc">
					<div class = "tableNode" >
						<div class="ui segment" style="padding-bottom:8px">
							<div class="ui tertiary inverted segment">
								<h3 align="center" style="color:black">Node details</h3>
							</div>
							<table class="ui secondary inverted table segment">
								<?php
								include('getdetail.php');
								?>
							</table>
							<div class="ui horizontal icon divider">
							<i class="circular settings icon"></i>
							</div>
						</div>
					</div>
				</div>

				<div class="column" style="background-color:#b2d0cc">
					<?php
					switch($row['work']){
						case 0:
							echo "Not Working"; break;
						case 1:
							echo "Parallel"; break;
						case 2:
							echo "Hadoop"; break;
						case 3:
							echo "both"; break;
					}

					echo "<div id='frameNode' class='frameNode' visible='false'>";
					echo "<div id='ui segment' class='ui segment' style='padding:5px'>";
					echo "<div id='frame' class= 'frame' style='float:center' visible='false'>";
					echo "<iframe src='' frameborder='0' width='800px' height='450px' visible='false'>";
					echo "</iframe></div></div></div>";
					?>
				</div>
			</div>
		</div>
		
	</div>
</body>
</head>