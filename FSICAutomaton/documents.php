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
						<li style="padding-top: 14px;padding-bottom: 14px;"><a href="documents.php" style="color:#444; border: 0;"><span class="glyphicon glyphicon-list-alt" style="color:#444"></span>&nbsp;&nbsp;Documents</a></li>
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

		<div style="margin-top: 3%;font-size: 32px;text-align: center;">FSIC Documents
		<br><button type="button" class="btn btn-info" style="float: right;margin-right: 5em;" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus"></span>Add Document</button>
		</div>

		<div style="margin: 5em;margin-top: 2%; background: none;">
		<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>FSIC #</th>
					<th>Business</th>
					<th>Type</th>
					<th>Owner</th>
					<th>OR #</th>
					<th>Received</th>
					<th>Released</th>
					<th>Remarks</th>
					<th>New</th>
					<th>Edit</th>
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

	<div class="modal fade" id="myModal" role="dialog">
	    <div class="modal-dialog">   
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title"><b>Add a New FSIC Document</b></h4>
	        </div>
	        <div class="modal-body">
	          <form action="add" method="POST">
	        	 <div class="form-group">
				  <div style="text-align: center;">
					  <b>FSIC #:</b>&nbsp;&nbsp;&nbsp;<input type="number" class="form-control" id="schedule" name="fsicNo" min="1" max="10000" style="width: 25%;" required>&nbsp;&nbsp;&nbsp;<b>OR #:</b>&nbsp;&nbsp;&nbsp; 
					  <input type="number" class="form-control" id="schedule" name="orNo" min="1" max="10000" required style="width: 25%;">
				  </div>
				 </div>
				 <div class="form-group">
				  <label for="nameOfBusiness">Name of Business:</label>
				  <input type="text" class="form-control" id="nameOfBusiness" name="nameOfBusiness" maxlength="120" placeholder="Sari-sari Store" required>
				 </div>
				 <div class="form-group">
				  <label for="typeOfBusiness">Type of Business:</label>
				  <input type="text" class="form-control" id="typeOfBusiness" name="typeOfBusiness" maxlength="120" placeholder="Sari-sari Store" required>
				 </div>
				 <div class="form-group">
				  <label for="nameOwner">Owner:</label>
				  <input type="nameOwner" class="form-control" id="nameOwner" name="nameOwner" maxlength="80" placeholder="FirstName LastName" required>
				 </div>
				 <div class="form-group">
				  <div style="text-align: center;">
					  Date Received:&nbsp;&nbsp;<input type="date" class="form-control" id="schedule" name="dateReceived" style="width: 28%;" required>&nbsp;&nbsp;&nbsp; &nbsp;Date Released:&nbsp;&nbsp;&nbsp; 
					  <input type="date" class="form-control" id="schedule" name="dateReleased" style="width: 28%;" required>
				  </div>
				 </div>
				<div class="form-group">
			    <div style="text-align: center;">
					  Amount to be Paid:&nbsp;&nbsp;<input type="number" name="amount" value="0.00" min="0" step="0.01" data-number-to-fixed="2" data-number-stepfactor="100" class="form-control currency" id="schedule" required style="width: 23%;" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Date Paid:&nbsp;&nbsp;&nbsp; 
					  <input type="date" class="form-control" id="schedule" name="payDate" style="width: 28%;" required>
				  </div>
				 </div>
				 <div class="form-group">
				  <label for="remarks">Remarks:</label>
				  <textarea class="form-control" rows="5" maxlength='500' name='remarks' style="resize: none;"></textarea>
				 </div>
				 <div class="checkbox">
				  <label>
				  <input type="checkbox" id="new" checked name="new">New
				  </label>
				 </div>
				<input type="submit" class="btn btn-primary btn-md" value="Submit" />
	          	<button type="button" class="btn btn-default btn-md" data-dismiss="modal">Close</button>
	          	</form>
	        </div>
	      </div>
	    </div>
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