<?php
    include 'includes/connection.php';
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
		<meta name="HandheldFriendly" content="true">
		<link rel="stylesheet" href="css/styles.css">
		<link rel="icon" href="images/fsic.ico">
		<title>FSIC | Login</title>
	</head>

	<body>
		<div class="hedatu">
			<img src="images/logo.png" alt="FSIC Automaton" width="220" style="margin:0 auto;" />
		</div>
		<div class="id">
			<form method="POST">
				<div style="margin: 0 auto;text-align: center; font-size: 18px;"><label for="user">ID</label></div>
				<input type="text" name="user" class="user" style="width: 25%;margin: 0 auto; color: black;"><br>
				<div style="margin: 0 auto;text-align: center; font-size: 18px;"><label for="password">Password</label></div>
				<input type="password" name="password" class="user" style="width: 25%;margin: 0 auto; color: black;"><br>
				<div style="margin: 0 auto; width: 40%;display: flex;justify-content: center;align-items: center;">
					<input type="submit" formaction="login.php" value="Login" class="loginButton" style="width: 28%; display: inline-block;background-color: #fc4c3f; color:white;">
				</div>
				<div style="margin: 0 auto;text-align: center;"><input type='submit' class="buttonLink" value="Request for an Account" formaction="login.php"></div>
			</form>		
		</div>
	</body>
</html>