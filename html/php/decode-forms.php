<?php


$json = $_POST['jsondata'];  
$data = json_decode($json);
echo $data->{'x'}.' '.$data->{'max_anoms'};

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