<?php
	// for every user first time generate a unique id which is later used for referencing him
	session_start();
	$user = strtolower($_GET['user']);
	$uid = uniqid();
	$hide_overlay = false;

	// check for the user in database ad-users (id, uname, uid)
	if (isset($user) && $user != ''){		
		$servername = "127.0.0.1";
		$username = "root";
		$password = "sither04";
		$dbname = "ad-users";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		} 

		$sql = "SELECT * FROM users WHERE uname='".$user."'";
		$result = $conn->query($sql);

		if ($result->num_rows > 0) {
			$row = $result->fetch_assoc();
		    $uid = $row["uid"];
		} else {
		    echo "0 results, ";
		    $sql = "INSERT INTO users (uname, uid) VALUES ('$user', '$uid')";
		    if ($conn->query($sql) === TRUE) {
			    echo "New record created successfully";
			} else {
			    echo "Error: " . $sql . "<br>" . $conn->error;
			}
		}
		$hide_overlay = true;

		$conn->close();
	}
?>
<!DOCTYPE html>

<html lang="en">
	<head>
		<style>
		#overlay {
		    position: fixed;
		    display: block;
		    width: 100%;
		    height: 100%;
		    top: 0;
		    left: 0;
		    right: 0;
		    bottom: 0;
		    background-color: rgba(0,0,0,0.5);
		    z-index: 2;
		    cursor: pointer;
		}
		#namediv{
			margin-top: 500px;
			color: #fff;
			font-size: 98px;
			text-align: center;
		}
		#namediv input{
			width: 500px;
			height: 100px;
			font-size: 70px;
			display: inline-block;
			color: rgba(0,0,0,0.5);
			padding: 10px;
		}		
		</style>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE-edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Welcome to Anomaly Detection Package</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"> 
		<link rel="stylesheet" type="text/css" href="css/default.css">

	</head>

	<body>
		<?php
			if (!$hide_overlay){
		?>
			<div id="overlay">			
				<div id="namediv">
					User: <input type="text" name="username" id="overlay_input">
				</div>
			</div>
		<?php
			}
		?>
		<div class="banner">			
			<h1>Anomaly Detection Modules</h1>
		</div>

		<div class="container-fluid display-table">			
			<div class="row display-table-row">
				<!-- main content -->
				<div class="col-md-12 display-table-cell">
						<div class="row">
							<header id="nav-header" class="clearfix">
								<div class="col-md-5">
									<input type="text" id="header-search-field" placeholder="Search for Algos and Datasets...">
								</div>
								<div class="col-md-7">
									<ul class="pull-right">

										<li id="welcome">Welcome <?php echo strtoupper($user) ?> to the main panel</li>
										
										<li class="fixed-width">
											<a href="#">
												<span class="glyphicon glyphicon-bell" aria-hidden="true"></span>
												<span class="label label-warning">3</span>
											</a>											
										</li>
										<li class="fixed-width">
											<a href="#">
												<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
												<span class="label label-message">3</span>
											</a>											
										</li>
										<?php  
											if($hide_overlay){ 
										?>
												<li>
													<a href="#" class="logout">
														<span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>
														log out
													</a>																					
												</li>
										<?php 
											} 
										?>
									</ul>
								</div>
							</header>
						</div>

						<!-- main row -->
						<div class="row">
							<div class="col-md-11">
								<!-- modules -->
								<div class="row modules">
									<!-- module 1 -->
									<div class="col-md-4 module nab">
										<div class="row">
											<a href="#" class="clearfix">
											<span class="glyphicon glyphicon-chevron-right pull-right" id="right-arrow" aria-hidden="true"></span>
										    </a>
											<form id="form_nab" action="http://0.0.0.0:4000/methods/random" method="get" target="iframe-output">
												<ul style="list-style: none;">
													<h2>NAB Numenta</h2>
													<li>
														Datasets: 
														<select name="x">
														<?php 
															$servername = "127.0.0.1";
															$username = "root";
															$password = "sither04";
															$dbname = "ad";
															$conn = new mysqli($servername, $username, $password, $dbname);
															$sql = "SHOW TABLES";
															$datasets = $conn->query($sql);
															$format = '<option value="%s">%s</option>';
															while($row = $datasets->fetch_assoc()) {
													        	echo sprintf($format, $row["Tables_in_ad"], $row["Tables_in_ad"]);
													    	}
													    	$conn->close();
													    ?>
														</select>
													</li>												    
												    <li>
												    	Method:
											  	  	  <select name="method">
													      <option value="BayesChangePtDetector">Bayes Change Point</option>
												          <option value="NumentaDetector">Numenta</option>
												          <option value="HtmjavaDetector">HTM Java</option>
												          <option value="NumentaTMDetector">Numenta TM</option>
												          <option value="NullDetector">NULL</option>
												          <option value="RandomDetector">Random</option>
												          <option value="SkylineDetector">Skyline</option>
												          <option value="WindowedGaussianDetector">Windowed Gaussian</option>
												          <option value="RelativeEntropyDetector">Relative Entropy</option>
													  </select>	
												    </li>
											  	    
												    <li>
												    	Detect: <input type="checkbox" name="detect">	
												    </li>			
												    <li>
												    	Optimize: <input type="checkbox" name="optimize">	
												    </li>
												    <li>
												    	Normalize: <input type="checkbox" name="normalize">	
												    </li>
												    <li>
												    	Score: <input type="checkbox" name="score">	
												    </li>									    																		    
											    	<li>									  		
												  		<input type="button" onclick="nab_numenta()" value="Submit form">
											  		</li>
											  <ul>
											</form>										
										</div>
										<pre id="nabdemo"></pre> <!-- Testing -->
									</div> <!-- END of module 1 -->

									<!-- module 2 -->							
									<div class="col-md-8 module auto1">
										<div class="row" id="twitter">
											<div class="col-md-6">
												<form id="form_anomalydetectionts" name="form_anomalydetectionts" action="">
												<ul style="list-style: none;">
													<h2>Twitter Anomaly Detection Timeseries</h2>
												<li>
													Datasets:
													<select name="x">
													<?php 
														$servername = "127.0.0.1";
														$username = "root";
														$password = "sither04";
														$dbname = "ad";
														$conn = new mysqli($servername, $username, $password, $dbname);
														$sql = "SHOW TABLES";
														$datasets = $conn->query($sql);
														$format = '<option value="%s">%s</option>';
														while($row = $datasets->fetch_assoc()) {
												        	echo sprintf($format, $row["Tables_in_ad"], $row["Tables_in_ad"]);
												    	}
												    	$conn->close();
												    ?>
													</select>
												</li>
												<li>
													Max Anomaly: <input type="text" name="max_anoms" value="0.1">	
												</li>
											    
											    <li>
											    	Direction:
										  	  	  <select name="direction">
												    <option value="both">BOTH</option>
												    <option value="pos">POSITIVE</option>
												    <option value="neg">NEGATIVE</option>
												  </select>	
											    </li>
										  	    
												<li>
													Alpha: <input type="text" name="alpha" value="0.05">	
												</li>
											    
											    <li>
											    	Only Last:
										  	  	  <select name="only_last">
												    <option value="NULL">NULL</option>
												    <option value="day">DAY</option>
												    <option value="hr">HOUR</option>
												  </select>	
											    </li>
											    
											    <li>
											    	Threshold:
												  <select name="threshold">
												    <option value="None">NONE</option>
												    <option value="med_max">MED MAX</option>
												    <option value="p95">P95</option>
												    <option value="p99">P99</option>
												  </select>	
											    </li>
											    
											    <li>
											    	E Value: <input type="checkbox" name="e_value" value="TRUE">	
											    </li>
											    
											    <li>
											    	Longterm: <input type="checkbox" name="longterm" value="TRUE">
											    </li>
											    
											    <li>
											    	Piecewise Median Period Weeks: <input type="text" name="piecewise_median_period_weeks" value="2">
											    </li>
											    									    
										    	<li>									  		
											  		<input type="button" onclick="twitter_anomaly_ts()" value="Submit form">
										  		</li>
											  <ul>
											</form>
											</div>

											<div class="col-md-6"> <!-- Anomaly Detection Vec -->										
												<form id="form_anomalydetectionvec" name="form_anomalydetectionvec" action="">
												<ul style="list-style: none;">
													<h2>Twitter Anomaly Detection Vector</h2>
												<li>
													Datasets: 
													<select id="x" name="x">
													<?php 
														$servername = "127.0.0.1";
														$username = "root";
														$password = "sither04";
														$dbname = "ad";
														$conn = new mysqli($servername, $username, $password, $dbname);
														$sql = "SHOW TABLES";
														$datasets = $conn->query($sql);
														$format = '<option value="%s">%s</option>';
														while($row = $datasets->fetch_assoc()) {
												        	echo sprintf($format, $row["Tables_in_ad"], $row["Tables_in_ad"]);
												    	}
												    	$conn->close();
												    ?>
													</select>
												</li>
												<li>
													Max Anomaly: <input type="text" name="max_anoms" value="0.1">	
												</li>
											    
											    <li>
											    	Direction:
											  	  	  <select name="direction">
													    <option value="both">BOTH</option>
													    <option value="pos">POSITIVE</option>
													    <option value="neg">NEGATIVE</option>
													  </select>	
											    </li>
										  	    
												<li>
													Alpha: <input type="text" name="alpha" value="0.05">	
												</li>
											    
											    <li>
													Period: <input type="text" name="period" value="NULL">	
												</li>

												<li>
													Only Last: 	<input type="checkbox" name="only_last">
												</li>
											    
											    <li>
											    	Threshold:
												  <select name="threshold">
												    <option value="None">NONE</option>
												    <option value="med_max">MED MAX</option>
												    <option value="p95">P95</option>
												    <option value="p99">P99</option>
												  </select>	
											    </li>
											    
											    <li>
											    	E Value: <input type="checkbox" name="e_value">	
											    </li>
											    
											    <li>
											    	Longterm Period: <input type="text" name="longterm_period" value="NULL">
											    </li>
											    									    
										    	<li>									  		
											  		<input type="button" onclick="twitter_anomaly_vec()" value="Submit form">
										  		</li>
											  <ul>
											</form>
											</div>

										</div>

										<pre id="twitterdemo"></pre> <!-- Testing -->
									</div> <!-- END of module 2 -->	

									<!-- rapid miner module 

									<div class="col-md-6">
										<h2>Rapidminer Anomaly Detection Extension</h2>
									</div>					
									-->
								</div>
							</div> 

							<div class="col-md-1 module services">
								<h3 style="color: blue; text-align: center; margin: 2px;">Algos Status</h3>

								<ul class="services" id="services" style="list-style: none; padding: 0px; margin-top: 5px; margin-bottom: 2px;">
									<?php 
										$servername = "127.0.0.1";
										$username = "root";
										$password = "sither04";
										$dbname = "ad-services";
										$conn = new mysqli($servername, $username, $password, $dbname);
										// $sql = "SELECT * FROM services WHERE uid=".$uid." ORDER BY id DESC";
										$sql = sprintf("SELECT * FROM services WHERE uid='%s' ORDER BY id DESC", $uid);
										$datasets = $conn->query($sql);				
										$format = '<li class="service" style="margin-bottom:2px; cursor:pointer; border: solid 1px; padding-left: 5px; background-color=#90EE90;"> <a href="%s"> %s - %d </a> </li>';

										$actual_link = "http://" . $_SERVER['SERVER_NAME'];
										while($row = $datasets->fetch_assoc()) {
											// $url = $strtok($_SERVER["REQUEST_URI"],'?');
								        	echo sprintf($format, $actual_link."/results.php?uid=".$uid."&serviceid=".$row["serviceid"], $row["process_name"], $row["id"]);
								    	}
								    	$conn->close();
								    ?>
								    <!-- 
									<li class="service" style="margin-bottom:2px; cursor:pointer; border: solid 1px; padding-left: 5px; background-color=#90EE90;"> <a href="#"> Demo1 </a> </li> -->
								</ul>
							</div> <!-- services column ENDs -->
						</div><!-- main row div ENDs -->

						<div class="row">
							<footer id="admin-footer" class="clearfix">
								<div class="pull-left"><b>Copyright DFKI GmbH </b>&copy; 2018</div>
								<div class="pull-right">main system</div>
							</footer>
						</div>
				</div>
			</div>
		</div>

		<!-- jQuery and Bootstrap -->
		<script type="text/javascript" src="js/jquery.min.js"></script> 
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/utils.js"></script>
		<script>			
			$(document).ready(function(){
				$("#overlay_input").focus();
				var user = '<?php echo $user ?>';
				var uid = '<?php echo $uid ?>';

				var location = window.location.href;
		        if (location.includes('?')){
		        	var n = location.indexOf('?');
		        	location = 	location.substring(0,n);			        	
		        }

				$("#overlay_input").on('keyup', function (e) {
				    if (e.keyCode == 13) {				        				        
				        window.open(location+'?user='+document.getElementById('overlay_input').value, '_self');
				    }
				});

				$('.logout').on('click', function (e){
					 window.open(location, '_self');
				});			


				// REMOVE
				$("#form_anomalydetectionvec option:last").attr("selected", "selected"); 
			});

			function nab_numenta(){
				var json_obj = formDataToJSON('form_nab');
				var json_html = JSON.stringify(json_obj, undefined, 2); // formatted for html
				document.getElementById("nabdemo").innerHTML = json_html;		
			}

			function twitter_anomaly_ts() {
				// document.getElementById("form_anomalydetectionts").submit(); 				
				var json_obj = formDataToJSON('form_anomalydetectionts');
				var json_html = JSON.stringify(json_obj, undefined, 2); // formatted for html												
				var data={"x":"product","max_anoms":"riserva wine glass"};
				document.getElementById("twitterdemo").innerHTML = json_html;				

				$.ajax({
				   type: "POST",
				   url: "php/decode-forms.php",
				   async: true,
				   data: {jsondata: JSON.stringify(json_obj)},
				   success: function(data){
		   			  // document.getElementById("twitterdemo").innerHTML = data;
				      console.log(data);
				      return true;
				   },
				   complete: function() {},
				   error: function(xhr, textStatus, errorThrown) {
				     console.log('twitter_anomaly_ts ajax loading error...');
				     return false;
				   }
				});	
			}		

				

			function twitter_anomaly_vec() {		
				// document.getElementById("form_anomalydetectionvec").submit();							
				var json_obj = formDataToJSON('form_anomalydetectionvec');			
				json_obj["input_db"] = "ad";
				json_obj['uid'] = "<?php echo $uid ?>";
				var x = JSON.stringify(getQueryParams($('#form_anomalydetectionvec #x').serialize()));

				// serviceid
				var serviceid = '-1';
				$.ajax({
				   type: "POST",
				   url: "php/generate-uid.php",
				   async: true,
				   success: function(data){
				      // console.log(data);
		      		  serviceid = data;
		      		  json_obj["serviceid"] = serviceid;
		      		  var json_html = JSON.stringify(json_obj, undefined, 2);
		      		  // document.getElementById("twitterdemo").innerHTML = json_html;
		          
		      		  // call the R method
		      		  $.ajax({
						   type: "POST",
						   url: "http://localhost:8000/twitter",
						   async: true,
						   data: JSON.stringify(json_obj),
						   success: function(data){
						   	  document.getElementById("twitterdemo").innerHTML = JSON.stringify(data);

						   	  // add algo
						   	  $.ajax({
								   type: "POST",
								   url: "php/algo.php",
								   async: true,
								   data: {"serviceid":json_obj['serviceid']},
								   success: function(data){  		
								   	  $("#services").prepend(data);						   	  
								      // console.log(data);
								      return true;
								   },
								   complete: function() {},
								   error: function(xhr, textStatus, errorThrown) {
								     console.log('twittervec algo ajax loading error...');
								     return false;
								   }
								});


						      console.log(data);
						      return true;
						   },
						   complete: function() {},
						   error: function(xhr, textStatus, errorThrown) {
						     console.log('twittervec R ajax loading error...');
						     return false;
						   }
						});

				      return true;
				   },
				   complete: function() {},
				   error: function(xhr, textStatus, errorThrown) {
				     console.log('twittervec php ajax loading error...');
				     return false;
				   }
				});
			}
			
		</script>
	</body>

	</html>