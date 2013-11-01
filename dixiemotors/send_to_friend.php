<?php
session_start();
include_once("includes.php");

$listing_obj  = new Listing();
$user_details = new User;

$id = $_GET['id'];

$vdetails = $listing_obj->get_listing_detail($id);
$uid 			= $vdetails['user_id'];
$price 			= $vdetails['price'];
$cartitle		= $vdetails['year']." ".$vdetails['make']." ".$vdetails['model'];
$category		= $vdetails['vehicle_type'];
$stock_no		= $vdetails['stock_no'];
$vin			= $vdetails['vin'];

if(isset($_POST['submit'])) {
	
	//send mail
	$from		= $_POST["your_email"];
	$to			= $_POST["friend_email"];
	$headers	= "From: ". $from . "\r\n" .
				  "Reply-To: " . $to . "\r\n" .
				  "MIME-Version: 1.0\r\n" .
				  "Content-Type: text/html; charset=ISO-8859-1\r\n";
	$subject	= "Important message from ".$_POST['name'];
					
	$body		= " <html>
					<body>
					<table cellpadding='0' cellspacing='5' width='650px' style='font-family:Verdana; font-size:13px'>
						<tr>
							<td><img src='".SITE_URL."sandbox/web/theme/images/logo.jpg' border='0'  /></td>
						</tr>
						<tr>
							<td align='left' style='color:#8b0000'><br><b>Email from DixieMotorsUtah.com</b></td>
						</tr>
						<tr>
							<td  align='left' style='color:#333333; text-decoration:none' ><br>".$_POST['name']." has been on our web site and has found a Vehicle they would like you to look at.<br>Click on the link to see the details.
							</td>
						</tr>
						<tr>
							<td align='left' style='color:#333333'><br><b><a href='http://www.dixiemotorsutah.com/listing_detail.php?lid=".$id."'>".$_POST['vehicle']."</a></b>
							</td>
						</tr>
						<tr>
							<td  align='left' style='color:#8b0000'><br><b>message from ".$_POST['name'].":</b>
							</td>
						</tr>
						<tr>
							<td align='left' style='color:#333333'>".$_POST['message']."<br />
							</td>
						</tr>
					</table>
					</body>
					</html>";
	
	$result = mail($to, $subject, $body, $headers);
	
	if($result) {
		$_SESSION['msg_alert']="Your Request has been successfully sent!";	
		msgbox("Your Email has been successfully sent!");
		//redirect_page("listing_detail.php?lid=$id");
	}
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

</head>

<body>
<div id="wrapper-popup">
	<h1>Send To A Friend</h1>
    <div id="main-popup">
        <div id="container" style="width:97%">
        	<section>
            	<p style="font-size:11px;">Let someone know about a listing you found on this site. Type in their e-mail address, hit send, and we will send them information about this listing.</p>
                <div class="separator" style="margin:10px 0;"></div>
            	<div class="vehicle-details">
                <?php 
				$images_list = $listing_obj->get_listing_images($id);
			
				$img = SITE_URL.SITE_LISTING_THUM_PATH.$images_list[0]['image_name']; ?>
                	<img src="<?php echo $img; ?>" alt="Image" width="152" height="113" />
                    <p class="vehicle-asking-price">$<?php echo number_format($price); ?></p>
                    <p class="vehicle-name"><?php echo $cartitle; ?></p>
                    <p style="font-size:11px;">
                    	<b>Category:</b> <?php echo $category; ?><br>
                       	<b>Stock #:</b> <?php echo $stock_no; ?><br>
                       	<b>VIN #:</b> <?php echo $vin; ?>
                    </p>
                </div>
                <div class="separator" style="margin:10px 0;"></div>
                <div id="moreinfo">
                	<form method="post">
                    	<input type="hidden" name="vehicle" value="<?php echo $cartitle; ?>" />
                        <div class="cols-1">
                            <div>
                                <input type="hidden" name="type" id="type" value="Request More Info">
                                <label>Your Name <span>*</span></label><br />
                                <input type="text" name="name" id="name" required />
                            </div>
                        </div>
                        <div class="cols-1">
                            <div>
                                <label>Your Email <span>*</span></label><br />
                                <input type="email" name="your_email" id="your_email" required />
                            </div>
                        </div>
                        <div class="cols-1">
                            <div>
                                <label>Send Email To <span>*</span></label><br />
                                <input type="email" name="friend_email" id="friend_email" required />
                            </div>
                        </div>
                        <div class="cols-1">
                            <div>
                                <label>Message</label><br />
                                <textarea style="height:80px; width:400px;" name="message"></textarea>
                            </div>
                        </div>
                        <div class="separator" style="margin:10px 0;"></div>
                        <p class="required"><span>*</span>=Required</p>
                        <input type="submit" name="submit" value="Send Email">
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>
</body>
</html>