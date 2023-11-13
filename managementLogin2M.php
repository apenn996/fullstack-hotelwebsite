<link rel="stylesheet" href="assets/css/email.css">
<?php
	
ini_set( 'display_errors', 1 );
ini_set( 'display_startup_errors', 1 );
error_reporting( E_ALL );

?>



</br></br></br></br></br></br>
<div class="login">
  <h1>Administrator Login</h1> 
	<h3>Sign in to start your session</h3> 
	
	<?php
	if (isset($_GET['statusM'])) {
			echo '<div class="alert alert-danger" role="alert">
			Credentials are incorrect, please try again. 
			</div>';
			echo '</b>';
		}
	
	if (isset($_GET['notfullM'])) {
		echo '<div class="alert alert-danger" role="alert">
  		Please fill out each field.  
		</div>';
		echo '</b>';
	}
?>
  <form method="post" action="managementLogin2M.php">
	<p><input type="number" name="EID" value="" placeholder="Employee ID"></p>
	  
    <p><input type="text" name="emailM" value="" placeholder="Email"></p>
	 
    <p><input type="password" name="password" value="" placeholder="Password"></p>
    
    <p class="submit"><input type="submit" name="login" value="login"></p>
  </form>
</div>




<?php



if (isset($_POST['login'])) {
	//echo "<h1 style=\"z-index: -1\";> YOOOO </h1>";
	include 'functionsM.php';				//connects to the DB
	$mysqli = db_iconnectM("userlog");

	if(!empty($_POST['EID']) && !empty($_POST['emailM']) && !empty($_POST['password'])){
    $email = $_POST['emailM'];
    $employeeID = $_POST['EID'];
    $password = $_POST['password'];
	$sql = "SELECT * FROM employees WHERE EMAIL='$email' AND PW='$password' AND EID='$employeeID';";	//as we need to mod the query its easier to mod var
    $result = $mysqli->query($sql) or die("Something went wrong with: $sql<br>".$mysqli->error()); //need to see the query and what values are fed in otherwise dont know the error
	echo $email;
	echo $employeeID;
	echo $password;
		if ($result->num_rows == 1) {
        while($row = $result->fetch_assoc()) {
            //echo "It works. Hooray.";
            //echo "<br> id: ". $row["id"]. " - Name: ". $row["username"]. " " . $row["email"] . " " . $row["password"] . "<br>";
		//	session_name($_POST['EID']);
            session_start();
            $_SESSION['ACCESS'] = $row['ACCESS'];
			$_SESSION['HID'] = $row['HID'];
			$_SESSION['EMAIL'] = $row['EMAIL'];
            $_SESSION['EID'] = $row['EID'];
			//echo $_SESSION['ACCESS'];
			//echo $_SESSION['HID'];
			//echo $_SESSION['EMAIL'];
			//echo $_SESSION['EID'];
            // email variable in session?
            header("location: testm.php");
            exit();
        }
    } else {
        //echo "Zero results. Try again.";
        header("location: managementLogin2M.php?statusM=incorrect");
	}
	}else{
		header("location: managementLogin2M.php?notfullM=true");
	}
	       // header("location: protoLogin.php?status=incorrect");
    
}
?>