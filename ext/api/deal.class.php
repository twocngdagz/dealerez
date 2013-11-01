<?php

class deal{
	
	public function getLastID($identification){
		
		$sql = "select deal_id from deals where identification = '".$identification."'";
		$query = mysql_query($sql);
		
		$result = mysql_fetch_array($query);
		
		return $result['deal_id'];
		
	}
	
	public function get_user_deals($user_id){
		
		$sql = "
			SELECT
				d.*
				, dc.fname
				, dc.mname
				, dc.lname
				, dsi.type_of_sale
				, di.listing_id
			FROM
				deals d
				, deal_contact dc
				, deal_sale_information dsi
				, deal_inventory di
			WHERE
				dc.deal_id = d.deal_id
				and
				d.deal_id = dsi.deal_id
				and
				d.user_id = '".mysql_real_escape_string($user_id)."'
				and
				d.is_archived = 0
				and
				d.is_deleted = 0
				and
				d.is_closed = 0
				and
				dc.is_cobuyer = 0
		";
		//echo $sql;die();
		$query = mysql_query($sql);
		
		return $query;
		
	}
	
	public function get_user_deals_archived($user_id){
		
		$sql = "
			SELECT
				d.*
				, dc.fname
				, dc.mname
				, dc.lname
				, dsi.type_of_sale
				, di.listing_id
			FROM
				deals d
				, deal_contact dc
				, deal_sale_information dsi
				, deal_inventory di
			WHERE
				d.deal_id = dc.deal_id
				and
				d.deal_id = dsi.deal_id
				and
				d.user_id = '".mysql_real_escape_string($user_id)."'
				and
				d.is_archived = 1
				and
				d.is_deleted = 0
				and
				d.is_closed = 0
				and
				dc.is_cobuyer = 0
		";
		//echo $sql;die();
		$query = mysql_query($sql);
		
		return $query;
		
	}
	
	public function get_user_deals_closed($user_id){
		
		$sql = "
			SELECT
				d.*
				, dc.fname
				, dc.mname
				, dc.lname
				, dsi.type_of_sale
			FROM
				deals d
				, deal_contact dc
				, deal_sale_information dsi
			WHERE
				d.deal_id = dc.deal_id
				and
				d.deal_id = dsi.deal_id
				and
				d.user_id = '".mysql_real_escape_string($user_id)."'
				and
				d.is_deleted = 0
				and
				d.is_closed = 1
				and
				dc.is_cobuyer = 0
		";
		//echo $sql;die();
		$query = mysql_query($sql);
		
		return $query;
		
	}
	
	public function get_deal_by_deal_id($userid,$dealid){
		
		$sql = "
			select
				d.*
				, dc.*
			from
				deals d
				, deal_contact dc
			where
				d.deal_id = $dealid
				and
				d.user_id = $user_id
				and
				d.deal_id = dc.deal_id
				and
				dc.is_cobuyer = 0
		";
		
		$query = mysql_query($sql);
		
		$result = mysql_fetch_array($query);
		
		return $result;
		
	}
	
	public function get_deal_overview($user_id,$dealid){
		
		$sql = "select d.*, dsi.close_date from deals d, deal_sale_information dsi where d.deal_id = dsi.deal_id and d.deal_id = '".$dealid."' and d.user_id = '".$user_id."'";
		
		$query = mysql_query($sql);
		
		$result = mysql_fetch_array($query);
		
		return $result;
		
	}
	
	public function get_deal_customer_information($dealid,$is_cobuyer=0){
		
		$sql = "select * from deal_contact where deal_id = '".$dealid."' and is_cobuyer = '".$is_cobuyer."'";
		
		$query = mysql_query($sql);
		
		return $query;
		
	}
	
	public function get_deal_vehicle_information($dealid,$is_tradein=0){
		
		$sql = "select * from deal_inventory where deal_id = '".$dealid."' and is_tradein = '".$is_tradein."'";
		
		$query = mysql_query($sql);
		
		return $query;
		
	}
	
	public function get_deal_sale_information($deal_id){
		
		$sql = "select * from deal_sale_information where deal_id = '".$deal_id."'";
		
		$query = mysql_query($sql);
		
		$result = mysql_fetch_array($query);
		
		return $result;
		
	}
	
	public function get_deal_additional_products($deal_id){
		
		$sql = "select * from deal_additional_products where deal_id = '".$deal_id."'";
		
		$query = mysql_query($sql);
		
		$result = mysql_fetch_array($query);
		
		return $result;
		
	}
	
	public function get_deal_fees_taxes($deal_id){
		
		$sql = "select * from deal_fees_taxes where deal_id = '".$deal_id."'";
		
		$query = mysql_query($sql);
		
		$result = mysql_fetch_array($query);
		
		return $result;
		
	}
	
}

?>