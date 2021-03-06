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
	<title>FSIC | Payments</title>
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
						<li style="padding-top: 14px;padding-bottom: 14px;"><a href="payments.php" style="color: #444; border: 0;"><span class="glyphicon glyphicon-folder-close" style="color:#444"></span>&nbsp;&nbsp;Payments</a></li>
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

		<div style="margin-top: 3%;font-size: 32px;text-align: center;">FSIC Payments
		<br>
		</div>

		<div style="margin: 5em;margin-top: 2%; background: none;">
		<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>OR #</th>
					<th>FSIC #</th>
					<th>Business</th>
					<th>Owner</th>
					<th>Amount Paid</th>
					<th>Date</th>
					<th>Remarks</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$query = "SELECT * FROM document JOIN payment USING(orNo) ORDER BY fsicNo;";
					$result = mysqli_query($conn, $query);

					while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
						$received = date('F j, Y', strtotime($row['dateReceived']));
						$released = date('F j, Y', strtotime($row['dateReleased']));
						echo '<tr>
								<form action="" method="GET" id="recordVals">
								<td>'.$row["orNo"].'
									<input type="hidden" name="orNo" value="'.$row["orNo"].'"></td>
								<td>'.$row["fsicNo"].'
									<input type="hidden" name="fsicNo" value="'.$row["fsicNo"].'"></td>
								<td>'.$row["nameOfBusiness"].'
									<input type="hidden" name="nameOfBusiness" value="'.$row["nameOfBusiness"].'"></td>
								<td>'.$row["nameOwner"].'
									<input type="hidden" name="nameOwner" value="'.$row["nameOwner"].'"></td>
								<td>'.$row['amtPaid'].'
									<input type="hidden" name="amount" value="'.$row["amtPaid"].'"></td>
								<td>'.$row['payDate'].'
									<input type="hidden" name="payDate" value="'.$row["payDate"].'">
								</td>
								<td>'.$row["remarks"].'
									<input type="hidden" name="remarks" value="'.$row["remarks"].'">
								</td>
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
	<script  src="js/indextwo.js"></script>

	</body>
</html>