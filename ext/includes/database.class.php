<?php
#CLASS TO HANDLE DATABASE
class database_handler
{

public $db_link;
public $db_name;
public $db_user;
public $db_password;
public $db_server;
public $db_selected;
public $db_object;

function database_handler() {}


function connect($server,$database, $user, $password) {
	
	$this->db_name=$database;
	$this->db_user=$user;
	$this->db_password=$password;
	$this->db_server=$server;

	try {
		$this->db_link = mysql_connect($this->db_server, $this->db_user, $this->db_password);
	}catch(Exception $ex) {}
	
	if (!$this->db_link) {
		$_SESSION['mysql_connect_error']='Could not connect: ' . mysql_error();
	}
	
	$this->db_selected = mysql_select_db($this->db_name, $this->db_link);
	
	if (!$this->db_selected) {	
		$_SESSION['mysql_connect_error']="Cant use $database : " . mysql_error();
	}
}


function commit() {
	mysql_query("commit",$this->db_link);
}


function begin() {
	mysql_query("begin",$this->db_link);
}

function rollback() {
	if($result=mysql_query("rollback ",$this->db_link)) {}
	else {
		echo $sql.mysql_error();
	}
}


function Execute_command($sql){

	try{
		if(!$result=mysql_query($sql,$this->db_link)) {
			$result=$sql.mysql_error();
		}
	}
	catch(Exeption $e){
		return $e;
	}
	
	return $result;
}


/************** ASAD FUNCTION *************/

function updateQuery($params, $tblname, $id, $columnname){
	
	$sql = "update ".$tblname." set ";
	
	foreach($params as $col => $val){
		$sql .= "`".$col."` = '".mysql_real_escape_string($val)."',";
	}
	
	$sql = substr($sql,0,strlen($sql)-1);
	
	$sql .= " where ".$columnname." = '".$id."'";
	
	$query = mysql_query($sql);
	
	return $query;
	
}

function insertQuery($params, $tblname){
	
	$sql = "insert into ".$tblname." set ";
	
	foreach($params as $col => $val){
		$sql .= "`".$col."` = '".mysql_real_escape_string($val)."',";
	}
	
	$sql = substr($sql,0,strlen($sql)-1);
	
	$query = mysql_query($sql);
	
	return $query;
	
}

function replaceQuery($params, $tblname){
	
	$sql = "replace into ".$tblname." set ";
	
	foreach($params as $col => $val){
		$sql .= "`".$col."` = '".mysql_real_escape_string($val)."',";
	}
	
	$sql = substr($sql,0,strlen($sql)-1);
	
	$query = mysql_query($sql);
	
	return $query;
	
}

function beginTrans(){
	mysql_query("BEGIN;");
}

function commitTrans(){
	mysql_query("COMMIT;");
}

function undoTrans(){
	mysql_query("ROLLBACK;");
}

/************** ASAD FUNCTION END *************/

}//END OF THE CLASS


?>