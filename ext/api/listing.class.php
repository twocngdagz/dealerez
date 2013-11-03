<?php
class Listing
{



//FUNCTION WILL RETURN DEALER ALL LISTING
function get_user_listing($user_id,$start_limit=false,$end_limit=false)
{	$result_info=array();
	
	if($user_id)
	{
			if($end_limit)
			{
				
				$sql="select * from listing where user_id=$user_id order by created_date DESC limit $start_limit,$end_limit";
			}
			else
			{ 
				$sql="select * from listing where user_id=$user_id order by created_date DESC";
			}
			
			
			
			$result=Execute_command($sql);
			
			$a=0;
			
			try
			{		while($record=mysql_fetch_array($result))
					{
						$result_info[$a]=$record;
						$result_info[$a]['images_array']=$this->get_listing_images($record['listing_id']);
						$result_info[$a]['image_name']  = $this->get_listing_image_name($record['listing_id']); //ADDED BY LEO NEIL 2-21-2013
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
//-================FUNCTION WILL RETURN DEALER ALL LISTING===============- -by category selected!!
function get_user_listing_by($user_id,$start_limit=false,$end_limit=false,$category=false)
{	$result_info=array();
	
	if($user_id)
	{
			
				if($end_limit)
				{
					if($category=="ViewAll")
					{
						$sql="select * from listing where user_id='".$user_id."' order by created_date DESC limit $start_limit,$end_limit";
					}
					else
					{
						$sql="select * from listing where user_id='".$user_id."' and category = '".$category."' order by created_date DESC limit $start_limit,$end_limit";
					}
					
				}
				else
				{ 
					$sql="select * from listing where user_id='".$user_id."' order by created_date DESC limit $start_limit,$end_limit";
				}

			
			$result=Execute_command($sql); 
		//	var_dump($result);
			
			$a=0;
			
			try
			{		while($record=mysql_fetch_array($result))
					{
						$result_info[$a]=$record;
						$result_info[$a]['images_array']=$this->get_listing_images($record['listing_id']);
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

//FUNCTION WILL RETURN ALL LISTING FOR SEARCH
function get_all_listing($start_limit=false,$end_limit=false,$order_by=false,$sort_by=false,$cond=false)
{	$result_info=array();
	
	
			if($order_by)
			{
			$order_by="Order by $order_by";
			}
            else
			{
			$order_by="created_date ";
			$sort_by=" DESC";
                        }
			if($end_limit)
			{
				
				$sql="select * from  listing   where listing_id>0 $cond $order_by $sort_by limit $start_limit,$end_limit";
			}
			else
			{ 
				$sql="select * from  listing  where listing_id>0 $cond $order_by $sort_by";
			}
			
			
			$result=Execute_command($sql);
			
			$a=0;
			
			try
			{		while($record=mysql_fetch_array($result))
					{
						$result_info[$a]=$record;
						$result_info[$a]['images_array']=$this->get_listing_images($record['listing_id']);
						$a++;	
					}
			}
			catch(Exception $e)
			{
				$_SESSION['mysql_eror']=$result;
			}
	
	

	return $result_info;

}
//count number of listing for selected user_id
function get_listings_count_by_userid($user_id) {
	if($user_id) {
		$sql = "select count(*) from listing inner join users on listing.user_id = users.user_id where users.user_id = " .$user_id;
	}
	
	$result=Execute_command($sql);
	$count = mysql_result($result,0);
	return $count;
}
//added by leo 9/12/2013
function getVehicleDataWithCounts($user_id=false,$data=false) {
	$result_info=array();
	if($user_id) {
		$sql = "select * from listing where user_id = $user_id";
	}	
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
	return $result_info;
}
function getSimilarVehicle($user_id=false,$vehicle,$lid) {
	$result_info=array();
		if($user_id) {
			$sql = "select * from listing where user_id = $user_id and make = '$vehicle' and listing_id <> $lid";
		}
		else {
			$sql = "select * from listing where make = '$vehicle' and listing_id <> $lid";
		}
		//echo $sql;
		$result=Execute_command($sql);
			//echo $sql;
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
	
	

	return $result_info;
		
}
//CREATED BY: LEO NEIL ::: FUNCTION WILL RETURN ALL LISTING FOR SEARCH
function getall_listing($start_limit=false,$end_limit=false,$order_by=false,$sort_by=false,$cond=false)
{	$result_info=array();
	
			$cond = isset($cond)?$cond:'';
			$order_by = isset($order_by)?$order_by:'';
			$sort_by = isset($sort_by)?$sort_by:'';
			$start_limit =  isset($start_limit)?$start_limit:'';
			$end_limit =  isset($end_limit)?$end_limit:'';
			
			if($cond)
			{
				if($end_limit)
				{
					$sql="select * from  listing WHERE $cond ORDER BY $order_by $sort_by LIMIT ".$start_limit.",".$end_limit;
				}
				else
				{
					$sql="select * from  listing WHERE $cond ORDER BY $order_by $sort_by";
				}
			}
			else
			{ 
				if($end_limit)
				{
					$sql="select * from  listing ORDER BY $order_by $sort_by LIMIT ".$start_limit.",".$end_limit;
				}
				else
				{
					$sql="select * from  listing ORDER BY $order_by $sort_by";
				}
			}
			
			
			$result=Execute_command($sql);
			//echo $sql;
			$a=0;
			
			try
			{		while($record=mysql_fetch_array($result))
					{
						$result_info[$a]=$record;
						$result_info[$a]['images_array']=$this->get_listing_images($record['listing_id']);
						$result_info[$a]['image_name']  = $this->get_listing_image_name($record['listing_id']); //ADDED 2-21-2013
						//$result_info[$a]['user_details']=$this->get_user_details($record['listing_id']);
						$a++;	
					}
			}
			catch(Exception $e)
			{
				$_SESSION['mysql_eror']=$result;
			}
	
	

	return $result_info;

}
//CREATED BY: LEO NEIL ::: 8/2/2013
function countInquiresToday($cartype) {
		$dateToday = date("Y-m-d");
		
		if($cartype=="new") {
			$sql="select count(*) from  listing_inquiries WHERE subject = 'Enquiry - New Car Quote' and add_date = '$dateToday'";
		}
		else {
			$sql="select count(*) from  listing_inquiries WHERE subject = 'Enquiry - Used Car Quote' and add_date = '$dateToday'";
		}
		
		$result=Execute_command($sql);
		$count = mysql_result($result,0);
		return $count;
}
function getListingsGroupBy($start_limit=false,$end_limit=false,$order_by=false,$sort_by=false,$cond=false,$groupby=false)
{	$result_info=array();
	
			$cond = isset($cond)?$cond:'';
			$order_by = isset($order_by)?$order_by:'';
			$sort_by = isset($sort_by)?$sort_by:'';
			$start_limit =  isset($start_limit)?$start_limit:'';
			$end_limit =  isset($end_limit)?$end_limit:'';
			$groupby = isset($groupby)?"group by ".$groupby:'';
			
			if($cond)
			{
				if($end_limit)
				{
					$sql="select * from  listing WHERE $cond $groupby ORDER BY $order_by $sort_by LIMIT ".$start_limit.",".$end_limit;
				}
				else
				{
					$sql="select * from  listing WHERE $cond $groupby ORDER BY $order_by $sort_by";
				}
			}
			else
			{ 
				if($end_limit)
				{
					$sql="select * from  listing ORDER BY $order_by $sort_by LIMIT ".$start_limit.",".$end_limit;
				}
				else
				{
					$sql="select * from  listing ORDER BY $order_by $sort_by";
				}
			}
			
			
			$result=Execute_command($sql);
			
			//echo $sql;
			
			$a=0;
			
			try
			{		while($record=mysql_fetch_array($result))
					{
						$result_info[$a]=$record;
						$listing_id = $record['listing_id'];
					
						$a++;	
					}
			}
			catch(Exception $e)
			{
				$_SESSION['mysql_eror']=$result;
			}
	
	

	return $result_info;

}

//CREATED BY: LEO NEIL ::: 6/27/2013
function getListings($start_limit=false,$end_limit=false,$order_by=false,$sort_by=false,$cond=false)
{	$result_info=array();
	
			$cond = isset($cond)?$cond:'';
			$order_by = isset($order_by)?$order_by:'';
			$sort_by = isset($sort_by)?$sort_by:'';
			$start_limit =  isset($start_limit)?$start_limit:'';
			$end_limit =  isset($end_limit)?$end_limit:'';
			
			if($cond)
			{
				if($end_limit)
				{
					$sql="select * from  listing WHERE $cond ORDER BY $order_by $sort_by LIMIT ".$start_limit.",".$end_limit;
				}
				else
				{
					$sql="select * from  listing WHERE $cond ORDER BY $order_by $sort_by";
				}
			}
			else
			{ 
				if($end_limit)
				{
					$sql="select * from  listing ORDER BY $order_by $sort_by LIMIT ".$start_limit.",".$end_limit;
				}
				else
				{
					$sql="select * from  listing ORDER BY $order_by $sort_by";
				}
			}
			
			
			$result=Execute_command($sql);
			
			//echo $sql;
			
			$a=0;
			
			try
			{		while($record=mysql_fetch_array($result))
					{
						$result_info[$a]=$record;
						$listing_id = $record['listing_id'];
					
						$a++;	
					}
			}
			catch(Exception $e)
			{
				$_SESSION['mysql_eror']=$result;
			}
	
	

	return $result_info;

}

//FUNCTION WILL DELETE LISTING FROM DATABASE
function delete_listing($listing_id,$user_id=false)
{

	if($listing_id)
	{
			if($user_id)
			{
				
				$sql="delete from listing where listing_id=$listing_id and user_id=$user_id";
			}
			else
			{ 
				$sql="delete from listing where  listing_id=$listing_id";
			}
			
				
			
				$result=Execute_command($sql);	
				if($result==1)
				{
					$result_info=$record;
					
					
				}
				else
				{
					$_SESSION['mysql_eror']=$result;
				}

					
	}
	else
	{
		$_SESSION['mysql_eror']="Please provide listing detail to delete listing";
	}
	

	return $result_info;


}

//FUNCTION WILL DELETE LISTING IMAGE FROM DATABASE
function delete_listing_image($listing_id,$image_id)
{

	if($image_id)
	{
			
				$sql="delete from listing_images where  image_id=$image_id";
					
				$result=Execute_command($sql);	
				if($result==1)
				{
					$result_info=$record;
					
					
				}
				else
				{
					$_SESSION['mysql_eror']=$result;
				}

					
	}
	else
	{
		$_SESSION['mysql_eror']="Please provide listing detail to delete listing";
	}
	

	return $result_info;


}
//FUNCTION WILL RETURN DEALER ALL LISTING
function get_user_custum_listing($user_id,$result_per_page=false,$page=false,$make=false,$price_from=false,$price_to=false,$listing_id=false)
{	
	$result_info=array();

	if($user_id)
	{
			$cond=" user_id=$user_id";
		
	if($listing_id)
	{
		$cond.=" and listing_id=$listing_id";
	}
	else
	{
		if($make)
		{
			$cond.=" and make='$make'";
		}
		if($price_from)
		{
			$cond.=" and  price>='$price_from'";
		}
		if($price_to)
		{
			$cond.=" and  price<='$price_to'";
		}
		$limit="";
		if($result_per_page and $page)
		{
		$page=$page-1;
		$limit=" limit $page,$result_per_page";
		}
	}		
		
			$sql="select * from listing where $cond  Order by created_date $limit";
			
			
			$result=Execute_command($sql);
			
			$a=0;
			
			try
			{		while($record=mysql_fetch_array($result))
					{
						$result_info[$a]=$record;
						$result_info[$a]['images_array']=$this->get_listing_images($record['listing_id']);
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


//FUNCTION WILL RETURN DEALER FEATURE LISTING
function get_feature_listing($user_id)
{	$result_info=array();
	
	if($user_id)
	{
			$sql="select * from listing where user_id=$user_id and is_featured=1 order by Rand() ";
			$result=Execute_command($sql);
			
			$a=0;
			
			try
			{		while($record=mysql_fetch_array($result))
					{
						$result_info[$a]=$record;
						$result_info[$a]['images_array']=$this->get_listing_images($record['listing_id']);
						$result_info[$a]['image_name']  = $this->get_listing_image_name($record['listing_id']); //ADDED 2-21-2013
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
//FUNCTION WILL RETURN LISTING ACCORDING TO SEARCH CATEGORY 
function get_search_listing($result_per_page=false,$page=false,$make=false,$price_from=false,$price_to=false,$region=false)
{	
	$result_info=array();
		if($make)
		{
			$cond.=" and make='$make'";
		}
		if($price_from)
		{
			$cond.=" and  price>='$price_from'";
		}
		if($price_to)
		{
			$cond.=" and  price<='$price_to'";
		}
		$limit="";
		if($result_per_page and $page)
		{
		$page=$page-1;
		$limit=" limit $page,$result_per_page";
		}	
		
			$sql="select * from listing where $cond  Order by created_date $limit";
			
			
			$result=Execute_command($sql);
			
			$a=0;
			
			try
			{		while($record=mysql_fetch_array($result))
					{
						$result_info[$a]=$record;
						$result_info[$a]['images_array']=$this->get_listing_images($record['listing_id']);
						$a++;	
					}
			}
			catch(Exception $e)
			{
				$_SESSION['mysql_eror']=$result;
			}

	return $result_info;

}


//MODIFIED BY LEO NEIL FUNCTION WILL RETURN ALL FEATURE LISTING 2-22-13
function get_all_feature_listing()
{	$result_info=array();
	
			$sql="select * from listing where is_featured=1 order by Rand() limit 0,1 ";
			$result=Execute_command($sql);
			
			$a=0;
			
			try
			{		while($record=mysql_fetch_array($result))
					{
						$result_info[$a]=$record;
						$result_info[$a]['images_array']=$this->get_listing_images($record['listing_id'],4);
						$result_info[$a]['image_name']  = $this->get_listing_image_name($record['listing_id']);
						//$result_info[$a]['user_details'] = $this->get_user_details($record['listing_id']);
						$a++;	
					}
			}
			catch(Exception $e)
			{
				$_SESSION['mysql_eror']=$result;
			}

	return $result_info;

}

//FUNCTION WILL RETURN LISTING DETAIL
function get_listing_detail($listing_id,$user_id=false)
{	$result_info=array();
	
	if($listing_id)
	{		
			if($user_id)
			{
				$sql="select * from listing where listing_id=$listing_id and user_id=$user_id";
			}
			else
			{
				$sql="select * from listing where listing_id=$listing_id";
			}
			
			$result=Execute_command($sql);
			$a=0;
			try
			{		while($record=mysql_fetch_array($result))
					{
						$result_info=$record;
						//$result_info[$a]['images_array']=$this->get_listing_images($record['listing_id']); //ORIGINAL EDITED AT 2/28/13
						$result_info['images_array']=$this->get_listing_images($record['listing_id']);
						$result_info['image_name']  = $this->get_listing_image_name($record['listing_id']);
						$a++;
					}
			}
			catch(Exception $e)
			{
				$_SESSION['mysql_eror']=$result;
			}
			
	}
	else	
	{
		return false;
	}

	return $result_info;

}
//CREATED BY LEO NEIL FUNCTION WILL RETURN USER DETAILS 2-22-13
function get_user_details($listing_id)
{	$result_info=array();
	
			$sql="SELECT users.*, listing.listing_id FROM listing Inner Join users ON users.user_id = listing.user_id WHERE listing.listing_id = " .$listing_id;
			$result=Execute_command($sql);

			
			try
			{		while($record=mysql_fetch_array($result))
					{
						$result_info=$record;
					}
			}
			catch(Exception $e)
			{
				$_SESSION['mysql_eror']=$result;
			}

	return $result_info;

}

//FUNCTION WILL RETURN IMAGE DETAIL
function get_image_detail($listing_id,$image_id)
{	$result_info=array();
	
	if($image_id)
	{		
			if($listing_id)
			{
				$sql="select * from listing_images where listing_id=$listing_id and image_id=$image_id";
			}
			else
			{
				$sql="select * from listing_images where image_id=$image_id";
			}
			
			$result=Execute_command($sql);
			
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
	else	
	{
		return false;
	}

	return $result_info;

}

//FUNCTION WILL INSERT LISTING IMAGES
function insert_listing_images($listing_id,$images_array)
{	$result_info=array();
	
	if($listing_id and count($images_array)>=0)
	{
			
			
			$a=0;
			
			try
			{		foreach($images_array as $record)
					{
						$sql="insert into  listing_images set listing_id=$listing_id,image_name='".$record."'";
						$result=Execute_command($sql);
						
					}
			}
			catch(Exception $e)
			{
				$_SESSION['mysql_eror']=$result;
			}
	}
	


	return $result;

}
//FUNCTION WILL RETURN LISTING IMAGES
function get_listing_images($listing_id,$limit = false)
{	$result_info=array();
	
	if($listing_id)
	{
			if($limit){
				$sql="select * from listing_images where listing_id=$listing_id order by display_order LIMIT 0, " .$limit;
			}
			else {
				$sql="select * from listing_images where listing_id=$listing_id order by display_order";
			}

			$result=Execute_command($sql);
			$a=0;
			$totalrows = mysql_num_rows($result);
			if($totalrows>0)
			{
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
	}
	


	return $result_info;

}
function get_img_name($listing_id) {
		$sql_img = mysql_query("select image_name from listing_images where listing_id=$listing_id limit 1");
		$row_img = mysql_result($sql_img,0);
		return $row_img;
}
////MODIFIED BY: LEO NEIL :::FUNCTION WILL RETURN LISTING IMAGE
function get_listing_image_name($listing_id)
{	$result_info=array();
	
	if($listing_id)
	{
			$sql="select * from listing_images where listing_id=$listing_id order by display_order limit 1";
			$result=Execute_command($sql);
			$a=0;
			$totalrows = mysql_num_rows($result);
			if($totalrows>0)
			{
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
	}
	


	return $result_info;

}

function get_image($listing_id)
{	
	$img_details = array();
	if($listing_id)
	{
			$sql="select * from listing_images where listing_id=$listing_id order by display_order limit 1";
			$result=Execute_command($sql);
			
			$img_details['image_id'] = mysql_result($result,0,"image_id");
			$img_details['image_name'] = mysql_result($result,0,"image_name");
	}
	return $img_details;
}
////CREATED BY: LEO NEIL :::FUNCTION WILL RETURN ADS
function get_ads($listing_id,$table,$cond,$field)
{	$result_info=array();
	
	if($listing_id)
	{
			$sql="select * from". $table. " where ".$cond." order by" .$field;
			$result=Execute_command($sql);
			$a=0;
			$totalrows = mysql_num_rows($result);
			if($totalrows>0)
			{
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
	}
	


	return $result_info;

}

//FUNCTION WILL RETURN SUM OF ALL LISTING
function count_listing($user_id=false)
{	
	$cond="";
	if($user_id)
	{
	$cond=" where user_id=".$user_id;		
	}
	
	$sql=Execute_command("select count(listing_id) as count_listing from listing $cond");

	$result = mysql_result($sql,0,"count_listing");

	return $result;
	

}
//FUNCTION WILL RETURN MAX LISTING ID
function get_max_listing_id($user_id=false)
{	
	$result_info=1;
	
	if($user_id)
	{
		$sql="select max(listing_id) from listing where user_id=$user_id ";
	}
	else
	{
		$sql="select max(listing_id) from listing";
	}
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


	return $result_info;

}

//FUNCTION WILL RETURN DETAIL OF HOME PAGE LISTING FOR USER
function get_home_makes($user_id)
{
			$make_array=array();
			$result_info=array();
			
		$make_array=$this->get_all_makes();
		
		foreach($make_array as $make)
		{	
			$cond="user_id=".$user_id." and make='".$make['make_name']."'";
			$sql="select count(listing_id) from listing where $cond";
		
			
			$result_count = mysql_query($sql);
			$rows_count = mysql_num_rows($result_count);
			
			if($rows_count>0)
			{
				if($row=mysql_fetch_array($result_count))
				{	
					if($row[0]>0)
					{
					$result_info[$a]['make_id']=$make['make_id'];
					$result_info[$a]['make_name']=$make['make_name'];
					$result_info[$a]['count']=$row[0];
					$a++;
					}
					
					
				}
			}				
		}
		
		
return $result_info;

}


//FUNCTION WILL RETURN DEALER ALL MAKE FROM DATABASE
function get_all_makes()
{
		$result_info=array();
		$sql="select * from make order by make_name";
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

//FUNCTION WILL RETURN DEALER ALL MAKE FROM DATABASE
function get_all_model()
{
		$result_info=array();
		$sql="select * from make_model order by model_name";
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


//FUNCTION WILL RETURN MODEL OF PARTICULAER MAKE
function get_make_model($make_name)
{
		$result_info=array();
		$sql="select * from make_model where make_name='$make_name' order by model_name";
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

//FUNCTION WILL RETURN LIST OF ALL CATEGORIES
function get_all_categories()
{
		$result_info=array();
		$sql="select * from listing_category order by cat_name";
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

//FUNCTION WILL RETURN LIST OF BODY STYLE
function get_body_style_groupByStyleName()
{
		$result_info=array();
		$sql="SELECT * FROM body_style group by style_name";
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
//FUNCTION WILL RETURN LIST OF ALL CATEGORIES
function get_body_style()
{
		$result_info=array();
		$sql="select * from body_style order by style_name";
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
#FUNCTION WILL ADD NEW  LISTING 
function add_new_listing($data_array)
{
	if(count($data_array)>0)
	{
		$sql="insert into listing set user_id=".$data_array['user_id'].",created_date='".$data_array['created_date']."',title='".$data_array['title']."',year='".$data_array['year']."',price='".$data_array['price']."',description='".$data_array['description']."',category='".$data_array['category']."',main_category='".$data_array['main_category']."',miles='".$data_array['miles']."',vin='".$data_array['vin']."',new_used='".$data_array['new_used']."',make='".$data_array['make']."',model='".$data_array['model']."',body_style='".$data_array['body_style']."',is_featured='".$data_array['is_featured']."',stock_no='".$data_array['stock_no']."',hours='".$data_array['hours']."',exterior='".$data_array['exterior']."',interior='".$data_array['interior']."',drive='".$data_array['drive']."',engine='".$data_array['engine']."',trans='".$data_array['trans']."',doors='".$data_array['doors']."',image_1='".$data_array['image_1']."',image_2='".$data_array['image_2']."',image_3='".$data_array['image_3']."',image_4='".$data_array['image_4']."',image_5='".$data_array['image_5']."'";
		
		$result=Execute_command($sql);
		if($result==1)
		{
			$listing_id==0;
			$listing_id=$this->get_max_listing_id($data_array['user_id']);
			
			$imags_result=$this->insert_listing_images($listing_id,$data_array['images_array']);
			return $result;
		}
		else
		{
			$_SESSION['mysql_eror']=$result;
			return false;
		}
		
	}
	else
	{
	$_SESSION['mysql_eror']="Please provide listing detail to add listing";
	return false;
	}
	
	
}


#FUNCTION WILL UPDATE LISTING ONLY BASIC INFO NOT IMAGES
function update_listing($data_array)
{
	if(count($data_array)>0)
	{
		$sql="update listing set title='".$data_array['title']."',year='".$data_array['year']."',price='".$data_array['price']."',description='".$data_array['description']."',category='".$data_array['category']."',main_category='".$data_array['main_category']."',miles='".$data_array['miles']."',vin='".$data_array['vin']."',new_used='".$data_array['new_used']."',make='".$data_array['make']."',model='".$data_array['model']."',body_style='".$data_array['body_style']."',is_featured='".$data_array['is_featured']."',stock_no='".$data_array['stock_no']."',hours='".$data_array['hours']."',exterior='".$data_array['exterior']."',interior='".$data_array['interior']."',drive='".$data_array['drive']."',engine='".$data_array['engine']."',trans='".$data_array['trans']."',doors='".$data_array['doors']."' where listing_id=".$data_array['listing_id']." and user_id=".$data_array['user_id']."";
		
		$result=Execute_command($sql);
		if($result==1)
		{
			return $result;
		}
		else
		{
			$_SESSION['mysql_eror']=$result;
			return false;
		}
		
	}
	else
	{
	$_SESSION['mysql_eror']="Please provide listing detail to UPDATE listing";
	return false;
	}
	
	
}


/**** ASAD FUNCTIONS START ****/

function getListingByUserID($data){
	
	$sql = "select * from listing where user_id = ".$data['user_id']." and is_active = 1";
	
	if($data['vehicle_type'] != '') {
		if($data['vehicle_type'] == 'Car') {
			$sql .= " and (vehicle_type = '".$data['vehicle_type']."' or vehicle_type = 'Vehicle')";
		} else {
			$sql .= " and vehicle_type = '".$data['vehicle_type']."'";
		}
	}
	
	if($data['filter_sort'] != ''){
		$sql .= " order by ".$data['filter_sort'];
	}
	else{
		$sql .= " order by listing_id";
	}
	
	$sql .= " desc";
	
	$result=Execute_command($sql);
	
	return $result;
	
}

function getArchivedListingByUserID($data){
	
	$sql = "select * from listing where user_id = ".$data['user_id']." and is_active = 0";
	
	if($data['vehicle_type'] != '') {
		if($data['vehicle_type'] == 'Car') {
			$sql .= " and (vehicle_type = '".$data['vehicle_type']."' or vehicle_type = 'Vehicle')";
		} else {
			$sql .= " and vehicle_type = '".$data['vehicle_type']."'";
		}
	}
	
	if($data['filter_sort'] != ''){
		$sql .= " order by ".$data['filter_sort'];
	}
	else{
		$sql .= " order by listing_id";
	}
	
	$sql .= " desc";
	
	$result=Execute_command($sql);
	
	return $result;
	
}

function getImageInfoByID($imgID){
	
	$sql = "select * from listing_images where image_id = $imgID";
	
	$query = mysql_query($sql);
	
	$result = mysql_fetch_array($query);
	
	return $result;
	
}

function getImageInfoByListingID($listingID){
	
	$sql = "select * from listing_images where listing_id = $listingID";
	
	$query = mysql_query($sql);
	
	//$result = mysql_fetch_array($query);
	
	return $query;
	
}

function deleteImage($imgID){
	
	$sql = "delete from listing_images where image_id = ".$imgID;
	
	$query = mysql_query($sql);
	
	return $query;
	
}

function deleteListing($listingID){
	
	$sql = "delete from listing where listing_id = ".$listingID;
	
	$query = mysql_query($sql);
	
	return $query;
	
}

function getlastlistingid($identification){
	
	$sql = "select listing_id from listing where identification = '".$identification."' order by listing_id desc limit 1";
	
	$query = mysql_query($sql);
	
	$result = mysql_fetch_array($query);
	
	return $result['listing_id'];
	
}

function getColors(){
	
	$sql = "select `title`, `value` from listing_color";
	
	$query = mysql_query($sql);
	
	return $query;
}

function getDrives(){
	
	$sql = "select `title`, `value` from listing_drive";
	
	$query = mysql_query($sql);
	
	return $query;
}

function getEngines(){
	
	$sql = "select `title`, `value` from listing_engine";
	
	$query = mysql_query($sql);
	
	return $query;
}

function getFuelTypes(){
	
	$sql = "select `title`, `value` from listing_fuel_type";
	
	$query = mysql_query($sql);
	
	return $query;
}

function getTransmissions(){
	
	$sql = "select `title`, `value` from listing_transmission";
	
	$query = mysql_query($sql);
	
	return $query;
}

function dropDownOptionListing($userid){
	
	$sql = "select listing_id, title from listing where user_id = ".$userid;
	
	$query = mysql_query($sql);
	
	$option = '';
	
	while($row = mysql_fetch_array($query)){
		
		extract($row);
		
		$option .= '<option value="'.$listing_id.'">'.$title.'</option>';
		
	}
	
	return $option;
}


function dropDownOptionListing2($userid,$listingID){
	
	$sql = "select listing_id, title from listing where user_id = ".$userid;
	
	$query = mysql_query($sql);
	
	$option = '';
	
	while($row = mysql_fetch_array($query)){
		
		extract($row);
		
		if($listing_id == $listingID) {
			$option .= '<option value="'.$listing_id.'" selected>'.$title.'</option>';
		} else {
			$option .= '<option value="'.$listing_id.'">'.$title.'</option>';
		}
		
	}
	
	return $option;
}


function getModelByMake($make){
	
	$sql = "select * from make_model where make_name = '$make'";

	$query = mysql_query($sql_model);
	
	return $query;
	
}

function getBodyByVehicle($vehicle){
	
	$sql = "select * from body_style where main_category = '$vehicle'";

	$query = mysql_query($sql_model);
	
	return $query;
	
}


/**** ASAD FUNCTIONS END ****/




################wali function########################3


function remove_images_from_server($file_link)
{



		if(file_exists($file_link))
		 {
			$do = unlink($file_link); 
			if($do=="1"){ 
			
		 
				return true;
			}
			else
			{echo $file_link;

				return false;
			}
		}
		


}

//FUNCTION WILL DELETE LISTING IMAGES FROM SERVER FOR THE PROVIDED USER ID

function remove_dealer_listing_images($user_id)
{
		
		if($user_id)
		{
			$sql="select *  from listing_images where listing_id IN(select listing_id from listing where user_id='$user_id')";
			$result=Execute_command($sql);	
			
			
			try
			{		while($record=mysql_fetch_array($result))
					{
						
						$thumb_path = ROOT_PATH.SITE_LISTING_THUMB_PATH;
						$large_path = ROOT_PATH.SITE_LISTING_IMAGES_PATH;
						$big_path = ROOT_PATH.SITE_LISTING_BIG_PATH;
						$mobile_path = ROOT_PATH.SITE_LISTING_MOBILE_PATH;
						$origianl_path = ROOT_PATH.SITE_LISTING_ORIGNAL_PATH;
						
						$this->remove_images_from_server($thumb_path.$record["image_name"]);
						$this->remove_images_from_server($large_path.$record["image_name"]);
						$this->remove_images_from_server($big_path.$record["image_name"]);
						$this->remove_images_from_server($mobile_path.$record["image_name"]);
						$this->remove_images_from_server($origianl_path.$record["image_name"]);
						
						
						
						
					}
			}
			catch(Exception $e)
			{
				$_SESSION['mysql_eror']=$result;
			}
			
		}


}


//FUNCTION WILL DELETE LISTING IMAGES FROM SERVER

function remove_listing_images($listing_id=false,$image_id=false)
{
			if($listing_id or $image_id)
				{
					if($image_id)
					{
						$sql="select *  from listing_images where image_id='$image_id' ";
					}
					else
					{
						$sql="select *  from listing_images where listing_id='$listing_id'";
					}
					
					$result=Execute_command($sql);	
					
					
					try
					{		while($record=mysql_fetch_array($result))
							{
								
								$thumb_path = ROOT_PATH.SITE_LISTING_THUMB_PATH;
								$large_path = ROOT_PATH.SITE_LISTING_IMAGES_PATH;
								$big_path = ROOT_PATH.SITE_LISTING_BIG_PATH;
								$mobile_path = ROOT_PATH.SITE_LISTING_MOBILE_PATH;
								$origianl_path = ROOT_PATH.SITE_LISTING_ORIGNAL_PATH;
								
								$this->remove_images_from_server($thumb_path.$record["image_name"]);
								$this->remove_images_from_server($large_path.$record["image_name"]);
								$this->remove_images_from_server($big_path.$record["image_name"]);
								$this->remove_images_from_server($mobile_path.$record["image_name"]);
								$this->remove_images_from_server($origianl_path.$record["image_name"]);
						
						
								
								
								
							}
					}
					catch(Exception $e)
					{
						$_SESSION['mysql_eror']=$result;
					}
				
			}
			
			


}
//FUNCTION WILL DELETE DEALER ALL LISTING FROM DATABASE
function delete_dealer_all_listing($user_id=false)
{
	$result_info=1;
	if($user_id)
	{
	
	
			$this->remove_dealer_listing_images($user_id);
			
			
			$sql="delete from listing_images where listing_id IN(select listing_id from listing where user_id='$user_id')";
			$result=Execute_command($sql);	
			
			if($result==1)
			{
				$sql="delete from listing where user_id=$user_id";
				$result=Execute_command($sql);
				if($result==1)
				{
					$result_info=$result;
				}
				else
				{
					$_SESSION['mysql_eror']=$result;
				}
										
			}
			else
			{
				$_SESSION['mysql_eror']=$result;
			}

					
	}
	else
	{
		$_SESSION['mysql_eror']="Please provide listing detail to delete listing";
	}
	

	return $result_info;


}

############WALI FUNCION END######################33

}


?>