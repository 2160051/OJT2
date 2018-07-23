<?php
	include 'includes/connection.php';

	$first_name = $_GET['firstName'];
	$last_name = $_GET['lastName'];
	$position = $_GET['position'];
	$contact_no = $_GET['contactNo'];
	$id = $_GET['id'];

	$query = "SELECT * from client WHERE CONCAT(firstName, ' ', lastName) = '".$first_name." ".$last_name."' OR id = '$id'  ORDER BY lastName;";
	$result = mysqli_query($conn, $query);
	$count = mysqli_num_rows($result);

	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		$from = $row['fromTime'];
		$to = $row['toTime'];
		$duration = $row['duration'];
	}
	$duration = explode("-", $duration);

	$mon = $tue = $wed = $thur = $fri = $sat = $sun = "";
	for ($ctr=0; $ctr < count($duration); $ctr++) { 
		switch ($duration[$ctr]) {
			case 'Monday':
				$mon = "checked";
				break;
			case 'Tuesday':
				$tue = "checked";
				break;
			case 'Wednesday':
				$wed = "checked";
				break;
			case 'Thursday':
				$thur = "checked";
				break;
			case 'Friday':
				$fri = "checked";
				break;
			case 'Saturday':
				$sat = "checked";
				break;
			case 'Sunday':
				$sun = "checked";
				break;
		}
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

	<div style="margin-top: 3%;font-size: 32px;text-align: center;">Edit Record</div>
	<div style="margin:0 auto;margin-top: 2%;font-size: 18px;width: 35%;">
		<form action="" method="POST">
			<div class="form-group">
			  <label for="firstName">First Name:</label>
			  <input type="text" class="form-control" id="firstName" name="firstName" value=<?php echo $first_name; ?> maxlength="120" required>
			</div>
			 <div class="form-group">
			  <label for="lastName">Last Name:</label>
			  <input type="text" class="form-control" id="lastName" name="lastName" maxlength="120" value="<?php echo $last_name; ?>" required>
			 </div>
			 <div class="form-group">
			  <label for="id">ID:</label>
			  <input type="text" class="form-control" id="id" name="id" maxlength="45" value="<?php echo $id; ?>" required>
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
			  <label for="schedule">Schedule:</label>
			  <br>
			  <div style="text-align: center;">
				  From:&nbsp;&nbsp;&nbsp;<input type="time" class="form-control" id="schedule" name="from" value="<?php echo $from; ?>" required>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;To:&nbsp;&nbsp;&nbsp; 
				  <input type="time" class="form-control" id="schedule" name="to" value="<?php echo $to; ?>" required>
			  </div>
			  <div style="text-align: center; margin-top: 1%;">
			  	<label class="checkbox-inline">
			      <input type="checkbox" name="duration[]" <?php echo $mon; ?> value="Monday">Monday
			    </label>
			    <label class="checkbox-inline">
			      <input type="checkbox" name="duration[]" <?php echo $tue; ?> value="Tuesday">Tuesday
			    </label>
			    <label class="checkbox-inline">
			      <input type="checkbox" name="duration[]" <?php echo $wed; ?> value="Wednesday">Wednesday
			    </label>
			    <label class="checkbox-inline">
			      <input type="checkbox" name="duration[]" <?php echo $thur; ?> value="Thursday">Thursday
			    </label>
			  </div>
			  <div style="text-align: center; margin-top: 1%;">
			    <label class="checkbox-inline">
			      <input type="checkbox" name="duration[]" <?php echo $fri; ?> value="Friday">Friday
			    </label>
			    <label class="checkbox-inline">
			      <input type="checkbox" name="duration[]" <?php echo $sat; ?> value="Saturday">Saturday
			    </label>
			    <label class="checkbox-inline">
			      <input type="checkbox" name="duration[]" <?php echo $sun; ?> value="Sunday">Sunday
			    </label>
			</div>
			</div>
			<input type="hidden" name='origFirst' value="<?php echo $first_name; ?>" />
			<input type="hidden" name='origLast' value="<?php echo $last_name; ?>" />
			<input type="hidden" name='origID' value="<?php echo $id; ?>" />
			<input type="submit" class="btn btn-primary btn-lg" name="submit" value="Submit" style="float:right;margin-left: 2%;" />
			<input type="submit" class="btn btn-default btn-lg" formaction="records" value="Go Back" style="float:right;" />
		</form>
	</div>

	<?php 
		if(isset($_POST['submit'])){
			$first_name = $_POST['firstName'];
			$last_name = $_POST['lastName'];
			$position = $_POST['position'];
			$contact_no = $_POST['contactNo'];
			$from = $_POST['from'];
			$from = date("H:i:s", strtotime($from));
			$to = $_POST['to'];
			$to = date("H:i:s", strtotime($to));
			$duration = $_POST['duration'];
			$duration = implode("-", $duration);
			$id = $_POST['id'];
			$orig_id = $_POST['origID'];
			$orig_first = $_POST['origFirst'];
			$orig_last = $_POST['origLast'];

			$query = "UPDATE client SET id = '$id', firstName = '$first_name', lastName = '$last_name', position = '$position', contactNo = '$contact_no', fromTime = '$from', toTime = '$to', duration = '$duration' WHERE firstName = '$orig_first' AND lastName = '$orig_last' AND id = '$orig_id';";

			if(mysqli_query($conn, $query)){
				echo "<script>
					    window.location = 'records';
					</script>";
			}else{
				echo("Error description: " . mysqli_error($conn));
			}
		}
	?>

</body>
</html>