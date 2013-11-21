
<?php
include("includes.php");

$name=$_POST['p'];

if(isset($names)) {
	?>
    Leo Neil Laurito Testing <br />
    <?php	
}


if(isset($name)) {
	$query=mysql_query("SELECT * FROM listing WHERE title like '$name%'");
	
	$num = mysql_num_rows($query);
	
	if($num > 0) {
		?>
		Number of Records: <?php echo $num; ?>
		<br />
		<ul>
		<?php
		while($row=mysql_fetch_assoc($query)){
			echo "<li>".$row['title']."</li>";
		}
		?>
		</ul>
	
		<?php
	}
	else {
		echo "No record found!";	
	}
}
?>