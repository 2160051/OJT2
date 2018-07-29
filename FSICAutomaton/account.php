<?php
    include 'includes/connection.php';
    session_start();
    if(!isset($_SESSION['user'])){
    	header('Location: index.php');
	}else{
		$query = "SELECT * from admin WHERE id = '".$_SESSION['user']."';";
		$result = mysqli_query($conn, $query);
		$count = mysqli_num_rows($result);

		if($count >= 1){
			header('Location: admin.php');
		}
	}

	$query = "SELECT * from client WHERE id = '".$_SESSION['user']."';";
	$result = mysqli_query($conn, $query);
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		$profile = $row['profilepicture'];
		$name = $row['firstName']." ".$row['lastName'];
		$fname = $row['firstName'];
		$lname = $row['lastName'];
		$position = $row['position'];
		$contact_no = $row['contactNo'];
	}

	$profile = "images/profilepictures/".$profile;
?>
<!DOCTYPE HTML>
<html style="overflow: scroll;">
<head>
	<meta charset="UTF-8">
	<title>FSIC | Account</title>
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
						<li style="padding-top: 14px;padding-bottom: 14px;"><a href="client.php"><span class="glyphicon glyphicon-home"></span>&nbsp;&nbsp;Home</a></li>
						<li style="padding-top: 14px;padding-bottom: 14px;"><a href="payments.php"><span class="glyphicon glyphicon-folder-close"></span>&nbsp;&nbsp;Payments</a></li>
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#"><img src="<?php echo $profile; ?>" style="width: 50px;height: 50px;border-radius: 50%;" alt="Profile" /></a>
							<ul class="dropdown-menu" style="background-color: #444;">
								<li><a href="account.php"><span class="glyphicon glyphicon-cog" style="color:#fff;"></span>&nbsp;&nbsp;Account</a></li>
								<li><a href="logout.php"><span class="glyphicon glyphicon-log-out" style="color:#fff;"></span>&nbsp;&nbsp;Logout</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>

		<div style="margin-top: 3%;font-size: 32px;text-align: center;">Account Settings 
		<br>
		</div>

		<div class="centered" style="margin-top: 5%;">
			<button id="inputAsLink"  data-toggle="modal" data-target="#profModal" style="border:none;font-size: 16px;">
				<div class="profImg" style="background: url(<?php echo $profile; ?>);background-size: contain;">
				</div>
				<span>Change Profile</span>
			</button>

			<span style="width: 3%;"></span>

			<div style=" display: inline-block;width: 31%;">
				<ul class="list-group" style="font-size: 16px;">
				  <li class="list-group-item"><span class="glyphicon glyphicon-user" style="color:#fc3131"></span>&nbsp;&nbsp;&nbsp;Name<span style="float: right;"><?php echo $name; ?></span></li>
				  <li class="list-group-item"><span class="glyphicon glyphicon-lock" style="color:#fc3131"></span>&nbsp;&nbsp;&nbsp;ID<span style="float: right;"><?php echo $_SESSION['user']; ?></span></li>
				  <li class="list-group-item"><span class="glyphicon glyphicon-briefcase" style="color:#fc3131"></span>&nbsp;&nbsp;&nbsp;Position<span style="float: right;"><?php echo $position; ?></span></li>
				  <li class="list-group-item"><span class="glyphicon glyphicon-phone" style="color:#fc3131"></span>&nbsp;&nbsp;&nbsp;Contact #<span style="float: right;"><?php echo $contact_no; ?></span></li>
				</ul>
			</div>
		</div>
		<div class="centered" style="margin-left: -8%;">
				<button class="btn btn-default btn-lg" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-edit" style="color:#444"></span>&nbsp;&nbsp;&nbsp;Edit</button>
		</div>

		<div class="modal fade" id="myModal" role="dialog">
		    <div class="modal-dialog">   
		      <div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal">&times;</button>
		          <h4 class="modal-title"><b>Update Account Info</b></h4>
		        </div>
		        <div class="modal-body">
		          <form action="editClientInfo" method="POST">
		        	 <div class="form-group">
					  <label for="firstName">First Name:</label>
					  <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo $fname; ?>" maxlength="120" required>
					 </div>
					 <div class="form-group">
					  <label for="lastName">Last Name:</label>
					  <input type="text" class="form-control" id="lastName" name="lastName" maxlength="120" value="<?php echo $lname; ?>" required>
					 </div>
					 <div class="form-group">
					  <label for="id">ID:</label>
					  <input type="text" class="form-control" id="id" name="id" maxlength="45" value="<?php echo $_SESSION['user']; ?>" required>
					 </div>
					 <div class="form-group">
					  <label for="position">Position:</label>
					  <input type="text" class="form-control" id="position" name="position" maxlength="120" value="<?php echo $position; ?>" required>
					 </div>
					 <div class="form-group">
					  <label for="contactNo">Contact #:</label>
					  <input type="text" class="form-control" id="contactNo" name="contactNo" value="<?php echo $contact_no; ?>" maxlength="11" minlength="11" required>
					 </div>
					 <div class="form-group">
					  <label for="password" id="newpass">Old Password:</span></label>
					  <input type="password" class="form-control" id="password" name="passwordOld" maxlength="32" required>
					 </div>
					 <div class="form-group">
					  <label for="password" id="confirmnewpass">New Password:</label>
					  <input type="password" class="form-control" id="password" name="passwordFin" maxlength="32" required>
					 </div>
					 <input type="hidden" name="editAccount" value="true" />
					<input type="submit" class="btn btn-primary btn-md" value="Submit" />
		          	<button type="button" class="btn btn-default btn-md" data-dismiss="modal">Close</button>
		          	</form>
		        </div>
		      </div>
		    </div>
		  </div>

		  <div class="modal fade" id="profModal" role="dialog">
		    <div class="modal-dialog">   
		      <div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal">&times;</button>
		          <h4 class="modal-title"><b>Change Profile Picture</b></h4>
		        </div>
		        <div class="modal-body">
		          <form action="editClientInfo" method="POST" enctype="multipart/form-data">
		          	Select image to upload:
    				<input type="file" name="fileToUpload" id="fileToUpload">
					 <input type="hidden" name="editProfile" value="true" />
					<input type="submit" name="submit" class="btn btn-primary btn-md" value="Submit" />
		          	<button type="button" class="btn btn-default btn-md" data-dismiss="modal">Close</button>
		          	</form>
		        </div>
		      </div>
		    </div>
		  </div>

		<script>
			
		</script>
	</body>
</html>