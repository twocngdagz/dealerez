<?php

class contact{
	
	
	public function getAlphabetsByUserID($userid){
		
		$sql = "SELECT DISTINCT LOWER(SUBSTRING(lname, 1,1)) alphabets  FROM contact WHERE user_id = ".$userid." and is_active = 1 and is_deleted = 0 ORDER BY lname";
		$query = mysql_query($sql);
		
		return $query;
		
	}
	
	public function getArchivedAlphabetsByUserID($userid){
		
		$sql = "SELECT DISTINCT LOWER(SUBSTRING(lname, 1,1)) alphabets  FROM contact WHERE user_id = ".$userid." and is_active = 0 and is_deleted = 0 ORDER BY lname";
		$query = mysql_query($sql);
		
		return $query;
		
	}
	
	public function getAllContactByAlphabets($alpha,$userid){
		
		$sql = "SELECT * FROM contact WHERE lname LIKE '$alpha%' and user_id = ".$userid." and is_active = 1 and is_deleted = 0";
		$query = mysql_query($sql);
		
		return $query;
		
	}
	
	public function getArchiveContactByAlphabets($alpha,$userid){
		
		$sql = "SELECT * FROM contact WHERE lname LIKE '$alpha%' and user_id = ".$userid." and is_active = 0 and is_deleted = 0";
		$query = mysql_query($sql);
		
		return $query;
		
	}
	
	public function deleteContact($contactid){
		
		$sql = "update contact set is_deleted = 1 where c_id = ".$contactid;
		
		$query = mysql_query($sql);
		
		return $query;
		
	}
	
	public function archiveContact($contactid){
		
		$sql = "update contact set is_active = 0 where c_id = ".$contactid;
		
		$query = mysql_query($sql);
		
		return $query;
		
	}
	
	public function unarchiveContact($contactid){
		
		$sql = "update contact set is_active = 1 where c_id = ".$contactid;
		
		$query = mysql_query($sql);
		
		return $query;
		
	}
	
	public function getContactByContactID($contactid,$userid){
		
		$sql = "select * from contact where c_id = $contactid and user_id = ".$userid;
		$query = mysql_query($sql);
		
		if(mysql_num_rows($query) > 0){
			return mysql_fetch_array($query);
		}
		else{
			return 0;
		}
		
	}
	
	public function getAllContacts($user_id){
		
		$sql = "select * from contact where is_active = 1 and is_deleted = 0 and user_id = ".$user_id;
		
		$query = mysql_query($sql);
		
		return $query;
	}
	
	public function getUserContact($user_id)
	{	$result_info=array();
		
		if($user_id)
		{
				
				$sql="select * from contact where user_id=$user_id order by ts DESC";
				
				$result=Execute_command($sql);
				
				$a=0;
				
				try
				{		while($record=mysql_fetch_array($result))
						{
							$result_info[$a]=$record;
							$a++;	
						}
				}
				catch(Exception $e)
				{
					$_SESSION['mysql_eror']=$result;
				}
		}
		
	
		return $result_info;
	
	}
	
}


?>