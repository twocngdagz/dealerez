<?php 	
include_once("includes.php");

if($_REQUEST["work"] == "filterByYear"){
	
	$selected = $_POST['year'];
	$params = $_POST['params'];
	
	if($selected == "All")
		$year = '<option selected value="All">All Years</option>';
	else
		$year = '<option value="All">All Years</option>';
		
	$make = '<option value="All">All Makes</option>';
	$model = '<option value="All">All Model</option>';
	
	$sql = mysql_query("select * from listing where dealer_id = 306 $params group by year order by year desc");
	while($row = mysql_fetch_array($sql)) {
		//count
		$cnt = mysql_query("select count(year) as countyear from listing where dealer_id = 306 and year = $row[year]");
		
		if($selected == $row['year'])
			$year .= "<option selected value='".$row['year']."'>".$row['year']. " (".mysql_result($cnt,0). ")" ."</option>";
		else
			$year .= "<option value='".$row['year']."'>".$row['year']. " (".mysql_result($cnt,0). ")" ."</option>";
	}
	
	$sql = mysql_query("select * from listing where dealer_id = 306 $params group by make order by make desc");
	while($row = mysql_fetch_array($sql)) {
		//count
		$cnt = mysql_query("select count(make) as countmake from listing where dealer_id = 306 $params and make = '$row[make]'");
		
		$make .= "<option value='".$row['make']."'>".$row['make']. " (".mysql_result($cnt,0). ")" ."</option>";
	}
	
	$sql = mysql_query("select * from listing where dealer_id = 306 $params group by model order by model desc");
	while($row = mysql_fetch_array($sql)) {
		//count
		$cnt = mysql_query("select count(model) as countmodel from listing where dealer_id = 306 $params and model = '$row[model]'");
		
		$model .= "<option value='".$row['model']."'>".$row['model']. " (".mysql_result($cnt,0). ")" ."</option>";
	}
	
	echo $year."@".$make."@".$model;
}

if($_REQUEST["work"] == "filterByMake"){
	
	$year_ = stripslashes($_POST['year']);
	$make_ = stripslashes($_POST['make']);
	$params = "";
	
	if($year_ == "All") {
		$year = '<option selected value="All">All Years</option>';
	} else {
		$year = '<option value="All">All Years</option>';
		$params .= "and year = $year_";
	}
	
	if($make_ == "All") {
		$make = '<option selected value="All">All Makes</option>';
	} else {
		$make = '<option value="All">All Makes</option>';
		$params .= " and make = '$make_'";
	}
		
	$model = '<option value="All">All Model</option>';
	
	$sql = mysql_query("select * from listing where dealer_id = 306 $params group by year order by year desc");
	while($row = mysql_fetch_array($sql)) {
		//count
		$cnt = mysql_query("select count(year) as countyear from listing where dealer_id = 306 and year = $row[year] and make = '$make_'");
		
		if($year_ == $row['year'])
			$year .= "<option selected value='".$row['year']."'>".$row['year']. " (".mysql_result($cnt,0). ")" ."</option>";
		else
			$year .= "<option value='".$row['year']."'>".$row['year']. " (".mysql_result($cnt,0). ")" ."</option>";
	}
	
	$sql = mysql_query("select * from listing where dealer_id = 306 $params group by make order by make desc");
	while($row = mysql_fetch_array($sql)) {
		//count
		$cnt = mysql_query("select count(make) as countmake from listing where dealer_id = 306 $params and make = '$row[make]'");
		
		if($make_ == $row['make'])
			$make .= "<option selected value='".$row['make']."'>".$row['make']. " (".mysql_result($cnt,0). ")" ."</option>";
		else
			$make .= "<option value='".$row['make']."'>".$row['make']. " (".mysql_result($cnt,0). ")" ."</option>";
	}
	
	$sql = mysql_query("select * from listing where dealer_id = 306 $params group by model order by model desc");
	while($row = mysql_fetch_array($sql)) {
		//count
		$cnt = mysql_query("select count(model) as countmodel from listing where dealer_id = 306 $params and model = '$row[model]'");
		
		$model .= "<option value='".$row['model']."'>".$row['model']. " (".mysql_result($cnt,0). ")" ."</option>";
	}
	
	echo $year."@".$make."@".$model;
}

if($_REQUEST["work"] == "filterByModel"){
	
	$year_ = stripslashes($_POST['year']);
	$make_ = stripslashes($_POST['make']);
	$model_ = stripslashes($_POST['model']);
	$params = "";
	
	if($year_ == "All") {
		$year = '<option selected value="All">All Years</option>';
	} else {
		$year = '<option value="All">All Years</option>';
		$params .= "and year = $year_";
	}
	
	if($make_ == "All") {
		$make = '<option selected value="All">All Makes</option>';
	} else {
		$make = '<option value="All">All Makes</option>';
		$params .= " and make = '$make_'";
	}
	
	if($model_ == "All") {
		$model = '<option selected value="All">All Model</option>';
	} else {
		$model = '<option value="All">All Model</option>';
		$params .= " and model = '$model_'";
	}
	
	$sql = mysql_query("select * from listing where dealer_id = 306 $params group by year order by year desc");
	while($row = mysql_fetch_array($sql)) {
		//count
		$cnt = mysql_query("select count(year) as countyear from listing where dealer_id = 306 and year = $row[year] and make = '$make_' and model = '$model_'");
		
		if($year_ == $row['year'])
			$year .= "<option selected value='".$row['year']."'>".$row['year']. " (".mysql_result($cnt,0). ")" ."</option>";
		else
			$year .= "<option value='".$row['year']."'>".$row['year']. " (".mysql_result($cnt,0). ")" ."</option>";
	}
	
	$sql = mysql_query("select * from listing where dealer_id = 306 $params group by make order by make desc");
	while($row = mysql_fetch_array($sql)) {
		//count
		$cnt = mysql_query("select count(make) as countmake from listing where dealer_id = 306 $params and make = '$row[make]'");
		
		if($make_ == $row['make'])
			$make .= "<option selected value='".$row['make']."'>".$row['make']. " (".mysql_result($cnt,0). ")" ."</option>";
		else
			$make .= "<option value='".$row['make']."'>".$row['make']. " (".mysql_result($cnt,0). ")" ."</option>";
	}
	
	$sql = mysql_query("select * from listing where dealer_id = 306 $params group by model order by model desc");
	while($row = mysql_fetch_array($sql)) {
		//count
		$cnt = mysql_query("select count(model) as countmodel from listing where dealer_id = 306 $params and model = '$row[model]'");
		
		if($model_ == $row['model'])
			$model .= "<option selected value='".$row['model']."'>".$row['model']. " (".mysql_result($cnt,0). ")" ."</option>";
		else
			$model .= "<option value='".$row['model']."'>".$row['model']. " (".mysql_result($cnt,0). ")" ."</option>";
	}
	
	echo $year."@".$make."@".$model;
}

?>