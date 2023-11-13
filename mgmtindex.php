<!DOCTYPE html>
<html>
<head>
	<title> Management Login </title>
	<link rel="stylesheet" type="text/css" href="mgmtstyle.css">	
</head>
<body style="background-color:darkcyan">
	<form action="mgmtlogin.php" method="post">
		<h2>Management Login</h2>
		<img class="card-img-top" src="img/standardMagnolia.jpg" alt="Card image cap" width="960"
		 height="480" class="center"/>
		<?php if(isset($_GET['error'])) { ?>
			<p class="error"> <?php echo $_GET['error']; ?></p>
		<?php } ?>
		<br/>
		<label> User Name</label>
		<input type="text" name="uname" placeholder="User Name"><br>
		<label>Password</label>
		<input type="password" name="password" placeholder="Password"><br>
		
		<button type="submit">Login</button>
	</form>
</body>
</html>