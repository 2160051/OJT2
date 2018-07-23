<?php 
	include 'includes/connection.php';
	$first_name = $_GET['firstName'];
	$last_name = $_GET['lastName'];
	$id = $_GET['id'];

	$query = "DELETE from client WHERE firstName = '$first_name' AND lastName='$last_name' AND id = '$id'";
	if(mysqli_query($conn, $query)){
		header("Location: records.php");
	}
?>