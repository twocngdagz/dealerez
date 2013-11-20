<?php
session_start();
include_once("includes.php");

$listing_obj  = new Listing();
$user_details = new User;

$lid = $_GET['lid'];

$vdetails = $listing_obj->get_listing_detail($lid);


		$uid  =			$vdetails['user_id'];
		$price =  		$vdetails['price'];
		$miles = 	    $vdetails['miles'];
		$doors	= 		$vdetails['doors'];
		$fuel=			$vdetails['fuel'];
		$drive=			$vdetails['drive'];
		$engine=		$vdetails['engine'];
		$trans=			$vdetails['trans'];
		$interior=		$vdetails['interior'];
		$exterior=		$vdetails['exterior'];
		$title_type=	$vdetails['title_type'];
		$vin=			$vdetails['vin'];
		$body_style=	$vdetails['body_style'];
		$model=			$vdetails['model'];
		$make=			$vdetails['make'];
		$year=			$vdetails['year'];
		$city=			$vdetails['city'];
		$state=			$vdetails['state'];
		$fuelEC=		$vdetails['fuelEC'];
		$fuelEH=		$vdetails['fuelEH'];
		$description= 	$vdetails['description'];
		$cartitle=		$year." ".$make." ".$model;

if(isset($_POST['submit'])) {
	

	//CONTACT INFO
	$firstname	= $_POST['firstname'];
	$lastname	= $_POST['lastname'];
	$email		= $_POST['email'];
	$phone		= $_POST['phone'];
	$ddlBestTime		= $_POST['time'];
	$ddlPurchaseTime	= $_POST['timing'];
	$timezone			= $_POST['timezone'];
	$message			= $_POST['message'];
	$type				= $_POST['type'];
	
	//make an offer
	$offerprice = isset($_POST['offerprice'])?$_POST['offerprice']:'';
	
	//test drive
	
	$firsttime =	isset($_POST['firsttime'])?$_POST['firsttime']:'';
	$secondtime =	isset($_POST['secondtime'])?$_POST['secondtime']:'';
	
	$firsttimetime =	isset($_POST['firsttimetime'])?$_POST['firsttimetime']:'';
	$secondtimetime =	isset($_POST['secondtimetime'])?$_POST['secondtimetime']:'';
	
	if($type=='Make an Offer') { 
			$makeoffer =  "Price Offered: ". $offerprice."<br />";
	}
	if($type=='Request a Test Drive') { 
			$testdrive = "1st Time Preference: ". $firsttime." @".$firsttimetime."<br/>";
			$testdrive.= "2st Time Preference: ". $secondtime." @".$secondtimetime."<br/>";
	}
					
	//send mail
	$from		=	"info@dixiemotors.com";
	$to			=	"mrgwagner@gmail.com";

	$subject	=	"dixiemotors.com: Enquiry - $type";

	
	$body		=	"Dear Dealer, <br /> <br />

					We pleased to present you following Request from our www.dixiemotors.com website.
					
					 <br />
					 <br />
					<strong>
					Contact Information
					</strong>
					<br/>
					<br />
					Customer Name: ".   $firstname." ". $lastname."
					 <br />					
					Customer Email: ".  $email."
					 <br />					
					Customer Phone: ". $phone."
					 <br /> 
					Best time to Contact: ". $ddlBestTime."
					 <br /> 
					Purchase Timeframe: ". $ddlPurchaseTime."
					 <br /> 
					Timezone: ". $timezone."
					 <br /> 
					Message: ". $message."
					 <br /> 
					
					$makeoffer
					$testdrive
					
					<strong>
					<br /> 
					
					
					
					Vehicle Information: 
					</strong>
						<ul>
							<li><strong>Type: </strong>$body_style</li>
							<li><strong>Year: </strong>$year</li>
							<li><strong>Make: </strong>$make</li>
							<li><strong>Mode: </strong>$model</li>
						</ul>
					<strong>
					
					We trust you will provide a good follow-up service and reply to this email with a final report status.
					 <br /> <br />
					 
					
					Sincere best wishes for your success!
					 <br />
					 <br />
					
					Support
					<br />
					Dixiemotors.com";

	
	
	send_email($from,$to,$subject,$body);
	$_SESSION['msg_alert']="Your Request has been successfully sent!";	
	msgbox("Your Request has been successfully sent!");
	
	//redirect_page("listing_detail.php?lid=$lid");
	
	//end send mail
	
	}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Dixie Motors Utah</title>
