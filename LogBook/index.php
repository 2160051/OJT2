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
		<link rel="icon" href="images/bfp.png">
		<title>BFP | LogBook</title>
	</head>

	<body>
		<div class="hedatu">
			<div><b>BFP | <span>LogBook</b></span></div>
		</div>
		<br>
		<div class="id">
			<form method="POST">
				<input type="text" placeholder="ID" name="user" class="user" style="width: 25%;margin: 0 auto;"><br>
				<div style="margin: 0 auto; width: 40%;display: flex;justify-content: center;align-items: center;">
					<input type="submit" formaction="timeIn.php" value="Time In" class="loginButton" style="width: 28%; display: inline-block;background-color: rgba(0, 252, 42, 0.8); color:white;">
					<input type="submit" formaction="timeOut.php" value="Time Out" class="loginButton" style="margin-left: 5%;width: 28%; display: inline-block;background-color:rgba(250, 45, 45, 0.8);color:white;">
				</div>
				<input type='submit' class="buttonLink" value="Log In As Admin" formaction="login.php">
			</form>		
		</div>
	</body>
</html>