<?php
$SQL = "SELECT * FROM preferences";

$RESULT	=	mysql_query($SQL);



while($row	=	mysql_fetch_array($RESULT)) {

	if(!defined($row['key'])) {
	
		define($row['key'],$row['value']);

	}

}

?>