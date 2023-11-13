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
	<?php 
	
$db = db_iconnect("******");
$hotelName = $_POST['hotelName'];
$fetch = $db->query("SELECT * FROM hotels, amenities, roomTypes WHERE hotels.HID=amenities.HID AND hotels.HID=roomTypes.HID AND hotels.NAME = '$hotelName'") or die($db->error());
?>
<div class="info">
  <form action="editHotelM.php" method="post">
	  <h2>Edit <?php echo $_POST['hotelName']?></h2>
	  <h6>Reservations can be viewed based on the filters below: </br>
		  	&nbsp;&nbsp;&nbsp;&nbsp;- Both, one, or no entries can be entered. </br>
		  	&nbsp;&nbsp;&nbsp;&nbsp;- Entering both entries will filter out reservations that dont meet both criteria. </br>
	  		&nbsp;&nbsp;&nbsp;&nbsp;- Entering one entry will display reservations that meet only that characteristic.</br>
	  		&nbsp;&nbsp;&nbsp;&nbsp;- Entering no entries will show all current reservations.</h6>
	  </br> 

  </form>
<dis class="container">
     <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#add-room-modal">Add Room</button>
</dis>

  </br>
  </br>
  <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">HID</th>
      <th scope="col">Room Types</th>
      <th scope="col">Price</th>
      <th scope="col">Room Available</th>
	  <th scope="col">Weekend Rate</th>
	  <th scope="col">Image</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
	  
<?php
	  $sql="SELECT A.HID, A.TYPE, A.NUM_ROOMS, A.PRICE, B.WKND_DIFF, B.IMG FROM `roomTypes` A, `hotels` B WHERE A.HID=B.HID";
	  
    $result = mysqli_query($mysqli,$sql);
	  
	  if ($result){
		  while($row = mysqli_fetch_assoc($result)){
			  $HID = $row['HID'];
			  $Types = $row['TYPE'];
			  $price = $row['PRICE'];
			  $AVAIL = $row['NUM_ROOMS'];
			  $WdR  = $row['WKND_DIFF'];
			  $IMG = $row['IMG'];
			  echo '
                    <th scope="row">'.$HID.'</th>
                    <td>'.$Types.'</td>
                    <td>'.$price.'</td>
                    <td>'.$AVAIL.'</td>
					<td>'.$WdR.'</td>
					<td>'.$IMG.'</td>
					<td>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit-room-modal">Edit</button>
					</td>
					<td>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete-room">Delete</button>
          			</td>
                    </tr>';
			  
		  }
			 
	  }
	  
	  ?>
	  
  </tbody>
</table>
<div class="modal fade" id="delete-room" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Room</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Do you want to Delete this Room?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary">Delete</button>
      </div>
    </div>
  </div>
</div>
<div class="modal" id="edit-room-modal">
	  	<div class="modal-dialog">
		    <div class="modal-content">

		      	<!-- Modal Header -->
		      	<div class="modal-header">
			        <h4 class="modal-title">Edit Room</h4>
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
		      	</div>

		      	<!-- Modal body -->
		      	<div class="modal-body">
		        	<form action="update.php" id="edit-form">
		        		<input class="form-control" type="hidden" name="id">
						<div class="form-group">
                              <label class="form-label">Hotel ID</label>
                              <input type="text" required class="form-control" name="HID">
                        </div>
				    	<div class="form-group">
						    <label for="email">Room Type</label>
						    <input class="form-control" type="text" name="TYPE">
					  	</div>
					  	<div class="form-group">
						    <label for="first_name">Price</label>
						    <input class="form-control" type="text" name="PRICE">
					  	</div>
						<div class="form-group">
						    <label for="first_name">Room Available</label>
						    <input class="form-control" type="text" name="NUM_ROOMS">
					  	</div>
						<div class="form-group">
						    <label for="first_name">Weekend Rate</label>
						    <input class="form-control" type="text" name="WKND_DIFF">
					  	</div>
					  	 <div class="form-group">
                                    <div class="mb-2">
                                        <label class="form-label">Image</label>
                                        <input type="file" required class="form-control" name="IMG">
                                    </div>
                                </div>
					  	<button type="button" class="btn btn-primary" id="btnUpdateSubmit">Edit</button>
					  	<button type="button" class="btn btn-danger float-right" data-dismiss="modal">Close</button>
					</form>


		      	</div>

		    </div>
		</div>
	</div>
<div class="modal" id="add-room-modal">
	  	<div class="modal-dialog">
		    <div class="modal-content">

		      	<!-- Modal Header -->
		      	<div class="modal-header">
			        <h4 class="modal-title">Add Room</h4>
			        <button type="button" class="close" data-dismiss="modal">&times;</button>
		      	</div>

		      	<!-- Modal body -->
		      	<div class="modal-body">
		        	<form action="update.php" id="edit-form">
		        		<input class="form-control" type="hidden" name="id">
						<div class="form-group">
                              <label class="form-label">Hotel ID</label>
                              <input type="text" required class="form-control" name="HID">
                        </div>
				    	<div class="form-group">
						    <label for="email">Room Type</label>
						    <input class="form-control" type="text" name="TYPE">
					  	</div>
					  	<div class="form-group">
						    <label for="first_name">Price</label>
						    <input class="form-control" type="text" name="PRICE">
					  	</div>
						<div class="form-group">
						    <label for="first_name">Room Available</label>
						    <input class="form-control" type="text" name="NUM_ROOMS">
					  	</div>
						<div class="form-group">
						    <label for="first_name">Weekend Rate</label>
						    <input class="form-control" type="text" name="WKND_DIFF">
					  	</div>
					  	 <div class="form-group">
                                    <div class="mb-2">
                                        <label class="form-label">Image</label>
                                        <input type="file" required class="form-control" name="IMG">
                                    </div>
                                </div>
					  	<button type="button" class="btn btn-primary" id="btnUpdateSubmit">Add</button>
					  	<button type="button" class="btn btn-danger float-right" data-dismiss="modal">Close</button>
					</form>


		      	</div>

		    </div>
		</div>
	</div>
</div>
  </br>   </br> 
<?php include_once 'footer.php' ?>
</div>
</div>