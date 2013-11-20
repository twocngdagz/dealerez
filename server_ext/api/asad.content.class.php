<?php


class Contents
{
	#function will return site pages
	function get_site_pages()
	{
			$result_info=array();
		$sql="select * from site_pages where is_active=1 and is_custum!=1 order by global_order";
		$result=Execute_command($sql);
		$a=0;
		
		try	{
				while($record=mysql_fetch_array($result))
					{
						$result_info[$a]=$record;
						$a++;
					}
			}
			catch(Exception $e)
			{
				$_SESSION['mysql_eror']=$result;
			}
		
		return $result_info;
	}
	
	#function will return site theme Headers
	function get_site_header()
	{
			$result_info=array();
		$sql="select * from site_header  where is_active=1 order by global_order";
		$result=Execute_command($sql);
		$a=0;
		
		try	{
				while($record=mysql_fetch_array($result))
					{
						$result_info[$a]=$record;
						$a++;
					}
			}
			catch(Exception $e)
			{
				$_SESSION['mysql_eror']=$result;
			}
		
		return $result_info;
	}
	
	
	#function will return site theme color
	function get_site_color()
	{
			$result_info=array();
		$sql="select * from site_color order by global_order";
		$result=Execute_command($sql);
		$a=0;
		
		try	{
				while($record=mysql_fetch_array($result))
					{
						$result_info[$a]=$record;
						$a++;
					}
			}
			catch(Exception $e)
			{
				$_SESSION['mysql_eror']=$result;
			}
		
		return $result_info;
	}
	
