<?php

class Admin {



public function getDealers($data){



	$sql = "select * from dealers_email";

	

	if($data['filter_sort'] != ''){

		$sql .= " order by ".$data['filter_sort'];

	}

	else{

		$sql .= " order by AddDate";

	}

	

	$sql .= " desc";



	return $sql;

	

}

public function getUsers($data){



	$sql = "select * from users";

	

	if($data['condition'] != ''){

		$sql .= " where ".$data['condition'];

	}

	if($data['filter_sort'] != ''){

		$sql .= " order by ".$data['filter_sort'];

	}

	else{

		$sql .= " order by reg_date";

	}

	

	$sql .= " desc";

	//echo $sql;

	return $sql;

	

}

public function getSiteSettings($user_id){



	$sql = "select * from site_settings where user_id = ".$user_id;

	$query = Execute_command($sql);

	$result = mysql_fetch_array($query);

	//echo $sql;

	return $result;

	

}

public function getUserPlan($user_id){

	

	$sql = "select * from users where user_id = " .$user_id;	

	$query = Execute_command($sql);

	$result = mysql_fetch_array($query);

	//echo $sql;

	return $result;

	

}

}

?>