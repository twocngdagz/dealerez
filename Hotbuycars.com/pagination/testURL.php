<a href="testURL.php?page=1&sort=desc&item=shoes">Click here</a>
<br/>

<?php

$getVars = $_GET;
foreach($getVars as $list=>$key){
	echo $list."->".$key."<br/ >";
}
?>