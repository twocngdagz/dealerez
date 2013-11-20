<?php

class Feeds
{


//function will return dealer feed deailt 
function get_feed_detail($feed_id)
{
		$result_info=array();
	
		if($feed_id)
		{	
			$sql	="select * from dealer_feed_files  where feed_id=$feed_id";
			
			
			
			$result=Execute_command($sql);
		
			$a=0;
			
			try
			{		if($record=mysql_fetch_array($result))
					{
						$result_info=$record;
					
					}
			}
			catch(Exception $e)
			{
				$_SESSION['mysql_eror']=$result;
			}
	
		}
	

	return $result_info;

}
//function will return dealer feed deailt 
function get_dealer_feed($cond=false,$order_by=false,$sort_by=false,$slimit=false,$elimit=false,$return_sql=false)
{
$result_info=array();
	
			if($order_by)
			{
					$order_by=" Order by $order_by $sort_by";
			}
			else
			{
					$order_by=" Order by createdDate desc";
			
			}
		
		if($slimit and $elimit)
		{
			$limit="limit $slimit,$elimit";
		}
		else if($elimit)
		{
			$limit="limit 0,$elimit"; 
		}

			
			if($cond)
			{
				$sql	="select * from dealer_feed_files where $cond $order_by $limit";
			}
			else
			{
				$sql	="select * from dealer_feed_files   $order_by $limit";
			}
			
			
			if($return_sql)
			{
				return $sql;
				exit;
			}
			else
			{
			
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

#FUNCTION WILL UPDATE THE USER PAGE TITLE
function add_new_feed_file($data_array)
	{
		if(count($data_array)>0)
		{
			$sql="insert into dealer_feed_files set createdDate='".$data_array["createdDate"]."',createdByUserNum='".$data_array["createdByUserNum"]."',uploadByUserNum='".$data_array["uploadByUserNum"]."',uploadDate='".$data_array["uploadDate"]."',user_id='".$data_array["user_id"]."',file_name='".$data_array["file_name"]."',status='".$data_array["status"]."',user_ip='".$data_array["user_ip"]."',feed_category='".$data_array["feed_category"]."'";
		
			$result=Execute_command($sql);
			
			if($result==1)
			{
			 	return true;
			}
			else
			{
				$_SESSION['mysql_eror']=$result;
				return false;
				
			}
		}
		else
		{
				$_SESSION['mysql_eror']="Please provide detail to update dealer feed information";
				return false;
		}
	
	}





//function will create new transaction in database
function delete_feed($feed_id,$user_id=false)
{
			
			if($user_id)
			{
			
				$sql="delete from   dealer_feed_files where feed_id=$feed_id";
			}
			else
			{
				$sql="delete from   dealer_feed_files where feed_id=$feed_id and user_id=$user_id";
			}
			$result=Execute_command($sql);
			
						if($result==1)
						{
							return true;
						}
						else
						{
						$_SESSION['mysql_eror']=$result;
						
						return false;
						
						}
						
}

function update_feed_status($data_array)
{
			
			if(count($data_array)>0)
		{
			$sql="update dealer_feed_files set uploadByUserNum='".$data_array["uploadByUserNum"]."',uploadDate='".$data_array["uploadDate"]."',status='".$data_array["status"]."',total_listings='".$data_array["total_listings"]."' where feed_id='".$data_array["feed_id"]."'";
		
			$result=Execute_command($sql);
			
			if($result==1)
			{
			 	return true;
			}
			else
			{
				$_SESSION['mysql_eror']=$result;
				return false;
				
			}
		}
		else
		{
				$_SESSION['mysql_eror']="Please provide detail to update dealer feed information";
				return false;
		}
			
}




}




?>