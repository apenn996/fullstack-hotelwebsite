<?php
function db_iconnectM($db)
{
	//echo"in";
	$hostname="******";//localhost
	//$username="******";
	$username = "*******";
	//$password="***********";
	$password = "*****";
	$mysqli = new mysqli($hostname,$username,$password,$db);
	//echo"here";
	if (mysqli_connect_error())
	{
		die("Something went wrong connecting to $db".mysqli_connect_error());
	}
	//echo"still";
	return $mysqli;
}