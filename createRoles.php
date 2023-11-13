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
  <form action="createRoles.php" method="post">
	  <h2>Manage Roles</h2>
	  </br> 
	<h2><center>Create </center></h2>
	  <h6>Create new roles for employees by entering all fields: </br>
		  	&nbsp;&nbsp;&nbsp;&nbsp;- Employee ID: The unique ID for the new employee. </br>
		  	&nbsp;&nbsp;&nbsp;&nbsp;- Hotel ID: The hotel ID of the hotel the employee will be working for. </br>
	  		&nbsp;&nbsp;&nbsp;&nbsp;- Email Address: The email address of the new employee, to recieve work emails. </br>
	  		&nbsp;&nbsp;&nbsp;&nbsp;- Password: The assigned password the new employee will use to sign in to the system. </br>
			&nbsp;&nbsp;&nbsp;&nbsp;- Access Character: The character specifying the level of permissions the new employee will have in the system. The character 'e' specifies they are a low level employee, and 'p' specifies they are a branch manager.</h6>
	  </br> 

	  <h5> Employee ID </h5>	  
    <div class="form-group">
      <div class="input-group">
        <div class="input-group-prepend">  </div>
        <input name="empID" class="form-control" placeholder="Enter Employee ID" type="number" >
      </div>
    </div>
	
	<h5> Hotel ID </h5>
    <div class="form-group">
      <div class="input-group">
        <div class="input-group-prepend">  </div>
        <input name="hotelID"  class="form-control" placeholder="Enter Hotel ID" type="number">
      </div>
    </div>

	<h5> Email adress </h5>
    <div class="form-group">
      <div class="input-group">
        <div class="input-group-prepend">  </div>
        <input name="emailAddress"  class="form-control" placeholder="Enter Email Adress" type="email">
      </div>
    </div>

	<h5> Password </h5>
    <div class="form-group">
      <div class="input-group">
        <div class="input-group-prepend">  </div>
        <input name="password"  class="form-control" placeholder="Enter Password" type="text">
      </div>
    </div>

	<h5> Access Character </h5>
    <div class="form-group">
      <div class="input-group">
        <div class="input-group-prepend">  </div>
        <input name="accessChar"  class="form-control" placeholder="Enter Acess Character" type="text">
      </div>
    </div>

    <div class="form-group mr-4">
      <button type="submit" class="btn btn-primary" name="create-role" value="create-role"> Create </button>
      <!--<button type="submit reset" class="btn btn-primary" value="clear-all" name="clear-all" > Clear </button>-->
    </div>

</br></br><hr class="hr1">
</br></br>
<h2><center>Delete </center></h2>
			<h6>To delete a role, all fields must be entered in the form below. </br>
		  	&nbsp;&nbsp;&nbsp;&nbsp;- The action of deleting a role is irreversible. </br>
		  	&nbsp;&nbsp;&nbsp;&nbsp;- Only one role can be deleted at a time. </br>

	  </br> 
	  <h5> Employee </h5>
	  
    <div class="form-group">
      <div class="input-group">
        <div class="input-group-prepend">  </div>
        <input name="empID-D" class="form-control" placeholder="Enter Employee ID" type="number" >
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
	<h5> Hotel ID </h5>
    <div class="form-group">
      <div class="input-group">
        <div class="input-group-prepend">  </div>
        <input name="hotelID-D"  class="form-control" placeholder="Enter Hotel ID" type="number">
      </div>
    </div>
    <div class="form-group mr-4">
      <button type="submit" class="btn btn-danger" name="delete-role" value="delete-role"> Delete</button>
      <!--<button type="submit reset" class="btn btn-primary" value="clear-all" name="clear-all" > Clear </button>-->
    </div>
