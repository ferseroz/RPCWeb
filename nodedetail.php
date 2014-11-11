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

					//echo "<div class='frameNode'>";
					//echo "<div class='ui segment' style='padding:5px'>";
					//echo "<div class= 'frame' style='float:center'>";
					//echo "<iframe src='http://www.google.com' frameborder='0' width='800px' height='450px'>";
					//echo "</iframe></div></div></div>";
					?>
				</div>
			</div>
		</div>
		
	</div>
</body>
</head>