<?php


class Transaction
{
	#function will return LAST PENDING TRANSACTION
	function get_pending_transactions($cond=false)
	{
		$result_info=array();
		if($cond)
		{
			$sql="select * from user_payments  where $cond order by payment_date DESC";
		}
		else
		{
			$sql="select * from user_payments  where is_updated=0 order by payment_date DESC";
		}
		
		
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
	
	//FUNCTION WILL RETURENT TODAYS MONTH EARNING
	function get_today_earning($user_id=false)
	{
		if($user_id){
			$extra_cond = "user_id = $user_id and ";
		}
		$result_info=0;
		$today=get_today_date();
		$sql="select sum(amount) from user_payments  where $extra_cond (payment_date>='$today' and is_accepted=1)";
		$result=Execute_command($sql);
		$a=0;
		
		try	{
				if($record=mysql_fetch_array($result))
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
	//FUNCTION WILL RETURENT THIS MONTH EARNING
	function get_month_earning($user_id=false)
	{
		if($user_id){
			$extra_cond = "user_id = $user_id and ";
		}
		
		$result_info=0;
		$month=date('m');
		$sql="select sum(amount) from user_payments  where $extra_cond (month(payment_date)='$month' and is_accepted=1)";
		$result=Execute_command($sql);
		$a=0;
		
		try	{
				if($record=mysql_fetch_array($result))
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
	//FUNCTION WILL RETURENT THIS YEAR EARNING
	function get_year_earning($user_id=false)
	{
		if($user_id){
			$extra_cond = "user_id = $user_id and ";
		}
		
		$result_info=0;
		$year=date('Y');
		$sql="select sum(amount) from user_payments  where $extra_cond (year(payment_date)='$year' and is_accepted=1)";
		$result=Execute_command($sql);
		$a=0;

		try	{
				if($record=mysql_fetch_array($result))
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
	
	
	
	//FUNCTION WILL RETURENT PAYMENT DETAIL
	function get_payment_detail($payment_id,$user_id=false)
	{
		$result_info=array();

		if($payment_id)
		{
			if($user_id)
			{
			
				$sql="select * from user_payments  where payment_id=$payment_id and user_id=$user_id";
			}
			else
			{
				$sql="select * from user_payments  where payment_id=$payment_id";
			}
			
			$result=Execute_command($sql);
			$a=0;
			
			try	{
					if($record=mysql_fetch_array($result))
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
	
	
	//FUNCTION WILL RETURENT USER ALL PAYMENT DETAIL
	function get_user_payment_detail($user_id,$cond = false)
	{
		$result_info=array();
		if($cond)
		{
			$cond = "and $cond";
		}
		if($user_id)
		{
			
			$sql="select * from user_payments  where  user_id=$user_id $cond";
					
			$result=Execute_command($sql);
			$a=0;
			
			try	{
					while($record=mysql_fetch_array($result))
						{
							$result_info[]=$record;
							
						}
				}
				catch(Exception $e)
				{
					$_SESSION['mysql_eror']=$result;
				}
		}			
			
		return $result_info;
}
//FUNCTION WILL ACCEPT PAYMENT THAT WAS MADE BY USER 
function accept_user_payment($payment_id)
{	

	if($payment_id)
	{
		
	$sql="update user_payments set is_accepted=1,is_updated=1";
	
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


//FUNCTION WILL ACCEPT PAYMENT THAT WAS MADE BY USER 
function decline_user_payment($payment_id)
{	

	if($payment_id)
	{
		
	$sql="update user_payments set is_accepted=2,is_updated=1";
	
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
#FUNCTION USED TO UPGRADE USER MEMBER SHIIP
function upgrade_user_membership($user_id,$payment_detail)
{
		if($user_id and count($payment_detail)>0)
		{
			$payment_period=0;
			$payment_id=$payment_detail['payment_id'];
			
			if($payment_detail['payment_period']==1)
			{
				$exp_date=mktime(0,0,0,date('m')+1,date('d'),date('y'));
				$payment_period=1;
			}
			else if($payment_detail['payment_period']==6)
			{
				$exp_date=mktime(0,0,0,date('m')+6,date('d'),date('y'));
				$payment_period=6;
			}
			else if($payment_detail['payment_period']==12)
			{
				$exp_date=mktime(0,0,0,date('m')+13,date('d'),date('y'));
				$payment_period=12;
			}
			else
			{
				$exp_date=mktime(0,0,0,date('m')+1,date('d'),date('y'));
				$payment_period=1;
			
			}
			
				$exp_date=date("Y-m-d",$exp_date);
				$sql="update user_payments set exp_date='$exp_date' where user_id=$user_id and payment_id=$payment_id";
				$result=Execute_command($sql);
				$sql="update users set exp_date='$exp_date' where user_id=$user_id";
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
		$_SESSION['mysql_eror']="please provide payment detail to process payment";
	
	}			

}

}
?>