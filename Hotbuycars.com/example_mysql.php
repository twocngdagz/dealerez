<?php
// Establish MySQL connection
$host	  = 'localhost';
$user	  = 'root';
$pass	  = 'innovation';
$database = 'mlm';
$table	  = 'lead';

function setParamSearch(){
	
}	
$mysql = new mysqli($host, $user, $pass, $database);

// Get total entries
$totalEntries = $mysql->query("SELECT COUNT(*) FROM ". $table);
$totalEntries = $totalEntries->fetch_row();
$totalEntries = $totalEntries[0];

// Include Pagination class file
include "Pagination-2.php";

// Instantiate pagination object with appropriate arguments
$pagesPerSection = 5;							// How many pages will be displayed in the navigation bar
												// If total number of pages is less than this number, the
												// former number of pages will be displayed
$options		 = array(5, 10, 25, 50, "All");	// Display options
$paginationID	 = "lead";					// This is the ID name for pagination object
$stylePageOff	 = "pageOff";					// The following are CSS style class names. See styles.css
$stylePageOn	 = "pageOn";
$styleErrors	 = "paginationErrors";
$styleSelect	 = "paginationSelect";

$test1="ASC";
$test2="Shorts";
$test3="DCSHOES";

$addParams = array(
	"sortby" => $test1,
	"category" => $test2,
	"brand" => $test3
);

$Pagination = new Pagination($totalEntries, $pagesPerSection, $options, $paginationID, $stylePageOff, $stylePageOn, $styleErrors, $styleSelect,$addParams);
$start 		= $Pagination->getEntryStart();
$end 		= $Pagination->getEntryEnd();

// Retrieve MySQL data
$result = $mysql->query("SELECT * FROM ". $table ." LIMIT ". $start .",". $end);
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="styles.css"/>
</head>
<body>

<?php
echo $Pagination->display();
// Display pagination display option selection interface
echo $Pagination->displaySelectInterface();

// Display Data
echo "<ul>";

while($row = $result->fetch_array(MYSQLI_ASSOC))
{
	echo "<li>". $row['fname'] ." ". $row['lname']. "</li>";
}

echo "</ul>";
// Display pagination navigation bar
echo $Pagination->display();
// Close MySQL connection
$mysql->close();

?>
</body>
</html>

