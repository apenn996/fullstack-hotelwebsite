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
	<h2>Previous Notifications</h2>
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
	<div class="form-group mr-4">
      <button onClick="window.location.reload();" class="btn btn-primary" name="show-list" value="show-list"> Refresh</button>
   	  </div>
	
		</br><hr class="hr1">
</br>
		<a  class="list-group-item list-group-item-action flex-column align-items-start ">
  <form action="notificationsM.php" method="post">
	  
    
	  <h5> Header </h5>
    <div class="form-group">
      <div class="input-group">
        <div class="input-group-prepend">  </div>
        <input name="header"  class="form-control" placeholder="Write a header for your post" type="text">
      </div>
    </div>
	  <h5> Notification </h5>
    <div class="form-group" ">
      <div class="input-group" >
        <div class="input-group-prepend" ">  </div>
        <input name="notification"  style="height: 100px;" class="form-control" placeholder="Write notification post" type="text">
      </div>
    </div>
    <div class="form-group mr-4">
      <button type="submit" class="btn btn-primary" name="post-notif" value="post-notif"> Post</button>
   	  </div>
    <!-- <p class="text-center"><a href="#" class="btn">Forgot password?</a></p> -->
  </form>
			</a>
</div>
  
  </br>
  </br>
  <div class="row ml-3">
    <?php 
	  if(isset($_POST['post-notif'])){
		if(!empty($_POST['header']) && !empty($_POST['notification'])){
			$header=$_POST['header'];
			$notif=$_POST['notification'];
			$date = date("Y-m-d");
			$mysqli->query("INSERT INTO `notifications` ( header, description, date) VALUES('$header','$notif','$date')") or die($mysqli->error);
		}else{
//empty fields
		  echo '<div class="callout" style="border: 2px solid; color: black; background:lightgrey;">
			  <div class="callout-header" style="background: orange;">Warning</div>
			  <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>
			  <div class="callout-container" style="background: lightgrey;">
				<p>Your reqeuest post a notification failed. </br> You might not have filled each required entry. </p>
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