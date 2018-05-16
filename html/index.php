<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE-edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Welcome to Anomaly Detection Package</title>

		<!-- Bootstrap CSS -->
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"> 
		<link rel="stylesheet" type="text/css" href="css/default.css">

	</head>

	<body>
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
										<li id="welcome">Welcome to main panel</li>
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
										<li>
											<a href="#" class="logout">
												<span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>
												log out
											</a>											
										</li>
									</ul>
								</div>
							</header>
						</div>

						<!-- modules -->
						<div class="row modules">
							<!-- module 1 -->
							<div class="col-md-6 module nab">
								<h1>
									NAB
								</h1>
								<a href="#" class="clearfix">
								<span class="glyphicon glyphicon-chevron-right pull-right" id="right-arrow" aria-hidden="true"></span>
							    </a>
								<div class="row">
									<div class="col-md-6">
										<form action="http://0.0.0.0:4000/methods/random" method="get" target="iframe-output">
											<p><strong>Select nab methods (press strg for multi-select): </strong></p>
											<select class="select-methods" multiple size="9">
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


											<p><strong>Select parameters (press strg for multi-select): </strong></p>
											<select multiple size="7">
											          <option value="detect">Detect</option>
											          <option value="normalize">Normalize</option>
											          <option value="optimize">Optimize</option>
											          <option value="score">Score</option>
											          <option value="-windowsfile">WinFile</option>
											          <option value="-profilefile">ProFile</option>
											          <option value="-thresholdfile">ThesFile</option>
											</select>

											<div class="nab-submit"> <input type="submit" name="submit-nab"> </div>
										</form>
									</div>

									<!-- Output -->
									<div class="col-md-6 output">
										<p> <strong> Command </strong></p>
										<span class="command">python run.py --skipConfirmation </span>

										<p><strong> Output </strong></p>
										<iframe src="" name="iframe-output" >
											
										</iframe>

										<iframe class="status" src="" name="iframe-status">
											
										</iframe>
									</div>
								</div>

							</div>

							<!-- module 2 -->							
							<div class="col-md-6 module auto1">
								<div class="row">
									<div class="col-md-6">
										<form id="form_anomalydetectionts" action="">
										<ul>
											<h2>Twitter Anomaly Detection Timeseries</h2>
										<li>
											Datasets: <input type="text" name="x" required value="ts_Yahoo_A1Benchmark_real_1">
										</li>
										<li>
											Max Anomaly: <input type="text" name="max_anoms" value="0.1">	
										</li>
									    
									    <li>
									    	Direction:
								  	  	  <select>
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
								  	  	  <select>
										    <option value="NULL">NULL</option>
										    <option value="day">DAY</option>
										    <option value="hr">HOUR</option>
										  </select>	
									    </li>
									    
									    <li>
									    	Threshold:
										  <select>
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
										<form id="form_anomalydetectionvec" action="">
										<ul>
											<h2>Twitter Anomaly Detection Vector</h2>
										<li>
											Datasets: <input type="text" name="x" required value="ts_Yahoo_A1Benchmark_real_1">
										</li>
										<li>
											Max Anomaly: <input type="text" name="max_anoms" value="0.1">	
										</li>
									    
									    <li>
									    	Direction:
									  	  	  <select>
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
											Only Last: 	<input type="checkbox" name="TRUE">
										</li>
									    
									    <li>
									    	Threshold:
										  <select>
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
									    	Longterm Period: <input type="text" name="longterm_period" value="NULL">
									    </li>
									    									    
								    	<li>									  		
									  		<input type="button" onclick="twitter_anomaly_vec()" value="Submit form">
								  		</li>
									  <ul>
									</form>
									</div>

								</div>

									
							</div>

						</div>

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
		<script>
			function twitter_anomaly_ts() {
				// document.getElementById("form_anomalydetectionts").submit(); 
				var form1 = document.getElementById('form_anomalydetectionts');
				var query = $(form1).serialize();
				alert(query) 
			}

			function twitter_anomaly_vec() {
			    document.getElementById("form_anomalydetectionvec").submit();			


			}
		</script>
	</body>

	</html>