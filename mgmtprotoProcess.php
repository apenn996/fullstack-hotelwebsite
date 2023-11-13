<?php

//$mysqli = new mysqli('*******', '******', '*****', '*****') or die(mysqli_error($mysqli));
include ("functions.php");				//connects to the DB
$mysqli = db_iconnect("*****");
//$username = "hi";
// update properties table to include a data field for image names

// ========================================================================
// need to update conditional to not allow duplicate records in database
if (isset($_POST['register'])) {
    $username = $_POST['enter_username'];
    $email = $_POST['enter_email'];
    $password = $_POST['enter_password'];
	$sql = "INSERT INTO users (username, email, password) VALUES('$username', '$email', '$password')";
    $mysqli->query($sql) or die($mysqli->error);

    $_SESSION['message'] = "Record has been saved!";
    $_SESSION['msg_type'] = "success";

    header("location: mgmtprotoLogin.php");
}

if (isset($_POST['login'])) {				
    $EMAIL = $_POST['EMAIL'];
    $PW = $_POST['PW'];
	echo $EMAIL;
	echo $PW;
	$sql = "SELECT * FROM employees WHERE EMAIL='$EMAIL' AND PW='$PW'";	//as we need to mod the query its easier to mod var
    $result = $mysqli->query($sql) or die("Something went wrong with: $sql<br>".$mysqli->error()); //need to see the query and what values are fed in otherwise dont know the error

    if ($result->num_rows == 1) {
        while($row = $result->fetch_assoc()) {
            //echo "It works. Hooray.";
            //echo "<br> id: ". $row["id"]. " - Name: ". $row["username"]. " " . $row["email"] . " " . $row["password"] . "<br>";
            session_start();
            $_SESSION['EMAIL'] = $EMAIL;
            $_SESSION['EID'] = $row['EID'];
            // email variable in session?
            header("location: protoMain.php");
            exit();
        }
    } else {
        //echo "Zero results. Try again.";
        header("location: mgmtprotoLogin.php?status=incorrect");
    }
}

// Make sure reserve button only works if user is logged in and session exists
// $result statement should be fine since there can't be any duplicate usernames
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
    	echo "wrong range - try again";
		header("location: hotelbuildings2.php?wrongrange=true");
	}
	else {
	    
    // get unique ID from user logged in using username
    $fetchId = $mysqli->query("SELECT EID FROM employees WHERE EMAIL='$EMAIL'") or die($mysqli->error());
    $rowForId = $fetchId->fetch_assoc();

    // get price from properties
    $fetchPrice = $mysqli->query("SELECT price, availability, nightlyRateSurcharge FROM properties WHERE propId='$propId'") or die($mysqli->error());
    $rowForPrice = $fetchPrice->fetch_assoc();

    $userId = $rowForId['id'];
    $price = findTotalCost($startDate, $endDate, $rowForPrice['price'], $rowForPrice['nightlyRateSurcharge']);
    $availability = $rowForPrice['availability'];

    // if statement to handle what to do if availability is 0
    if ($availability == 0) {
        header("location: protoMain.php?reserveFail");
    }
    else {
        // query to insert new reservation in reservation table
        $mysqli->query("INSERT INTO reservations (id, propId, totalCost, startDate, endDate) VALUES('$userId', '$propId', '$price', '$startDate', '$endDate')") or die($mysqli->error);

        // query to decrement availability number from property reserved
        $availability --;
        $mysqli->query("UPDATE properties SET availability=$availability WHERE propId='$propId'") or die($mysqli->error);

        header("location: protoMain.php?reserved=true");
    }
	}
}

if (isset($_POST['reserveNotLoggedIn'])) {
    header("location: protoLogin.php?please=true");
}

if (isset($_POST['delete'])) {
	$userId = $_POST['userId'];
	$propId = $_POST['propId'];
	
	$query = "DELETE FROM reservations WHERE propId='$propId' AND id='$userId' LIMIT 1;";
	$mysqli->query($query) or die($mysqli->error);
	
	$query2 = "SELECT * FROM properties WHERE propId='$propId';";
	$fetch = $mysqli->query($query2) or die($mysqli->error);
	$rowForAvail = $fetch->fetch_assoc();
	$availability = $rowForAvail['availability'];
	$availability ++;
	$mysqli->query("UPDATE properties SET availability=$availability WHERE propId='$propId';");
	
	header("location: profile.php?deleted=true");
}

