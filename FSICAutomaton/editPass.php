<?php 
	include 'includes/connection.php';
	session_start();
	$user = $_SESSION['user'];
	$old_pass = mysqli_real_escape_string($conn, $_POST['oldPass']);
	$new_pass = mysqli_real_escape_string($conn, $_POST['newPass']);

	$query = "SELECT password FROM admin WHERE id = '$user' AND password = '$old_pass';";
	$result = mysqli_query($conn, $query);
	$count = mysqli_num_rows($result);

	if($count == 1){
		$query = "UPDATE admin SET password = '$new_pass' WHERE id = '$user';";

		if(mysqli_query($conn, $query)){
			echo "<script>
				    window.location = 'accountSettings.php';
				</script>";
		}else{
			echo "<script>window.location.href='accountSettings.php';</script>";
		}
	}else{
		echo "<script>alert('Incorrect password.');
					  window.location.href='accountSettings.php';</script>";
	}
?>