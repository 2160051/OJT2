<?php
	include 'includes/connection.php';

	session_start();
	$user = $_SESSION['user'];
	$fsic_no = $_GET['fsicNo'];
	$orig_fsic = $_GET['fsicNo'];
	$orig_or = "";
	$amount = $_GET['amount'];
	$pay_Date = $_GET['payDate'];
	$date_received = $_GET['dateReceived'];
	$date_released = $_GET['dateReleased'];
	$name_of_business = $_GET['nameOfBusiness'];
	$type_of_business = $_GET['typeOfBusiness'];
	$name_owner = $_GET['nameOwner'];

	if ($_GET['orNo'] == "") {
		$or_no = "None";
	}else{
		$or_no = $_GET['orNo'];
		$orig_or = $_GET['orNo'];
	}
	
	if ($_GET['remarks'] == "Not Stated") {
		$remarks = "";
	}else{
		$remarks = $_GET['remarks'];
	}

	if ($_GET['new'] == "Not Stated") {
		$new = "";
	}else{
		$new = "checked";
	}

	$query = "SELECT profilepicture from client WHERE id = '".$_SESSION['user']."';";
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
	<title>FSIC | Edit Document</title>
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

	<div style="margin-top: 3%;font-size: 32px;text-align: center;">Edit FSIC Document</div>
	<div style="margin:0 auto;margin-top: 2%;font-size: 14px;width: 35%;">
		<form action="editProcess.php" method="POST">
	        	 <div class="form-group">
				  <div style="text-align: center;">
					  <b>FSIC #:</b>&nbsp;&nbsp;&nbsp;<input type="number" class="form-control" id="schedule" name="fsicNo" min="1" max="10000" style="width: 25%;" value="<?php echo $fsic_no; ?>" required>&nbsp;&nbsp;&nbsp;<b>OR #:</b>&nbsp;&nbsp;&nbsp; 
					  <input type="number" class="form-control" id="schedule" name="orNo" min="1" max="10000" value="<?php echo $or_no; ?>" style="width: 25%;">
					  <input type="hidden" class="form-control" name="origFSIC" value="<?php echo $orig_fsic; ?>" required>
					  <input type="hidden" class="form-control" name="origOR" value="<?php echo $orig_or; ?>" required>
				  </div>
				 </div>
				 <div class="form-group">
				  <label for="nameOfBusiness">Name of Business:</label>
				  <input type="text" class="form-control" id="nameOfBusiness" name="nameOfBusiness" maxlength="120" value="<?php echo $name_of_business; ?>" required>
				 </div>
				 <div class="form-group">
				  <label for="typeOfBusiness">Type of Business:</label>
				  <input type="text" class="form-control" id="typeOfBusiness" name="typeOfBusiness" maxlength="120" value="<?php echo $type_of_business; ?>" required>
				 </div>
				 <div class="form-group">
				  <label for="nameOwner">Owner:</label>
				  <input type="nameOwner" value="<?php echo $name_owner; ?>" class="form-control" id="nameOwner" name="nameOwner" maxlength="80" required>
				 </div>
				 <div class="form-group">
				  <div style="text-align: center;">
					  Received:&nbsp;&nbsp;<input type="date" class="form-control" id="schedule" name="dateReceived" style="width: 28%;" value="<?php echo $date_received; ?>" required>&nbsp;&nbsp;&nbsp;Released:&nbsp;&nbsp; 
					  <input type="date" class="form-control" id="schedule" name="dateReleased" style="width: 28%;" value="<?php echo $date_released; ?>" required>
				  </div>
				 </div>
				 <div class="form-group">
			    <div style="text-align: center;">
					  Amount to be Paid:&nbsp;&nbsp;<input type="number" name="amount" value="<?php echo $amount; ?>" min="0" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" id="schedule" required style="width: 23%;" />&nbsp;&nbsp;&nbsp;&nbsp;Date Paid:&nbsp;&nbsp;&nbsp; 
					  <input type="date" class="form-control" id="schedule" name="payDate" style="width: 28%;" value="<?php echo $pay_Date; ?>" required>
				  </div>
				 </div>
				 <div class="form-group">
				  <label for="remarks">Remarks:</label>
				  <textarea class="form-control" rows="5" maxlength='500' name='remarks' style="resize: none;"><?php echo $remarks; ?></textarea>
				 </div>
				 <div class="checkbox">
				  <label>
				  <input type="checkbox" <?php echo $new; ?> id="new" name="new">New
				  </label>
				 </div>
				<div style="float: right;">
					<input type="submit" class="btn btn-default btn-md" formaction="client.php" value="Go Back" />
					<input type="submit" class="btn btn-primary btn-md" value="Submit" />
				</div>
	          	</form>
	</div>
</body>
</html>