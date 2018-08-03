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
	<title>FSIC | Home</title>
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


		<ul class="nav nav-tabs" style="margin-top: 2%;" id="tabAccount">
		    <li><a data-toggle="tab" href="#account" class="active">User Accounts</a></li>
		    <li><a data-toggle="tab" href="#acctRequest">Account Requests</a></li>
		</ul>

		<div class="tab-content">
		    <div id="account" class="tab-pane fade active in" style="text-align: center;margin-top: 3%;font-size: 24px;">
		    	User Accounts
		    	<div class="centered" style="margin-top: 2%;">
		    		<?php 
		    			$query = "SELECT * from client WHERE status != 'Pending';";
		    			$result = mysqli_query($conn, $query);
		    			$ctr = 1;

		    			while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
							if($ctr == 1){
								echo '<div class="card-c" style="display:inline-block;">
									<form method="POST" style="font-size:16px;">
										<button type="submit" formaction="documents.php" class="buttonLinkTwo" style="font-size:16px;">
										<input type="hidden" name="user" value="'.$row['id'].'" />
										 <img src="images/profilepictures/'.$row['profilepicture'].'" style="width: 100px;height: 100px;border-radius: 50%;" alt="Profile" />
										 <br><br>
										 	<b>'.$row['firstName'].' '.$row['lastName'].'</b>
										 </button><br>
										 	'.$row['id'].'<br>
										 	'.$row['position'].'<br><br>';
								if($row['status'] == "Active"){
									echo '<button class="btn btn-warning" style="width: 80%;">Disable Account</button>';
								}else if($row['status'] == "Disabled"){
									echo '<button class="btn btn-default" style="width: 80%;">Activate Account</button>';
								}
								echo '</form> 
									  </div>';
							}else if($ctr > 1){
								echo '<div class="card-c" style="display:inline-block;margin-left: 3%;">
									<form method="POST" style="font-size:16px;">
										<button type="submit" formaction="documents.php" class="buttonLinkTwo" style="font-size:16px;">
										<input type="hidden" name="user" value="'.$row['id'].'" />
										 <img src="images/profilepictures/'.$row['profilepicture'].'" style="width: 100px;height: 100px;border-radius: 50%;" alt="Profile" />
										 <br><br>
										 	<b>'.$row['firstName'].' '.$row['lastName'].'</b>
										 </button><br>
										 	'.$row['id'].'<br>
										 	'.$row['position'].'<br><br>';
								if($row['status'] == "Active"){
									echo '<button class="btn btn-warning" style="width: 80%;">Disable Account</button>';
								}else if($row['status'] == "Disabled"){
									echo '<button class="btn btn-default" style="width: 80%;">Activate Account</button>';
								}
								echo '</form> 
									  </div>';
							}

							$ctr++;
						}
		    		?>
		    	</div>
		    </div>
		    <div id="acctRequest" class="tab-pane fade">
		      	<div class="centered" style="margin-top: 3%;font-size: 24px;">Account Requests
		      		<?php 

		    		?>
		    	</div>
		    </div>
		</div>
	<script>
		$(document).ready(function(){
			$('#tabAccount a:first').tab('show');
		});
	</script>
	</body>
</html>