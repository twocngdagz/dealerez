<?php 
session_start();
include_once("includes.php");

global $ct;

$obj_listing = new Listing;
$obj_user	 = new User;
$obj_mysql	 = new Mysql;

$data_array	 = array();

$gc 		= $_REQUEST['getcarquote_subject']; // for get quote  submit
$fc 		= $_REQUEST['findacar_subject']; // for findacar submit
$sc 		= $_REQUEST['sellacar_subject']; // for sellacar submit
$ci 		= $_REQUEST['insurance_subject']; // for car insurance submit

if(isset($gc)){
	
	$firstname		= ucwords($_REQUEST['newcars_firstname']);
	$lastname		= ucwords($_REQUEST['newcars_lastname']);
	$phone		= $_REQUEST['newcars_phone'];
	$email		= $_REQUEST['newcars_email'];
	$p_type		= $_REQUEST['newcars_type'];
	$p_timing	= $_REQUEST['newcars_timing'];
	$make		= $_REQUEST['newcars_make'];
	$model		= $_REQUEST['newcars_model'];
	$color		= $_REQUEST['newcars_color'];
	$zip		= $_REQUEST['newcars_zip'];
	$cartype	= $_REQUEST['rCarType'];
	
	if($cartype=="used") {
		$subject = "Enquiry - Used Car Quote";
		$ct = "used";
	}
	else {
		$subject = "Enquiry - New Car Quote";
		$ct = "new";
	}
	//msgbox($cartype);

	$data_array['table_name']				=	"listing_inquiries";	
	$data_array['columns_name']['subject']	=	$subject;
	$data_array['columns_name']['firstname']		=	$firstname;
	$data_array['columns_name']['lastname']		=	$lastname;
	$data_array['columns_name']['phone']	=	$phone;
	$data_array['columns_name']['email']	=	$email;
	$data_array['columns_name']['purchase_type']	=	$p_type;
	$data_array['columns_name']['purchase_timing']	=	$p_timing;
	$data_array['columns_name']['make']		=	$make;
	$data_array['columns_name']['model']	=	$model;
	$data_array['columns_name']['color']	=	$color;
	$data_array['columns_name']['zip']		=	$zip;
	$data_array['columns_name']['add_date']	=	datetime();
	
	$exec = $obj_mysql->insert($data_array);

	//send mail
	$from		=	"info@hotbuycars.com";
	//$to			=	"lnllaurito@yahoo.com";
	$to			=	"support@hotbuycars.com";
	
	if($cartype=="used") {
		$subject	=	'Hotbuycars.com: Enquiry - Used Car Quote - lead#'.generateLeadNo()."-".$obj_listing ->countInquiresToday("used");
	}
	else {
		$subject	=	'Hotbuycars.com: Enquiry - New Car Quote - lead#'.generateLeadNo()."-".$obj_listing ->countInquiresToday("new");
	}
	
	$body		=	"Dear Dealer, <br /> <br />

					We pleased to present you following New Car Quote lead from our www.HotBuyCar.com website.
					
					 <br />
					 <br />
					Customer Name: ".   $firstname." ". $lastname."
					 <br />					
					Customer Email: ".  $email."
					 <br />					
					Customer Phone: ". $phone."
					 <br /> 
					Vehicle Make: ".$make."
					 <br />
					Vehicle Model: ".$model."
					 <br />
					Vehicle Color: ".$color."
					 <br />
					Location:  ".$zip."
					 <br /> <br />
					 
					
					We trust you will provide a good follow-up service and reply to this email with a final report status.
					 <br /> <br />
					 
					
					Sincere best wishes for your success!
					 <br />
					 <br />
					
					Support
					<br />
					HotBuyCars.com";

	
	
	send_email($from,$to,$subject,$body);	
	//end send mail
	
	if(!$exec){
		
		echo "<h1>Something wrong...</h1>".mysql_error();
		redirect_page("getcarquote.php");
		exit;
		
	}
	else {
		
		$_SESSION["condition"]    ="zip = '$zip'";
		$_SESSION["sent"]="sent";
		$_SESSION['cartype'] = $ct;

		redirect_page("getcarquote.php");
		exit;
	
	}
	
}

