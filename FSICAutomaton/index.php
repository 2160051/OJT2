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
		<title>FSIC | Login</title>
	</head>

	<body>
		<div class="hedatu">
			<img src="images/logo.svg" alt="FSIC Automaton" width="220" style="margin:0 auto;" />
		</div>
		<div class="id">
			<form method="POST">
				<div style="margin: 0 auto;text-align: center; font-size: 18px;"><label for="user">ID</label></div> 
				<input type="text" name="user" class="user" required style="width: 25%;margin: 0 auto; color: black; height: 10%;"><br>
				<div style="margin: 0 auto;text-align: center; font-size: 18px;"><label for="password">Password</label></div>
				<input type="password" name="password" class="user" required style="width: 25%;margin: 0 auto; color: black; height: 10%;"><br>
				<div style="margin: 0 auto; width: 40%;display: flex;justify-content: center;align-items: center;">
					<input type="submit" value="Login" class="loginButton" style="width: 28%; display: inline-block;background-color: #fc4c3f; color:white;">
				</div>

				<?php
				    if(isset($_POST['password'])){
				    	session_start();
				        $user = $_POST['user'];
				        $password = $_POST['password'];

				        $query = "SELECT password FROM admin WHERE id = '$user' AND password = '$password';";
				        $query_two = "SELECT password FROM client WHERE id = '$user' AND password = '$password' AND status = 'Active';";
				        $result = mysqli_query($conn, $query);
				        $result_two = mysqli_query($conn, $query_two);
				        $count = mysqli_num_rows($result);
				        $count_two = mysqli_num_rows($result_two);
				        if($count == 1){
				            $_SESSION['user'] = $user;
				            header('Location: admin.php');
				        }else if($count_two == 1){
				        	$_SESSION['user'] = $user;
				            header('Location: client.php');
				        }else{
				        	echo "<div class='alert'>
									  <span class='closebtn'>&times;</span> 
									  Wrong Username or Password. Please Try Again.
								  </div>";
				        }
		            }
				?>
			</form>	
			<div style="margin: 0 auto;text-align: center;"><form><input type='submit' class="buttonLink" value="Request for an Account" formaction="request.php"></form></div>	
		</div>
	
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