if (isset($_POST['modify'])) {
	// get variables from POST request for queries
	$propId = $_POST['propId'];
	$loginId = $_POST['loginName'];
	$reserveId = $_POST['reserveId'];
	$newStartDate = $_POST['newStartDate'];
	$newEndDate = $_POST['newEndDate'];
	
	// create two queries to update both start date and end date
	$queryStart = "UPDATE reservations SET startDate='$newStartDate' WHERE reserveId='$reserveId' AND id='$loginId' AND propId='$propId'";
	$queryEnd = "UPDATE reservations SET endDate='$newEndDate' WHERE reserveId='$reserveId' AND id='$loginId' AND propId='$propId'";
	
	// execute those queries
	$mysqli->query($queryStart) or die($mysqli->error);
	$mysqli->query($queryEnd) or die($mysqli->error);
	
	// ======================================================================
	// now we have to update the pricing for the modified reservation dates.
	$queryForNewPricing = "SELECT * FROM reservations, properties WHERE reservations.propId=properties.propId AND reservations.id='$loginId' AND reserveId='$reserveId';";
	
	// execute query and fetch row for PHP to read in data
	$fetchForNewPricing = $mysqli->query($queryForNewPricing) or die($mysqli->error);
	$rowForNewPricing = $fetchForNewPricing->fetch_assoc();
	
	// create new variables for update query
	$price = $rowForNewPricing['price'];
	$surcharge = $rowForNewPricing['nightlyRateSurcharge'];
	$newTotalCharge = findTotalCost($newStartDate, $newEndDate, $price, $surcharge);
	
	// query to update pricing for modified reservation
	
	header("location: profile.php?modifyTrue");
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
if(isset($_POST['editHP']))
{
    $propID = $_POST['propId'];
    $hotelName = $_POST['hotelName'];
    $roomType = $_POST['roomType'];
    $amenities = $_POST['amenities'];
    if(isset($_POST['visibility']))
    {
        $status = "1"; 
    }
    else{
        $status = "0";
    }
    $price = $_POST['price'];


    $new_image = $_FILES['img/standardMagnolia.jpg']['name'];
    $old_image = $_POST['img/standardMagnolia.jpg'];

    if($new_image != '')
    {
        $update_filename = $new_image;
    }
    else
    {
        $update_filename = $old_image;
    }

    if($new_image !='')
    {
        if(file_exists("../uploads/" . $new_image))
        {
            $filename = $new_image;
            redirect("editPH.php","Image already Exists ".$filename);
        }
    }
    $query = "UPDATE editHP SET hotelName='$hotelName', roomType='$roomType', amenities='$amenities', price='$price', img/standardMagnolia.jpg='$update_filename', status='$status' WHERE id='$propID' ";
    $query_run = mysqli_query($con, $query);
    if($query_run)
    {
        if($new_image !='')
        {
            move_uploaded_file($_FILES["img/standardMagnolia.jpg"]["tmp_name"], "../uploads/".$_FILES["img/standardMagnolia.jpg"]["name"]);
            unlink("../uploads/".$old_image);
        }
        redirect("editHP.php", "Data Updated Successfully");
    }
    else
    {
        redirect("editHP.php","Data NOT Updated.!");
    }
}
if(isset($_POST['AddHotelM']))
{
    
    if($filename = $_FILES['img/standardMagnolia.jpg']['name'] != '')
    {
          $propID = $_POST['propId'];
          $hotelName = $_POST['hotelName'];
		  $roomType = $_POST['roomType'];
          $amenities = $_POST['amenities'];
    if(isset($_POST['visibility']))
    {
        $status = "1"; 
    }
    else{
        $status = "0";
    }
    $price = $_POST['price'];

        $allowed_exttension = array('gif', 'png', 'jpg', 'jpeg');
        $filename = $_FILES['img/standardMagnolia.jpg']['name'];
        $file_extension = pathinfo($filename, PATHINFO_EXTENSION);
        if (!in_array($file_extension, $allowed_exttension)) 
        {
            $_SESSION['status'] = "You are allowed with only jpg, png, jpeg and gif ";
            header('Location: AddHotelM.php');
        }
        else
        {
            if(file_exists("upload/" . $_FILES['img/standardMagnolia.jpg']['name']))
            {
                $filename = $_FILES['img/standardMagnolia.jpg']['name'];
                $_SESSION['status'] = "Image already Exists ".$filename;
                header('Location: AddHotelM.php');
            }
            else
            {
                echo $add_query = "INSERT INTO editHP (hotelName,roomtype,amenites,price,img/standardMagnolia.jpg,status) VALUES ('$hotelName','$roomType','$amenities',,'$price','$filename','$status') ";
                $add_query_run = mysqli_query($con, $add_query);
            
                if($add_query_run)
                {
                    move_uploaded_file($_FILES["img/standardMagnolia.jpg"]["tmp_name"], "../uploads/".$_FILES["img/standardMagnolia.jpg"]["name"]);
                    $_SESSION['status'] = "Room AddHotelM Successfully";
                    header('Location: AddHotelM.php');
                }
                else
                {
                    $_SESSION['status'] = "Something went Wrong";
                    header('Location: AddHotelM.php');
                }
            }
        }
    }
    else
    {
        redirect("AddHotelM.php","Image field cannot be empty");
    }
}
if(isset($_GET['deletebutton']))
{
    $HID=$_GET['deletebutton'];
	
	$sql = "delete from `hotels` where HID=$HID";
	$result=mysqli_query($mysqli,$sql);
	if($result){
		echo "Deleted Successfull";
	}else{
		die(mysqli_error($mysqli));
		header("location: editHP.php");
}
    }


?>