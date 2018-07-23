<?php 
	include 'includes/connection.php';
	$user = $_POST['user'];

	date_default_timezone_set('Asia/Manila');
    $time_now = date("H:i:s");
	$date_now = date('Y-m-d');

	$query = "INSERT INTO timelog (id, timeIn, dateIn) VALUES ('$user', '$time_now', '$date_now');";

	if(mysqli_query($conn, $query)){
		header("Location: index.php");
	}else{
		echo "<script>
				alert('The user does not exist. Please try again.');
				location = 'index.php';
			  </script>";
	}
?>