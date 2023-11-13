<?php

echo"1-";


$res = include("functionsM.php");
//echo $res;
echo"2-";
$mysqli = db_iconnectM("*****");
echo"INTE";
if(isset($_POST['view-reservations'])){
echo"3-";
	$username = $_POST['username'];
	$userID = $_POST['userID'];
	echo $userID;
	echo $username;
	if(empty($userID) && empty($username)){
		$sql = "SELECT * FROM properties, reservations WHERE properties.propId=reservations.propId";
		$mysqli->query($sql) or die("Reservation info not available");
	}
	echo"4-";
	if(empty($username)){
	$sql = "SELECT * FROM properties, reservations WHERE properties.propId=reservations.propId AND reservations.id=" . $userID . ";";
		$mysqli->query($sql) or die("Reservation info not available");
	}
	echo"5-";
	header("location: viewReservationsM.php?reservations-get=true");

}

if(isset($_POST['clear-all'])){
	
	$sql = "SELECT * FROM properties, reservations WHERE properties.propId=reservations.propId AND reservations.id=" . $userID . ";";
		$mysqli->query($sql) or die("Reservation info not available");
	header("location: viewReservationsM.php?reservations-get=false");
}



echo"6-";
?>
