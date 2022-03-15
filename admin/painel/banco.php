<?php
$con = mysqli_connect('127.0.0.1', 'tgi', 'V1n!c!us@', 'tgi');

function DataParaBanco($data){
	$data = explode("/", $data);
	$data = $data[2].'-'.$data[1].'-'.$data[0];
	return $data;
}
function DataParaHTML($data){
	$data = explode("-", $data);
	$data = $data[2].'/'.$data[1].'/'.$data[0];
	return $data;
}
?>