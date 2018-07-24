<?php
    include 'includes/connection.php';
    session_start();
    if(!isset($_SESSION['user'])){
    	header('Location: index.php');
	}
?>
<!DOCTYPE HTML>
<html style="overflow: scroll;">
	<head>
		<meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
		<meta name="HandheldFriendly" content="true">
		<script src='js/jquery-3.3.1.js'></script>
  		<link rel='stylesheet prefetch' href='css/bootstrap.min.css'>
		<link rel="stylesheet" href="css/styles.css">
		<link href="css/logo-nav.css" rel="stylesheet">
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.bundle.min.js"></script>
  		<script src="js/bootstrap.min.js"></script>
		<link rel="icon" href="images/fsic.ico">
		<title>FSIC | Home</title>
	</head>

	<body style="padding-top: 54px;">
		
	  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
	      <div class="container">
	        <a class="navbar-brand" href="#">
	          <img src="http://placehold.it/300x60?text=Logo" width="150" height="30" alt="">
	        </a>
	        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
	          <span class="navbar-toggler-icon"></span>
	        </button>
	        <div class="collapse navbar-collapse" id="navbarResponsive">
	          <ul class="navbar-nav ml-auto">
	            <li class="nav-item active">
	              <a class="nav-link" href="#">Home
	                <span class="sr-only">(current)</span>
	              </a>
	            </li>
	            <li class="nav-item">
	              <a class="nav-link" href="#">Account</a>
	            </li>
	            <li class="nav-item">
	              <a class="nav-link" href="logout">Logout</a>
	            </li>
	          </ul>
	        </div>
	      </div>
	    </nav>
        
	</body>

</html>