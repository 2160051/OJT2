<?php
    include 'includes/connection.php';
    session_start();
    if(!isset($_SESSION['user'])){
    	header('Location: index.php');
	}else{
		$query = "SELECT * from client WHERE id = '".$_SESSION['user']."';";
		$result = mysqli_query($conn, $query);
		$count = mysqli_num_rows($result);

		if($count >= 1){
			header('Location: client.php');
		}
	}

	$query = "SELECT profilepicture from admin WHERE id = '".$_SESSION['user']."';";
	$result = mysqli_query($conn, $query);
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		$profile = $row['profilepicture'];
	}

	$profile = "images/profilepictures/".$profile;
?>
<!DOCTYPE HTML>
<html style="overflow: scroll;">
<head>
	<meta charset="UTF-8">
	<title>FSIC | Change Password</title>
	<meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="HandheldFriendly" content="true">
  	<script src='js/jquery-3.3.1.js'></script>
  	<link rel='stylesheet prefetch' href='css/bootstrap.min.css'>
	<link rel='stylesheet prefetch' href='css/dataTables.bootstrap.min.css'>
	<link rel='stylesheet prefetch' href='css/buttons.bootstrap.min.css'>
	<link rel="stylesheet" href="css/styles.css">
  	<script src="js/jquery.min.js"></script>
  	<script src="js/bootstrap.min.js"></script>
	<link rel="icon" href="images/fsic.ico">
</head>
	<body style="background: none;">

		<nav class="navbar navbar-inverse" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-navbar-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="client.php"><img src="images/logo2.png" alt="FSIC" height="35" /></a>
				</div>
				<div class="collapse navbar-collapse" id="top-navbar-1">
					<ul class="nav navbar-nav navbar-right">
						<li style="padding-top: 14px;padding-bottom: 14px;"><a href="client.php" style="border: 0;"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;Home</a></li>
						<li style="padding-top: 14px;padding-bottom: 14px;"><a href="documents.php" style="border: 0;"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp;Documents</a></li>
						<li style="padding-top: 14px;padding-bottom: 14px;"><a href="payment.php"><span class="glyphicon glyphicon-folder-close"></span>&nbsp;&nbsp;Payments</a></li>
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#"><img src="<?php echo $profile; ?>" style="width: 50px;height: 50px;border-radius: 50%;" alt="Profile" /></a>
							<ul class="dropdown-menu" style="background-color: #444;">
								<li><a href="manage.php"><span class="glyphicon glyphicon-cog" style="color:#fff;"></span>&nbsp;&nbsp;Manage User Accounts</a></li>
								<li><a href="accountSettings.php"><span class="glyphicon glyphicon-cog" style="color:#fff;"></span>&nbsp;&nbsp;Account Settings</a></li>
								<li><a href="logout.php"><span class="glyphicon glyphicon-log-out" style="color:#fff;"></span>&nbsp;&nbsp;Logout</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>

		<div class="centered">
			<div class="card-c" style="padding: 30px; margin-top: 4%;width: 30%; height: auto;display: inline;text-align: center;font-size: 14px;">
				<img src="images/password.png" width="150" /><br><br>
				<form action="editPass.php" method="POST" style="text-align: left;">
					<div class="form-group">
					  <label for="oldPass">Confirm Old Password:</label>
					  <input type="password" class="form-control" id="oldPass" name="oldPass" maxlength="32" required>
					 </div>
					 <div class="form-group">
					  <label for="newPass">New Password:</label>
					  <input type="password" class="form-control" id="newPass" name="newPass" maxlength="32" required>
					 </div>
					 <div class="form-group">
					  <label for="reNewPass">Re-Type New Password:</label>
					  <input type="password" class="form-control" id="reNewPass" name="reNewPass" maxlength="32" onkeyup="checkPass(); return false;" required>
					  <span id="notif" class="notif"></span>
					 </div>
					 <input type="submit" class="btn btn-primary btn-md" value="Submit" />
				</form>
			</div>
		</div>
		<script>
			function checkPass(){
			    var newPass = document.getElementById('newPass');
			    var reNewPass = document.getElementById('reNewPass');
			    var message = document.getElementById('notif');
			    var correct = "#75d635";
			    var wrong = "#ff6868";

			    if(newPass.value == reNewPass.value){
			        reNewPass.style.backgroundColor = correct;
			        message.style.color = correct;
			        message.innerHTML = "Passwords Match!"
			    }else{
			        reNewPass.style.backgroundColor = wrong;
			        message.style.color = wrong;
			        message.innerHTML = "Passwords Do Not Match!"
			    }
			}  
		</script>
	</body>
</html>