<link href="css/reset.css" rel="stylesheet" type="text/css">
<script src="js/jquery-1.8.2.min.js" type="text/javascript"></script>
<link href="css/popup.css" rel="stylesheet" type="text/css">
<script src="js/jquery.validate.js"></script>
<script type="text/javascript" src="js/jquery.maskedinput-1.2.2.js"></script>
<script>
$(function() {
	$("form:submit").validate();
	$('form:submit').on('submit', function() {
		if(!$('.brs').length) {
			$("label.error").before("<br class='brs'/>");
		}
		
	});
	$('.phone').mask("(999) 999-9999"); 
	$('nav ul li').on('click', function() {
		$(this).siblings('li').removeClass('active')			
		$(this).addClass('active');
		
		
		var indexSelectedA = $(this).index()
			caption = $(this).find('a').text();
		
		$('#wrapper-popup h1').text(caption);
		if(indexSelectedA==0) {
			$('#moreinfo').show();
			$('#testdrive').hide();
			$('#getaquote').hide();
			$('#offer').hide();
			$('#call').hide();
		}
		else if(indexSelectedA==1) {
			$('#moreinfo').hide();
			$('#testdrive').show();
			$('#getaquote').hide();
			$('#offer').hide();
			$('#call').hide();
		}
		else if(indexSelectedA==2) {
			$('#moreinfo').hide();
			$('#testdrive').hide();
			$('#getaquote').show();
			$('#offer').hide();
			$('#call').hide();
		}
		else if(indexSelectedA==3) {
			$('#moreinfo').hide();
			$('#testdrive').hide();
			$('#getaquote').hide();
			$('#offer').show();
			$('#call').hide();
			$('#offerprice').focus();
		}
		else {
			$('#moreinfo').hide();
			$('#testdrive').hide();
			$('#getaquote').hide();
			$('#offer').hide();
			$('#call').show();
		}
		return false;
	});
	
	
});
</script>

</head>

