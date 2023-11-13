<?php 
$_SESSION['varName'] = null;
$_SESSION = array();
session_destroy();
header("location: managementLogin2M.php");
?>