</br></br><hr class="hr1">
</br></br>
<h2><center>View </center></h2>
			<h6>To view roles, any field can be entered or omitted. </br>
		  	&nbsp;&nbsp;&nbsp;&nbsp;- Entering no fields will show all employees. </br>
		  	&nbsp;&nbsp;&nbsp;&nbsp;- Entering one or two entries will show employees matching those characteristics. </br>

	  </br> 
	  <h5> Employee </h5>
	  
    <div class="form-group">
      <div class="input-group">
        <div class="input-group-prepend">  </div>
        <input name="empID-V" class="form-control" placeholder="Enter Employee ID" type="number" >
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
	<h5> Hotel ID </h5>
    <div class="form-group">
      <div class="input-group">
        <div class="input-group-prepend">  </div>
        <input name="hotelID-V"  class="form-control" placeholder="Enter Hotel ID" type="number">
      </div>
    </div>
    <div class="form-group mr-4">
      <button type="submit" class="btn btn-primary" name="view-role" value="view-role"> View</button>
      <!--<button type="submit reset" class="btn btn-primary" value="clear-all" name="clear-all" > Clear </button>-->
    </div>
    <!-- <p class="text-center"><a href="#" class="btn">Forgot password?</a></p> -->
  </form>
  </br>
  </br>
  <div class="row ml-3">
    
	  <?php 
	  
	 if(isset($_POST['create-role'])){
		 
		  include 'functionsM.php';
		  $mysqli = db_iconnectM("userlog");
		 
		 if(!empty($_POST['empID']) && !empty($_POST['hotelID']) && !empty($_POST['emailAddress']) && !empty($_POST['password']) && !empty($_POST['accessChar'])){ //all fields full
			 
			  $sql  = "SELECT * FROM employees WHERE employees.EID=". $_POST['empID'] .";";
		  
			$fetch = $mysqli->query($sql) or die("Info not available");
			 $reservationRows = $fetch->fetch_assoc();
			 if(empty($reservationRows['EID'])){ //employee with this ID does not exist yet
				$empID = $_POST['empID'];
			 	$hotelID =  $_POST['hotelID'];
			  	$emailAddress = $_POST['emailAddress'];
			  	$password = $_POST['password'];
			  	$accessChar = $_POST['accessChar'];
				// echo $empID; echo $hotelID; echo $emailAddress; echo $password; echo $accessChar;
				
				 $mysqli->query("INSERT INTO employees (EID, HID, EMAIL, PW, ACCESS) VALUES('$empID','$hotelID','$emailAddress', '$password','$accessChar' )") or die($mysqli->error);
				 
				 echo '<div class="callout" style="border: 2px solid; color: black; background:lightgrey;">
			  <div class="callout-header" style="background: green; color: black;">Success!</div>
			  <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>
			  <div class="callout-container" style="background: lightgrey;">
				
				<p>You have successfully entered a new employee to the system. </p>
			  </div>
			</div>';
				 
				 
				// echo "yess";
			 }else{
				 //employee with that EID already exists
				 		 	//echo "NON EMPTY";
				 echo '<div class="callout" style="border: 2px solid; color: black; background:lightgrey;">
			  <div class="callout-header" style="background: red;">Error</div>
			  <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>
			  <div class="callout-container" style="background: lightgrey;">
				
				<p>Your reqeuest to create a new role has failed. </br> The employee ID you\'ve specified is already in use. Try a new employee ID. </p>
			  </div>
			</div>';
			 }
		 }
		 else{
			 echo '<div class="callout" style="border: 2px solid; color: black; background:lightgrey;">
			  <div class="callout-header" style="background: orange;">Warning</div>
			  <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>
			  <div class="callout-container" style="background: lightgrey;">
				<p>Your reqeuest to create a new role has failed. </br> You might not have filled each required entry. </p>
			  </div>
			</div>';
			//echo" <script>
  		//		alert('this is an alert');
		//	</script>";
			// echo "missing a field";//not all fields are full
		 }
	 }
	  
	  ?>
	  <?php 
	  
	 if(isset($_POST['delete-role'])){
		 
		  include 'functionsM.php';
		  $mysqli = db_iconnectM("userlog");
		 
		 if(!empty($_POST['empID-D']) && !empty($_POST['hotelID-D'])){ //all fields full
			 
			 		  $query = "DELETE FROM `employees` WHERE EID=".$_POST['empID-D']." AND HID=".$_POST['hotelID-D']." LIMIT 1;";
			$mysqli->query($query) or die($mysqli->error);
				 
				 echo '<div class="callout" style="border: 2px solid; color: black; background:lightgrey;">
			  <div class="callout-header" style="background: green; color: black;">Success!</div>
			  <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>
			  <div class="callout-container" style="background: lightgrey;">
				
				<p>You have successfully deleted an employee from the system. </p>
			  </div>
			</div>';
				 
				 
				// echo "yess";
			 }else{
				 //employee with that EID already exists
				 		 	//echo "NON EMPTY";
				echo '<div class="callout" style="border: 2px solid; color: black; background:lightgrey;">
			  <div class="callout-header" style="background: orange;">Warning</div>
			  <span class="closebtn" onclick="this.parentElement.style.display=\'none\';">&times;</span>
			  <div class="callout-container" style="background: lightgrey;">
				<p>Your reqeuest to delete a role has failed. </br> You might not have filled each required entry. </p>
			  </div>
			</div>';
			 }
		 }

	 
	  
	  ?>
	  
	  <?php 
	  
	 if(isset($_POST['view-role'])){
		 
		  include 'functionsM.php';
		  $mysqli = db_iconnectM("userlog");
		 
		 echo " <table class=\"table\" style='border: 2px solid; color: black; padding: 0.5rem; width: 95%; border-collapse: collapse; '>
		  			<thead class=\"thead-dark\"><tr>
					<th style='border: 2px solid #000000;  text-align: center;'>Employee ID</th>
					<th style='border: 2px solid #000000;  text-align: center;'>Hotel ID</th>
					<th style='border: 2px solid #000000;  text-align: center;'>Email</th>
					<th style='border: 2px solid #000000;  text-align: center;'>Access</th>
					
				  </tr></thead>";
		 
		 
		 		  if(!empty($_POST['empID-V']) && empty($_POST['hotelID-V'])){
		 
		  $sql  = "SELECT * FROM `employees` WHERE EID=" . $_POST['empID-V'] . " ;";
		  
		$fetch = $mysqli->query($sql) or die("Reservation info not available");
		  while ($reservationRows = $fetch->fetch_assoc()){
			  
			echo "<tr style='padding-left: 5px; color: black; text-align: center; border: 1px solid #000000;'>
				<td style='border: 1px solid'>".$reservationRows['EID']."</td>
				<td style='border: 1px solid'>".$reservationRows['HID']."</td>
				<td style='border: 1px solid'>".$reservationRows['EMAIL']."</td>
				<td style='border: 1px solid'>".$reservationRows['ACCESS']."</td>
				
		  </tr>" ;

	  
		  	}
		  }
		  
		  if(!empty($_POST['empID-V']) && !empty($_POST['hotelID-V']) ){
		 
		  		  $sql  = "SELECT * FROM `employees` WHERE EID=" . $_POST['empID-V'] . " AND HID=".$_POST['hotelID-V'].";";

		  
		$fetch = $mysqli->query($sql) or die("Reservation info not available");
		  while ($reservationRows = $fetch->fetch_assoc()){
			  
			echo "<tr style='padding-left: 5px; color: black; text-align: center; border: 1px solid #000000;'>
				<td style='border: 1px solid'>".$reservationRows['EID']."</td>
				<td style='border: 1px solid'>".$reservationRows['HID']."</td>
				<td style='border: 1px solid'>".$reservationRows['EMAIL']."</td>
				<td style='border: 1px solid'>".$reservationRows['ACCESS']."</td>
				
		  </tr>" ;

	  
		  	}
		  }
		
		  if(empty($_POST['empID-V']) && !empty($_POST['hotelID-V']) ){
		 
			  $sql  = "SELECT * FROM `employees` WHERE HID=" . $_POST['hotelID-V'] . " ;";
		  
		$fetch = $mysqli->query($sql) or die("Reservation info not available");
		  while ($reservationRows = $fetch->fetch_assoc()){
			  
			echo "<tr style='padding-left: 5px; color: black; text-align: center; border: 1px solid #000000;'>
								<td style='border: 1px solid'>".$reservationRows['EID']."</td>
				<td style='border: 1px solid'>".$reservationRows['HID']."</td>
				<td style='border: 1px solid'>".$reservationRows['EMAIL']."</td>
				<td style='border: 1px solid'>".$reservationRows['ACCESS']."</td>
		  </tr>" ;

	  
		  }
		  }
		  
		  if(empty($_POST['empID-V']) && empty($_POST['hotelID-V']) ){
		 
  	$sql  = "SELECT * FROM `employees` ;";
		  
		$fetch = $mysqli->query($sql) or die("Reservation info not available");
		  while ($reservationRows = $fetch->fetch_assoc()){
			  
			echo "<tr  style='padding-left: 5px; color: black; text-align: center; border: 1px solid #000000;'>
				<td style='border: 1px solid'>".$reservationRows['EID']."</td>
				<td style='border: 1px solid'>".$reservationRows['HID']."</td>
				<td style='border: 1px solid'>".$reservationRows['EMAIL']."</td>
				<td style='border: 1px solid'>".$reservationRows['ACCESS']."</td>
		  </tr>" ;

	  
		  }
		  }
		  
		echo "</table>";
		 }

	 
	  
	  ?>
	  <script>
    if ( window.history.replaceState ) {
        window.history.replaceState( null, null, window.location.href );
    }
</script>
  </div>
</div>
  </br>   </br> 
<?php include_once 'footer.php' ?>
</div>
</div>