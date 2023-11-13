<?php
	
include ("functions.php");
$mysqli = db_iconnect("*****");

// NOTE: worry about duplicate names
if (isset($_POST['register'])) {
    $username = $_POST['enter_username'];
    $email = $_POST['enter_email'];
    $password = $_POST['enter_password'];
	
	// auto increment option in phpmyadmin was acting wonky and weird for the 
	// customer database, so this segment of code will auto increment itself
	$fetchCID = $mysqli->query("SELECT CID FROM customers order by CID desc limit 1") or die($mysqli->error);
	$rowForCID = $fetchCID->fetch_assoc();
	$lastCID = $rowForCID['CID'];
	$lastCID ++;
	
	$sql = "INSERT INTO customers (CID, USERNAME, EMAIL, PW) VALUES('$lastCID', '$username', '$email', '$password')";
    $mysqli->query($sql) or die($mysqli->error);

    header("location: protoLogin.php?registered=true");
}

if (isset($_POST['login'])) {	

		
    $username = $_POST['username'];
    $password = $_POST['password'];
	$sql = "SELECT * FROM customers WHERE USERNAME='$username' AND PW='$password'";	//as we need to mod the query its easier to mod var
    $result = $mysqli->query($sql) or die("Something went wrong with: $sql<br>".$mysqli->error()); //need to see the query and what values are fed in otherwise dont know the error
	
    if ($result->num_rows == 1) {
        while($row = $result->fetch_assoc()) {
            //echo "It works. Hooray.";
            //echo "<br> id: ". $row["id"]. " - Name: ". $row["username"]. " " . $row["email"] . " " . $row["password"] . "<br>";
            session_start();
            $_SESSION['loginName'] = $username;
            $_SESSION['id'] = $row['CID'];
            header("location: protoMain.php");
            exit();
        }
    }
	else {
        header("location: protoLogin.php?status=incorrect");
    }
}
// Make sure reserve button only works if user is logged in and session exists
// $result statement should be fine since there can't be any duplicate usernames
// make sure users can only reserve from today's date and onward
if (isset($_POST['reserve'])) {
    // grab propId and username to be used in following queries
    $propId = $_POST['propId'];
    $username = $_POST['loginName'];
	$startDate = $_POST['startDate'];
	$endDate = $_POST['endDate'];
	
	// check if dates are correct (end date does not start before start date)
	$time1 = strtotime($startDate);
	$time2 = strtotime($endDate);
	if($time1 > $time2){
    	//echo "wrong range - try again";
		header("location: hotelbuildings2.php?wrongrange=true");
	}
	else {
	    
    // get unique ID from user logged in using username
    $fetchId = $mysqli->query("SELECT CID FROM customers WHERE USERNAME='$username'") or die($mysqli->error());
    $rowForId = $fetchId->fetch_assoc();
	//pre_r($rowForId);

    // get price from properties
    $fetchPrice = $mysqli->query("SELECT * FROM hotels, roomTypes WHERE hotels.HID=roomTypes.HID and roomTypes.RT_ID='$propId'") or die($mysqli->error());
    $rowForPrice = $fetchPrice->fetch_assoc();
	//pre_r($rowForPrice);

    $userId = $rowForId['CID'];
    $price = findTotalCost($startDate, $endDate, $rowForPrice['PRICE'], $rowForPrice['WKND_DIFF']);
    $availability = $rowForPrice['NUM_ROOMS'];
	//echo "Availability: " . $availability;
	//echo "User id: " . $userId;
	//echo "Total price: " . $price;

    // if statement to handle what to do if availability is 0
    if ($availability == 0) {
        header("location: buildingpage2.php?reserveFail");
    }
    else {
		
		//SELECT RES_NUM FROM reservation order by RES_NUM desc limit 1
		// auto increment option in phpmyadmin was acting wonky and weird for the 
		// customer database, so this segment of code will auto increment itself
		$fetchNum = $mysqli->query("SELECT RES_NUM FROM reservation order by RES_NUM desc limit 1") or die($mysqli->error);
		$rowForNum = $fetchNum->fetch_assoc();
		$lastNum = $rowForNum['RES_NUM'];
		$lastNum ++;
		//echo "last num: " . $lastNum;
		$getRID = "SELECT RID FROM `rooms` WHERE RT_ID='$propId' limit 1;";
		$myRID = $mysqli->query($getRID) or die();
		$row3=$myRID->fetch_assoc();
		$fRID=$row3['RID'];
        // query to insert new reservation in reservation table
        $mysqli->query("INSERT INTO reservation (RES_NUM, RID, CID, TOTAL, START_DT, END_DT, RT_ID) VALUES('$lastNum', '$fRID', '$userId', '$price', '$startDate', '$endDate', '$propId')") or die($mysqli->error);

        // query to decrement availability number from property reserved
        $availability --;
        $mysqli->query("UPDATE roomTypes SET NUM_ROOMS=$availability WHERE RT_ID='$propId'") or die($mysqli->error);
		//echo "availability: $availability";

        header("location: protoMain.php?reserved=true");
    }
	}
}

