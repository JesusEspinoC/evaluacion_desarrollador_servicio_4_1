<?php 
	require_once('modelo/Api.php');

	header("HTTP/1.1 200");
	header('Content-Type: application/json; charset=UTF-8');
	header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');

	$metodo =  $_SERVER['REQUEST_METHOD'];

	$api = new Api($metodo);
	// Se añade echo para mostrar la respuesta, y se mantienen solamente returns en clases
	echo $api->Call();

?>