	//FUNCTION WILL RETURN PAGE DETAIL BY PAGE NAME
function get_page_detail($page_name,$page_id=false)
{
	$page_detail=array();
	
	if($page_name or $page_id)
	{
			if($page_id)
			{
				$sql="select * from site_pages where page_id=$page_id";
			}
			else
			{
				$sql="select * from site_pages where page_name='$page_name'";
			}
			$result=Execute_command($sql);
			
			
			
			while($record=mysql_fetch_array($result))
			{
				$page_detail=$record;
			
			}
	}
	else
	{
		return false;
	}
	
	return $page_detail;
	

}
	
//FUNCTION WILL RETURN color DETAIL 
function get_color_detail($color_id)
{
	$color_info=false;
	if($color_id)
	{
			$sql="select * from site_color where color_id=$color_id";
			$result=Execute_command($sql);
			
			
			if($record=mysql_fetch_array($result))
			{
			
					
				$color_info=$record;
				
			}
	}
	else	
	{
		return false;
	}

	return $color_info;
	

}





function is_filed_exisit($field_name,$filed_value,$table)
{	

			$data_array=false;
	
			$sql="select * from $table where $field_name='$filed_value'";
			
			$result=Execute_command($sql);
			if($record=mysql_fetch_array($result))
			{
				$data_array=true;
			}
	
	
	return $data_array;
	
}




//FUNCTION WILL UPDATE DEALER PROFILE
function update_cms_user_profile($data_array)
{
	if(count($data_array)>0)
	{
		if(count($data_array)>0)
		{
	
		
			if(count($data_array['columns_name'])>0)
			{	
				$cond='';
				$b=1;
				$user_type=$data_array['user_type'];
				$table_name=$data_array['table_name'];
				
				foreach($data_array['columns_name'] as $key =>$value) 
				{
					
						$column_values.="$key='$value'";
						if($b<count($data_array['columns_name']))
						{
							$column_values.=",";
						}	
					$b++;
						
				}
				
				
				$sql="update $table_name set $column_values where num=".$data_array['num']."";
				
		
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
		}
	}
}


//FUNCTION WILL ADD NEW DYNAMIC FOR THE USER
function add_dynamic_profile($data_array)
{
	if(count($data_array)>0)
	{
	
		
		if(count($data_array['columns_name'])>0)
		{	
			$cond='';
			$b=1;
			foreach($data_array['columns_name'] as $key =>$value) 
			{
				
					$column_values.="$key='$value'";
					if($b<count($data_array['columns_name']))
					{
						$column_values.=",";
					}	
				$b++;
					
			}
		
			$sql="insert into ".$data_array['table_name']." set $column_values";
			
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
		
	}
}




//FUNCTION WILL ADD NEW DYNAMIC FOR THE USER
function add_dynamic_data($data_array)
{
	if(count($data_array)>0)
	{
	
		
		if(count($data_array['columns_name'])>0)
		{	
			$cond='';
			$b=1;
			foreach($data_array['columns_name'] as $key =>$value) 
			{
				
					$column_values.="$key='$value'";
					if($b<count($data_array['columns_name']))
					{
						$column_values.=",";
					}	
				$b++;
					
			}
		
			$sql="insert into ".$data_array['table_name']." set $column_values";
			
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
		
	}
}


//FUNCTION WILL UPDATE USER ACCOUNT TABLE
function update_dynamic_accounts($data_array)
{
	if(count($data_array)>0)
	{
	
		
		if(count($data_array['columns_name'])>0)
		{	
			$cond='';
			$b=1;
			foreach($data_array['columns_name'] as $key =>$value) 
			{
				
					$column_values.="$key='$value'";
					if($b<count($data_array['columns_name']))
					{
						$column_values.=",";
					}	
				$b++;
					
			}
		
			$sql="update ".$data_array['table_name']." set $column_values where ".$data_array['condition']."";
			
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
	}

}


//FUNCTION WILL UPDATE USER ACCOUNT TABLE
function update_site_visit($table_name,$column_values,$condition)
{
	
		
			$sql="update $table_name set $column_values where $condition";
			
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
//function will create new transaction in database
function add_page_count($data_array)
{
	
	if(count($data_array)>=0)
	{
			
			$sql="insert into page_visit_count set user_id=".$data_array['user_id'].",listing_id='".$data_array['listing_id']."', page_type='".$data_array['page_type']."',ip='".$data_array['trans_detail']."',createdDate='".$data_array['createdDate']."'";
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
}



function get_visit_count($page_type,$user_id=false,$listing_id=false,$cond=false)
{

		$result_info=0;
			$condition="";
		
		if($page_type and ($user_id or $listing_id))
			{	
			
				
			
			if($page_type==PAGE_TYPE_LISTING)
			{
			
					$condition=" page_type='".PAGE_TYPE_LISTING."'";	
			
			}
			else
			{
				 $condition="  page_type='".PAGE_TYPE_PROFILE."'";	
			}
			
			if($listing_id)
			{
				 $condition.="  and listing_id='".$listing_id."'";
			}
			else
			{
				$condition.="  and user_id='".$user_id."'";
			}
			
			if($cond)
			{
				$condition.=$cond;
			}
			
			
			
			$sql="select count(num) from page_visit_count where $condition";
			
			
			$result=Execute_command($sql);
		
				try
				{		if($record=mysql_fetch_array($result))
						{
							$result_info=$record[0];
							
						}
				}
				catch(Exception $e)
				{
					$_SESSION['mysql_eror']=$result;
				}
		
		}
			return $result_info;
}

//FUNCTION WILL RETURN  PAGE visit detail
function get_visit_list($page_type,$num=false,$listing_id=false)
{
	$result_info=array();
	
	if($page_type and ($num or $listing_id))
	{
			
			if($page_type==PAGE_TYPE_LISTING)
			{
			
					$condition=" page_type='".PAGE_TYPE_LISTING."'";	
			
			}
			else
			{
				 $condition="  page_type='".PAGE_TYPE_PROFILE."'";	
			}
			
			if($listing_id)
			{
				 $condition.="  and listing_id='".$listing_id."'";
			}
			else
			{
				$condition.="  and num='".$num."'";
			}
			
			
			$sql="select * from page_visit_count where $condition order by num desc";
			$result=Execute_command($sql);
			
			
			while($record=mysql_fetch_array($result))
			{
				$result_info[]=$record;
			}
	}
	else
	{
		return false;
	}
	return $result_info;
	

}


/************* Asad Function Start **************/

function getUserInfoByID($userid){
	
	$sql = "select * from users where user_id = ".$userid;
	
	$query = Execute_command($sql);
	
	$result = mysql_fetch_array($query);
	
	return $result;
	
}

function getStates(){
	
	$sql = "select * from tbl_states";
	
	$query = Execute_command($sql);
	
	return $query;
	
}

/************* Asad Function End ****************/



	
}
?>