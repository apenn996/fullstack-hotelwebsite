<?php
session_start();

if(isset($_SESSION['id']) && isset($_SESSION['user_name'])) {
	?>

	<!DOCTYPE html>
	<html>
	<head>
		
		<title>Home</title>
		<link rel="stylesheet" type="text/css" href="mgmtstyle.css">
	</head>
	<body>
		<h1>Hello, <?php echo $_SESSION['user_name']; ?></h1>
		<a href="mgmtlogout.php">Logout</a>
	</body>
	</html>

	<?php
}
else {
	header("Location: mgmtprotoLogin.php");
	exit();
}
?>