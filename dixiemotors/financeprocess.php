<?php  session_start();
include("includes.php");
$listing_obj = new Listing;
$mysql		 = new Mysql;

if(isset($_POST['submit_loan'])) {
	
	//number 1
	$v_make		= $_POST['v_make'];
	$vendor		= $_POST['vendor'];
	$model		= $_POST['model'];
	$v_city		= $_POST['v_city'];
	$v_state	= $_POST['v_state'];
	$vin		= $_POST['vin'];
	$year		= $_POST['year'];
	$v_phone	= $_POST['v_phone'];
	$price		= $_POST['price'];
	$v_fax		= $_POST['v_fax'];
	
	//personal info
	$firstname 	= $_POST['fname'];
	$lastname  	= $_POST['lname'];
	$email 	   	= $_POST['email'];
	$cellphone1 	= $_POST['cellphone1'];
	$date_month 	= $_POST['date_month'];
	$date_day 	= $_POST['date_day'];
	$date_year 	= $_POST['date_year'];
	$bday		= $date_year."-".$date_month."-".$date_day;
	$ssn 		= $_POST['ssn1']." ".$_POST['ssn2']." ".$_POST['ssn3'];
	
	//residentail info
	$address 		= $_POST['address'];
	$city 			= $_POST['city'];
	$state	 		= $_POST['state'];
	$zip	 		= $_POST['zip'];
	$residence_type 	= $_POST['residence_type'];
	$time_address_year 	= $_POST['time_address_year'];
	$time_address_months 	= $_POST['time_address_months'];
	$monthly_payment	= $_POST['monthly_payment'];
	$emp_name		= $_POST['emp_name'];
	$occupation		= $_POST['occupation'];
	$emp_phone1		= $_POST['emp_phone1'];
	$emp_zip		= $_POST['emp_zip'];
	$emp_type		= $_POST['emp_type'];
	$twe_years		= $_POST['twe_years'];
	$twe_months		= $_POST['twe_months'];
	$monthly_income		= $_POST['monthly_income'];
	
	//additional info
	$ca		= $_POST['ca'];
	$sa		= $_POST['sa'];
	$cc		= $_POST['cc'];
	
	
	/*cobuyers information*/
	//personal info
	$cobuyer_firstname 	= $_POST['cobuyer_fname'];
	$cobuyer_lastname  	= $_POST['cobuyer_lname'];
	$cobuyer_email 	   	= $_POST['cobuyer_email'];
	$cobuyer_cellphone1 	= $_POST['cobuyer_cellphone1'];
	$cobuyer_date_month 	= $_POST['cobuyer_date_month'];
	$cobuyer_date_day 	= $_POST['cobuyer_date_day'];
	$cobuyer_date_year 	= $_POST['cobuyer_date_year'];
	$cobuyer_bday		= $date_year."-".$date_month."-".$date_day;
	$cobuyer_ssn 		= $_POST['cobuyer_ssn1']." ".$_POST['cobuyer_ssn2']." ".$_POST['cobuyer_ssn3'];
	
	//residentail info
	$cobuyer_address 		= $_POST['cobuyer_address'];
	$cobuyer_city 			= $_POST['cobuyer_city'];
	$cobuyer_state	 		= $_POST['cobuyer_state'];
	$cobuyer_zip	 		= $_POST['cobuyer_zip'];
	$cobuyer_residence_type 	= $_POST['cobuyer_residence_type'];
	$cobuyer_time_address_year 	= $_POST['cobuyer_time_address_year'];
	$cobuyer_time_address_months 	= $_POST['cobuyer_time_address_months'];
	$cobuyer_monthly_payment	= $_POST['cobuyer_monthly_payment'];
	$cobuyer_emp_name		= $_POST['cobuyer_emp_name'];
	$cobuyer_occupation		= $_POST['cobuyer_occupation'];
	$cobuyer_emp_phone1		= $_POST['cobuyer_emp_phone1'];
	$cobuyer_emp_zip		= $_POST['cobuyer_emp_zip'];
	$cobuyer_emp_type		= $_POST['cobuyer_emp_type'];
	$cobuyer_twe_years		= $_POST['cobuyer_twe_years'];
	$cobuyer_twe_months		= $_POST['cobuyer_twe_months'];
	$cobuyer_monthly_income		= $_POST['cobuyer_monthly_income'];
	
	//additional info
	$cobuyer_ca		= $_POST['cobuyer_ca'];
	$cobuyer_sa		= $_POST['cobuyer_sa'];
	$cobuyer_cc		= $_POST['cobuyer_cc'];
	
	$agree		= $_POST['agree'];
	
	//send mail
	$from		=	"info@dixiemotors.com";
	$to		=	"labrums@yahoo.com";
	$headers	= 	"From: info@dixiemotors.com" . "\r\n" .
				"Reply-To: labrums@yahoo.com " . "\r\n" .
				"Cc: support@dealerez.com" . "\r\n";
	$subject	=	"Dixie Motors Finance Application";

	
	$body		=	"<html><body>
					Dear Dealer, <br /> <br />

					We pleased to present you following Auto Loan Application from our www.dixiemotors.com website.
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
					Zip: ". $zip."
					 <br />
					Residence Type: ". $residence_type."
					 <br /> 
					Time at Address: ". $time_address_year." ".$time_address_months."
					 <br />
					Monthly Payment: ". $monthly_payment."
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
					Time with Employer: ". $twe_years." ".$twe_months."
					<br/>
					Monthly Income: ".$monthly_income."
					<br/>
					<strong>
					<br /> 
					Additional Information: 
					</strong>
					<ul>
						<li><strong>Checking Account: </strong>$ca</li>
						<li><strong>Saving Account: </strong>$sa</li>
						<li><strong>Credit Card: </strong>$cc</li>
					</ul>
					
					<strong>
					Cobuyer's Personal Information
					</strong>
					<br/><br/>
					Customer Name: ".   $cobuyers_firstname." ".$cobuyers_lastname."
					 <br />					
					Customer Email: ".  $cobuyers_email."
					 <br />					
					Customer Phone: ". $cobuyers_cellphone1."
					 <br /> 
					Date of Birth: ". $cobuyers_bday."
					<br />
					Social Security No.: ". $cobuyers_ssn."
					 <br /> 
					 <br/>
					<strong>
					Cobuyer's Residential Information
					</strong>
					<br/><br/>
					Address: ". $cobuyers_address."
					<br />
					City: ". $cobuyers_city."
					 <br /> 
					State: ". $cobuyers_state."
					 <br /> 
					Zip: ". $cobuyers_zip."
					 <br />
					Residence Type: ". $cobuyers_residence_type."
					 <br /> 
					Time at Address: ". $cobuyers_time_address_year." ".$cobuyers_time_address_months."
					 <br />
					Monthly Payment: ". $cobuyers_monthly_payment."
					<br/>
					<br/>
					
					<strong>
					Cobuyer's Employment Information
					</strong>
					<br/><br/>
					Employer Name: ". $cobuyers_emp_name."
					<br/>
					Occupation: ". $cobuyers_occupation."
					<br/>
					Work Phone: ". $cobuyers_emp_phone1."
					<br/>
					Employer Zip: ". $cobuyers_emp_zip."
					<br/>
					Employmnet Type: ". $cobuyers_emp_type."
					<br/>
					Time with Employer: ". $cobuyers_twe_years." ".$cobuyers_twe_months."
					<br/>
					Monthly Income: ".$cobuyers_monthly_income."
					<br/>
					<strong>
					<br /> 
					Cobuyer's Additional Information: 
					</strong>
					<ul>
						<li><strong>Checking Account: </strong>$cobuyers_ca</li>
						<li><strong>Saving Account: </strong>$cobuyers_sa</li>
						<li><strong>Credit Card: </strong>$cobuyers_cc</li>
					</ul>
					
					<strong>
					Vehicle Information
					</strong>
						<ul>
							<li><strong>Year: </strong>$year</li>
							<li><strong>Make: </strong>$v_make</li>
							<li><strong>Model: </strong>$model</li>
							<li><strong>Price: </strong>$ $price</li>
							<li><strong>Vendor: </strong>$vendor</li>
							<li><strong>Vin: </strong>$infovin</li>
							<li><strong>City: </strong>$v_city</li>
							<li><strong>State: </strong>$v_state</li>
							<li><strong>Phone: </strong>$v_phone</li>
							<li><strong>Fax: </strong>$v_fax</li>
						</ul>

					We trust you will provide a good follow-up service and reply to this email with a final report status.
					 <br /> <br />
					 
					
					Sincere best wishes for your success!
					 <br />
					 <br />
					
					Support
					<br />
					Dixiemotors.com
					</body></html>";

	
	
	smail($to, $subject, $body, $headers);	
	$_SESSION['msg_alert']="Auto Loan Application successfully sent!";	
	msgbox("Auto Loan Application successfully sent!");
}

?>