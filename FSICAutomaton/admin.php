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

	$num_rec = 0;
    $num_fo = 0;
    $num_insp = 0;
    $num_intern = 0;
    $num_others = 0;

    $query = "SELECT * from client;";
    $result = mysqli_query($conn, $query);
    $num_rec = mysqli_num_rows($result);

    $query = "SELECT * from client WHERE position LIKE '%Fire Officer%' OR position LIKE '%fire officer%';";
    $result = mysqli_query($conn, $query);
    $num_fo = mysqli_num_rows($result);

    $query = "SELECT * from client WHERE position LIKE '%Inspector%' OR position LIKE '%inspector%';";
    $result = mysqli_query($conn, $query);
    $num_insp = mysqli_num_rows($result);

    $query = "SELECT * from client WHERE position LIKE '%Intern%' OR position LIKE '%intern%';";
    $result = mysqli_query($conn, $query);
    $num_intern = mysqli_num_rows($result);

    $query = "SELECT * from client WHERE position NOT LIKE '%Intern%' AND position NOT LIKE '%intern%' AND position NOT LIKE '%Inspector%' AND position NOT LIKE '%inspector%' AND position NOT LIKE '%Fire Officer%' AND position NOT LIKE '%fire officer%';";
    $result = mysqli_query($conn, $query);
    $num_others = mysqli_num_rows($result);
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
						<li style="padding-top: 14px;padding-bottom: 14px;"><a href="client.php" style="color: #444; border: 0;"><span class="glyphicon glyphicon-home" style="color:#444"></span>&nbsp;&nbsp;Home</a></li>
						<li style="padding-top: 14px;padding-bottom: 14px;"><a href="documents.php" style="border: 0;"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp;Documents</a></li>
						<li style="padding-top: 14px;padding-bottom: 14px;"><a href="payment.php"><span class="glyphicon glyphicon-folder-close"></span>&nbsp;&nbsp;Payments</a></li>
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#"><img src="<?php echo $profile; ?>" style="width: 50px;height: 50px;border-radius: 50%;" alt="Profile" /></a>
							<ul class="dropdown-menu" style="background-color: #444;">
								<li><a href="manage.php"><span class="glyphicon glyphicon-cog" style="color:#fff;"></span>&nbsp;&nbsp;Manage User Accounts</a></li>
								<li><a href="accountSettings.php"><span class="glyphicon glyphicon-cog" style="color:#fff;"></span>&nbsp;&nbsp;Change Password</a></li>
								<li><a href="logout.php"><span class="glyphicon glyphicon-log-out" style="color:#fff;"></span>&nbsp;&nbsp;Logout</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>

		<div class="dashContainer" style="margin-top: 4%;">
			<div class="card card-a" style="display: inline-block;width:23%; height: auto; padding:30px;">
				<img src="images/clipboard.png" width="50" style="vertical-align: middle;margin-bottom: 0.75em;" alt="Records">
		          <a href="records" style="text-decoration: none;"><span style="font-size: 24px;">Records</span></a>
		          <h1 style="text-align: center;"><?php echo $num_rec; ?></h1><br>
		          
		          <div id="wrap">
				    <div id="left_col">
				        Inspector<br><br>
				        Fire Officer<br><br>
				        Intern<br><br>
				        Others
				    </div>
				    <div id="right_col">
				    	<form action="manage.php" method="GET">
				    		<input type="hidden" name="choice" value="inspector">
				    		<input type="submit" id="inputAsLink" name="val" value="<?php echo $num_insp; ?>"><br><br>
				    	</form>
				    	<form action="manage.php" method="GET">
				    		<input type="hidden" name="choice" value="fireOfficer">
				    		<input type="submit" id="inputAsLink" name="val" value="<?php echo $num_fo; ?>"><br><br>
				    	</form>
				    	<form action="manage.php" method="GET">
				    		<input type="hidden" name="choice" value="intern">
				    		<input type="submit" id="inputAsLink" name="val" value="<?php echo $num_intern; ?>"><br><br>
				    	</form>
				    	<form action="manage.php" method="GET">
				    		<input type="hidden" name="choice" value="others">
				    		<input type="submit" id="inputAsLink" name="val" value="<?php echo $num_others; ?>">
				    	</form>
				    </div>
				</div>
		</div>
	</body>
</html>