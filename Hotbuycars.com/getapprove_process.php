<?php
session_start();
include_once("includes.php");

$obj_mysql	 = new Mysql;

$data_array	 = array();

	$make		= $_REQUEST['make'];
	$vendor		= $_REQUEST['vendor'];
	$model		= $_REQUEST['model'];
	$v_city		= $_REQUEST['v_city'];
	$year		= $_REQUEST['year'];
	$v_state	= $_REQUEST['v_state'];
	$vin		= $_REQUEST['vin'];
	$v_phone	= $_REQUEST['v_phone'];
	$price		= $_REQUEST['price'];
	$v_fax		= $_REQUEST['v_fax'];
	$fname		= $_REQUEST['fname'];
	$lname		= $_REQUEST['lname'];
	$email		= $_REQUEST['email'];
	$dayphone	= $_REQUEST['dayphone1']."-".$_REQUEST['dayphone2'].$_REQUEST['dayphone3'];
	$cellphone	= $_REQUEST['cellphone1']."-".$_REQUEST['cellphone2']."-".$_REQUEST['cellphone3'];
	$bday		= $_REQUEST['date_year']."-".$_REQUEST['date_month']."-".$_REQUEST['date_day'];
	$ssn		= $_REQUEST['ssn1']."-".$_REQUEST['ssn2']."-".$_REQUEST['ssn3'];
	$address	= $_REQUEST['address'];
	$city		= $_REQUEST['city'];
	$state		= $_REQUEST['state'];
	$zip		= $_REQUEST['zip'];
	$residence_type		= $_REQUEST['residence_type'];
	$time_address		= $_REQUEST['time_address_year']." ".$_REQUEST['time_address_months'];
	$monthly_payment	= $_REQUEST['monthly_payment'];
	$emp_name		= $_REQUEST['emp_name'];
	$occupation	= $_REQUEST['occupation'];
	$emp_name	= $_REQUEST['emp_name'];
	$emp_phone	= $_REQUEST['emp_phone1']."-".$_REQUEST['emp_phone2']."-".$_REQUEST['emp_phone3'];
	$emp_zip	= $_REQUEST['emp_zip'];
	$emp_type	= $_REQUEST['emp_type'];
	$twe		= $_REQUEST['twe_years']." ".$_REQUEST['twe_months'];
	$monthly_income		= $_REQUEST['monthly_income'];
	$ca			= $_REQUEST['ca'];
	$sa			= $_REQUEST['sa'];
	$cc			= $_REQUEST['cc'];
	$co_buyer	= isset($_REQUEST['co-buyer'])?1:0;
	
	$data_array['table_name']				=	"auto_loan_application";	
	$data_array['columns_name']['fname']	=	$fname;
	$data_array['columns_name']['lname']	=	$lname;
	$data_array['columns_name']['phone']	=	$dayphone;
	$data_array['columns_name']['cellphone']=	$cellphone;
	$data_array['columns_name']['birthdate']=	$bday;
	$data_array['columns_name']['ssn']		=	$ssn;
	$data_array['columns_name']['address']	=	$make;
	$data_array['columns_name']['city']		=	$city;
	$data_array['columns_name']['state']	=	$state;
	$data_array['columns_name']['zip']		=	$zip;
	$data_array['columns_name']['residence_type']	= $residence_type;	
	$data_array['columns_name']['time_address']		=	$time_address;
	$data_array['columns_name']['monhtly_payment']	=	$monthly_payment;
	$data_array['columns_name']['employer_name']	=	$emp_name;
	$data_array['columns_name']['occupation']		=	$occupation;
	$data_array['columns_name']['work_phone']		=	$emp_phone;
	$data_array['columns_name']['employer_zip']		=	$emp_zip;
	$data_array['columns_name']['employment_type']	=	$emp_type;
	$data_array['columns_name']['time_employer']	=	$twe;
	$data_array['columns_name']['monthly_income']	=	$monthly_income;
	$data_array['columns_name']['checking_account']	=	$ca;
	$data_array['columns_name']['saving_account']	=	$sa;
	$data_array['columns_name']['credit_card']		=	$cc;
	$data_array['columns_name']['co_buyer']			=	$co_buyer;
	$data_array['columns_name']['make']				=	$make;
	$data_array['columns_name']['model']			=	$model;
	$data_array['columns_name']['year']				=	$year;
	$data_array['columns_name']['vin']				=	$vin;
	$data_array['columns_name']['price']			=	$price;
	$data_array['columns_name']['vendor']			=	$vendor;
	$data_array['columns_name']['vehicle_city']		=	$v_city;
	$data_array['columns_name']['vehicle_state']	=	$v_state;
	$data_array['columns_name']['vehicle_phone']	=	$v_phone;
	$data_array['columns_name']['vehicle_fax']		=	$v_fax;
	$data_array['columns_name']['date_applied']		=	datetime();
	
	$exec = $obj_mysql->insert($data_array);
	
	if(!$exec){
		msgbox("some went wrong!");
		redirect_page("getapproved.php");
		exit;
	}
	else{
		msgbox("Auto Loan Application has been successfully sent.");
		redirect_page("getapproved.php");
		exit;
	}
?>