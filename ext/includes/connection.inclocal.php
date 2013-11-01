<?php
include_once("database.class.php");
$server = "localhost";
$database = "impactdealers";
$user = "root";
$password = "";
global $db_object;
$db_object=new database_handler();
$db_connect=$db_object->connect($server,$database, $user, $password);
if(isset($_SESSION['mysql_connect_error']))
{
	echo "Could Not Connect To Database".$_SESSION['mysql_connect_error'];
	unset($_SESSION['mysql_connect_error']);
}
?>