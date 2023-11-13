<?php include_once 'header.php' ?>
<script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
<?php 
	

	if(!isset($_SESSION['EID']) && empty($_SESSION['EID'])){
		header("location: accessDeniedM.php");
	}
	
?>

<div class="wrapper">

    <?php require_once 'sideNavbarM.php' ?>
	
	
    <div class="main_content">
		 <div id="blue-header"></div>
     <?php  
	if($_SESSION['ACCESS'] != "p" && $_SESSION['ACCESS'] != "f")
		echo "error";
	if($_SESSION['ACCESS'] == "p"){
	echo "<div class=\"header\">You are currently logged in as an administrator with [Employee] permissions. </div>";  
	}
	if($_SESSION['ACCESS'] == "f"){
		echo "<div class=\"header\">You are currently logged in as an administrator with [Head Manager] permissions. </div>";  
	}
		
		?>
        <div class="info">
         <?php echo "<h6>Welcome Admin #".$_SESSION['EID']." at HOTEL #".$_SESSION['HID']." </h6> </br>"; ?>
			
			
      </div>
<?php include_once 'footer.php' ?>
    </div>
</div>


