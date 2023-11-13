<?php 
session_start();
$_SESSION['EID'] = null;


session_destroy();
header("location: managementLogin2M.php");
?>