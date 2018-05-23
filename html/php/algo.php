<?php 
	// echo $_POST['serviceid'];


	$servername = "127.0.0.1";
	$username = "root";
	$password = "sither04";
	$dbname = "ad-services";
	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn->connect_error) {
	    // die("Connection failed: " . $conn->connect_error);
	    // echo "connection failed";
	} 
	$sql = sprintf("SELECT * FROM services WHERE serviceid='%s'", $_POST['serviceid']);
	$datasets = $conn->query($sql);		
	if ($datasets->num_rows > 0) {
		// echo "\n".$datasets->num_rows." rows found";
	} else {
	    // echo "\n0 row found";
	}
	$row = $datasets->fetch_assoc();


	$actual_link = "http://" . $_SERVER['SERVER_NAME'];
	$format = '<li class="service" style="margin-bottom:2px; cursor:pointer; border: solid 1px; padding-left: 5px; background-color=#90EE90;"> <a href="%s"> %s - %d </a> </li>';
	
	
	echo sprintf($format, $actual_link."/results.php?uid=".$row['uid']."&serviceid=".$row['serviceid'], $row["process_name"], $row["id"]);
	
	$conn->close();
	
?>