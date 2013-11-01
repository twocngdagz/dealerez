<?php

class User 
{

	//FUNCTION WILL RETURN USER BASIC DETAIL

	function get_user_detail($user_id) {
		
		$user_info=array();
		
		if($user_id) {
			$sql="select * from users where user_id='$user_id'";
			$result=Execute_command($sql);
			
			try {
				
				if($record=mysql_fetch_array($result)) {
					$user_info=$record;
				}
			} catch(Exception $e) {
				$_SESSION['mysql_eror']=$result;
			}
		} else {
			return false;
		}
		
		return $user_info;
	}


	//FUNCTION WILL RETURN THE LIST OF ALL USER IN WEBSITE

	function get_all_user($is_active=false,$orderby = false,$sortby = "DESC",$slimit=false,$elimit=false) {
		
		$user_info=array();
		
		if($orderby){
			$orderby = 	"order by $orderby $sortby";
		}
		
		if($elimit){
			$elimit = "LIMIT $slimit, $elimit";
		}
		
		if($is_active) { //for active users only
			$sql="select * from users where is_active=1 and user_type not in ('Admin','Others')  $orderby $elimit";
		} else { //for inactive users only
			$sql="select * from users where is_active=0 and user_type not in ('Admin','Others') $orderby $elimit";
		}
		
		
		$result=Execute_command($sql);
		
		try {
			
			while($record=mysql_fetch_array($result)) {
				$user_info[]=$record;
			}
		} catch(Exception $e) {
			$_SESSION['mysql_eror']=$result;
		}
		
		return $user_info;
	}


//FUNCTION WILL RETURN USER PAGE CONTETNS

function get_page_contents($user_id,$page_id=false)

{

	$page_detail=array();

	

	if($user_id and $page_id)

	{

			$sql="select * from user_page_contents where user_id=$user_id and page_id=$page_id";

			$result=Execute_command($sql);

			

			if(mysql_num_rows($result)>0) {

			if($record=mysql_fetch_array($result))

			{

				$page_detail=$record;

			} }

	}

	else

	{

		return  false;

	}

	return $page_detail;

	



}















//FUNCTION WILL RETURN HEADER DETAIL 

function get_header_detail($header_id)

{

	$header_info=false;

	if($header_id)

	{

			$sql="select * from site_header where header_id=$header_id";

			$result=Execute_command($sql);

			

			

			if($record=mysql_fetch_array($result))

			{

			

					

				$header_info=$record;

				

			}

	}

	else	

	{

		return false;

	}



	return $header_info;

	



}









//FUNCTION WILL INSERT PAGE CONTENTS

function insert_page_contetns($data_array)

{

	$color_info=false;

		

	if($data_array['user_id'] and $data_array['page_id'])

	{

			if($this->check_page_contents($data_array['user_id'],$data_array['page_id']))

			{

				$sql="update user_page_contents set page_id=".$data_array['page_id'].",page_contetns='".$data_array['page_contetns']."',page_testimonial='".$data_array['page_testimonial']."',page_css='".$data_array['page_css']."' where user_id=".$data_array['user_id']."";

			}

			else

			{

				$sql="insert into user_page_contents set user_id=".$data_array['user_id'].",page_id=".$data_array['page_id'].",page_contetns='".$data_array['page_contetns']."',page_testimonial='".$data_array['page_testimonial']."',page_css='".$data_array['page_css']."'";

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

	else	

	{

		$_SESSION['mysql_eror']="Please provide detail to update contents";

		return false;

	}



	return $color_info;

	



}



//FUNCTION WILL CHECK EITHER USER HAVE INSERTED CONTENTS FOR PAGE OR NOT

function check_page_contents($user_id,$page_id)

{

	if($user_id and $page_id)

	{	

			$sql="select * from user_page_contents where user_id=$user_id and page_id=$page_id";

			$result=Execute_command($sql);

					

			if($record=mysql_fetch_array($result))

			{

				return true;

			}

			else

			{

				return false;

			}

			

	}

	else

	{

		return false;

	}

}





#FUNCTION WILL UPDATE THE USER HEADER INFORMATION

function upadte_user_header($user_id,$header_id)

	{

	

		if($user_id and $header_id)

		{

			$sql="update users set header_id=$header_id where user_id=$user_id";

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

				$_SESSION['mysql_eror']="Please provide detail to update header information";

				return false;

		}

	

	}



//FUNCTION WILL UPDATE USER SITE THEME OR COLOR

function upadte_user_color($user_id,$color_id)

	{

	

		if($user_id and $color_id)

		{

			$sql="update users set color_id=$color_id where user_id=$user_id";

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

				$_SESSION['mysql_eror']="Please provide detail to update header information";

				return false;

		}

	

	}









#******************UBI FUNCTION STARTS HERE*********************************88



function user_check_email($email){



$sql="select * from users where email='".$email."'";

$result=Execute_command($sql);



$counter=false;

while(mysql_fetch_array($result))

	{

	$counter=true;

	}

return $counter;

}



//FUNCTION WILL REGISTER NEW USER TO WEBSITE

function New_user($name,$password,$email,$user_ip,$phone){





		$contact_email=$email;

	$sql="insert into users (name,login,password,email,contact_email,reg_date,user_ip,phone)  VALUES ('".$name."','".	$name."','".$password."','".$email."','".$contact_email."','".date("y-m-d",time())."','".$user_ip."','".$phone."')";

	

	

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



function Edit_user($data_array){

$sql="update users set name='".$data_array['name']."',address='".$data_array['address']."',city='".$data_array['city']."',state='".$data_array['state']."',zip='".$data_array['zip']."',cell='".$data_array['cell']."',fax='".$data_array['fax']."' where email='".$data_array['email']."' and  user_id='".$data_array['user_id']."' ";







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

function Edit_user_header($data_array){



if(count($data_array)>0)

{

	if($data_array['header_image']){

$sql="update users set slogan='".$data_array['slogan']."',phone='".$data_array['phone']."',header_image='".$data_array['header_image']."' where user_id='".$data_array['user_id']."' ";

}else{

$sql="update users set slogan='".$data_array['slogan']."',phone='".$data_array['phone']."' where user_id='".$data_array['user_id']."' ";



}

$result=Execute_command($sql);

}

else

{

$_SESSION['mysql_eror']="Please provide data to update database";

}

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





function update_password($email , $password){



if($email && $password)

{

	

$sql="update users set password='".$password."' where email='".$email."' ";



$result=Execute_command($sql);

}

else

{

$_SESSION['mysql_eror']="Please provide data to update database";

}

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







function Delete_user($user_id){

Execute_command("user","status='0'","user_id=".$user_id."");

Execute_command("user_login","user_id=".$user_id."");

}





function is_user_login_exist($login)

{

$sql="select * from user_login where login='".$login."'";

$result=Execute_command($sql);



if($login_detail=mysql_fetch_array($result))

{

return true;

}

else

{

return false;

}

}











#FUNCTION WILL UPDATE THE USER PAGE TITLE

function upadte_user_page_title($user_id,$page_title)

	{

	

		if($user_id )

		{

			$sql="update users set page_title='$page_title' where user_id=$user_id";

		

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

				$_SESSION['mysql_eror']="Please provide detail to update header information";

				return false;

		}

	

	}

#FUNCTION WILL UPDATE THE USER bg_color

function upadte_user_bg_color($user_id,$bg_color)

	{

	

		if($user_id )

		{

			$sql="update users set bg_color='$bg_color' where user_id=$user_id";

		

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

				$_SESSION['mysql_eror']="Please provide detail to update header information";

				return false;

		}

	

	}





#FUNCTION WILL UPDATE THE USER analytic_code

function upadte_user_analytic_code($user_id,$analytic_code)

	{

	

		if($user_id )

		{

			$sql="update users set analytic_code='$analytic_code' where user_id=$user_id";

		

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

				$_SESSION['mysql_eror']="Please provide detail to update header information";

				return false;

		}

	

	}





#FUNCTION WILL UPDATE THE USER analytic_code

function upadte_user_meta_tags($user_id,$meta_tags,$meta_description)

	{

	

		if($user_id )

		{

			$sql="update users set meta_tags='$meta_tags' , meta_description='$meta_description'  where user_id=$user_id";

		

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

				$_SESSION['mysql_eror']="Please provide detail to update header information";

				return false;

		}

	

	}



#FUNCTION WILL UPDATE THE USER analytic_code

function upadte_user_contact_email($user_id,$contact_email)

	{

	

		if($user_id )

		{

			$sql="update users set contact_email='$contact_email' where user_id=$user_id";

		

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

				$_SESSION['mysql_eror']="Please provide detail to update header information";

				return false;

		}

	

	}



function upadte_user_comments($user_id,$user_comments)

	{

	

		if($user_id )

		{

			$sql="update users set user_comments='$user_comments' where user_id=$user_id";

		

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

				$_SESSION['mysql_eror']="Please provide detail to update header information";

				return false;

		}

	

	}







function upadte_google_api_key($user_id,$google_api_key)

	{

	

		if($user_id )

		{

			$sql="update users set google_api_key='$google_api_key' where user_id=$user_id";

		

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

				$_SESSION['mysql_eror']="Please provide detail to update google api key information";

				return false;

		}

	

	}





	///////////***********UBAID FUNCTION ***********************



function all_users($slimit=false,$elimit=false,$order_by=false,$sort_by="ASC",$cond=false){









 $limit="limit $slimit,$elimit"; 

	$user_info=array();









			$sql="select * from users $cond $order_by $sort_by $limit ";

			

			$result=Execute_command($sql);

			

			try

			{		while($record=mysql_fetch_array($result))

					{

						$user_info[$record['user_id']]=$record;

						

					}

			}

			catch(Exception $e)

			{

				$_SESSION['mysql_eror']=$result;

			}

	



	return $user_info;

	

}



function active_user_site($user_id)

	{

	

		if($user_id)

		{

			$sql="update users set site_status='active' where user_id=$user_id";

		

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

				$_SESSION['mysql_eror']="Please provide detail to update header information";

				return false;

		}

	

	}



function deactive_user_site($user_id)

	{

	

		if($user_id)

		{

			$sql="update users set site_status='deactive' where user_id=$user_id";

		

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

				$_SESSION['mysql_eror']="Please provide detail to update header information";

				return false;

		}

	

	}



function active_user_acount($user_id)

	{

	

		if($user_id)

		{

			$sql="update users set is_active=1 where user_id=$user_id";

		

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

				$_SESSION['mysql_eror']="Please provide detail to update header information";

				return false;

		}

	

	}



function deactive_user_acount($user_id)

	{

	

		if($user_id)

		{

			$sql="update users set is_active=0 where user_id=$user_id";

		

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

				$_SESSION['mysql_eror']="Please provide detail to update header information";

				return false;

		}

	

	}







//FUNCTION WILL UPDATE THE USER DOMAIN NAME

function upadte_user_domain($user_id,$domain_name)

{

	

	

		if($user_id )

		{

			$sql="update users set domain_name='$domain_name' where user_id=$user_id";

		

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

				$_SESSION['mysql_eror']="Please provide detail to update header information";

				return false;

		}

	

	

}







//FUNCTION WILL CHECK EITHER DOMAIN NAME ALREADY REGISTERED BY ANOTHER USER

function check_domain_name($user_id,$domain_name)

{

	if($user_id and $domain_name)

	{	

			$sql="select * from users where user_id!=$user_id and domain_name='$domain_name'";

			$result=Execute_command($sql);

			

			if($record=mysql_fetch_array($result))

			{

				return true;

			}

			else

			{

				return false;

			}

			

	}

	else

	{

		return false;

	}

}











//FUNCTION WILL GET USER ID FROM DOMAIN NAME

function get_user_id_by_domain($domain_name)

{

	$user_id=0;

	if($domain_name)

	{	

			$sql="select * from users where domain_name='$domain_name'";

			$result=Execute_command($sql);

			

			if($record=mysql_fetch_array($result))

			{

				$user_id=$record['user_id'];

			}

			else

			{

				return false;

			}

			

	}

	else

	{

		return false;

	}

	

	return $user_id;

}



/************* Asad Function Start **************/



function getUserInfoByID($userid){

	

	$sql = "select * from users where user_id = ".$userid;

	

	$query = Execute_command($sql);

	

	$result = mysql_fetch_array($query);

	

	return $result;

	

}



function getUserDealInfo($userid){

	

	$sql = "select * from user_deal_setting where user_id = ".$userid;

	

	$query = Execute_command($sql);

	

	$result = mysql_fetch_array($query);

	

	return $result;

	

}



function checkDealSetting($userid){

	

	$sql = "select * from user_deal_setting where user_id = ".$userid;

	

	$query = Execute_command($sql);

	

	if(mysql_num_rows($query) > 0){

		

		return 1;

		

	}

	

	else{

		

		return 0;

		

	}

	

}



function getUserPartnerInfo($userid){

	

	$sql = "select * from user_partner_setting where user_id = ".$userid;

	

	$query = Execute_command($sql);

	

	$result = mysql_fetch_array($query);

	

	return $result;

	

}



function checkPartnerSetting($userid){

	

	$sql = "select * from user_partner_setting where user_id = ".$userid;

	

	$query = Execute_command($sql);

	

	if(mysql_num_rows($query) > 0){

		

		return 1;

		

	}

	

	else{

		

		return 0;

		

	}

	

}





/************* Asad Function End ****************/



#-==========================LEO FUNCTION========================#

function getUserID($cond=false){

	$record = array();

	if($cond){

		$cond = "WHERE $cond";	

	}

	$sql = "select * from users $cond";

	$query = Execute_command($sql);



	while($result = mysql_fetch_array($query)){

			$record[] = $result;

	}

	return $record;

	

}

#-==========================END LEO FUNCTION====================#

}



?>