if (isset($_POST['reserveNotLoggedIn'])) {
    header("location: protoLogin.php?please=true");
}

if (isset($_POST['delete'])) {
	$userId = $_POST['loginName'];
	$propId = $_POST['propId'];
	$reserveId = $_POST['reserveId'];
	//echo '$propId is' . $propId .'userID is '. $userId .' and RES_NUM is' . $reserveId .'';
	$query = "DELETE FROM reservation WHERE RT_ID='$propId' AND CID='$userId' AND RES_NUM='$reserveId';";
	$mysqli->query($query) or die($mysqli->error);
	
	$query2 = "SELECT * FROM roomTypes WHERE RT_ID='$propId';";
	$fetch = $mysqli->query($query2) or die($mysqli->error);
	$rowForAvail = $fetch->fetch_assoc();
	$availability = $rowForAvail['NUM_ROOMS'];
	$availability ++;
	$mysqli->query("UPDATE roomTypes SET NUM_ROOMS=$availability WHERE RT_ID='$propId';");
	
	header("location: profile.php?deleted=true");
}

if (isset($_POST['modify'])) {
	// get variables from POST request for queries
	$propId = $_POST['propId'];
	$loginId = $_POST['loginName'];
	$reserveId = $_POST['reserveId'];
	$newStartDate = $_POST['newStartDate'];
	$newEndDate = $_POST['newEndDate'];
	
	$time1 = strtotime($newStartDate);
	$time2 = strtotime($newEndDate);
	if($time1 > $time2){
		header("location: profile.php?wrongrange=true");
	}
	else {
	
	// create two queries to update both start date and end date
	$queryStart = "UPDATE reservation SET START_DT='$newStartDate' WHERE RES_NUM='$reserveId' AND CID='$loginId' AND RT_ID='$propId'";
	$queryEnd = "UPDATE reservation SET END_DT='$newEndDate' WHERE RES_NUM='$reserveId' AND CID='$loginId' AND RT_ID='$propId'";
	
	// execute those queries
	$mysqli->query($queryStart) or die($mysqli->error);
	$mysqli->query($queryEnd) or die($mysqli->error);
	
	// ======================================================================
	// now we have to update the pricing for the modified reservation dates.
	$queryForNewPricing = "SELECT * FROM reservation, roomTypes, hotels WHERE reservation.RT_ID=roomTypes.RT_ID AND reservation.CID='$loginId' AND RES_NUM='$reserveId' AND roomTypes.HID=hotels.HID";
	
	// execute query and fetch row for PHP to read in data
	$fetchForNewPricing = $mysqli->query($queryForNewPricing) or die($mysqli->error);
	$rowForNewPricing = $fetchForNewPricing->fetch_assoc();
	
	// create new variables for update query
	$price = $rowForNewPricing['PRICE'];
	$surcharge = $rowForNewPricing['WKND_DIFF'];
	$newTotalCost = findTotalCost($newStartDate, $newEndDate, $price, $surcharge);
	
	// query to update pricing for modified reservation
	$queryToUpdatePricing = "UPDATE reservation SET TOTAL='$newTotalCost' WHERE RES_NUM='$reserveId';";
	
	// execute query
	$mysqli->query($queryToUpdatePricing) or die($mysqli->error);
	
	header("location: profile.php?modifyTrue");
	}
}

function pre_r( $array ) {
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}

function findTotalCost($startDate, $endDate, $price, $surcharge) {
	$begin = new DateTime($startDate);
	$end = new DateTime($endDate);
	$totalCost = 0;

	for($i = $begin; $i <= $end; $i->modify('+1 day')){
    	$day = $i->format("Y-m-d");
		$dayofweek = date('w', strtotime($day));
	
		if ($dayofweek == 0 || $dayofweek == 5 || $dayofweek == 6) {
			$totalCost += ($price * (1 + $surcharge));
			continue;
		}
	
		$totalCost += $price;
	}

	return $totalCost;
}
?>