<body>
<div id="wrapper-popup">
	<h1>Request More Info</h1>
    <div id="main-popup">
    	<nav>
        	<ul>
            	<li class="active"><a href="#">Request More Info</a></li>
                <li><a href="#">Request A Test Drive</a></li>
                <li><a href="#">Get A Quote</a></li>
                <li><a href="#">Make An Offer</a></li>
                <li><a href="#">Call today!</a></li>
            </ul>
        </nav>
        <div id="container">
        	<section id="request-more-info">
            	<div class="vehicle-details">
                <?php 
				$images_list = $listing_obj->get_listing_images($lid);
			
				$img = SITE_URL.SITE_LISTING_THUM_PATH.$images_list[0]['image_name']; ?>
                	<img src="<?php echo $img; ?>" alt="Image" width="152" height="113" />
                    <p class="vehicle-name"><?php echo $cartitle; ?></p>
                <!--    <p class="vehicle-desc">Honda Civic 2012</p>-->
                    <p class="vehicle-miles"><?php echo number_format($miles); ?> miles</p>
                    <p class="vehicle-asking-price">Asking Price: $<?php echo number_format($price); ?></p>
                </div>
                
                <!-- more infor -->
                <div id="moreinfo">
                	<form name="form-request-info"  method="post">
                	<textarea cols="30" rows="5" name="message">I am interested in this vehicle. Please contact me via phone or email with more information.</textarea>
               		<input type="hidden" name="vname" value="<?php echo $cartitle; ?>" />
                    <input type="hidden" name="miles" value="<?php echo $miles; ?>" />
                    <input type="hidden" name="price" value="<?php echo number_format($price); ?>" />
                    <div class="input-inline">
                        <label>My Purchase Timing is: </label>
                        <select name="timing" id="timing">
                            	<option value="I plan to purchase within the next 24 hours">Within the next 24 hours</option>
                                <option value="I plan to purchase within the next 72 hours">Within the next 72 hours</option>
                                <option value="I plan to purchase within the next 2 weeks">Within the next 2 weeks</option>
                                <option value="I plan to purchase within the next month">Within the next month</option>
                                <option value="I am undecided">I am undecided</option>
                        </select>
                    </div>
                    
                    <div class="separator"></div>
                    
                    <div class="cols-2">
                    	<div>
                        	<input type="hidden" name="type" id="type" value="Request More Info">
                        	<label>First Name <span>*</span></label><br />
                            <input type="text" name="firstname" id="firstname" required />
                        </div>
                        <div>
                        	<label>Last Name <span>*</span></label><br />
                            <input type="text" name="lastname" id="lastname" required>
                        </div>
                    </div>
                    
                    <div class="cols-1">
                    	<div>
                        	<label>Email <span>*</span></label><br />
                            <input type="email" name="email" id="email" required>
                        </div>
                    </div>
                    
                     <div class="cols-2">
                    	<div>
                        	<label>Phone <span>*</span></label><br />
                            <input type="text" name="phone" class="phone" required>
                        </div>
                    </div>
                    
                     <div class="cols-2">
                    	<div>
                        	<label>Best Time to Contact</label><br />
                             <select name="time" id="time">
                                   <option value="Morning">Morning</option>
                                  <option value="Afternoon">Afternoon</option>
                                  <option value="Evening">Evening</option>
                             </select>
                        </div>
                        <div>
                        	<label>Time Zone</label><br />
                             <select name="timezone" id="timezone">
                    	          <option value="0">Select Time Zone</option>
                                  <option value="Eastern">Eastern</option>
                                  <option value="Central">Central</option>
                                  <option value="Mountain">Mountain</option>
                                  <option value="Pacific">Pacific</option>
                      		 </select>
                        </div>
                    </div>
                    
                    <div class="separator"></div>
                    
                    <p class="required"><span>*</span>=Required</p>
                    
                    <input type="submit" name="submit" id="submit" value="submit">
                    
                </form>
                </div>
               <!-- end more infor -->
               
               <!-- test drive -->
               <div id="testdrive" style="display:none;">
               
               		<form name="form-request-info"  method="post">	
                    <div class="cols-2">
                    	<div>
                        	<label>1st Time Preference: </label><br />
                            <input type="text" name="firsttime" id="firsttime"  value="<?php echo get_today_date(); ?>" />
                        </div>
                        <div>
                        	<label>2nd Time Preference:</label><br />
                            <input type="text" name="secondtime" id="secondtime" value="<?php echo get_today_date(); ?>">
                        </div>
                    </div>
                     <div class="cols-2">
                    	<div>
                        	<label>Time: </label><br />
                            <select name="firsttimetime">
                            	<option value="8 a.m.">8 a.m.</option>
                                <option value="9 a.m.">9 a.m.</option>
                                <option value="10 a.m.">10 a.m.</option>
                                <option value="11 a.m.">11 a.m.</option>
                                <option value="12 a.m.">12 a.m.</option>
                                <option value="1 p.m.">1 p.m.</option>
                                <option value="2 p.m.">2 p.m.</option>
                                <option value="3 p.m.">3 p.m.</option>
                                <option value="4 p.m.">4 p.m.</option>
                                <option value="5 p.m.">5 p.m.</option>
                                <option value="6 p.m.">6 p.m.</option>
                                <option value="7 p.m.">7 p.m.</option>
                                <option value="8 p.m.">8 p.m.</option>
                                <option value="9 p.m.">9 p.m.</option>
                            </select>
                        </div>
                        <div>
                        	<label>Time:</label><br />
                            <select name="secondtimetime">
                            	<option value="8 a.m.">8 a.m.</option>
                                <option value="9 a.m.">9 a.m.</option>
                                <option value="10 a.m.">10 a.m.</option>
                                <option value="11 a.m.">11 a.m.</option>
                                <option value="12 a.m.">12 a.m.</option>
                                <option value="1 p.m.">1 p.m.</option>
                                <option value="2 p.m.">2 p.m.</option>
                                <option value="3 p.m.">3 p.m.</option>
                                <option value="4 p.m.">4 p.m.</option>
                                <option value="5 p.m.">5 p.m.</option>
                                <option value="6 p.m.">6 p.m.</option>
                                <option value="7 p.m.">7 p.m.</option>
                                <option value="8 p.m.">8 p.m.</option>
                                <option value="9 p.m.">9 p.m.</option>
                            </select>
                        </div>
                    </div>
                	<textarea cols="30" rows="5" name="message">I am interested in this vehicle. Please contact me via phone or email with more information.</textarea>
               		<input type="hidden" name="vname" value="<?php echo $cartitle; ?>" />
                    <input type="hidden" name="miles" value="<?php echo $miles; ?>" />
                    <input type="hidden" name="price" value="<?php echo number_format($price); ?>" />
                    <div class="input-inline">
                        <label>My Purchase Timing is: </label>
                        <select name="timing" id="timing">
                            	<option value="I plan to purchase within the next 24 hours">Within the next 24 hours</option>
                                <option value="I plan to purchase within the next 72 hours">Within the next 72 hours</option>
                                <option value="I plan to purchase within the next 2 weeks">Within the next 2 weeks</option>
                                <option value="I plan to purchase within the next month">Within the next month</option>
                                <option value="I am undecided">I am undecided</option>
                        </select>
                    </div>
                    
                    <div class="separator"></div>
                    
                    <div class="cols-2">
                    	<div>
                        	<input type="hidden" name="type" id="type" value="Request a Test Drive">
                        	<label>First Name <span>*</span></label><br />
                            <input type="text" name="firstname" id="firstname" required />
                        </div>
                        <div>
                        	<label>Last Name <span>*</span></label><br />
                            <input type="text" name="lastname" id="lastname" required>
                        </div>
                    </div>
                    
                    <div class="cols-1">
                    	<div>
                        	<label>Email <span>*</span></label><br />
                            <input type="email" name="email" id="email" required>
                        </div>
                    </div>
                    
                     <div class="cols-2">
                    	<div>
                        	<label>Phone <span>*</span></label><br />
                            <input type="text" name="phone" class="phone" required>
                        </div>
                    </div>
                    
                     <div class="cols-2">
                    	<div>
                        	<label>Best Time to Contact</label><br />
                             <select name="time" id="time">
                                   <option value="Morning">Morning</option>
                                  <option value="Afternoon">Afternoon</option>
                                  <option value="Evening">Evening</option>
                             </select>
                        </div>
                        <div>
                        	<label>Time Zone</label><br />
                             <select name="timezone" id="timezone">
                    	          <option value="0">Select Time Zone</option>
                                  <option value="Eastern">Eastern</option>
                                  <option value="Central">Central</option>
                                  <option value="Mountain">Mountain</option>
                                  <option value="Pacific">Pacific</option>
                      		 </select>
                        </div>
                    </div>
                    
                    <div class="separator"></div>
                    
                    <p class="required"><span>*</span>=Required</p>
                    
                    <input type="submit" name="submit" id="submit" value="submit">
                    
                </form>
               </div>
               <!-- end testdrive -->
               
               <!-- test get quote -->
               <div id="getaquote" style="display:none;">
               
               		<form name="form-request-info"  method="post">	

                	<textarea cols="30" rows="5" name="message">I am interested in a price quote on this vehicle. Please contact me at your earliest convenience with your best price on this vehicle.</textarea>
               		<input type="hidden" name="vname" value="<?php echo $cartitle; ?>" />
                    <input type="hidden" name="miles" value="<?php echo $miles; ?>" />
                    <input type="hidden" name="price" value="<?php echo number_format($price); ?>" />
                    <div class="input-inline">
                        <label>My Purchase Timing is: </label>
                        <select name="timing" id="timing">
                            	<option value="I plan to purchase within the next 24 hours">Within the next 24 hours</option>
                                <option value="I plan to purchase within the next 72 hours">Within the next 72 hours</option>
                                <option value="I plan to purchase within the next 2 weeks">Within the next 2 weeks</option>
                                <option value="I plan to purchase within the next month">Within the next month</option>
                                <option value="I am undecided">I am undecided</option>
                        </select>
                    </div>
                    
                    <div class="separator"></div>
                    
                    <div class="cols-2">
                    	<div>
                        	<input type="hidden" name="type" id="type" value="Get a Quote">
                        	<label>First Name <span>*</span></label><br />
                            <input type="text" name="firstname" id="firstname" required />
                        </div>
                        <div>
                        	<label>Last Name <span>*</span></label><br />
                            <input type="text" name="lastname" id="lastname" required>
                        </div>
                    </div>
                    
                    <div class="cols-1">
                    	<div>
                        	<label>Email <span>*</span></label><br />
                            <input type="email" name="email" id="email" required>
                        </div>
                    </div>
                    
                     <div class="cols-2">
                    	<div>
                        	<label>Phone <span>*</span></label><br />
                            <input type="text" name="phone" class="phone" required>
                        </div>
                    </div>
                    
                     <div class="cols-2">
                    	<div>
                        	<label>Best Time to Contact</label><br />
                             <select name="time" id="time">
                                   <option value="Morning">Morning</option>
                                  <option value="Afternoon">Afternoon</option>
                                  <option value="Evening">Evening</option>
                             </select>
                        </div>
                        <div>
                        	<label>Time Zone</label><br />
                             <select name="timezone" id="timezone">
                    	          <option value="0">Select Time Zone</option>
                                  <option value="Eastern">Eastern</option>
                                  <option value="Central">Central</option>
                                  <option value="Mountain">Mountain</option>
                                  <option value="Pacific">Pacific</option>
                      		 </select>
                        </div>
                    </div>
                    
                    <div class="separator"></div>
                    
                    <p class="required"><span>*</span>=Required</p>
                    
                    <input type="submit" name="submit" id="submit" value="submit">
                    
                </form>
               </div>
               <!-- end get quote -->
               
               <!-- make an offer -->
               <div id="offer" style="display:none;">
               
               		<form name="form-request-info"  method="post">	
					<div class="cols-1">
                    	<div>
                        	<br/>
                        	<label>Price <span>*</span></label><br />
                            <input type="text" name="offerprice" id="offerprice" value="$<?php echo number_format($price); ?>" required />
                        </div>
                    </div>
                	<textarea cols="30" rows="5" name="message">I am interested in a price quote on this vehicle. Please contact me at your earliest convenience with your best price on this vehicle.</textarea>
               		<input type="hidden" name="vname" value="<?php echo $cartitle; ?>" />
                    <input type="hidden" name="miles" value="<?php echo $miles; ?>" />
                    <input type="hidden" name="price" value="<?php echo number_format($price); ?>" />
                    <div class="input-inline">
                        <label>My Purchase Timing is: </label>
                        <select name="timing" id="timing">
                            	<option value="I plan to purchase within the next 24 hours">Within the next 24 hours</option>
                                <option value="I plan to purchase within the next 72 hours">Within the next 72 hours</option>
                                <option value="I plan to purchase within the next 2 weeks">Within the next 2 weeks</option>
                                <option value="I plan to purchase within the next month">Within the next month</option>
                                <option value="I am undecided">I am undecided</option>
                        </select>
                    </div>
                    
                    <div class="separator"></div>
                    
                    <div class="cols-2">
                    	<div>
                        	<input type="hidden" name="type" id="type" value="Make an Offer">
                        	<label>First Name <span>*</span></label><br />
                            <input type="text" name="firstname" id="firstname" required />
                        </div>
                        <div>
                        	<label>Last Name <span>*</span></label><br />
                            <input type="text" name="lastname" id="lastname" required>
                        </div>
                    </div>
                    
                    <div class="cols-1">
                    	<div>
                        	<label>Email <span>*</span></label><br />
                            <input type="email" name="email" id="email" required>
                        </div>
                    </div>
                    
                     <div class="cols-2">
                    	<div>
                        	<label>Phone <span>*</span></label><br />
                            <input type="text" name="phone" class="phone" required>
                        </div>
                    </div>
                    
                     <div class="cols-2">
                    	<div>
                        	<label>Best Time to Contact</label><br />
                             <select name="time" id="time">
                                   <option value="Morning">Morning</option>
                                  <option value="Afternoon">Afternoon</option>
                                  <option value="Evening">Evening</option>
                             </select>
                        </div>
                        <div>
                        	<label>Time Zone</label><br />
                             <select name="timezone" id="timezone">
                    	          <option value="0">Select Time Zone</option>
                                  <option value="Eastern">Eastern</option>
                                  <option value="Central">Central</option>
                                  <option value="Mountain">Mountain</option>
                                  <option value="Pacific">Pacific</option>
                      		 </select>
                        </div>
                    </div>
                    
                    <div class="separator"></div>
                    
                    <p class="required"><span>*</span>=Required</p>
                    
                    <input type="submit" name="submit" id="submit" value="submit">
                    
                </form>
               </div>
               <!-- end make an offer -->
               
               <!-- call -->
               <div id="call" style="display:none;padding-top: 15px;">
               <div class="separator"></div>
               <div style="text-align: center;">
               		<h3>Contact Sales Group today for more information on this vehicle. </h3>
                    <p>Toll Free: 888-9600-1114</p>
                    <p>Our Office: 801-435-628-2240</p>
                    <p>Fax Line: 801-628-2240</p>
                    
               </div>
               </div>
               <!-- end call -->
               
            </section>
        </div>
    </div>
</div>
</body>
</html>