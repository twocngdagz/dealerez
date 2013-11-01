<?php
session_start();
include_once("includes.php");

$listing_obj  = new Listing();
$user_details = new User;

include_once("header.php"); ?>
<script>
$(function() {
	$("#frmTrade").validate();
	$('form').on('submit', function() {
		if(!$('.brs').length) {
			$("label.error").before("<br class='brs'/>");
		}
		
	});
});
</script>
<?php 
if(isset($_POST['submit'])) {
	//vehicle of interest
	$vtype	= $_POST['vtype'];
	$iyear 	= ucwords($_POST['iyear']);
	$imake 	= $_POST['imake'];
	$imodel	= $_POST['imodel'];
	$istock	= $_POST['istock'];
	
	//vehicle information
	$infoyear	= $_POST['infoyear'];
	$infomake	= $_POST['infomake'];
	$infomodel	= $_POST['infomodel'];
	$infomileage= number_format($_POST['infomileage']);
	$infoext	= $_POST['infoext'];
	$infoint	= $_POST['infoint'];
	$infopayoff	= number_format($_POST['infopayoff']);
	$infocond	= $_POST['infocond'];
	$infovin	= $_POST['infovin'];
	$infocomment	= $_POST['infocomment'];
	
	//CONTACT INFO
	$contactfirstname	= $_POST['contactfirstname'];
	$contactlastname	= $_POST['contactlastname'];
	$email				= $_POST['email'];
	$contactphone		= $_POST['contactphone'];
	$ddlBestTime		= $_POST['ddlBestTime'];
	$ddlPurchaseTime	= $_POST['ddlPurchaseTime'];
	$contactmessage		= $_POST['contactmessage'];
		

	//send mail
	$from		=	"info@dixiemotors.com";
	$to			=	"mrgwagner@gmail.com";

	$subject	=	"dixiemotors.com: Enquiry - Trade Appraisal";

	
	$body		=	"Dear Dealer, <br /> <br />

					We pleased to present you following Trade Appraisal lead from our www.dixiemotors.com website.
					
					 <br />
					 <br />
					<strong>
					Contact Information
					</strong>
					<br/>
					<br />
					Customer Name: ".   $contactfirstname." ". $contactlastname."
					 <br />					
					Customer Email: ".  $email."
					 <br />					
					Customer Phone: ". $contactphone."
					 <br /> 
					Best time to Contact: ". $ddlBestTime."
					 <br /> 
					Purchase Timeframe: ". $ddlPurchaseTime."
					 <br /> 
					Message: ". $contactmessage."
					 <br /> 
					<strong>
					<br /> 
					Vehicle Of Interest: 
					</strong>
						<ul>
							<li><strong>Type: </strong>$vtype</li>
							<li><strong>Year: </strong>$iyear</li>
							<li><strong>Make: </strong>$imake</li>
							<li><strong>Mode: </strong>$imodel</li>
							<li><strong>Stock#: </strong>$istock</li>
						</ul>
					<strong>
					Vehicle Information
					</strong>
						<ul>
							<li><strong>Year: </strong>$infoyear</li>
							<li><strong>Make: </strong>$infomake</li>
							<li><strong>Model: </strong>$infomodel</li>
							<li><strong>Mileage: </strong>$infomileage</li>
							<li><strong>Ext: </strong>$infoext</li>
							<li><strong>Int: </strong>$infoint</li>
							<li><strong>Pay Off Balance: </strong>$ $infopayoff</li>
							<li><strong>Condition: </strong>$infocond</li>
							<li><strong>Vin: </strong>$infovin</li>
							<li><strong>Comment: </strong>$infocomment</li>
						</ul>

					We trust you will provide a good follow-up service and reply to this email with a final report status.
					 <br /> <br />
					 
					
					Sincere best wishes for your success!
					 <br />
					 <br />
					
					Support
					<br />
					Dixiemotors.com";

	
	
	send_email($from,$to,$subject,$body);
	$_SESSION['msg_alert']="Trade Appraisal successfully sent!";	
	msgbox("Trade Appraisal successfully sent!");
	redirect_page("trade_appraisal.php");
	//end send mail
	
	}
