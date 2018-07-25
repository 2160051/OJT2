<?php
	include 'includes/connection.php';

	$fsic_no = $_POST['fsicNo'];
	$date_received = $_POST['dateReceived'];
	$date_released = $_POST['dateReleased'];
	$name_of_business = mysqli_real_escape_string($conn, $_POST['nameOfBusiness']);
	$type_of_business = mysqli_real_escape_string($conn, $_POST['typeOfBusiness']);
	$name_owner = mysqli_real_escape_string($conn, $_POST['nameOwner']);

	if ($_POST['orNo'] == "") {
		$or_no = "None";
	}else{
		$or_no = $_POST['orNo'];
	}
	
	if ($_POST['remarks'] == "") {
		$remarks = "Not Stated";
	}else{
		$remarks = mysqli_real_escape_string($conn, $_POST['remarks']);
	}

	if (!isset($_POST['new'])) {
		$new = "Not Stated";
	}else{
		$new = "Yes";
	}

	$query = "SELECT * from document WHERE fsicNo = $fsic_no || orNo = '$or_no';";
	$result = mysqli_query($conn, $query);
	$count = mysqli_num_rows($result);

	if($count >= 1){
		echo "<script>
				alert('The record for FSIC with number ".$fsic_no." already exists.');
				window.location.href = 'client';
			  </script>";
	}else{
		$query = "INSERT INTO document (fsicNo, dateReceived, dateReleased, nameOfBusiness, typeOfBusiness, nameOwner, orNo, remarks, new) VALUES ('$fsic_no', '$date_received', '$date_released', '$name_of_business', '$type_of_business', '$name_owner', '$or_no', '$remarks', '$new');";
		if(mysqli_query($conn, $query)){
			header('Location: client.php');
		}else{
			echo "<script>
				alert('An Error Occured. Please Try Again.');
				window.location.href = 'client';
			  </script>";
		}
	}
?>