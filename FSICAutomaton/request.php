<?php
    include 'includes/connection.php';
?>
<!DOCTYPE HTML>
<html style="overflow: scroll;">
	<head>
		<meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
		<meta name="HandheldFriendly" content="true">
		<link rel="stylesheet" href="css/styles.css">
		<link rel="icon" href="images/fsic.ico">
		<title>FSIC | Account Request</title>
	</head>

	<body>
		<div class="hedatu" style="font-size: 30px;">
			Account Request
		</div>
		<br>
		<div class="id">
			<form method="POST">
				<div style="margin: 0 auto;text-align: center; font-size: 18px;"><label for="fname">First Name</label></div> 
				<input type="text" name="fname" placeholder="Juan" maxlength="120" class="user" required style="width: 25%;margin: 0 auto; color: black; height: 10%;"><br>
				<div style="margin: 0 auto;text-align: center; font-size: 18px;"><label for="lname">Last Name</label></div> 
				<input type="text" name="lname" placeholder="Dela Cruz" maxlength="120" class="user" required style="width: 25%;margin: 0 auto; color: black; height: 10%;"><br>
				<div style="margin: 0 auto;text-align: center; font-size: 18px;"><label for="contact">Contact Number</label></div> 
				<input type="text" name="contact" class="user" placeholder="09XXXXXXXXX" required minlength="11" maxlength="11" style="width: 25%;margin: 0 auto; color: black; height: 10%;"><br>
				<div style="margin: 0 auto;text-align: center; font-size: 18px;"><label for="pos">Position</label></div> 
				<input type="text" name="pos" class="user" maxlength="120" placeholder="Fire Officer 1" required style="width: 25%;margin: 0 auto; color: black; height: 10%;"><br>
				<div style="margin: 0 auto;text-align: center; font-size: 18px;"><label for="id">ID</label></div> 
				<input type="text" name="id" class="user" maxlength="45" placeholder="XXXX" required style="width: 25%;margin: 0 auto; color: black; height: 10%;"><br>
				<div style="margin: 0 auto;text-align: center; font-size: 18px;"><label for="password">Password</label></div>
				<input type="password" name="password" maxlength="45" placeholder="*****" class="user" required style="width: 25%;margin: 0 auto; color: black; height: 10%;"><br>
				<div style="margin: 0 auto; width: 40%;display: flex;justify-content: center;align-items: center;">
					<input type="submit" value="Submit" class="loginButton" style="width: 28%; display: inline-block;background-color: #fc4c3f; color:white;">
				</div>

				<?php
				    if(isset($_POST['password'])){
				    	session_start();
				        $user = $_POST['id'];
				        $fname = $_POST['fname'];
				        $lname = $_POST['lname'];
				        $contact = $_POST['contact'];
				        $pos = $_POST['pos'];
				        $password = $_POST['password'];

				        $query = "SELECT password FROM admin WHERE id = '$user' OR (firstName = '$fname' AND lastName = '$lname');";
				        $query_two = "SELECT password FROM client WHERE id = '$user' OR (firstName = '$fname' AND lastName = '$lname');";
				        $result = mysqli_query($conn, $query);
				        $result_two = mysqli_query($conn, $query_two);
				        $count = mysqli_num_rows($result);
				        $count_two = mysqli_num_rows($result_two);
				        if($count == 1){
				           echo "<div class='alert'>
									  <span class='closebtn'>&times;</span> 
									  User already exists or has already requested. Please Try Again.
								  </div>";
				        }else if($count_two == 1){
				        	echo "<div class='alert'>
									  <span class='closebtn'>&times;</span> 
									  User already exists or has already requested. Please Try Again.
								  </div>";
				        }else{
				        	$query = "INSERT INTO client (id, password, firstName, lastName, contactNo, position) VALUES ('$user', '$password','$fname', '$lname', '$contact', '$pos');";
				        	if(mysqli_query($conn, $query)){
				        		header('Location: index.php');
				        	}else{
				        		 echo "Error description: " . mysqli_error($conn);
				        	}
				        }
		            }
				?>
			</form>	
	
	<script>
		var close = document.getElementsByClassName("closebtn");
		var i;

		for (i = 0; i < close.length; i++) {
		    close[i].onclick = function(){
		        var div = this.parentElement;
		        div.style.opacity = "0";
		        setTimeout(function(){ div.style.display = "none"; }, 600);
		    }
		}
	</script>
	</body>
</html>