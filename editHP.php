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
<dis class="container">
     <button class= "btn btn-secondary mr-3"><a href= "AddHotelM.php" class = "text-light">Add Hotel</a> </button>
</dis>


<dis class="container">
	<button class= "btn btn-secondary mr-3"><a href= "editHotelM.php" class = "text-light">Update</a> </button>
</dis>
  </br>
  </br>
  <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">HID</th>
      <th scope="col">Hotel Name</th>
      <th scope="col">Description</th>
      <th scope="col">Includes</th>
	  <th scope="col">Image</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>  
<?php
	  $sql="SELECT A.HID, A.NAME, A.DESCRIPTION, A.IMG, B.POOL, B.GYM, B.SPA, B.BUS_OffICE FROM `hotels` A, `amenities` B WHERE A.HID=B.HID" ;
	  
    $result = mysqli_query($mysqli,$sql);
	  
	  if ($result){
		  while($row = mysqli_fetch_assoc($result)){
			  $HID = $row['HID'];
			  $NAME = $row['NAME'];
			  $DESCRIPTION = $row['DESCRIPTION'];
			  $amenities = $row['SPA'];
			  $IMG = $row['IMG'];
			  echo '
                    <th scope="row">'.$HID.'</th>
                    <td>'.$NAME.'</td>
                    <td>'.$DESCRIPTION.'</td>
                    <td>'.$DESCRIPTION.'</td>
					<td>'.$IMG.'</td>
					<td>
                    <button class="btn btn-primary"><a href="EditButton.php? editbutton='.$HID.'" class="text-light">Edit</a></button>
					</td>
					<td>
                    <button class="btn btn-danger"><a href="mgmtprotoProcess.php? deletebutton='.$HID.'" class="text-light">Delete</a></button>
          			</td>
                    </tr>';
			  
		  }
			 
	  }
	  
	  ?>
	  </tbody>
</table>
</div>
  </br>   
</br> 
<?php include_once 'footer.php' ?>
</div>
</div>