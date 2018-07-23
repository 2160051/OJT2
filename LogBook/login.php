<?php
    include 'includes/connection.php';
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
		<meta name="HandheldFriendly" content="true">
		<link rel="stylesheet" href="css/styles.css">
		<link rel="icon" href="images/bfp.png">
		<title>BFP | Log-In</title>
	</head>

	<body>
		<a href='index.php' style="text-decoration: none;">
			<div class="header">
				<div>BFP | <span>LogBook</span></div>
			</div>
		</a>
		<br>
		<div class="login">
			<form method="POST">
				<input type="text" placeholder="username" name="user" required><br>
				<input type="password" placeholder="password" name="password" required><br>
				<input type="submit" value="Login" class="loginButton">
			</form>		
		</div>
		<?php
		    if(isset($_POST['password'])){
		    	session_start();
		        $user = $_POST['user'];
		        $password = $_POST['password'];

		        $query = "SELECT password FROM admin WHERE id = '$user' AND password = '$password';";
		        $result = mysqli_query($conn, $query);
		        $count = mysqli_num_rows($result);

		        echo $count;
		        if($count == 1){
		            $_SESSION['user'] = $user;
		            header('Location: dashboard.php');
		        }else{
		        	echo "<div class='alert'>
							  <span class='closebtn'>&times;</span> 
							  Wrong Username or Password. Please Try Again.
						  </div>";
		        }
            }
		?>
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