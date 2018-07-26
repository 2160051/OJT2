<?php
    include 'includes/connection.php';
    session_start();
    if(!isset($_SESSION['user'])){
        header('Location: login.php');
    }
?>
<!DOCTYPE HTML>
<html style="background: white;overflow: scroll;">
<head>
	<meta charset="UTF-8">
	<title>BFP LogBook | Records</title>
	<meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="HandheldFriendly" content="true">
  	<script src='js/jquery-3.3.1.js'></script>
  	<link rel='stylesheet prefetch' href='css/bootstrap.min.css'>
	<link rel='stylesheet prefetch' href='css/dataTables.bootstrap.min.css'>
	<link rel='stylesheet prefetch' href='css/buttons.bootstrap.min.css'>
	<link rel="stylesheet" href="css/styles.css">
	<link rel="stylesheet" href="css/chartist.css">
	<script type="text/javascript" src="js/chartist.js"></script>
  	<script src="js/jquery.min.js"></script>
  	<script src="js/bootstrap.min.js"></script>
	<link rel="icon" href="images/bfp.png">
</head>

<body>

	<ul class="topnav">
		<li><a href="dashboard.php"><img src="images/bfp.png" alt="BFP" width="27"></a></li>
	  	<li><a href="dashboard.php">Home</a></li>
	  	<li><a href="logbook.php">Log Book</a></li>
	  	<li><a class="active" href="records.php">Records</a></li>
	  	<li class="right"><a href="logout.php">Log Out</a></li>
	</ul>

	<div style="margin-top: 3%;font-size: 32px;text-align: center;">Records
		<br><button type="button" class="btn btn-info" style="float: right;margin-right: 5em;" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus"></span>Add Record</button>
	</div>

  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">   
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><b>Add a New Record</b></h4>
        </div>
        <div class="modal-body">
          <form action="add" method="POST">
        	 <div class="form-group">
			  <label for="firstName">First Name:</label>
			  <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Juan" maxlength="120" required>
			 </div>
			 <div class="form-group">
			  <label for="lastName">Last Name:</label>
			  <input type="text" class="form-control" id="lastName" name="lastName" maxlength="120" placeholder="Dela Cruz" required>
			 </div>
			 <div class="form-group">
			  <label for="id">ID:</label>
			  <input type="text" class="form-control" id="id" name="id" maxlength="45" placeholder="123ABC" required>
			 </div>
			 <div class="form-group">
			  <label for="position">Position:</label>
			  <input type="text" class="form-control" id="position" name="position" maxlength="120" placeholder="Fire Officer" required>
			 </div>
			 <div class="form-group">
			  <label for="contactNo">Contact #:</label>
			  <input type="text" class="form-control" id="contactNo" name="contactNo" placeholder="09XXXXXXXXX" maxlength="11" minlength="11" required>
			 </div>
			 <div class="form-group">
			  <label for="schedule">Schedule:</label>
			  <br>
			  <div style="text-align: center;">
				  From:&nbsp;&nbsp;&nbsp;<input type="time" class="form-control" id="schedule" name="from" maxlength="45" placeholder="8:00 - 5:00 MWF" required>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;To:&nbsp;&nbsp;&nbsp; 
				  <input type="time" class="form-control" id="schedule" name="to" maxlength="45" placeholder="8:00 - 5:00 MWF" required>
			  </div>
			  <div style="text-align: center; margin-top: 1%;">
			  	<label class="checkbox-inline">
			      <input type="checkbox" name="duration[]" value="Monday">Monday
			    </label>
			    <label class="checkbox-inline">
			      <input type="checkbox" name="duration[]" value="Tuesday">Tuesday
			    </label>
			    <label class="checkbox-inline">
			      <input type="checkbox" name="duration[]" value="Wednesday">Wednesday
			    </label>
			    <label class="checkbox-inline">
			      <input type="checkbox" name="duration[]" value="Thursday">Thursday
			    </label>
			  </div>
			  <div style="text-align: center; margin-top: 1%;">
			    <label class="checkbox-inline">
			      <input type="checkbox" name="duration[]" value="Friday">Friday
			    </label>
			    <label class="checkbox-inline">
			      <input type="checkbox" name="duration[]" value="Saturday">Saturday
			    </label>
			    <label class="checkbox-inline">
			      <input type="checkbox" name="duration[]" value="Sunday">Sunday
			    </label>
			</div>
			</div>
			<input type="submit" class="btn btn-primary btn-md" value="Submit" />
          	<button type="button" class="btn btn-default btn-md" data-dismiss="modal">Close</button>
          	</form>
        </div>
      </div>
    </div>
  </div>

	<div style="margin: 5em;margin-top: 2%;">
		<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>ID</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Position</th>
					<th>Schedule</th>
					<th>Days in the Week</th>
					<th>Contact #</th>
					<th>Edit</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$query = "SELECT * from client;";
					$result = mysqli_query($conn, $query);

					if(!isset($_GET['choice'])){
						while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {				
							$from = date('h:i a', strtotime($row['fromTime']));
							$weekly = "";
							$to = date('h:i a', strtotime($row['toTime']));
							$dura = explode("-", $row['duration']);

							for($ctr = 0; $ctr < count($dura); $ctr++){
								if(count($dura) == 7){
									$weekly = "Everyday";
								}else if($dura[$ctr] == "Thursday" || $dura[$ctr] == "Sunday"){
									$weekly .= $dura[$ctr][0].$dura[$ctr][1];
								}else{
									$weekly .= $dura[$ctr][0];
								}
							}

							echo '<tr>
									<form action="" method="GET" id="recordVals">
									<td>'.$row["id"].' <input type="hidden" name="id" value="'.$row["id"].'"></td>
									<td>'.$row["firstName"].' <input type="hidden" name="firstName" value="'.$row["firstName"].'"></td>
									<td>'.$row["lastName"].' <input type="hidden" name="lastName" value="'.$row["lastName"].'"></td>
									<td>'.$row["position"].' <input type="hidden" name="position" value="'.$row["position"].'"></td>
									<td>'.$from.' - '.$to.'<input type="hidden" name="position" value="'.$row["position"].'"></td>
									<td>'.$weekly.' <input type="hidden" name="position" value="'.$row["position"].'"></td>
									<td>'.$row["contactNo"].' <input type="hidden" name="contactNo" value="'.$row["contactNo"].'"></td>
									<td style="text-align: center;">
										<button type="submit" class="btn btn-default" formaction="edit" style="display: inline-block;"><span class="glyphicon glyphicon-edit"></span></button></td>
									<td style="text-align: center;">
										<button type="submit" class="btn btn-danger" formaction="remove" style="display: inline-block;margin-left: 4%;"><span class="glyphicon glyphicon-remove"></span></button>
									</td>
									</form>
								  </tr>';
						}
					}else if($_GET['choice'] == "fireOfficer"){
						$query = "SELECT * from client WHERE position LIKE '%Fire Officer%' OR position LIKE '%fire officer%';";
						$result = mysqli_query($conn, $query);
						while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
							$from = date('h:i a', strtotime($row['fromTime']));
							$weekly = "";
							$to = date('h:i a', strtotime($row['toTime']));
							$dura = explode("-", $row['duration']);

							for($ctr = 0; $ctr < count($dura); $ctr++){
								if(count($dura) == 7){
									$weekly = "Everyday";
								}else if($dura[$ctr] == "Thursday" || $dura[$ctr] == "Sunday"){
									$weekly .= $dura[$ctr][0].$dura[$ctr][1];
								}else{
									$weekly .= $dura[$ctr][0];
								}
							}
							echo '<tr>
									<form action="" method="GET" id="recordVals">
									<td>'.$row["id"].' <input type="hidden" name="id" value="'.$row["id"].'"></td>
									<td>'.$row["firstName"].' <input type="hidden" name="firstName" value="'.$row["firstName"].'"></td>
									<td>'.$row["lastName"].' <input type="hidden" name="lastName" value="'.$row["lastName"].'"></td>
									<td>'.$row["position"].' <input type="hidden" name="position" value="'.$row["position"].'"></td>
									<td>'.$from.' - '.$to.'<input type="hidden" name="position" value="'.$row["position"].'"></td>
									<td>'.$weekly.' <input type="hidden" name="position" value="'.$row["position"].'"></td>
									<td>'.$row["contactNo"].' <input type="hidden" name="contactNo" value="'.$row["contactNo"].'"></td>
									<td style="text-align: center;">
										<button type="submit" class="btn btn-default" formaction="edit" style="display: inline-block;"><span class="glyphicon glyphicon-edit"></span></button></td>
									<td style="text-align: center;">
										<button type="submit" class="btn btn-danger" formaction="remove" style="display: inline-block;margin-left: 4%;"><span class="glyphicon glyphicon-remove"></span></button>
									</td>
									</form>
								  </tr>';
						}
					}else if($_GET['choice'] == "inspector"){
						$query = "SELECT * from client WHERE position LIKE '%Inspector%' OR position LIKE '%inspector%';";
						$result = mysqli_query($conn, $query);
						while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
							$from = date('h:i a', strtotime($row['fromTime']));
							$weekly = "";
							$to = date('h:i a', strtotime($row['toTime']));
							$dura = explode("-", $row['duration']);

							for($ctr = 0; $ctr < count($dura); $ctr++){
								if(count($dura) == 7){
									$weekly = "Everyday";
								}else if($dura[$ctr] == "Thursday" || $dura[$ctr] == "Sunday"){
									$weekly .= $dura[$ctr][0].$dura[$ctr][1];
								}else{
									$weekly .= $dura[$ctr][0];
								}
							}
							echo '<tr>
									<form action="" method="GET" id="recordVals">
									<td>'.$row["id"].' <input type="hidden" name="id" value="'.$row["id"].'"></td>
									<td>'.$row["firstName"].' <input type="hidden" name="firstName" value="'.$row["firstName"].'"></td>
									<td>'.$row["lastName"].' <input type="hidden" name="lastName" value="'.$row["lastName"].'"></td>
									<td>'.$row["position"].' <input type="hidden" name="position" value="'.$row["position"].'"></td>
									<td>'.$from.' - '.$to.'<input type="hidden" name="position" value="'.$row["position"].'"></td>
									<td>'.$weekly.' <input type="hidden" name="position" value="'.$row["position"].'"></td>
									<td>'.$row["contactNo"].' <input type="hidden" name="contactNo" value="'.$row["contactNo"].'"></td>
									<td style="text-align: center;">
										<button type="submit" class="btn btn-default" formaction="edit" style="display: inline-block;"><span class="glyphicon glyphicon-edit"></span></button></td>
									<td style="text-align: center;">
										<button type="submit" class="btn btn-danger" formaction="remove" style="display: inline-block;margin-left: 4%;"><span class="glyphicon glyphicon-remove"></span></button>
									</td>
									</form>
								  </tr>';
						}
					}else if($_GET['choice'] == "intern"){
						$query = "SELECT * from client WHERE position LIKE '%Intern%' OR position LIKE '%intern%';";
						$result = mysqli_query($conn, $query);
						while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
							$from = date('h:i a', strtotime($row['fromTime']));
							$weekly = "";
							$to = date('h:i a', strtotime($row['toTime']));
							$dura = explode("-", $row['duration']);

							for($ctr = 0; $ctr < count($dura); $ctr++){
								if(count($dura) == 7){
									$weekly = "Everyday";
								}else if($dura[$ctr] == "Thursday" || $dura[$ctr] == "Sunday"){
									$weekly .= $dura[$ctr][0].$dura[$ctr][1];
								}else{
									$weekly .= $dura[$ctr][0];
								}
							}
							echo '<tr>
									<form action="" method="GET" id="recordVals">
									<td>'.$row["id"].' <input type="hidden" name="id" value="'.$row["id"].'"></td>
									<td>'.$row["firstName"].' <input type="hidden" name="firstName" value="'.$row["firstName"].'"></td>
									<td>'.$row["lastName"].' <input type="hidden" name="lastName" value="'.$row["lastName"].'"></td>
									<td>'.$row["position"].' <input type="hidden" name="position" value="'.$row["position"].'"></td>
									<td>'.$from.' - '.$to.'<input type="hidden" name="position" value="'.$row["position"].'"></td>
									<td>'.$weekly.' <input type="hidden" name="position" value="'.$row["position"].'"></td>
									<td>'.$row["contactNo"].' <input type="hidden" name="contactNo" value="'.$row["contactNo"].'"></td>
									<td style="text-align: center;">
										<button type="submit" class="btn btn-default" formaction="edit" style="display: inline-block;"><span class="glyphicon glyphicon-edit"></span></button></td>
									<td style="text-align: center;">
										<button type="submit" class="btn btn-danger" formaction="remove" style="display: inline-block;margin-left: 4%;"><span class="glyphicon glyphicon-remove"></span></button>
									</td>
									</form>
								  </tr>';
						}
					}else if($_GET['choice'] == "others"){
						$query = "SELECT * from client WHERE position NOT LIKE '%Intern%' AND position NOT LIKE '%intern%' AND position NOT LIKE '%Inspector%' AND position NOT LIKE '%inspector%' AND position NOT LIKE '%Fire Officer%' AND position NOT LIKE '%fire officer%';";
							$result = mysqli_query($conn, $query);
						while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
							$from = date('h:i a', strtotime($row['fromTime']));
							$weekly = "";
							$to = date('h:i a', strtotime($row['toTime']));
							$dura = explode("-", $row['duration']);

							for($ctr = 0; $ctr < count($dura); $ctr++){
								if(count($dura) == 7){
									$weekly = "Everyday";
								}else if($dura[$ctr] == "Thursday" || $dura[$ctr] == "Sunday"){
									$weekly .= $dura[$ctr][0].$dura[$ctr][1];
								}else{
									$weekly .= $dura[$ctr][0];
								}
							}
							echo '<tr>
									<form action="" method="GET" id="recordVals">
									<td>'.$row["id"].' <input type="hidden" name="id" value="'.$row["id"].'"></td>
									<td>'.$row["firstName"].' <input type="hidden" name="firstName" value="'.$row["firstName"].'"></td>
									<td>'.$row["lastName"].' <input type="hidden" name="lastName" value="'.$row["lastName"].'"></td>
									<td>'.$row["position"].' <input type="hidden" name="position" value="'.$row["position"].'"></td>
									<td>'.$from.' - '.$to.'<input type="hidden" name="position" value="'.$row["position"].'"></td>
									<td>'.$weekly.' <input type="hidden" name="position" value="'.$row["position"].'"></td>
									<td>'.$row["contactNo"].' <input type="hidden" name="contactNo" value="'.$row["contactNo"].'"></td>
									<td style="text-align: center;">
										<button type="submit" class="btn btn-default" formaction="edit" style="display: inline-block;"><span class="glyphicon glyphicon-edit"></span></button></td>
									<td style="text-align: center;">
										<button type="submit" class="btn btn-danger" formaction="remove" style="display: inline-block;margin-left: 4%;"><span class="glyphicon glyphicon-remove"></span></button>
									</td>
									</form>
								  </tr>';
						}
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
