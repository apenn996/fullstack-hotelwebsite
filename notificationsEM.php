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
	</br>
	<h2>Notifications</h2>
	<?php 
	include 'functionsM.php';
		  $mysqli = db_iconnectM("userlog");	 
	$sql  = "SELECT * FROM `notifications` ORDER BY date;";
	$fetch = $mysqli->query($sql) or die("Reservation info not available");
		  while ($reservationRows = $fetch->fetch_assoc()){
			 
			  
		echo "<div class=\"list-group\">
		  <a  class=\"list-group-item list-group-item-action flex-column align-items-start\">
			<div class=\"d-flex w-100 justify-content-between\">
			  <h5 class=\"mb-1\">".$reservationRows['header']."</h5>
			  <small>".$reservationRows['date']."</small>
			</div>
			<p class=\"mb-1\">".$reservationRows['description']."</p>
		  </a>";
		  }
	?>
	</br>
	
  </div>
</div>
  </br>   </br> 
<?php include_once 'footer.php' ?>
</div>
</div>