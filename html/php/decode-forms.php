<?php

$json = $_POST['jsondata'];  
$data = json_decode($json);
echo $data->{'x'}.' '.$data->{'max_anoms'};

?>