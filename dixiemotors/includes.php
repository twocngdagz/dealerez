<?php

if(!isset($_GET['debug'])) {
	error_reporting(0);
	/*ini_set('display_errors',1);
	ini_set('display_startup_errors',1);
	error_reporting(-1);
*/
	//define('DEBUG_MODE',false);

} else {

	//define('DEBUG_MODE',true);	

}

$includepath= "C:\\wamp\\www\\dealerez\\ext\\includes\\";
$apipath	= "C:\\wamp\\www\\dealerez\\ext\\api\\";

include_once($includepath."connection.inc.php");
include_once($includepath."constants.php");
include_once($includepath."functions.php");
include_once($includepath."html_functions.php");

include_once($apipath."user.class.php");
include_once($apipath."listing.class.php");
include_once($apipath."contents.class.php");

include_once($apipath."Session_Control.php");
include_once($apipath."transaction.class.php");
include_once($apipath."contact.class.php");

include_once($apipath."mysql.class.php");
include_once($apipath."admin.class.php");
include_once($apipath."blogs.class.php");
//include_once($includepath."ajax_contents.js.php");



?>