elseif(isset($fc)){
	
	$subject	= $_REQUEST['findacar_subject'];
	$name		= $_REQUEST['findacar_name'];
	$phone		= $_REQUEST['findacar_phone'];
	$email		= $_REQUEST['findacar_email'];
	$p_type		= $_REQUEST['findacar_type'];
	$p_timing	= $_REQUEST['findacar_timing'];
	$make		= $_REQUEST['findacar_make'];
	$model		= $_REQUEST['findacar_model'];
	$color		= $_REQUEST['findacar_color'];
	$year		= $_REQUEST['findacar_year'];
	$zip		= $_REQUEST['findacar_zip'];
	
	
	$data_array['table_name']				=	"listing_inquiries";	
	$data_array['columns_name']['subject']	=	$subject;
	$data_array['columns_name']['name']		=	$name;
	$data_array['columns_name']['phone']	=	$phone;
	$data_array['columns_name']['email']	=	$email;
	$data_array['columns_name']['purchase_type']	=	$p_type;
	$data_array['columns_name']['purchase_timing']	=	$p_timing;
	$data_array['columns_name']['make']		=	$make;
	$data_array['columns_name']['model']	=	$model;
	$data_array['columns_name']['color']	=	$color;
	$data_array['columns_name']['year']		=	$year;
	$data_array['columns_name']['zip']		=	$zip;
	$data_array['columns_name']['add_date']	=	datetime();
	
	$exec = $obj_mysql->insert($data_array);

	//send mail
	$from		=	"info@hotbuycars.com";
	$to			=	$email;
	$subject	=	'Hotbuycars.com: Find a Car Quote';
	$body		=	"Thank you ... your find a car quote will be provided shortly.";
	
	
	send_email($from,$to,$subject,$body);	
	//end send mail
	
	if(!$exec){
		
		echo "<h1>Something wrong...</h1>".mysql_error();
		redirect_page("findacar.php");
		exit;
		
	}
	else {
		msgbox($body);
		redirect_page("findacar.php");
		exit;
	
	}
	
}
elseif(isset($sc)){
	
	$subject	= $_REQUEST['sellacar_subject'];
	$name		= $_REQUEST['sellacar_name'];
	$firstname	= $_REQUEST['sellacar_firstname'];
	$lastname	= $_REQUEST['sellacar_lastname'];
	$phone		= $_REQUEST['sellacar_phone'];
	$email		= $_REQUEST['sellacar_email'];
	$make		= $_REQUEST['sellacar_make'];
	$model		= $_REQUEST['sellacar_model'];
	$color		= $_REQUEST['sellacar_color'];
	$year		= $_REQUEST['sellacar_year'];
	$zip		= $_REQUEST['sellacar_zip'];
	$v_title	= $_REQUEST['sellacar_v_title'];
	$financed	= $_REQUEST['sellacar_financed'];
	$owing		= $_REQUEST['sellacar_owing'];
	$condition	= $_REQUEST['sellacar_condition'];
	$miles		= $_REQUEST['sellacar_miles'];
	
	
	$data_array['table_name']				=	"listing_inquiries";	
	$data_array['columns_name']['subject']	=	$subject;
	$data_array['columns_name']['firstname']		=	$firstname;
	$data_array['columns_name']['lastname']		=	$lastname;
	$data_array['columns_name']['phone']	=	$phone;
	$data_array['columns_name']['email']	=	$email; 
	$data_array['columns_name']['make']		=	$make;
	$data_array['columns_name']['model']	=	$model;
	$data_array['columns_name']['color']	=	$color;
	$data_array['columns_name']['`year`']		=	$year;
	$data_array['columns_name']['zip']		=	$zip;
	$data_array['columns_name']['vehicle_title']	=	$v_title;
	$data_array['columns_name']['financed']	=	$financed;
	$data_array['columns_name']['owing']	=	$owing;
	$data_array['columns_name']['`condition`']	= $condition;
	$data_array['columns_name']['miles']	=	$miles;
	$data_array['columns_name']['add_date']	=	datetime();
	
	$exec = $obj_mysql->insert($data_array);

	//send mail
	$from		=	"info@hotbuycars.com";
	$to			=	"support@hotbuycars.com";
	$subject	=	'Hotbuycars.com: Find a Car Quote';
	$body		=	"";
	
	
	send_email($from,$to,$subject,$body);	
	//end send mail
	
	if(!$exec){
		
		echo "<h1>Something wrong...</h1>".mysql_error();
		redirect_page("sellacar.php");
		exit;
		
	}
	else {
		$_SESSION["sent"]="sent";
		redirect_page("sellacar.php");
		exit;
	
	}
	
}
elseif(isset($ci)){
	
	$subject	= $_REQUEST['insurance_subject'];
	$phone		= $_REQUEST['insurance_phone'];
	$email		= $_REQUEST['insurance_email'];
	$make		= $_REQUEST['insurance_make'];
	$model		= $_REQUEST['insurance_model'];
	$year		= $_REQUEST['insurance_year'];
	$licensed_state	= $_REQUEST['insurance_licensed_state'];
	$driver_age		= $_REQUEST['insurance_driver_age'];
	$driver_status	= $_REQUEST['insurance_driver_status'];
	$credit		= $_REQUEST['insurance_credit'];
	$violations	= $_REQUEST['insurance_violations'];
	$firstname		= $_REQUEST['insurance_firstname'];
	$lastname  =  $_REQUEST['insurance_lastname'];
	
	$phone		= $_REQUEST['insurance_phone'];
	
	
	$data_array['table_name']				=	"car_insurance_inquiries";	
	$data_array['columns_name']['subject']	=	$subject;
	$data_array['columns_name']['name']		=	$firstname. " ". $lastname;
	$data_array['columns_name']['phone']	=	$phone;
	$data_array['columns_name']['email']	=	$email; 
	$data_array['columns_name']['make']		=	$make;
	$data_array['columns_name']['model']	=	$model;
	$data_array['columns_name']['`year`']	=	$year;
	$data_array['columns_name']['licenced_state']	= $licensed_state;
	$data_array['columns_name']['age']		=	$driver_age;
	$data_array['columns_name']['driver_status']	=	$driver_status;
	$data_array['columns_name']['credit']	= $credit;
	$data_array['columns_name']['violations']	=	$violations;
	$data_array['columns_name']['add_date']	=	datetime();
	
	$exec = $obj_mysql->insert($data_array);

	//send mail
	$from		=	"info@hotbuycars.com";
	$to			=	"support@hotbuycars.com"; //$email;
	$subject	=	'Hotbuycars.com: Find a Car Quote';
	$body		=	"Thank you ... your car insurance quote will be provided shortly.";
	
	
	send_email($from,$to,$subject,$body);	
	
	
	if(!$exec){
		
		echo "<h1>Something wrong...</h1>".mysql_error();
		//redirect_page("insurance.php");
		exit;
		
	}
	else {
		$_SESSION["sent"]="sent";
		//msgbox($body);
		redirect_page("insurance.php");
		exit;
	
	}
	
}
?>

