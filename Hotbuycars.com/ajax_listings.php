<?php
session_start();

$orderby   = $_POST['orderby'];

if(isset($orderby)) {
	$_SESSION["orderby"]= $orderby;
}
else {
	$_SESSION["orderby"]= "created_date";
}
?>