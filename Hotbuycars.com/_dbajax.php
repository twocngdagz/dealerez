<?php  session_start();
include("includes.php");

if(isset($_POST['submitquery'])) {
	$sql = $_POST['submitquery'];
	
	$result = mysql_query($sql);
	$num_rows = mysql_num_rows($result);
	
	print "<table width=80% border=1>\n";
	
	$cols = 0;
	while ($get_info = mysql_fetch_assoc($result)){ 
	if($cols == 0)
	{
	  $cols = 1;
	  print "<tr>";
	  foreach($get_info as $col => $value)
	  {
		print "<th>$col</th>";
		
	  }
	  print "<tr>\n";
	}
	print "<tr>\n";
	foreach ($get_info as $field) 
	print "\t<td align='center'><font face=arial size=1/>$field</font></td>\n";
	print "</tr>\n";
	}
	print "</table>\n"; 
	
}

?>