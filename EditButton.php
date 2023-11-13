
<?php include_once 'header.php' ?>
<?php include_once 'functionsM.php' ?>
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
		<?php
	$HID=$_GET['editbutton'];
	$sql = "Select * from `hotels` where HID=$HID";
	$result=mysqli_query($mysqli,$sql);
	$row=mysqli_fetch_assoc($result);
	$HID=$row['HID'];
	$NAME=$row['NAME'];
	$DESCRIPTION=$row['DESCRIPTION'];
	$amenities=$row['amenities'];
	$IMG=$row['IMG'];
	
	
	if(isset($_POST['submit'])){
		$HID=$_POST['HID'];
	    $NAME=$_POST['NAME'];
		$DESCRIPTION = $_POST['DESCRIPTION'];
		$amenities=$_POST['amenities'];
		$IMG=$_POST['IMG'];
		
		$spl="update `hotels` set HID=$HID,NAME='$NAME',DESCRIPTION='$DESCRIPTION',amenities='$amenities',IMG='$IMG' where HID=$HID";
		$result=mysqli_query($mysqli,$sql);
		if($result){
			echo "Edit Complete";
			header('location:editHP.php');
		}else{
			die(mysqli_error($mysqli));
		}
	}
	
	
	?>

<div class="info">
  <form action="editHotelM.php" method="post">
	  <h2>Edit or Delete Hotels</h2>
	  <h6>Reservations can be viewed based on the filters below: </br>
		  	&nbsp;&nbsp;&nbsp;&nbsp;- Both, one, or no entries can be entered. </br>
		  	&nbsp;&nbsp;&nbsp;&nbsp;- Entering both entries will filter out reservations that dont meet both criteria. </br>
	  		&nbsp;&nbsp;&nbsp;&nbsp;- Entering one entry will display reservations that meet only that characteristic.</br>
	  		&nbsp;&nbsp;&nbsp;&nbsp;- Entering no entries will show all current reservations.</h6>
	  </br> 

  </form>


<div class="main_content">
<div id="blue-header"></div>
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="pl-3 pt-3">
                        <h4 class="heading">Add Hotel</h4>
                        <hr>
                    </div>
                    
                    <div class="card-body">
                        <form action="editHP.php" method="POST" enctype="multipart/form-data">
                            <div class="row">
								<div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">HID</label>
                                        <input type="text" required class="form-control" name="HID" placeholder ="Enter Hotel ID" value=<?php echo $HID;?>>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Hotel Name</label>
                                        <input type="text" required class="form-control" name="NAME" placeholder ="Enter Hotel Name"value=<?php echo $NAME;?>>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                       <label for="exampleFormControlTextarea1">Description</label>
                                     <textarea class="form-control" id="exampleFormControlTextarea1" name="DESCRIPTION" rows="3"></textarea>
                                 </div>
                                </div>
					  	        <div class="form-check">
						           <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                  <label class="form-check-label" for="flexCheckDefault">
                                   Pool
                                 </label>
                         </div>
						<div class="form-check">
						    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                              Gym
                           </label>
                         </div>
						<div class="form-check">
						    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                              Spar
                           </label>
                         </div>
						<div class="form-check">
						    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                              Business Office
                           </label>
                         </div>
						<div class="form-check">
						    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                              WIFI
                           </label>
                         </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Add Room Image</label>
                                        <input type="file" required class="form-control" name="IMG">
                                    </div>
                                </div>
                               
                                <div class="col-md-4">
                                    <div class="mt-4">
                                        <button type="submit" name="AddHotelM" class="btn btn-primary btn-block float-right">Add Hotel</button>
                                    </div>
                                </div>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>    
    </div>
</section>
<?php include_once 'footer.php' ?>