?>
    <div class="container_1">
    	    <?php include_once("menu.inc.php"); ?>
            <div class="container_2">   
            	  <div id="trade-in">
                  	<h2>Trade Appraisal</h2>
                    
                    <p>Get Your Free Trade In Appraisal Now! Use our free, no-obligation Trade In Appraisal form. Our sales department will contact you shortly with your trade in value. </p>
                    
                    <div class="separator"></div>
                    <?php
					 echo display_message();			
					 ?>
                    <h3>Vehicle of Interest:</h3>
                    
                    <form name="frmTrade" id="frmTrade" method="post">
                    <div class="cols-4 vehicle-type">
                    	<div>
                       	 	<label>New </label>
                            <input type="radio" name="vtype" value="new" checked >
                            <label>Used </label>
                            <input type="radio" name="vtype" value="used">
                        </div>
                    </div>
                    <div class="cols-4">
                    	<div>
                        	<label>Year </label><br />
                            <input type="text" name="iyear" id="iyear" class="shortTxt" maxlength="4"/>
                        </div>
                        <div>
                        	<label>Make </label><br />
                            <input type="text" name="imake" id="imake">
                        </div>
                        <div>
                        	<label>Model </label><br />
                            <input type="text" name="imodel" id="imodel">
                        </div>
                        <div>
                        	<label>Stock# </label><br />
                            <input type="text" name="istock" id="istock">
                        </div>
                    </div>
                    
                    <div class="separator"></div>
                    
                    <h3>Vehicle Information</h3>
                    
                    <div class="cols-3">
                    	<div>
                        	<label>Year <span>*</span></label><br />
                            <input type="text" name="infoyear" id="infoyear" class="shortTxt" maxlength="4" required/>
                        </div>
                        <div>
                        	<label>Make <span>*</span></label><br />
                            <input type="text" name="infomake" id="infomake" required>
                        </div>
                        <div>
                        	<label>Model <span>*</span></label><br />
                            <input type="text" name="infomodel" id="infomodel" required>
                        </div>
                    </div>
                    <div class="cols-3">
                    	<div>
                        	<label>Mileage <span>*</span></label><br />
                            <input type="text" name="infomileage" id="infomileage" class="shortTxt" required/>
                        </div>
                        <div>
                        	<label>Extension Color <span>*</span></label><br />
                            <input type="text" name="infoext" id="infoext" required>
                        </div>
                        <div>
                        	<label>Interior Color <span>*</span></label><br />
                            <input type="text" name="infoint" id="infoint" required>
                        </div>
                    </div>
                    
                    <div class="cols-3">
                    	<div>
                        	<label>Pay Off Balance<span>*</span></label><br />
                            <input type="text" name="infopayoff" id="infopayoff" class="shortTxt" required/>
                        </div>
                        <div class="divCondition">
                        	<label>Condition </label><br />
                            <input type="text" name="infocond" id="infocond">
                        </div>
                        <div>
                        	<label>VIN </label><br />
                            <input type="text" name="infovin" id="infovin">
                        </div>
                    </div>
                    
                    <div class="cols-1">
                    	<div>
                        	<label>Condition Comments</label><br />
                    		<textarea cols="30" rows="5" name="infocomment"></textarea>
                        </div>
                    </div>
                    
                   
                   	<h3>Contact Information</h3>
                    <div class="separator"></div>
                    
                     <div class="cols-2">
                    	<div>
                        	<label>First Name <span>*</span></label><br />
                            <input type="text" name="contactfirstname" id="contactfirstname" required/>
                        </div>
                        <div>
                        	<label>Last Name <span>*</span></label><br />
                            <input type="text" name="contactlastname" id="contactlastname" required>
                        </div>
                    </div>
                     		
                    <div class="cols-1 contact-info">
                    	<div>
                        	<label>Email <span>*</span></label><br />
                            <input type="email" name="email" id="email" required/>
                        </div>
                    </div>
                    <div class="cols-1">
                    	<div>
                        	<label>Phone</label><br />
                            <input type="text" name="contactphone" id="contactphone" />
                        </div>
                    </div>
                    
                    <div class="cols-2">
                    	<div>
                        	<label>Best Time to Contact </label><br />
                            <select class="ddlBestTime" id="ddlBestTime" name="ddlBestTime">
                                <option value="Morning">Morning</option>
                                <option value="Afternoon">Afternoon</option>
                                <option value="Evening">Evening</option>
							</select>
                        </div>
                        <div>
                        	<label>Purchase Timeframe </label><br />
                            <select class="ddlPurchaseTime" id="ddlPurchaseTime" name="ddlPurchaseTime">
                                <option value="I plan to purchase within the next 24 hours">Within the next 24 hours</option>
                                <option value="I plan to purchase within the next 72 hours">Within the next 72 hours</option>
                                <option value="I plan to purchase within the next 2 weeks">Within the next 2 weeks</option>
                                <option value="I plan to purchase within the next month">Within the next month</option>
                                <option value="I am undecided">I am undecided</option>
							</select>
                        </div>
                    </div>
                    
                    <div class="cols-1">
                    	<div>
                        	<label>Message </label><br />
                    		<textarea cols="30" rows="5" name="contactmessage"></textarea>
                        </div>
                    </div>
                    
                    <div class="separator"></div>
                                       
                    <input type="submit" name="submit" id="submit" value="Submit Request">
                    
                    <p class="required"><span>*</span> =Required</p>
                    </form>
                  </div>  
<?php include_once("footer-information.php"); ?> 					
<?php include_once("footer.php"); ?> 