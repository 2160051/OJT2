<?php
    include 'includes/connection.php';
    session_start();
    if(!isset($_SESSION['user'])){
        header('Location: login.php');
    }

    $num_rec = 0;
    $num_fo = 0;
    $num_insp = 0;
    $num_intern = 0;
    $num_others = 0;

    $query = "SELECT * from client;";
    $result = mysqli_query($conn, $query);
    $num_rec = mysqli_num_rows($result);

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
?>
<!DOCTYPE HTML>
<html style="background: white;overflow: scroll;">
	<head>
		<meta charset="UTF-8">
		<title>BFP LogBook | Home</title>
		<meta charset="UTF-8"/>
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <meta http-equiv="X-UA-Compatible" content="ie=edge">
		<meta name="HandheldFriendly" content="true">
	  	<script src='js/jquery-3.3.1.js'></script>
	  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	  	<link rel='stylesheet prefetch' href='css/bootstrap.min.css'>
		<link rel='stylesheet prefetch' href='css/dataTables.bootstrap.min.css'>
		<link rel='stylesheet prefetch' href='css/buttons.bootstrap.min.css'>
		<link rel="stylesheet" href="css/styles.css">
		<link rel="stylesheet" href="css/chartist.css">
		<script type="text/javascript" src="js/loader.js"></script>
		<script type="text/javascript" src="js/chartist.js"></script>
	  	<script src="js/jquery.min.js"></script>
	  	<script src="js/bootstrap.min.js"></script>
		<link rel="icon" href="images/bfp.png">
	</head>
	<body>
		<ul class="topnav">
			<li><a href="dashboard.php"><img src="images/bfp.png" alt="BFP" width="27"></a></li>
		  	<li><a class="active" href="dashboard.php">Home</a></li>
		  	<li><a href="logbook.php">Log Book</a></li>
		  	<li><a href="records.php">Records</a></li>
		  	<li class="right"><a href="logout.php">Log Out</a></li>
		</ul>

		<div style="margin-top: 3%;font-size: 32px;text-align: center;">Dashboard
		</div><br>

		<div class="dashContainer">
			<div class="card card-a" style="display: inline-block;width:23%; height: auto; padding:30px;">
				<img src="images/clipboard.png" width="50" style="vertical-align: middle;margin-bottom: 0.75em;" alt="Records">
		          <a href="records" style="text-decoration: none;"><span style="font-size: 24px;">Records</span></a>
		          <h1 style="text-align: center;"><?php echo $num_rec; ?></h1><br>
		          
		          <div id="wrap">
				    <div id="left_col">
				        Inspector<br><br>
				        Fire Officer<br><br>
				        Intern<br><br>
				        Others
				    </div>
				    <div id="right_col">
				    	<form action="records.php" method="GET">
				    		<input type="hidden" name="choice" value="inspector">
				    		<input type="submit" id="inputAsLink" name="val" value="<?php echo $num_insp; ?>"><br><br>
				    	</form>
				    	<form action="records.php" method="GET">
				    		<input type="hidden" name="choice" value="fireOfficer">
				    		<input type="submit" id="inputAsLink" name="val" value="<?php echo $num_fo; ?>"><br><br>
				    	</form>
				    	<form action="records.php" method="GET">
				    		<input type="hidden" name="choice" value="intern">
				    		<input type="submit" id="inputAsLink" name="val" value="<?php echo $num_intern; ?>"><br><br>
				    	</form>
				    	<form action="records.php" method="GET">
				    		<input type="hidden" name="choice" value="others">
				    		<input type="submit" id="inputAsLink" name="val" value="<?php echo $num_others; ?>">
				    	</form>
				    </div>
				</div>
			</div>

			<div class="card-b" style="margin-left: 5rem; display: inline-block; margin-bottom: 30px;width: 53%; height:350px;overflow: scroll;font-size: 18px;">    
				  <table class="table table-hover">
				    <thead>
				      <tr>
				        <th>Name</th>
				        <th>In</th>
				        <th>Out</th>
				        <th>Rendered Hours</th>
				        <th>Remaining Hours</th>
				      </tr>
				    </thead>
				    <tbody>
				      <?php
				      		function secondsToWords($seconds){
								$ret = "";

								/*** get the days ***/
								$days = intval(intval($seconds) / (3600*24));
								if($days> 0){
								    $ret .= "$days days ";
								}

								/*** get the hours ***/
								$hours = (intval($seconds) / 3600) % 24;
								if($hours > 0){
								    $ret .= "$hours hours ";
								}

								/*** get the minutes ***/
								$minutes = (intval($seconds) / 60) % 60;
								if($minutes > 0){
								    $ret .= "$minutes minutes ";
								}

								/*** get the seconds ***/
								$seconds = intval($seconds) % 60;
								if ($seconds > 0){
								    $ret .= "$seconds seconds";
								}

								return $ret;
							}

				      		$query = "SELECT * from client;";
				      		$result = mysqli_query($conn, $query);
				      		$id_arr = array();

				      		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				      			array_push($id_arr, $row['id']);
				      		}

				      		for ($ctr=0; $ctr < count($id_arr); $ctr++) { 
				      			$query = "SELECT * FROM client JOIN timelog USING(id) WHERE id = '$id_arr[$ctr]' ORDER BY timelog.dateOut, timeOut DESC LIMIT 1;";
				      			$result = mysqli_query($conn, $query);

				      			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				      				echo "<tr>
				      						<td>".$row['firstName']." ".$row['lastName']."</td>";
				      				if($row['timeOut'] != NULL){
				      					echo "<td></td>
				      						  <td><i class='fa fa-thumb-tack' style='color:#f94040;'></i></td>";
				      					$time_in = strtotime($row['timeIn']);
				      					$time_out = strtotime($row['timeOut']);
				      					$date_in = strtotime($row['timeOut']);
				      					$date_out = strtotime($row['timeOut']);
				      					$in = $time_in + $date_in;
				      					$out = $time_out + $date_out;
				      					$rendered = $out - $in;
				      					$rendered = secondsToWords($rendered);
				      					echo "<td>$rendered</td>";
				      					echo "</tr>";
				      				}else{
				      					echo "<td><i class='fa fa-thumb-tack' style='color: #2dadf7;'></i></td>
				      						  <td></td>";
				      					date_default_timezone_set('Asia/Manila');
            							$time_now = date("H:i:s");
            							$date_now = date("Y-m-d", time());
            							$date_now = strtotime($date_now);
            							$time_now = strtotime($time_now);
				      					$rendered = strtotime($row['timeIn']);
				      					$date = strtotime($row['dateIn']);
				      					$rendered = $rendered + $date;
				      					$time_now = $time_now + $date_now;
				      					$rendered = $time_now - $rendered;
				      					$rendered = secondsToWords($rendered);
				      					echo "<td>$rendered</td>";
				      					echo "</tr>";
				      				}
				      			}
				      		}	
				      ?>
				    </tbody>
				  </table>
			</div>
		</div>

		<div style="margin-top: 3%;font-size: 32px;text-align: center;">Weekly Time Report Chart
		</div>

		<div id="chart_div" class="card-b" style="margin:0 auto; margin-top: 2%; margin-bottom: 30px;width: 70%; height:auto; overflow: scroll;">
		</div>

	<script>
		google.charts.load('current', {'packages':['corechart']});
      	google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
	        var data = new google.visualization.DataTable();
	        data.addColumn('date', 'Date');
	      	data.addColumn('timeofday', 'User1');
	      	data.addColumn('timeofday', 'User2');

	        data.addRows([
	          /*<?php //$ctr = 0;
	           		//while($ctr < 16){
	           		//	echo "[new Date(2015, 0, $ctr), [$ctr, 30, 45]],";
	           		//	$ctr++;
	           		//}
	          ?>*/
	          [new Date(2015, 0, 7), [10, 0, 0, 0], [11, 0, 0, 0]],  
	          [new Date(2015, 0, 10), [10, 45, 0, 0], [12, 0, 0, 0]],
	          [new Date(2015, 0, 13), [11, 0, 0, 0], [13, 0, 0, 0]], 
	          [new Date(2015, 0, 16), [12, 15, 45, 0], [10, 0, 0, 0]], 
	          [new Date(2015, 0, 19), [13, 0, 0, 0], [15, 0, 0, 0]], 
	          [new Date(2015, 0, 22), [14, 30, 0, 0], [14, 0, 0, 0]], 
	          [new Date(2015, 0, 25), [15, 12, 0, 0], [13, 0, 0, 0]], 
	          [new Date(2015, 0, 28), [16, 45, 0], [16, 0, 0, 0]], 
	          [new Date(2015, 0, 31), [16, 59, 0], [18, 0, 0, 0]] 
	        ]);


	        var options = {
	          title: 'Weekly Time Report',
	          width: 900,
	          height: 500,
	          hAxis: {
	            format: 'MMM dd',
	            gridlines: {count: 15}
	          },
	          vAxis: {
	            gridlines: {color: 'none'}
	          }
	        };

	        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));

	        chart.draw(data, options);
      	}
	</script>
	</body>
</html>