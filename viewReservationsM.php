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
	  <h2>Reservation Filter</h2>
	  <h6>Reservations can be viewed based on the filters below: </br>
		  	&nbsp;&nbsp;&nbsp;&nbsp;- Both, one, or no entries can be entered. </br>
		  	&nbsp;&nbsp;&nbsp;&nbsp;- Entering both entries will filter out reservations that dont meet both criteria. </br>
	  		&nbsp;&nbsp;&nbsp;&nbsp;- Entering one entry will display reservations that meet only that characteristic.</br>
	  		&nbsp;&nbsp;&nbsp;&nbsp;- Entering no entries will show all current reservations.</h6>
	  </br> 
	  <h5> Hotel </h5>
	  
    <div class="form-group">
      <div class="input-group">
        <div class="input-group-prepend">  </div>
        <input name="hotelID" class="form-control" placeholder="Enter Hotel ID" type="number" >
      </div>
    </div>
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
        <input name="userID"  class="form-control" placeholder="Enter Customer ID" type="number">
      </div>
    </div>
    <div class="form-group mr-4">
      <button type="submit" class="btn btn-primary" name="view-reservations" value="view-reservations"> View</button>
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
		  echo " <table class=\"table\" style='border: 2px solid; color: black; padding: 0.5rem; width: 95%; border-collapse: collapse; '>
		  			<thead class=\"thead-dark\"><tr>
					<th style='border: 2px solid #000000;  text-align: center;'>Customer ID</th>
					<th style='border: 2px solid #000000;  text-align: center;'>Customer Username</th>
					<th style='border: 2px solid #000000;  text-align: center;'>Hotel Name</th>
					<th style='border: 2px solid #000000;  text-align: center;'>Hotel ID</th>
					<th style='border: 2px solid #000000;  text-align: center;'>Reservation ID</th>
					<th style='border: 2px solid #000000;  text-align: center;'>Room Type</th>
					<th style='border: 2px solid #000000;  text-align: center;'>Cost (USD)</th>
					<th style='border: 2px solid #000000;  text-align: center;'>Start Date</th>
					<th style='border: 2px solid #000000;  text-align: center;'>End Date</th>
				  </tr></thead>";
		  if(!empty($_POST['userID']) && empty($_POST['hotelID'])){
		 
		  $sql  = "SELECT A.TOTAL, A.RES_NUM,A.CID,A.START_DT,A.END_DT,B.RT_ID,C.HID,C.TYPE,D.USERNAME,E.NAME FROM `reservation` A,`rooms` B,`roomTypes` C,`customers` D,`hotels` E WHERE A.RID=B.RID AND A.CID=D.CID AND C.RT_ID=B.RT_ID AND E.HID=C.HID AND A.CID=" . $_POST['userID'] . ";";
		  
		$fetch = $mysqli->query($sql) or die("Reservation info not available");
		  while ($reservationRows = $fetch->fetch_assoc()){
			  
			echo "<tr style='padding-left: 5px; color: black; text-align: center; border: 1px solid #000000;'>
				<td style='border: 1px solid'>".$reservationRows['CID']."</td>
				<td style='border: 1px solid'>".$reservationRows['USERNAME']."</td>
				<td style='border: 1px solid'>".$reservationRows['NAME']."</td>
				<td style='border: 1px solid'>".$reservationRows['HID']."</td>
				<td style='border: 1px solid'>".$reservationRows['RES_NUM']."</td>
				<td style='border: 1px solid'>".$reservationRows['RT_ID']."</td>
				<td style='border: 1px solid'>".$reservationRows['TOTAL']."</td>
				<td style='border: 1px solid'>".$reservationRows['START_DT']."</td>
				<td style='border: 1px solid'>".$reservationRows['END_DT']."</td>
		  </tr>" ;

	  
		  	}
		  }
		  
		  if(!empty($_POST['userID']) && !empty($_POST['hotelID']) ){
		 
		  $sql  = "SELECT A.TOTAL, A.RID,A.CID,A.START_DT,A.END_DT,B.RT_ID,C.HID,C.TYPE,D.USERNAME,E.NAME FROM `reservation` A,`rooms` B,`roomTypes` C,`customers` D,`hotels` E WHERE A.RID=B.RID AND A.CID=D.CID AND C.RT_ID=B.RT_ID AND E.HID=C.HID AND A.CID=" . $_POST['userID'] . " AND C.HID=". $_POST['hotelID'] .";";
		  
		$fetch = $mysqli->query($sql) or die("Reservation info not available");
		  while ($reservationRows = $fetch->fetch_assoc()){
			  
			echo "<tr style='padding-left: 5px; color: black; text-align: center; border: 1px solid #000000;'>
				<td style='border: 1px solid'>".$reservationRows['CID']."</td>
				<td style='border: 1px solid'>".$reservationRows['USERNAME']."</td>
				<td style='border: 1px solid'>".$reservationRows['NAME']."</td>
				<td style='border: 1px solid'>".$reservationRows['HID']."</td>
				<td style='border: 1px solid'>".$reservationRows['RID']."</td>
				<td style='border: 1px solid'>".$reservationRows['RT_ID']."</td>
				<td style='border: 1px solid'>".$reservationRows['TOTAL']."</td>
				<td style='border: 1px solid'>".$reservationRows['START_DT']."</td>
				<td style='border: 1px solid'>".$reservationRows['END_DT']."</td>
		  </tr>" ;

	  
		  	}
		  }
		
		  if(empty($_POST['userID']) && !empty($_POST['hotelID']) ){
		 
		  $sql  = "SELECT A.TOTAL, A.RID,A.CID,A.START_DT,A.END_DT,B.RT_ID,C.HID,C.TYPE,D.USERNAME,E.NAME FROM `reservation` A,`rooms` B,`roomTypes` C,`customers` D,`hotels` E WHERE A.RID=B.RID AND A.CID=D.CID AND C.RT_ID=B.RT_ID AND E.HID=C.HID AND C.HID=". $_POST['hotelID'] .";";
		  
		$fetch = $mysqli->query($sql) or die("Reservation info not available");
		  while ($reservationRows = $fetch->fetch_assoc()){
			  
			echo "<tr style='padding-left: 5px; color: black; text-align: center; border: 1px solid #000000;'>
				<td style='border: 1px solid'>".$reservationRows['CID']."</td>
				<td style='border: 1px solid'>".$reservationRows['USERNAME']."</td>
				<td style='border: 1px solid'>".$reservationRows['NAME']."</td>
				<td style='border: 1px solid'>".$reservationRows['HID']."</td>
				<td style='border: 1px solid'>".$reservationRows['RID']."</td>
				<td style='border: 1px solid'>".$reservationRows['RT_ID']."</td>
				<td style='border: 1px solid'>".$reservationRows['TOTAL']."</td>
				<td style='border: 1px solid'>".$reservationRows['START_DT']."</td>
				<td style='border: 1px solid'>".$reservationRows['END_DT']."</td>
		  </tr>" ;

	  
		  }
		  }
		  
		  if(empty($_POST['userID']) && empty($_POST['hotelID']) ){
		 
		  $sql  = "SELECT A.TOTAL, A.RES_NUM,A.CID,A.START_DT,A.END_DT,B.RT_ID,C.HID,C.TYPE,D.USERNAME,E.NAME FROM `reservation` A,`rooms` B,`roomTypes` C,`customers` D,`hotels` E WHERE A.RID=B.RID AND A.CID=D.CID AND C.RT_ID=B.RT_ID AND E.HID=C.HID ;";
		  
		$fetch = $mysqli->query($sql) or die("Reservation info not available");
		  while ($reservationRows = $fetch->fetch_assoc()){
			  
			echo "<tr  style='padding-left: 5px; color: black; text-align: center; border: 1px solid #000000;'>
				<td style='border: 1px solid'>".$reservationRows['CID']."</td>
				<td style='border: 1px solid'>".$reservationRows['USERNAME']."</td>
				<td style='border: 1px solid'>".$reservationRows['NAME']."</td>
				<td style='border: 1px solid'>".$reservationRows['HID']."</td>
				<td style='border: 1px solid'>".$reservationRows['RES_NUM']."</td>
				<td style='border: 1px solid'>".$reservationRows['RT_ID']."</td>
				<td style='border: 1px solid'>".$reservationRows['TOTAL']."</td>
				<td style='border: 1px solid'>".$reservationRows['START_DT']."</td>
				<td style='border: 1px solid'>".$reservationRows['END_DT']."</td>
		  </tr>" ;

	  
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
