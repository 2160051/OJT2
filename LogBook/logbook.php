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
	<title>BFP LogBook | Log Book</title>
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
		  	<li><a class="active" href="logbook.php">Log Book</a></li>
		  	<li><a href="records.php">Records</a></li>
		  	<li class="right"><a href="logout.php">Log Out</a></li>
		</ul>

	<div style="margin-top: 3%;font-size: 32px;text-align: center;">Log Book
	</div>

		<div style="margin: 5em;margin-top: 2%;">
		<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>ID</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Time-In</th>
					<th>Time-Out</th>
					<th>Date</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$query = "SELECT * FROM client JOIN timelog USING(id);";
					$result = mysqli_query($conn, $query);

					while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
						$time_in = date('h:i a', strtotime($row['timeIn']));
						$time_out = date('h:i a', strtotime($row['timeOut']));
						$date = date('F j, Y', strtotime($row['date']));
						echo "<tr>
								<td>".$row['id']."</td>
								<td>".$row['firstName']."</td>
								<td>".$row['lastName']."</td>
								<td>".$time_in."</td>";
						if($row['timeOut'] == NULL || $row['timeOut'] == ""){
							echo "<td>--------</td>
								  ";
						}else{
							echo "<td>".$time_out."</td>";
						}
								
							  echo "<td>".$date."</td></tr>";
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