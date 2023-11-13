<?php include_once 'header.php' ?>
<?php
	
ini_set( 'display_errors', 1 );
ini_set( 'display_startup_errors', 1 );
error_reporting( E_ALL );

?>
<?php 

	function findTotalCost2($startDate, $endDate, $price, $surcharge) {
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

	if(!isset($_SESSION['EID']) && empty($_SESSION['EID'])){
		header("location: accessDeniedM.php");
	}
	
?>
<?php if (isset($_GET['wrongrange'])) {
			echo '<div class="alert alert-warning" role="alert">
  		Range of new reservation dates is invalid. Please try again.
		</div>';
	}
?>
<?php ?>
<script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
<div class="wrapper">
<?php require_once 'sideNavbarM.php'; ?>


<div class="main_content">
<div id="blue-header"></div>
<?php 
	if($_SESSION['ACCESS'] == "p"){
	echo "<div class=\"header\">You are currently logged in as an administrator with [Employee] permissions. </div>";  
	}
	if($_SESSION['ACCESS'] == "f"){
		echo "<div class=\"header\">You are currently logged in as an administrator with [Branch Manager] permissions. </div>";  
	}
		
		?>
<div class="info">
  <form action="editReservationsM.php" method="post">
	  <h2>Edit or Delete Reservations</h2>
	  </br>
	
		<h2><center>Edit </center></h2>
	  <h6>Reservations can be edited to update the following fields: </br>
		  	&nbsp;&nbsp;&nbsp;&nbsp;- Room type. </br>
		  	&nbsp;&nbsp;&nbsp;&nbsp;- Start date. </br>
	  		&nbsp;&nbsp;&nbsp;&nbsp;- End date.</br>
	  		&nbsp;&nbsp;&nbsp;&nbsp;- Price (as a consequence of changing dates and room types).</h6>
	  </br> 
	<!--  <h5> Hotel </h5>
	  
    <div class="form-group">
      <div class="input-group">
        <div class="input-group-prepend">  </div>
        <input name="hotelID-E" class="form-control" placeholder="Enter Hotel ID" type="number" >
      </div>
    </div>-->
	 <!-- <div class="form-group">
      <div class="input-group">
        <div class="input-group-prepend"> <span class="input-group-text"> <i class="fa fa-hotel"></i> </span> </div>
        <input name="username" class="form-control" placeholder="Enter Username" type="username" >
      </div>
    </div>-->
	<h5> Reservation </h5>
	  
    <div class="form-group">
      <div class="input-group">
        <div class="input-group-prepend">  </div>
        <input name="RES_NUM-E" class="form-control" placeholder="Enter Reservation ID" type="number" >
      </div>
    </div>
	<h5> Customer </h5>
    <div class="form-group">
      <div class="input-group">
        <div class="input-group-prepend">  </div>
        <input name="userID-E"  class="form-control" placeholder="Enter User ID" type="number">
      </div>
    </div>
	</br></br>
	<h6>Enter the fields to be changed. Blank fields will be left as is. </h6>
	<h5> Room Type ("standard", "queen" or "king") </h5>
    <div class="form-group">
      <div class="input-group">
        <div class="input-group-prepend">  </div>
        <input name="roomType-E"  class="form-control" placeholder="Enter Room Type" type="text">
      </div>
    </div>
	<div class="row">
		<div class="col-6">
	<h5> Start Date </h5>
    <div class="form-group">
      <div class="input-group">
        <div class="input-group-prepend">  </div>
        <input name="startDt-E"  class="form-control" placeholder="Enter First Day of Reservation" type="date">
      </div>
    </div>
			</div>
		<div class="col-6">
	<h5> End Date </h5>
    <div class="form-group">
      <div class="input-group">
        <div class="input-group-prepend">  </div>
        <input name="endDt-E"  class="form-control" placeholder="Enter Last Day of Reservation" type="date">
      </div>
    </div>
		</div>
	</div>

	
    <div class="form-group mr-4">
      <button type="submit" class="btn btn-secondary" name="edit-reservations" value="edit-reservations"> Update</button>
      <!--<button type="submit reset" class="btn btn-primary" value="clear-all" name="clear-all" > Clear </button>-->
    </div>
</br></br><hr class="hr1">
</br></br>
		<h2><center>Delete </center></h2>
			<h6>To delete a reservation, all fields must be entered in the form below. </br>
		  	&nbsp;&nbsp;&nbsp;&nbsp;- The action of deleting a reservation is irreversible. </br>
		  	&nbsp;&nbsp;&nbsp;&nbsp;- Only one reservation can be deleted at a time. </br>

	  </br> 
	  <h5> Reservation </h5>
	  
    <div class="form-group">
      <div class="input-group">
        <div class="input-group-prepend">  </div>
        <input name="RES_NUM-D" class="form-control" placeholder="Enter Reservation ID" type="number" >
      </div>
    </div>
	<!--<h5> Hotel </h5>
	  
    <div class="form-group">
      <div class="input-group">
        <div class="input-group-prepend">  </div>
        <input name="hotelID-D" class="form-control" placeholder="Enter Hotel ID" type="number" >
      </div>
    </div>-->
<!-- <div class="form-group">
      <div class="input-group">
        <div class="input-group-prepend"> <span class="input-group-text"> <i class="fa fa-hotel"></i> </span> </div>
        <input name="username" class="form-control" placeholder="Enter Username" type="username" >
      </div>
    </div>-->
	<h5> Customer </h5>
    <div class="form-group">
      <div class="input-group">
        <div class="input-group-prepend">  </div>
        <input name="userID-D"  class="form-control" placeholder="Enter Customer ID" type="number">
      </div>
    </div>
    <div class="form-group mr-4">
      <button type="submit" class="btn btn-danger" name="delete-reservations" value="delete-reservations"> Delete</button>
      <!--<button type="submit reset" class="btn btn-primary" value="clear-all" name="clear-all" > Clear </button>-->
    </div>


    <!-- <p class="text-center"><a href="#" class="btn">Forgot password?</a></p> -->
  </form>




  </br>
  </br>
  <div class="row ml-3">
    <?php 
	  if(isset($_POST['delete-reservations'])){
		  include 'functionsM.php';
		  $mysqli = db_iconnectM("userlog");
		 
		  
		  
		  if(!empty($_POST['userID-D']) && !empty($_POST['RES_NUM-D']) ){
		
			  
		  $query = "DELETE FROM `reservation` WHERE RES_NUM=".$_POST['RES_NUM-D']." AND CID=".$_POST['userID-D']." LIMIT 1;";
			$mysqli->query($query) or die($mysqli->error);
		  
		 echo '<div class="callout" style="border: 2px solid; color: white; background:lightgrey;">
			  <div class="callout-header" style="background: green; color: black;">Success!</div>
			  <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>
			  <div class="callout-container" style="background: lightgrey;">
				
				<p>You have deleted the single reservation corresponding to the reservation ID and customer ID. </p>
			  </div>
			</div>';
		
		  }else{
			  //some fields are empty
			   echo '<div class="callout" style="border: 2px solid; color: black; background:lightgrey;">
			  <div class="callout-header" style="background: orange;">Warning</div>
			  <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>
			  <div class="callout-container" style="background: lightgrey;">
				<p>Your reqeuest to delete a reservation has failed. </br> You might not have filled each required entry. </p>
			  </div>
			</div>';
		  }		   
	  }
	  ?>
	  
	  <?php 
	  if(isset($_POST['edit-reservations'])){
		  include 'functionsM.php';
		  $mysqli = db_iconnectM("userlog");
		 
		  
		  
		  if(!empty($_POST['userID-E']) && !empty($_POST['RES_NUM-E']) ){
		 
			  
			  $before = "SELECT h.WKND_DIFF, rt.PRICE, rt.HID,ro.rt_ID,r.RES_NUM,r.RID,r.CID,r.TOTAL,r.START_DT,r.END_DT FROM `reservation` r,`rooms` ro,`roomTypes` rt,`hotels` h WHERE rt.HID=h.HID AND rt.RT_ID=ro.RT_ID AND r.RID=ro.RID AND RES_NUM=".$_POST['RES_NUM-E']." AND CID=".$_POST['userID-E']." LIMIT 1;";
			  $before_ex = $mysqli->query($before) or die($mysqli->error);
			  $before = $before_ex->fetch_assoc();
			  
			  $RES_NUM=$before['RES_NUM'];
			  $RID=$before['RID'];
			  $CID=$before['CID'];
			  $startDt=$before['START_DT'];
			  $endDt=$before['END_DT'];
			  $roomType=$before['rt_ID'];
			  $HID=$before['HID'];
			  $price=$before['PRICE'];
			  $diff=$before['WKND_DIFF'];
			 // echo "here 1";
			 
			
			  
			  if(!empty($_POST['roomType-E'])){
				  $roomType=$_POST['roomType-E'];
			  }
			  if(!empty($_POST['startDt-E']) ){
				  $startDt=$_POST['startDt-E'];
			  }
			  if(!empty($_POST['endDt-E'])){
				  $endDt=$_POST['endDt-E'];
			  }
			  	$newstartDt = date("Y-m-d", strtotime($startDt));
			  	$newendDt = date("Y-m-d", strtotime($endDt));
			 
			  $startDt=$newstartDt;
			  $endDt=$newendDt;
			//   echo $startDt;
			//  echo $endDt;
			  echo $RID;
			  echo $roomType;
			  	$time1 = strtotime($startDt);
				$time2 = strtotime($endDt);
				if($time1 > $time2){
				 echo '<div class="callout" style="border: 2px solid; color: black; background:lightgrey;">
			  <div class="callout-header" style="background: red;">Error</div>
			  <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>
			  <div class="callout-container" style="background: lightgrey;">
				
				<p>Your reqeuest to update the reservation has failed. </br> There is an error with the specified dates. </p>
			  </div>
			</div>';
					exit();
				}
			  //	 echo "here 2";
			$total =  findTotalCost2($startDt, $endDt, $price, $diff);
			  
			  if($roomType=="standard"){
				  $rtq = "SELECT r.RID FROM `rooms` r,`roomTypes` rt WHERE r.RT_ID=rt.RT_ID AND rt.TYPE=\"s\" AND HID=$HID LIMIT 1;";
			  $rtqs = $mysqli->query($rtq) or die($mysqli->error);
			  $rtqa = $rtqs->fetch_assoc();
				  $RID=$rtqa['RID'];
			  }
			  if($roomType=="queen"){
				 $rtq = "SELECT r.RID FROM `rooms` r,`roomTypes` rt WHERE r.RT_ID=rt.RT_ID AND rt.TYPE=\"q\" AND HID=$HID LIMIT 1;";
			  			  $rtqs = $mysqli->query($rtq) or die($mysqli->error);
			  $rtqa = $rtqs->fetch_assoc();
				  $RID=$rtqa['RID'];
			  }if($roomType=="king"){
				$rtq = "SELECT r.RID FROM `rooms` r,`roomTypes` rt WHERE r.RT_ID=rt.RT_ID AND rt.TYPE=\"k\" AND HID=$HID LIMIT 1;";
			  $rtqs = $mysqli->query($rtq) or die($mysqli->error);
			  $rtqa = $rtqs->fetch_assoc();
				  $RID=$rtqa['RID'];
			  }
			  echo $RID;
			  			  echo $roomType;
			//  echo "here 3";
		  $query ="UPDATE `reservation` SET START_DT=\"$startDt\", END_DT=\"$endDt\", RID=$RID, TOTAL=$total WHERE RES_NUM=$RES_NUM AND CID=$CID LIMIT 1;";
			$mysqli->query($query) or die($mysqli->error);
		  
			  echo '<div class="callout" style="border: 2px solid; color: black; background:lightgrey;">
			  <div class="callout-header" style="background: green; color: black;">Success!</div>
			  <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>
			  <div class="callout-container" style="background: lightgrey;">
				
				<p>You have successfully edited a reservation. </p>
			  </div>
			</div>';
			//  echo "success!!!!";
		  }
		else{
			//left fields specifying reservation empty
			 echo '<div class="callout" style="border: 2px solid; color: black; background:lightgrey;">
			  <div class="callout-header" style="background: orange;">Warning</div>
			  <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>
			  <div class="callout-container" style="background: lightgrey;">
				<p>Your reqeuest to update a reservation has failed. </br> You might not have filled each required entry. </p>
			  </div>
			</div>';
		}
	  }
	  ?>
	  
	  
  </div>
</div>
  </br>   </br> 
<?php include_once 'footer.php' ?>
</div>
</div>
		
