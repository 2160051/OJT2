<?php
	include 'includes/connection.php';

	$first_name = mysqli_real_escape_string($conn, $_POST['firstName']);
	$last_name = mysqli_real_escape_string($conn, $_POST['lastName']);
	$position = mysqli_real_escape_string($conn, $_POST['position']);
	$contact_no = $_POST['contactNo'];
	$from = $_POST['from'];
	$from = date("H:i:s", strtotime($from));
	$to = $_POST['to'];
	$to = date("H:i:s", strtotime($to));
	$duration = $_POST['duration'];
	$id = $_POST['id'];

	$duration = implode("-", $duration);

	$query = "SELECT * from client WHERE CONCAT(firstName, ' ', lastName) = '".$first_name." ".$last_name."' OR id = '$id'  ORDER BY lastName;";
	$result = mysqli_query($conn, $query);
	$count = mysqli_num_rows($result);

	if($count >= 1){
		echo "<script>
				alert('The record for ".$first_name.' '.$last_name." already exists.');
				window.location.href = 'records';
			  </script>";
	}else{
		$query = "INSERT INTO client (id, firstName, lastName, position, contactNo, fromTime, toTime, duration) VALUES ('$id', '$first_name', '$last_name', '$position', '$contact_no', '$from', '$to', '$duration');";
		if(mysqli_query($conn, $query)){
			header('Location: records.php');
		}else{
			echo "<script>
				alert('An Error Occured. Please Try Again.');
				window.location.href = 'records';
			  </script>";
		}
	}
?>