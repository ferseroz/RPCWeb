
<html>
<head>
	<title>Raspberry Pis Cluster</title>
	<script src="js/jquery-2.1.1.min.js"></script>
	<script src="js/script.js"></script>
	<script src="packaged/javascript/semantic.js"></script>
	<script type="text/javascript">
        $(document).ready(function() {
        	//$('#LoadPage').hide();
        	var div = document.getElementById('ip');
        	var ip = div.textContent;
        	var url = "getcpu.php?ip=" + ip;
            $("#imgProg").show();
            $('#LoadPage').load(url, function() {
                $("#imgProg").hide();
            });
           // $("#imgProg").hide();
            //$("#LoadPage").show();
        });
    </script>
	<link rel="stylesheet" type="text/css" href="css/web.css">
	<link rel="stylesheet" type="text/css" href="packaged/css/semantic.css">
	
</head>
<?php
	if($_SESSION['class'] = 1){
		echo '<script type="text/javascript">'
   , 'adminLogin();'
   , 'alert("test");'
   , '</script>'
;
	}

?>

<body>

	<div class = "main"style="clear:both" >

		<div class = "headPane">
			<?php
			include('loggedin.php');
			if(check()) {

				echo "<p class='text-right'>You are logged in as: " . $_SESSION['username'] . "</p>";
				echo "<button class='configButton' type='button'><a href='configuration.php'>Configuration</a></button>";
			}
			else {
				echo "<form class = 'loginForm' action='checklogin.php' method='POST'>";
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
							<th>SSH with GUI</th>
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
						Select a file: <input type="file" name="file" id="file">
						<li><input type="radio" name="to" value="all"> All</li>
						<li><input type="radio" name="to" value="spec" class = "specNode"> Specify nodes(s)</li>
						<ul style="list-style-type:none">
							
							<!--Generate Selection-->
							<?php
							include('getlist.php');
							for($i = 0 ; $i < sizeof($nodeip) ; $i++){
								echo "<li><input type='checkbox' name='node[]' value='" . $nodeip[$i] . "'>" . $nodename[$i] . "</li>";
							}
							?>

							<input type="submit" value="Upload" id="upload" name="upload">
						</ul>
					</ul>
				</form>
			</div>
		</div>
	</div>
</body>
</html>

