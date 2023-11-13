<?php include_once 'header.php' ?>
<?php
	
ini_set( 'display_errors', 1 );
ini_set( 'display_startup_errors', 1 );
error_reporting( E_ALL );

?>
<?php 
	

	if(!isset($_SESSION['EID']) && empty($_SESSION['EID'])){
		header("location: accessDeniedM.php");
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
  <form action="viewReservationsM.php" method="post">
	  <?php ?> 
	  <h2>Account Details</h2>
	  
	  <?php
	  if($_SESSION['ACCESS'] == "p"){
	  echo " <h6>Welcome to your Account Page. Currently you are an employee at Hotel #".$_SESSION['HID']." with access to the following pages: </br>
		  	&nbsp;&nbsp;&nbsp;&nbsp;- Account. </br>
		  	&nbsp;&nbsp;&nbsp;&nbsp;- View Reservations </br>
	  		&nbsp;&nbsp;&nbsp;&nbsp;- Edit and Delete Reservations.</br>
	  		&nbsp;&nbsp;&nbsp;&nbsp;- Personal Inbox.</br> 
			&nbsp;&nbsp;&nbsp;&nbsp;- Employee Communication Channel.</h6></br>
			
			<h6> Your Employee ID is: [".$_SESSION['EID']."]</br> 
			
		  	<h6> Your Email is: [".$_SESSION['EMAIL']."]</br> 
			
			<h6> The Hotel you work at is: #[".$_SESSION['HID']."] in the system</br> 
			</br>";
	  }
	  
	  if($_SESSION['ACCESS'] == "f"){
	  echo " <h6>Welcome to your Account Page. Currently you are the Branch Manager with access to all pages and functionality: </br>
		  	&nbsp;&nbsp;&nbsp;&nbsp;- Account. </br>
		  	&nbsp;&nbsp;&nbsp;&nbsp;- View Reservations </br>
	  		&nbsp;&nbsp;&nbsp;&nbsp;- Edit and Delete Reservations.</br>
	  		&nbsp;&nbsp;&nbsp;&nbsp;- Personal Inbox. </br> 
			&nbsp;&nbsp;&nbsp;&nbsp;- Employee Communication Channel.</br>
			&nbsp;&nbsp;&nbsp;&nbsp;- Manage Roles. </br> 
			&nbsp;&nbsp;&nbsp;&nbsp;- Notification Posts. </br> 
			&nbsp;&nbsp;&nbsp;&nbsp;- Edit Hotel Page.</h6> </br> 
			
			<h6> Your Employee ID is [".$_SESSION['EID']."]</br> 
			
		  	<h6> Your Email is [".$_SESSION['EMAIL']."]</br> 
			";
	  }
	  
	  
				?>
	  
	  <h4> Update your relevant personal information below: </h4>
	  
	  <h5> Name </h5>
	  
    <div class="form-group">
      <div class="input-group">
        <div class="input-group-prepend">  </div>
        <input name="hotelID" class="form-control" placeholder="Enter Name" type="text" >
      </div>
    </div>
	  <div class="form-group mr-4">
      <button type="submit" class="btn btn-primary" name="view-reservations" value="view-reservations"> Submit </button>
      <!--<button type="submit reset" class="btn btn-primary" value="clear-all" name="clear-all" > Clear </button>-->
    </div>
	 <!-- <div class="form-group">
      <div class="input-group">
        <div class="input-group-prepend"> <span class="input-group-text"> <i class="fa fa-hotel"></i> </span> </div>
        <input name="username" class="form-control" placeholder="Enter Username" type="username" >
      </div>
    </div>-->
	<h5> Phone Number</h5>
    <div class="form-group">
      <div class="input-group">
        <div class="input-group-prepend">  </div>
        <input name="userID"  class="form-control" placeholder="Enter Mobile Phone" type="text">
      </div>
    </div>
    <div class="form-group mr-4">
      <button type="submit" class="btn btn-primary" name="view-reservations" value="view-reservations"> Submit </button>
      <!--<button type="submit reset" class="btn btn-primary" value="clear-all" name="clear-all" > Clear </button>-->
    </div>
	  
	  <h5> Mailing Address</h5>
    <div class="form-group">
      <div class="input-group">
        <div class="input-group-prepend">  </div>
        <input name="userID"  class="form-control" placeholder="Enter Mailing Address" type="text">
      </div>
    </div>
    <div class="form-group mr-4">
      <button type="submit" class="btn btn-primary" name="view-reservations" value="view-reservations"> Submit </button>
      <!--<button type="submit reset" class="btn btn-primary" value="clear-all" name="clear-all" > Clear </button>-->
    </div>
    <!-- <p class="text-center"><a href="#" class="btn">Forgot password?</a></p> -->
  </form>
  </br>
  </br>
  <div class="row ml-3">
    <?php 
	  if(isset($_POST['view-reservations'])){
		  include 'functionsM.php';
		  $mysqli = db_iconnectM("userlog");
		  
		  if(!empty($_POST['userID']) && empty($_POST['hotelID'])){
		 
		  $sql  = "SELECT A.RID,A.CID,A.START_DT,A.END_DT,B.RT_ID,C.HID,C.TYPE,D.USERNAME,E.NAME FROM `reservation` A,`rooms` B,`roomTypes` C,`customers` D,`hotels` E WHERE A.RID=B.RID AND A.CID=D.CID AND C.RT_ID=B.RT_ID AND E.HID=C.HID AND A.CID=" . $_POST['userID'] . ";";
		  
		$fetch = $mysqli->query($sql) or die("Reservation info not available");
		  while ($reservationRows = $fetch->fetch_assoc()){
			  


	  
		  }
		  }
		  
		  if(!empty($_POST['userID']) && !empty($_POST['hotelID']) ){
		 
		  $sql  = "SELECT A.RID,A.CID,A.START_DT,A.END_DT,B.RT_ID,C.HID,C.TYPE,D.USERNAME,E.NAME FROM `reservation` A,`rooms` B,`roomTypes` C,`customers` D,`hotels` E WHERE A.RID=B.RID AND A.CID=D.CID AND C.RT_ID=B.RT_ID AND E.HID=C.HID AND A.CID=" . $_POST['userID'] . " AND C.HID=". $_POST['hotelID'] .";";
		  
		$fetch = $mysqli->query($sql) or die("Reservation info not available");
		  while ($reservationRows = $fetch->fetch_assoc()){
			  
			
	  
		  }
		  }
		
		  if(empty($_POST['userID']) && !empty($_POST['hotelID']) ){
		 
		  $sql  = "SELECT A.RID,A.CID,A.START_DT,A.END_DT,B.RT_ID,C.HID,C.TYPE,D.USERNAME,E.NAME FROM `reservation` A,`rooms` B,`roomTypes` C,`customers` D,`hotels` E WHERE A.RID=B.RID AND A.CID=D.CID AND C.RT_ID=B.RT_ID AND E.HID=C.HID AND C.HID=". $_POST['hotelID'] .";";
		  
		$fetch = $mysqli->query($sql) or die("Reservation info not available");
		  while ($reservationRows = $fetch->fetch_assoc()){
			  
			

	  
		  }
		  }
		  
		  if(empty($_POST['userID']) && empty($_POST['hotelID']) ){
		 
		  $sql  = "SELECT A.RID,A.CID,A.START_DT,A.END_DT,B.RT_ID,C.HID,C.TYPE,D.USERNAME,E.NAME FROM `reservation` A,`rooms` B,`roomTypes` C,`customers` D,`hotels` E WHERE A.RID=B.RID AND A.CID=D.CID AND C.RT_ID=B.RT_ID AND E.HID=C.HID ;";
		  
		$fetch = $mysqli->query($sql) or die("Reservation info not available");
		  while ($reservationRows = $fetch->fetch_assoc()){
			  
			

	  
		  }
		  }
		  
		echo "</table>";
		    		   
	  }
	  ?>
  </div>
</div>
  </br>   </br> 
<?php include_once 'footer.php' ?>
</div>
</div>
