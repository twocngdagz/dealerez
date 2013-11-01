<?php

class Blogs 
{
//FUNCTION WILL RETURN blogs FOR database
function get_blogs($cond=false,$category_id=false,$order_by=false,$sort_by=false,$s_limit=false,$e_limit=false,$reutrun_sql=false)
{
	
	$user_info=array();

			
			
			if($cond)
			{
				$cond=" blog_id>=0  ".$cond;
			}
			else
			{
				$cond=" blog_id>=0";
			}
			if($category_id)
			{
				$cond.= " and category_id='$category_id'";
			
			}
			
			
			if($order_by)
			{
				$order_by=" Order By ".$order_by ." ".$sort_by;
			}
			else
			{
				$order_by="  Order By blog_id desc";
			}
			
			if($e_limit)
			{
			
					if($s_limit!=0)
					{
						$s_limit=$s_limit-1;
					}
					$limit=" limit $s_limit,$e_limit";
			}
			
			if($reutrun_sql)
			{
				$sql="select * from blogs where $cond $order_by";
				//echo $sql;die();
				return $sql;
		
			}
			
			$sql="select * from blogs where $cond $order_by $limit";
			
			
			$result=Execute_command($sql);
			$sql_access="";
			try
			{		while($record=mysql_fetch_array($result))
					{
						$user_info[]=$record;
						
						
							
							
							}
							}
							catch(Exception $e)
							{
								$_SESSION['mysql_eror']=$result;
							}
							
							
							
						return $user_info;
	

}


function get_blogs_detail($blog_id,$is_active=false)
{
	$user_info=array();
	if($blog_id)
	{
			
			if($is_active)
			{
				$sql="select * from blogs where blog_id='$blog_id' and is_active='$is_active' limit 1";
			}
			else
			{
				$sql="select * from blogs where blog_id='$blog_id' limit 1";
			}			
			$result=Execute_command($sql);
			$sql_access="";
			try
			{		if($record=mysql_fetch_array($result))
					{
						$user_info=$record;
							
							
								}
							}
							catch(Exception $e)
							{
								$_SESSION['mysql_eror']=$result;
							}
							
	}
							
							
						return $user_info;
	

}


function get_blogos_category()
{
	$user_info=array();
	if($num)
	{
			$sql="select * from blogs_category order by display_order asc";
			$result=Execute_command($sql);
			$sql_access="";
			try
			{		while($record=mysql_fetch_array($result))
					{
						$user_info[]=$record;
						
						
							
							
								}
							}
							catch(Exception $e)
							{
								$_SESSION['mysql_eror']=$result;
							}
							
							
	
	}						
						return $user_info;
	

}
function get_blogs_category_detail($category_id)
{
	$user_info=array();
	if($category_id)
	{
			$sql="select * from blogs_category where category_id='$category_id' order by display_order asc limit 1";
			$result=Execute_command($sql);
			$sql_access="";
			try
			{		if($record=mysql_fetch_array($result))
					{
						$user_info=$record;
							
							
					}
			}
			catch(Exception $e)
			{
				$_SESSION['mysql_eror']=$result;
			}
							
							
							
					
		}			
	return $user_info;
}



function add_blog($data_array)
{
$sql="insert into blogs set blog_title='".$data_array['blog_title']."',blog_description='".$data_array['blog_description']."',category_id='".$data_array['category_id']."',blog_image='".$data_array['blog_image']."',added_by='".$data_array['added_by']."',add_date='".$data_array['add_date']."',display_order='".$data_array['display_order']."',is_active='".$data_array['is_active']."',allow_comment='".$data_array['allow_comment']."',show_comment='".$data_array['show_comment']."', 	video_url='".$data_array['video_url']."'";

//echo $sql;die();

			try
			{	
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
			catch(Exception $e)
			{
				$_SESSION['mysql_eror']=$result;
			}

}




function upate_blog($data_array)
{
$sql="update blogs set blog_title='".$data_array['blog_title']."',blog_description='".$data_array['blog_description']."',category_id='".$data_array['category_id']."',blog_image='".$data_array['blog_image']."',is_active='".$data_array['is_active']."',allow_comment='".$data_array['allow_comment']."',show_comment='".$data_array['show_comment']."',video_url='".$data_array['video_url']."' where blog_id='".$data_array["blog_id"]."'";



			try
			{	
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
			catch(Exception $e)
			{
				$_SESSION['mysql_eror']=$result;
			}

}

//aactivate blgo
function update_blog_status($blog_id,$is_active)
{

	if($blog_id)
	{
			$sql="update blogs set is_active='$is_active' where blog_id='".$blog_id."'";
			
			try
			{	
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
			catch(Exception $e)
			{
				$_SESSION['mysql_eror']=$result;
			}
			
		}

}

//delete blgo
function delete_blog($blog_id)
{

	if($blog_id)
	{
			$sql="delete from blogs  where blog_id='".$blog_id."'";
			
			try
			{	
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
			catch(Exception $e)
			{
				$_SESSION['mysql_eror']=$result;
			}
			
		}

}


function add_comments($data_array)
{
$sql="insert into blogs_comments set name='".$data_array['name']."',email='".$data_array['email']."',comment='".$data_array['comment']."',blog_id='".$data_array['blog_id']."',added_by='".$data_array['added_by']."',add_date='".$data_array['add_date']."',added_ip='".$data_array['added_ip']."'";

			try
			{	
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
			catch(Exception $e)
			{
				$_SESSION['mysql_eror']=$result;
			}

}

//get blogs comments
function get_blogs_comment($blog_id)
{
	$user_info=array();
	if($blog_id)
	{
			$sql="select * from blogs_comments where blog_id='$blog_id'";
			$result=Execute_command($sql);
			$sql_access="";
			try
			{		while($record=mysql_fetch_array($result))
					{
						$user_info[]=$record;
							
							
					}
			}
			catch(Exception $e)
			{
				$_SESSION['mysql_eror']=$result;
			}
							
	}
							
							
						return $user_info;
	

}



//get blogs comments COMENTS
function get_blogs_comment_detail($comment_id)
{
	$user_info=array();
	if($blog_id)
	{
			$sql="select * from blogs_comments where comment_id='$comment_id' limit 1";
			$result=Execute_command($sql);
			$sql_access="";
			try
			{		if($record=mysql_fetch_array($result))
					{
						$user_info=$record;
							
							
					}
			}
			catch(Exception $e)
			{
				$_SESSION['mysql_eror']=$result;
			}
							
	}
						return $user_info;
	

}

}
?>