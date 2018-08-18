<?php
    include 'includes/connection.php';
    session_start();
    if(!isset($_SESSION['user'])){
    	header('Location: index.php');
	}else{
		$query = "SELECT * from client WHERE id = '".$_SESSION['user']."';";
		$result = mysqli_query($conn, $query);
		$count = mysqli_num_rows($result);

		if($count >= 1){
			header('Location: client.php');
		}
	}

	$query = "SELECT profilepicture from admin WHERE id = '".$_SESSION['user']."';";
	$result = mysqli_query($conn, $query);
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		$profile = $row['profilepicture'];
	}

	$profile = "images/profilepictures/".$profile;

	$num_rec = 0;
	$num_doc = 0;
	$num_pay = 0;
    $num_fo = 0;
    $num_insp = 0;
    $num_intern = 0;
    $num_others = 0;
    $num_paid = 0;
    $num_pending = 0;
    $num_fish = 0;
    $num_man = 0;
    $num_sari = 0;
    $num_merch = 0;
    $num_shop = 0;
    $num_oth = 0;

    $query = "SELECT * from client;";
    $result = mysqli_query($conn, $query);
    $num_rec = mysqli_num_rows($result);

    $query = "SELECT * from document;";
    $result = mysqli_query($conn, $query);
    $num_doc = mysqli_num_rows($result);

    $query = "SELECT * from payment;";
    $result = mysqli_query($conn, $query);
    $num_pay = mysqli_num_rows($result);

    $query = "SELECT * from client WHERE position LIKE '%Fire Officer%' OR position LIKE '%fire officer%';";
    $result = mysqli_query($conn, $query);
    $num_fo = mysqli_num_rows($result);

    $query = "SELECT * from client WHERE position LIKE '%Inspector%' OR position LIKE '%inspector%';";
    $result = mysqli_query($conn, $query);
    $num_insp = mysqli_num_rows($result);

    $query = "SELECT * from client WHERE position LIKE '%Intern%' OR position LIKE '%intern%';";
    $result = mysqli_query($conn, $query);
    $num_intern = mysqli_num_rows($result);

    $query = "SELECT * from client WHERE position NOT LIKE '%Intern%' AND position NOT LIKE '%intern%' AND position NOT LIKE '%Inspector%' AND position NOT LIKE '%inspector%' AND position NOT LIKE '%Fire Officer%' AND position NOT LIKE '%fire officer%';";
    $result = mysqli_query($conn, $query);
    $num_others = mysqli_num_rows($result);

    $query = "SELECT * from payment WHERE status = 'Pending';";
    $result = mysqli_query($conn, $query);
    $num_pending = mysqli_num_rows($result);

    $query = "SELECT * from payment WHERE status = 'Paid';";
    $result = mysqli_query($conn, $query);
    $num_paid = mysqli_num_rows($result);

    $query = "SELECT * from document WHERE typeOfBusiness LIKE '%Fish%' OR typeOfBusiness LIKE '%fish%';";
    $result = mysqli_query($conn, $query);
    $num_fish = mysqli_num_rows($result);

    $query = "SELECT * from document WHERE typeOfBusiness LIKE '%Manufact%' OR typeOfBusiness LIKE '%manufact%';";
    $result = mysqli_query($conn, $query);
    $num_man = mysqli_num_rows($result);

    $query = "SELECT * from document WHERE typeOfBusiness LIKE '%Merchandis%' OR typeOfBusiness LIKE '%merchandis%';";
    $result = mysqli_query($conn, $query);
    $num_merch = mysqli_num_rows($result);

    $query = "SELECT * from document WHERE typeOfBusiness LIKE '%Sari%' OR typeOfBusiness LIKE '%sari%';";
    $result = mysqli_query($conn, $query);
    $num_sari = mysqli_num_rows($result);

    $query = "SELECT * from document WHERE typeOfBusiness LIKE '%Shop%' OR typeOfBusiness LIKE '%shop%';";
    $result = mysqli_query($conn, $query);
    $num_shop = mysqli_num_rows($result);

    $query = "SELECT * from document WHERE typeOfBusiness NOT LIKE '%Shop%' AND typeOfBusiness NOT LIKE '%shop%' AND typeOfBusiness NOT LIKE '%Sari%' AND typeOfBusiness NOT LIKE '%sari%' AND typeOfBusiness NOT LIKE '%Merchandis%' AND typeOfBusiness NOT LIKE '%merchandis%' AND typeOfBusiness NOT LIKE '%Manufact%' AND typeOfBusiness NOT LIKE '%manufact%' AND typeOfBusiness NOT LIKE '%Fish%' AND typeOfBusiness NOT LIKE '%fish%';";
    $result = mysqli_query($conn, $query);
    $num_shop = mysqli_num_rows($result);
