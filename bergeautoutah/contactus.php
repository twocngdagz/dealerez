<?php
session_start();
include_once("includes.php");
require_once('recaptcha/recaptchalib.php');


$listing_obj  = new Listing();
$user_details = new User;

include_once("header.php"); 
?>
<script>
$(function() {
	$("form").validate();
});

var RecaptchaOptions = {
    theme : 'blackglass'
};

</script>
<?php 
if(isset($_POST['submit'])) {
	//CONTACT INFO
	$name				= $_POST['name'];
	$email				= $_POST['email'];
	$phone				= $_POST['phone'];
	$comment			= $_POST['comment'];
	
	
	/** Validate captcha */
	$privatekey = "6LeYJ-gSAAAAAJp2D_LtFTE-9qQHheEl1V3nNIHG";

	$resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

	  if (!$resp->is_valid) {
	  	$_SESSION['msg_error'] = "The reCAPTCHA wasn't entered correctly.";	
	  } else {
	        //send mail
		// $from		=	"info@bergeautoutah.com";
		$to		=	"labrums@yahoo.com";
		// $headers	= 	"From: info@bergeautoutah.com" . "\r\n" .
		// 			"Reply-To: info@bergeautoutah.com " . "\r\n" .
		// 			"Cc: support@dealerez.com" . "\r\n";
        $headers     = 'MIME-Version: 1.0' . "\r\n";
        $headers  .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers    .= "From: <info@bergeautoutah.com>". "\r\n";
        $headers    .= "Reply-To: <info@bergeautoutah.com>". "\r\n";
	
		$subject	=	"Berge Auto Contact Us";
	
		
		$body		=	"<div>
					Dear Dealer, <br /> <br />
					<br />
					<br />
					<strong>
					Contact Information
					</strong>
					<br/>
					<br />
					Customer Name: ".   $name."
					 <br />					
					Customer Email: ".  $email."
					 <br />					
					Customer Phone: ". $phone."
					 <br /> 
					Comment: ". $comment."
					 <br /> 
					<strong>
					<br />
					<br />
					We trust you will provide a good follow-up service and reply at your earliest convenience.
					 <br /> <br />
					 
					
					Sincere best wishes for your success!
					 <br />
					 <br />
					
					Support
					<br />
					BergeAutoUtah.com
					</div>";

	
	
		@mail($to, $subject, $body, $headers);
		$_SESSION['msg_alert'] = "Message Successfully Sent.";	
		msgbox("Message Successfully Sent");
	}
}
?>
    <div class="container_1">
    	    <?php include_once("menu.inc.php"); ?>
            <div class="container_2">   
            	  <div id="blog">
                  	<h2>Contact Us</h2>
					<div class="separator"></div>
                  	<div class="contact">
                    	<div id="contact1">
                        	<section>
                            	<h3>We Welcome Your Questions and Comments</h3>
                                <p>
                               			Do you have questions or comments for us? We'd love to hear them! Fill out the form and we will get back to you as soon as possible.
                                        <br/>
                                        <br/>
										If you need help with any aspect of the buying process, please don't hesitate to ask us. Our customer service representatives will be happy to assist you in any way. Whether through email, phone or in person, we're here to help you get the customer service you deserve.
                                </p>
                    			<?php echo display_message(); ?>
                                <form name="frmContact" id="frmContact" method="post">
                                    	<div class="cols-2">
                                            <div>
                                                <label>Name <span>*</span></label><br />
                                                <input type="text" name="name" id="name" required="required"/>
                                            </div>
                                            <div>
                                                <label>Email <span>*</span></label><br />
                                                <input type="email" name="email" id="email" required="required" />
                                            </div>
                                            <div>
                                                <label>Phone </label><br />
                                                <input type="text" name="phone" id="phone">
                                            </div>
                                        </div>
                                         <div class="cols-1">
                                            <div>
                                                <label>Comments</label><br />
                                                <textarea cols="30" rows="5" name="comment"></textarea>
                                            </div>
                                            <div>
                                                <label>Enter the digits below and submit.</label><br />
                                                <?php
                                                	$publickey = "6LeYJ-gSAAAAAJQHSw30X7l83DTc7yHpUR3nGjkM ";
                                                	echo recaptcha_get_html($publickey);
                                                ?>
                                            </div>
                                        </div>
                                        <!--
                                        <div id="capcha">	
                                        	<p>Enter the digits below and submit.</p>
                                          	<div>
                                            	<label>X J C B K</label>
                                                <input type="text" name="captcha" id="captcha"/>
                                          		<input type="submit" name="submit" value="Submit">
                                            </div>
                                          
                                        </div>
                                        -->
                                        <input type="submit" name="submit" value="Submit">
                                      
                                </form>
                            </section>
                        </div>
                        <div id="contact2">
                        	<div class="map-box">
                            	<h3>Contact Us</h3>
                                <p class="map-location">Berge Auto <br/> 199 E. 800 N. <br/> Orem, Utah 84057</p>
                                <div class="info-calls">
                                    <p>Toll Free: 888-952-1115</p>
                                    <p>Office Ph: 801-224-1555</p>
                                    <p>Fax Line:  801-224-1556</p>
                                </div>
                            </div>
                            <div class="map-box">
                            	<h3>Hours</h3>
                                <ul>
                                    <li>Monday</li>
                                    <li>Tuesday</li>
                                    <li>Wednesday</li>
                                    <li>Thursday</li>
                                    <li>Friday</li>
                                    <li>Saturday</li>
                                    <li>Sunday</li>
                                </ul>
                                <ul>
                                    <li>9am &ndash; 7pm</li>
                                    <li>9am &ndash; 7pm</li>
                                    <li>9am &ndash; 7pm</li>
                                    <li>9am &ndash; 7pm</li>
                                    <li>9am &ndash; 7pm</li>
                                    <li>9am &ndash; 5pm</li>
                                    <li>Closed</li>
                                </ul>
                            </div>
                            <div class="map-box">
                            	<h3>Map</h3>
                            	<div id="map"><?php include_once("map2.php"); ?></div>
                            </div>
                        </div>
                        <div class="clear"></div>
                        <div id="googlemap">
                        	
                        </div>
                    </div><!-- end contact  -->
                  </div>  					
<?php include_once("footer.php"); ?> 