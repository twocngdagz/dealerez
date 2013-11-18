<?php  session_start();
include("includes.php");
$listing_obj = new Listing;
$mysql		 = new Mysql;

if(isset($_POST['submit_loan'])) {
	
	//number 1
	$listing_id 			= $_POST['listing_id'];
	$v_make					= $_POST['v_make'];
	$vendor					= $_POST['vendor'];
	$model					= $_POST['model'];
	$v_city					= $_POST['v_city'];
	$v_state				= $_POST['v_state'];
	$vin					= $_POST['vin'];
	$year					= $_POST['year'];
	$v_phone				= $_POST['v_phone'];
	$price					= $_POST['price'];
	$v_fax					= $_POST['v_fax'];
	
	//personal info
	$firstname 				= $_POST['fname'];
	$lastname  				= $_POST['lname'];
	$email 	   				= $_POST['email'];
	$cellphone1 			= $_POST['cellphone1'];
	$date_month 			= $_POST['date_month'];
	$date_day 				= $_POST['date_day'];
	$date_year 				= $_POST['date_year'];
	$bday					= $date_year."-".$date_month."-".$date_day;
	$ssn 					= $_POST['ssn1']." ".$_POST['ssn2']." ".$_POST['ssn3'];
	
	//residentail info
	$address 				= $_POST['address'];
	$city 					= $_POST['city'];
	$state	 				= $_POST['state'];
	$zip	 				= $_POST['zip'];
	$country				= $_POST['country'];
	$residence_type 		= $_POST['residence_type'];
	$time_address_year 		= $_POST['time_address_year'];
	$time_address_months 	= $_POST['time_address_months'];
	$monthly_payment		= $_POST['monthly_payment'];
	$emp_name				= $_POST['emp_name'];
	$occupation				= $_POST['occupation'];
	$emp_phone1				= $_POST['emp_phone1'];
	$emp_zip				= $_POST['emp_zip'];
	$emp_type				= $_POST['emp_type'];
	$twe_years				= $_POST['twe_years'];
	$twe_months				= $_POST['twe_months'];
	$monthly_income			= $_POST['monthly_income'];
	$other_income 			= $_POST['other_income'];
	
	//additional info
	$ca						= $_POST['ca'];
	$sa						= $_POST['sa'];
	$cc						= $_POST['cc'];
	$downpayment			= $_POST['downpayment'];
	$downpayment_amount		= $_POST['downpayment_amount'];
	$credit_rating			= $_POST['credit_rating'];
	$credit_comment			= $_POST['credit_comment'];
	$trade_in				= $_POST['trade_in'];
	$trade_in_make			= $_POST['trade-in-make'];
	$trade_in_model			= $_POST['trade-in-model'];
	$trade_in_year			= $_POST['trade-in-year'];
	$trade_in_color			= $_POST['trade-in-color'];
	$trade_in_miles			= $_POST['trade-in-miles'];
	$owe_trade_in			= $_POST['owe_trade_in'];
	$input_owe_trade		= $_POST['input_owe_trade'];
	$condition_trade_rating	= $_POST['condition_trade_rating'];
	$trade_in_vin			= $_POST['condition_trade'];
	
	
	/*cobuyers information*/
	//personal info
	$cobuyer 				= $_POST['cobuyer'];
	$cobuyer_firstname 		= $_POST['cobuyer_fname'];
	$cobuyer_lastname  		= $_POST['cobuyer_lname'];
	$cobuyer_email 	   		= $_POST['cobuyer_email'];
	$cobuyer_cellphone1 	= $_POST['cobuyer_cellphone1'];
	$cobuyer_date_month 	= $_POST['cobuyer_date_month'];
	$cobuyer_date_day 		= $_POST['cobuyer_date_day'];
	$cobuyer_date_year 		= $_POST['cobuyer_date_year'];
	$cobuyer_bday			= $date_year."-".$date_month."-".$date_day;
	$cobuyer_ssn 			= $_POST['cobuyer_ssn1']." ".$_POST['cobuyer_ssn2']." ".$_POST['cobuyer_ssn3'];
	
	//residentail info
	$cobuyer_address 		= $_POST['cobuyer_address'];
	$cobuyer_city 			= $_POST['cobuyer_city'];
	$cobuyer_state	 		= $_POST['cobuyer_state'];
	$cobuyer_zip	 		= $_POST['cobuyer_zip'];
	$cobuyer_country	 		= $_POST['cobuyer_country'];
	$cobuyer_residence_type 	= $_POST['cobuyer_residence_type'];
	$cobuyer_time_address_year 	= $_POST['cobuyer_time_address_year'];
	$cobuyer_time_address_months = $_POST['cobuyer_time_address_months'];
	$cobuyer_monthly_payment	= $_POST['cobuyer_monthly_payment'];
	$cobuyer_emp_name		= $_POST['cobuyer_emp_name'];
	$cobuyer_occupation		= $_POST['cobuyer_occupation'];
	$cobuyer_emp_phone1		= $_POST['cobuyer_emp_phone1'];
	$cobuyer_emp_zip		= $_POST['cobuyer_emp_zip'];
	$cobuyer_emp_type		= $_POST['cobuyer_emp_type'];
	$cobuyer_twe_years		= $_POST['cobuyer_twe_years'];
	$cobuyer_twe_months		= $_POST['cobuyer_twe_months'];
	$cobuyer_monthly_income		= $_POST['cobuyer_monthly_income'];
	$cobuyer_other_income		= $_POST['cobuyer_other_income'];
	
	//additional info
	$cobuyer_ca				= $_POST['cobuyer_ca'];
	$cobuyer_sa				= $_POST['cobuyer_sa'];
	$cobuyer_cc				= $_POST['cobuyer_cc'];
	
	$agree		= $_POST['agree'];
	
	//send mail
	//$from		=	"info@dixiemotors.com";
	//$to		=	"labrums@yahoo.com";
	//$headers	= 	"From: info@dixiemotors.com" . "\r\n" .
	$to 		= "twocngdagz@yahoo.com";
	$headers	= 'MIME-Version: 1.0' . "\r\n";
    $headers  	.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$headers	.= "From: <roy.beldia@gmail.com>" . "\r\n";
	$headers	.= "Reply-To: <roy.beldia@gmail.com>" . "\r\n";
	$headers	.= "Cc: <glenn@impactsources.com>" . "\r\n";
	$subject	= "Berge Auto Finance Application";

	$cobuyer_detail = "
					<strong>
					Co-buyer's Personal Information
					</strong>
					<br/><br/>
					Customer Name: ".   $cobuyer_firstname." ".$cobuyer_lastname."
					 <br />					
					Customer Email: ".  $cobuyer_email."
					 <br />					
					Customer Phone: ". $cobuyer_cellphone1."
					 <br /> 
					Date of Birth: ". $cobuyer_bday."
					<br />
					Social Security No.: ". $cobuyer_ssn."
					 <br /> 
					 <br/>
					<strong>
					Co-buyer's Residential Information
					</strong>
					<br/><br/>
					Address: ". $cobuyer_address."
					<br />
					City: ". $cobuyer_city."
					 <br /> 
					State: ". $cobuyer_state."
					 <br />
					Country: ". $cobuyer_country."
					 <br />  
					Zip: ". $cobuyer_zip."
					 <br />
					Residence Type: ". $cobuyer_residence_type."
					 <br /> 
					Time at Address: ". $cobuyer_time_address_year." years ".$cobuyer_time_address_months." months "."
					 <br />
					Monthly Payment: $". number_format($cobuyer_monthly_payment)."
					<br/>
					<br/>
					
					<strong>
					Co-buyer's Employment Information
					</strong>
					<br/><br/>
					Employer Name: ". $cobuyer_emp_name."
					<br/>
					Occupation: ". $cobuyer_occupation."
					<br/>
					Work Phone: ". $cobuyer_emp_phone1."
					<br/>
					Employer Zip: ". $cobuyer_emp_zip."
					<br/>
					Employment Type: ". $cobuyer_emp_type."
					<br/>
					Time with Employer: ". $cobuyer_twe_years." years ".$cobuyer_twe_months." months "."
					<br/>
					Monthly Income: $".number_format($cobuyer_monthly_income)."
					<br/>
					Other Income: $".number_format($cobuyer_other_income)."
					<br/>
					<strong>
					<br /> 
					Co-buyer's Additional Information: 
					</strong>
					<ul>
						<li>Checking Account: $cobuyer_ca</li>
						<li>Saving Account: $cobuyer_sa</li>
						<li>Credit Card: $cobuyer_cc</li>
					</ul>
					";

	$vehicle_info = "
					<strong>
					Vehicle Information
					<br /><br />
					<a href='http://www.bergeautoutah.dealerez.com/listing_detail.php?lid=$listing_id' target='_blank'>http://www.bergeautoutah.dealerez.com/listing_detail.php?lid=$listing_id</a>
					</strong>
						<ul>
							<li>Year: $year</li>
							<li>Make: $v_make</li>
							<li>Model: $model</li>
							<li>Price: $price</li>
							<li>Vendor: $vendor</li>
							<li>Vin: $vin</li>
							<li>City: $v_city</li>
							<li>State: $v_state</li>
							<li>Phone: $v_phone</li>
							<li>Fax: $v_fax</li>
						</ul>

					We wish you success in your follow-up of this potential sale.
					 <br />
					 <br />
					Support @
					<br />
					DealerEZ.com 
					</div>";

	$html_downpayment = ($downpayment == "Yes") ? "<li>Downpayment Amount: $".number_format($downpayment_amount)."</li>" : "";
	$html_trade_in_vehicle = ($trade_in == "Yes") ? "<li>Vehicle Make: $trade_in_make</li>
						<li>Vehicle Model: $trade_in_model</li>
						<li>Vehicle Year: $trade_in_year</li>
						<li>Vehicle Color: $trade_in_color</li>
						<li>Vehicle Miles: $trade_in_miles</li>" : "";
	$html_owe_money = (($owe_trade_in == "Yes") &&  ($trade_in == "Yes")) ? "<li>Amount owe in Trade-in: $".number_format($input_owe_trade)."</li>" : "";
	$body		=	"<div>
					Dear Dealer, <br /> <br />

					We are pleased to present you following Vehicle Loan Application from website <a href='http://www.bergeautoutah.com' target='_blank'>www.bergeautoutah.com</a>
					<br />
					<br/>
					<br />
					<strong>
					Personal Information
					</strong>
					<br/><br/>
					Customer Name: ".   $firstname." ". $lastname."
					 <br />					
					Customer Email: ".  $email."
					 <br />					
					Customer Phone: ". $cellphone1."
					 <br /> 
					Date of Birth: ". $bday."
					<br />
					Social Security No.: ". $ssn."
					 <br /> 
					 <br/>
					<strong>
					Residential Information
					</strong>
					<br/><br/>
					Address: ". $address."
					<br />
					City: ". $city."
					 <br /> 
					State: ". $state."
					 <br /> 
					Country: ". $country."
					 <br /> 
					Zip: ". $zip."
					 <br />
					Residence Type: ". $residence_type."
					 <br /> 
					Time at Address: ". $time_address_year." years ".$time_address_months." months "."
					 <br />
					Monthly Payment: $". number_format($monthly_payment)."
					<br/>
					<br/>
					
					<strong>
					Employment Information
					</strong>
					<br/><br/>
					Employer Name: ". $emp_name."
					<br/>
					Occupation: ". $occupation."
					<br/>
					Work Phone: ". $emp_phone1."
					<br/>
					Employer Zip: ". $emp_zip."
					<br/>
					Employmnet Type: ". $emp_type."
					<br/>
					Time with Employer: ". $twe_years." years ".$twe_months." months "."
					<br/>
					Monthly Income: $".number_format($monthly_income)."
					<br/>
					Other Income: $".number_format($other_income)."
					<br/>
					<strong>
					<br /> 
					Financial Information: 
					</strong>
					<ul>
						<li>Checking Account: $ca</li>
						<li>Saving Account: $sa</li>
						<li>Credit Card: $cc</li>
						<li>Downpayment: $downpayment</li>
						$html_downpayment
						<li>Credit Rating: $credit_rating</li>
						<li>Comment: $credit_comment</li>
					</ul>
					<strong>
					Trade-in Information: 
					</strong>
					<ul>
						<li>Vehicle Trade-in: $trade_in</li>
						$html_trade_in_vehicle
						<li>Owe Money in Trade-in: $owe_trade_in</li>
						$html_owe_money
						<li>Trade-in Condition: $condition_trade_rating</li>
						<li>Vin: $trade_in_vin</li>
					</ul>
					";

	if ($cobuyer) {
		$body = $body.$cobuyer_detail.$vehicle_info;
	} else {
		$body = $body.$vehicle_info;
	}
	
	
	@mail($to, $subject, $body, $headers);	
	$_SESSION['msg_alert']="Auto Loan Application successfully sent!";	
	msgbox("Auto Loan Application successfully sent!");
}

?>