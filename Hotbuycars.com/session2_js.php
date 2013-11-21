<?php session_start(); 
include("includes.php");
if($_POST['usedtype']=="used") {
	$_SESSION['used'] = "true";
}
else {
	echo "unset-used";
	unset($_SESSION['used']);
}
?>
