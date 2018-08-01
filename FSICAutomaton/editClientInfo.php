<?php 
	include 'includes/connection.php';
    session_start();

	if(isset($_POST['editProfile'])){
		$target_dir = "images/profilepictures/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		$_FILES["fileToUpload"]["name"] = $_SESSION['user'].".".$imageFileType;
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		if(isset($_POST["submit"])) {
		    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		    if($check !== false) {
		        $uploadOk = 1;
		    } else {
		        $uploadOk = 0;
		    }
		}

		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		    $uploadOk = 0;
		}

		if ($_FILES["fileToUpload"]["size"] == 0) {
		    $uploadOk = 0;
		}

		if ($uploadOk == 0) {
			echo "<script>
						alert('An error occurred. Please try again.');
					    window.location = 'account.php';
					</script>";
		} else {
		    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
		    	$file = $_FILES["fileToUpload"]["name"];
		    	$user = $_SESSION['user'];
		    	$query = "UPDATE client SET profilepicture = '$file' WHERE id = '$user';";
		    	if(mysqli_query($conn, $query)){	
			        header('Location: account.php', true, 302);
		    	}else{
		    		echo "<script>
						alert('An error occurred. Please try again.');
					    window.location = 'account.php';
					</script>";
		    	}
		    } else {
		        echo "<script>
						alert('An error occurred. Please try again.');
					    window.location = 'account.php';
					</script>";
		    }
		}
	}else if(isset($_POST['editAccount'])){
		$user = $_SESSION['user'];
		$fname = mysqli_real_escape_string($conn, $_POST['firstName']);
		$lname = mysqli_real_escape_string($conn, $_POST['lastName']);
		$id = $_POST['id'];
		$position = mysqli_real_escape_string($conn, $_POST['position']);
		$contact_no = $_POST['contactNo'];
		$password_fin = mysqli_real_escape_string($conn, $_POST['passwordFin']);
		$password_old = mysqli_real_escape_string($conn, $_POST['passwordOld']);

		$query = "SELECT password FROM client WHERE id = '$user' AND password = '$password_old';";
		$result = mysqli_query($conn, $query);
		$count = mysqli_num_rows($result);

		if($count == 1){
			$query = "UPDATE client SET id = '$id', firstName = '$fname', lastName = '$lname', position = '$position', contactNo = '$contact_no', password = '$password_fin' WHERE id = '$user';";

			if(mysqli_query($conn, $query)){
				echo "<script>
					    window.location = 'account.php';
					</script>";
			}else{
				echo "<script>window.location.href='account.php';</script>";
			}
		}else{
			echo "<script>alert('Incorrect password.');
						  window.location.href='account.php';</script>";
		}
	}
?>