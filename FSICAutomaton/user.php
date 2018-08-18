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

	$user_profile = $_GET['profile'];
	$user_clicked = $_GET['user'];
	$name = "";
	$id = "";
	$contact = "";
	$position = "";
	$status = "";

	$query = "SELECT * FROM client WHERE id = '$user_clicked';";
	$result = mysqli_query($conn, $query);
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		$name = $row['firstName']." ".$row['lastName'];
		$id = $row['id'];
		$contact = $row['contactNo'];
		$position = $row['position'];
		$status = $row['status'];
	}
?>
<!DOCTYPE HTML>
<html style="overflow: scroll;">
<head>
	<meta charset="UTF-8">
	<title>FSIC | User</title>
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
								<li><a href="accountSettings.php"><span class="glyphicon glyphicon-cog" style="color:#fff;"></span>&nbsp;&nbsp;Change Password</a></li>
								<li><a href="logout.php"><span class="glyphicon glyphicon-log-out" style="color:#fff;"></span>&nbsp;&nbsp;Logout</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>

		<div style="width:20%;height:auto;margin-top: 2%;text-align: center;border-right: 2px solid #9a9999;font-size: 18px;">
			<img src="<?php echo 'images/profilepictures/'.$user_profile; ?>" style="width: 150px;height: 150px;border-radius: 10%;display: inline;" alt="Profile" /><br><br>
			<table class="centered">
				<tr>
					<td>
						<?php echo $name ?>
					</td>
				</tr>
				<tr>
					<td>
						<?php echo $id ?>
					</td>
				</tr>
				<tr>
					<td>
						<?php echo $position ?>
					</td>
				</tr>
				<tr>
					<td>
						<?php echo $contact ?>
					</td>
				</tr>
				<tr>
					<td>
						<form method="GET" style="font-size:16px;">
						<?php 
							if($status == "Active"){
								echo '<form>
									<input type="hidden" name="user" value="'.$id.'" />
									<input type="hidden" name="profile" value="'.$_GET['profile'].'" />
									<input type="hidden" name="process" value="disable" />
									<button type="submit" formaction="processor.php" class="btn btn-warning" style="width: 80%;">Disable Account</button>
									</form>';
							}else if($status == "Disabled"){
								echo '<form>
									<input type="hidden" name="user" value="'.$id.'" />
									<input type="hidden" name="profile" value="'.$_GET['profile'].'" />
									<input type="hidden" name="process" value="activate" />
									<button type="submit" formaction="processor.php" class="btn btn-info" style="width: 80%;">Activate Account</button>
									</form>';
							}
						?>
						</form>
					</td>
				</tr>
			</table>
		</div>
		<div class="card-b" style="font-size: 14px;max-width:70%;position: absolute;left: 24%;top: 15%;">
			<table id="example" class="table table-striped table-bordered" cellspacing="0" width="70%">
				<thead>
					<tr>
						<th>FSIC #</th>
						<th>Business</th>
						<th>Type</th>
						<th>Owner</th>
						<th>OR #</th>
						<th>Amount Paid</th>
						<th>Received</th>
						<th>Released</th>
						<th>Remarks</th>
						<th>New</th>
						<th>Edit</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$query = "SELECT * FROM document JOIN payment USING(orNo) JOIN clientdocument USING(orNo) WHERE id = '$id' ORDER BY document.fsicNo;";
						$result = mysqli_query($conn, $query);

						while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
							$received = date('F j, Y', strtotime($row['dateReceived']));
							$released = date('F j, Y', strtotime($row['dateReleased']));
							echo '<tr>
									<form action="" method="GET" id="recordVals">
									<td>'.$row["fsicNo"].'
										<input type="hidden" name="fsicNo" value="'.$row["fsicNo"].'"></td>
									<td>'.$row["nameOfBusiness"].'
										<input type="hidden" name="nameOfBusiness" value="'.$row["nameOfBusiness"].'"></td>
									<td>'.$row["typeOfBusiness"].'
										<input type="hidden" name="typeOfBusiness" value="'.$row["typeOfBusiness"].'"></td>
									<td>'.$row["nameOwner"].'
										<input type="hidden" name="nameOwner" value="'.$row["nameOwner"].'"></td>
									<td>'.$row["orNo"].'
										<input type="hidden" name="orNo" value="'.$row["orNo"].'"></td>
									<td>'.$row["amtPaid"].'
										<input type="hidden" name="orNo" value="'.$row["orNo"].'"></td>
									<td>'.$received.'
										<input type="hidden" name="dateReceived" value="'.$row["dateReceived"].'"></td>
									<td>'.$released.'
										<input type="hidden" name="dateReleased" value="'.$row["dateReleased"].'"></td>
									<td>'.$row["remarks"].'
										<input type="hidden" name="remarks" value="'.$row["remarks"].'"></td>
									<td>'.$row["new"].'
										<input type="hidden" name="new" value="'.$row["new"].'">
									</td>
									<input type="hidden" name="payDate" value="'.$row["payDate"].'">
									<input type="hidden" name="amount" value="'.$row["amtPaid"].'">
									<td style="text-align:center;"><button type="submit" class="btn btn-default" formaction="edit" style="display: inline-block;"><span class="glyphicon glyphicon-edit"></span></button></td>
								  </tr>
								  </form>';
							}
						?>
				</tbody>
			</table>			
		</div>
		<script src='js/jquery.dataTables.min.js'></script>
		<script src='js/dataTables.buttons.min.js'></script>
		<script src='js/buttons.colVis.min.js'></script>
		<script src='js/buttons.html5.min.js'></script>
		<script src='js/buttons.print.min.js'></script>
		<script src='js/dataTables.bootstrap.min.js'></script>
		<script src='js/buttons.bootstrap.min.js'></script>
		<script src='js/jszip.min.js'></script>
		<script src='js/pdfmake.min.js'></script>
		<script src='js/vfs_fonts.js'></script>
		<script  src="js/index.js"></script>
	</body>
</html>