<?php
	include 'includes/connection.php';
	$user = $_GET['user'];
	$process = $_GET['process'];

	if($process == "disable"){
		$query = "UPDATE client SET status = 'Disabled' WHERE id = '$user';";
		if(mysqli_query($conn, $query)){
			echo "<script>
					window.location.href = 'manage.php';
				  </script>";
		}else{
			echo "<script>
				    window.location = 'error.php';
				</script>";
		}
	}else if($process == "activate"){
		$query = "UPDATE client SET status = 'Active' WHERE id = '$user';";
		if(mysqli_query($conn, $query)){
			echo "<script>
					window.location.href = 'manage.php';
				  </script>";
		}else{
			echo "<script>
				    window.location = 'error.php';
				</script>";
		}
	}else if($process == "accept"){
		$query = "UPDATE client SET status = 'Active' WHERE id = '$user';";
		if(mysqli_query($conn, $query)){
			echo "<script>
					window.location.href = 'manage.php';
				  </script>";
		}else{
			echo "<script>
				    window.location = 'error.php';
				</script>";
		}
	}
?>