<?php 
	include 'includes/connection.php';
	$user = $_POST['user'];

	date_default_timezone_set('Asia/Manila');
    $time_now = date("H:i:s");
	$date_now = date('Y-m-d');

	$query = "UPDATE timelog SET timeOut = '$time_now', dateOut = '$date_now' WHERE id = '$user' AND timeOut IS NULL ORDER BY timelog.date, timeIn LIMIT 1;";
	$query_two = "SELECT * from client WHERE id = '$user';";
	$result = mysqli_query($conn, $query_two);
	$count = mysqli_num_rows($result);

	if($count == 0){
		echo "<script>
				alert('The user does not exist. Please try again.');
				location = 'index.php';
			  </script>";	
	}else{		
		if(mysqli_query($conn, $query)){
			header("Location: index.php");
		}
	}

?>