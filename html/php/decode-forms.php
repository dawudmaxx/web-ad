<?php


$json = $_POST['jsondata'];  
$data = json_decode($json);
echo $data->{'x'}.' '.$data->{'max_anoms'};


echo exec('pwd');



// for every user first time generate a unique id which is later used for referencing him
session_start();
$user = strtolower($_GET['user']);
$newid = uniqid();
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
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	        // echo " uid: " . $row["uid"];
	    }
	    $newid = $row["uid"];
	} else {
	    echo "0 results, ";
	    $sql = "INSERT INTO users (uname, uid) VALUES ('$user', '$newid')";
	    if ($conn->query($sql) === TRUE) {
		    echo "New record created successfully";
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
	$hide_overlay = true;

	$conn->close();
}


// call R here
/*$output = exec("Rscript ../R/plumber.R");
echo $output; */
/*
$ch = curl_init('localhost:8000/twitter');
curl_setopt_array($ch, array(
  CURLOPT_POST => TRUE,
  CURLOPT_RETURNTRANSFER => TRUE,
  CURLOPT_POSTFIELDS => json_encode($data)
));

$response = curl_exec($ch);

var_dump($response);

// Check for errors
if($response === FALSE){
	die(curl_error($ch));
}*/

?>