?>
<!DOCTYPE HTML>
<html style="overflow: scroll;">
<head>
	<meta charset="UTF-8">
	<title>FSIC | Home</title>
	<meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="HandheldFriendly" content="true">
  	<script src='js/jquery-3.3.1.js'></script>
  	<link rel='stylesheet prefetch' href='css/bootstrap.min.css'>
	<link rel='stylesheet prefetch' href='css/dataTables.bootstrap.min.css'>
	<link rel='stylesheet prefetch' href='css/buttons.bootstrap.min.css'>
	<link rel="stylesheet" href="css/styles.css">
  	<script src="js/jquery.min.js"></script>
  	<script src="js/bootstrap.min.js"></script>
	<link rel="icon" href="images/fsic.ico">
	<script src="js/moment.min.js"></script>
	<script src='js/Chart2.min.js'></script>
</head>
	<body style="background: none;">

		<nav class="navbar navbar-inverse" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-navbar-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="client.php"><img src="images/logo2.png" alt="FSIC" height="35" /></a>
				</div>
				<div class="collapse navbar-collapse" id="top-navbar-1">
					<ul class="nav navbar-nav navbar-right">
						<li style="padding-top: 14px;padding-bottom: 14px;"><a href="client.php" style="color: #444; border: 0;"><span class="glyphicon glyphicon-home" style="color:#444"></span>&nbsp;&nbsp;Home</a></li>
						<li style="padding-top: 14px;padding-bottom: 14px;"><a href="documents.php" style="border: 0;"><span class="glyphicon glyphicon-list-alt"></span>&nbsp;&nbsp;Documents</a></li>
						<li style="padding-top: 14px;padding-bottom: 14px;"><a href="payment.php"><span class="glyphicon glyphicon-folder-close"></span>&nbsp;&nbsp;Payments</a></li>
						<li class="dropdown">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#"><img src="<?php echo $profile; ?>" style="width: 50px;height: 50px;border-radius: 50%;" alt="Profile" /></a>
							<ul class="dropdown-menu" style="background-color: #444;">
								<li><a href="manage.php"><span class="glyphicon glyphicon-cog" style="color:#fff;"></span>&nbsp;&nbsp;Manage User Accounts</a></li>
								<li><a href="accountSettings.php"><span class="glyphicon glyphicon-cog" style="color:#fff;"></span>&nbsp;&nbsp;Change Password</a></li>
								<li><a href="logout.php"><span class="glyphicon glyphicon-log-out" style="color:#fff;"></span>&nbsp;&nbsp;Logout</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>

		<div class="dashContainer" style="margin-top: 4%;">			
			<div class="card card-c" style="display: inline-block;width:23%; height: auto; padding:25px;">
				<img src="images/document.png" width="50" style="vertical-align: middle;margin-bottom: 0.75em;" alt="Records">
		          <a href="documents" style="text-decoration: none;"><span style="font-size: 18px;">FSIC Documents</span></a>
		          <h1 style="text-align: center;"><?php echo $num_doc; ?></h1>
		          <br>

		        <img src="images/payment.png" width="50" style="vertical-align: middle;margin-bottom: 0.75em;" alt="Records">
		          <a href="payment" style="text-decoration: none;"><span style="font-size: 18px;">Payments</span></a>
		          <h1 style="text-align: center;"><?php echo $num_pay; ?></h1>
		          <canvas id="doughnut-chart" height="150"></canvas>
			</div>
			<div class="card card-c" style="display: inline-block;width:60%; height: auto; padding:30px;margin-left: 3%;">
				<canvas id="bar-chart" width="800" height="400"></canvas>
			</div>
		</div>
		<div class="dashContainer" style="margin-top: 4%;margin-bottom: 4%;">
			<div class="card card-c" style="display: inline-block;width:60%; height: auto; padding:30px;">
				<canvas id="line-chart" width="800" height="400"></canvas>
			</div>
			<div class="card card-c" style="display: inline-block;width:20%; height: auto; padding:25px;margin-left: 3%;">
				<img src="images/clipboard.png" width="50" style="vertical-align: middle;margin-bottom: 0.75em;" alt="Records">
		          <a href="records" style="text-decoration: none;"><span style="font-size: 18px;">Records</span></a>
		          <h1 style="text-align: center;"><?php echo $num_rec; ?></h1><br>
		          
		          <div id="wrap" style="font-size: 16px;">
				    <div id="left_col">
				        Inspector<br><br>
				        Fire Officer<br><br>
				        Intern<br><br>
				        Others
				    </div>
				    <div id="right_col">
				    	<form action="manage.php" method="GET">
				    		<input type="hidden" name="choice" value="inspector">
				    		<input type="submit" id="inputAsLink" name="val" value="<?php echo $num_insp; ?>"><br><br>
				    	</form>
				    	<form action="manage.php" method="GET">
				    		<input type="hidden" name="choice" value="fireOfficer">
				    		<input type="submit" id="inputAsLink" name="val" value="<?php echo $num_fo; ?>"><br><br>
				    	</form>
				    	<form action="manage.php" method="GET">
				    		<input type="hidden" name="choice" value="intern">
				    		<input type="submit" id="inputAsLink" name="val" value="<?php echo $num_intern; ?>"><br><br>
				    	</form>
				    	<form action="manage.php" method="GET">
				    		<input type="hidden" name="choice" value="others">
				    		<input type="submit" id="inputAsLink" name="val" value="<?php echo $num_others; ?>">
				    	</form>
				    </div>
				</div>
			</div>
		</div>
		<script>
			new Chart(document.getElementById("doughnut-chart"), {
			    type: 'doughnut',
			    data: {
			      labels: ["Paid", "Pending"],
			      datasets: [
			        {
			          label: "In Peso",
			          backgroundColor: ["#62f442", "#f44141"],
			          data: [<?php echo $num_paid ?>,<?php echo $num_pending ?>]
			        }
			      ]
			    }
			});

			new Chart(document.getElementById("bar-chart"), {
			    type: 'bar',
			    data: {
			      labels: ["Fishing/Stalls", "Merchandising", "Manufacturing", "Sari-Sari Store", "Shop", "Others"],
			      datasets: [
			        {
			          label: "By Total Numbers",
			          backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#f7ee3d","#e8c3b9","#c45850"],
			          data: [<?php echo $num_fish;?>,<?php echo $num_merch;?>,<?php echo $num_man;?>,<?php echo $num_sari;?>,<?php echo $num_shop;?>, <?php echo $num_oth;?>]
			        }
			      ]
			    },
			    options: {
			      legend: { display: false },
			      title: {
			        display: true,
			        text: 'Businesses With Permit (By Category)'
			      },
			      scales: {
		            yAxes: [{
		                ticks: {
		                    beginAtZero:true,
		                    stepSize: 1
		                }
		            }]
			      }
			    }
			});

			<?php 
				$query = "SELECT * from document ORDER by dateReceived ASC LIMIT 1;";
				$result = mysqli_query($conn, $query);
				$min = '2017-01-01';
				$max = date("Y-m-d");
				while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
					$min = $row['dateReceived'];
				}
			?>

		   new Chart(document.getElementById("line-chart"), {
		      type: 'line',
		      data: {
		         datasets: [{
		            data: [12, 19, 3, 5, 2, 3, 32, 15],
		            label: "",
		            borderWidth: 2,
		            borderColor: "#3e95cd",
		            fill: false,
		            pointRadius: 0
		         }]
		      },
		      options: {
		         scales: {
		            xAxes: [{
		               type: 'time',
		               time: {
		                  parser: 'YYYY-MM-DD HH:mm:ss',
		                  unit: 'week',
		                  displayFormats: {
		                     week: 'll'
		                  },
		                  min: '<?php echo $min; ?>',
		                  max: '<?php echo $max; ?>'
		               },
		               ticks: {
		                  source: 'data'
		               }
		            }]
		         },
		         legend: {
		            display: false
		         },
		         animation: {
		            duration: 0,
		         },
		         hover: {
		            animationDuration: 0,
		         },
		         responsiveAnimationDuration: 0
		      },
		      plugins: [{
		         beforeInit: function(chart) {
		            var time = chart.options.scales.xAxes[0].time, // 'time' object reference
		               timeDiff = moment(time.max).diff(moment(time.min), 'd'); // difference (in days) between min and max date
		            // populate 'labels' array
		            // (create a date string for each date between min and max, inclusive)
		            for (i = 0; i <= timeDiff; i++) {
		               var _label = moment(time.min).add(i, 'd').format('YYYY-MM-DD HH:mm:ss');
		               chart.data.labels.push(_label);
		            }
		         }
		      }]
		   });
		</script>
	</body>
</html>