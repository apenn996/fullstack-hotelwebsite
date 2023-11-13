<?php
function db_iconnect($db)
{
	ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
	// keep credentials this way
	$hostname="*******";//localhost
	$username="*******";
	//$password="************";
	$password = "**************";
	$db_port        = '3306';
	$mysqli = new mysqli($hostname,$username,$password,$db,$db_port);
	if (mysqli_connect_error())
	{
		die("Something went wrong connecting to $db".mysqli_connect_error());
	}
	return $mysqli;
}
