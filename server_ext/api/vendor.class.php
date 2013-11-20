<?php

class vendor{
	
	public function getVendorsByUserID($data){
		
		$sql = "select * from vendor where user_id = ".$data['user_id']." and is_archived = 0";
		
		$query = mysql_query($sql) or die(mysql_error());
		
		return $query;
		
	}
	
	public function getVendorByID($vendor_id){
		
		$sql = "select * from vendor where vendor_id = '".mysql_real_escape_string($vendor_id)."'";
		
		$query = mysql_query($sql); 
		
		$result = mysql_fetch_array($query);
		
		return $result;
		
	}
	
	public function getArchivedVendorsByUserID($data){
		
		$sql = "select * from vendor where user_id = ".$data['user_id']." and is_archived = 1";
		
		$query = mysql_query($sql) or die(mysql_error());
		
		return $query;
		
	}
	
	public function dropDownOptionVendors($userid){
		
		$data['user_id'] = $userid;
		
		$query = $this->getVendorsByUserID($data);
		
		$option = '';
		while($row = mysql_fetch_array($query)){
			
			extract($row);
			
			$option .= '<option value="'.$vendor_id.'">'.$name.'</option>';
			
		}
		
		return $option;
		
	}
	
	public function dropDownOptionVendors2($userid, $vendorID){
		
		$data['user_id'] = $userid;
		
		$query = $this->getVendorsByUserID($data);
		
		$option = '';
		while($row = mysql_fetch_array($query)){
			
			extract($row);
			
			if($vendor_id == $vendorID) {
				$option .= '<option value="'.$vendor_id.'" selected>'.$name.'</option>';
			} else {
				$option .= '<option value="'.$vendor_id.'">'.$name.'</option>';
			}
			
		}
		
		return $option;
		
	}
	
	
}

?>