<?php session_start(); 
include("includes.php");

if($_POST['newtype']=="new") {
	$_SESSION['new'] ="true";
}
else {
	unset($_SESSION['new']);
	echo "unset-new";
}
?>
