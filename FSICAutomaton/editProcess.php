<?php 
	include 'includes/connection.php';
	session_start();
	$user = $_SESSION['user'];
	$fsic_no = $_POST['fsicNo'];
	$amount = $_POST['amount'];
	$or_no = $_POST['orNo'];
	$pay_Date = $_POST['payDate'];
	$orig_fsic = $_POST['origFSIC'];
	$orig_or = $_POST['origOR'];
	$date_received = $_POST['dateReceived'];
	$date_released = $_POST['dateReleased'];
	$name_of_business = mysqli_real_escape_string($conn, $_POST['nameOfBusiness']);
	$type_of_business = mysqli_real_escape_string($conn, $_POST['typeOfBusiness']);
	$name_owner = mysqli_real_escape_string($conn, $_POST['nameOwner']);
	
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

	$query = "UPDATE document SET fsicNo = '$fsic_no', dateReceived = '$date_received', dateReleased = '$date_released', nameOfBusiness = '$name_of_business', typeOfBusiness = '$type_of_business', nameOwner = '$name_owner', orNo = '$or_no', remarks = '$remarks', new = '$new' WHERE fsicNo = '$orig_fsic';";

	if(mysqli_query($conn, $query)){
		$query = "UPDATE payment SET orNo = '$or_no', amtPaid = '$amount', payDate = '$pay_Date' WHERE orNo = '$orig_or';";
		if(mysqli_query($conn, $query)){
			echo "<script>
				    window.location = 'client.php';
				</script>";
		}else{
			echo "<script>
				    window.location = 'error.php';
				</script>";
		}
	}else{
		echo "<script>
				    window.location = 'error.php';
			  </script>";
	}
?>