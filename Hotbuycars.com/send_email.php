<?php

		session_start();
		include_once("includes.php");
		
		$lid = $_SESSION["lid"];
		
	/*	$listing_title=isset($_REQUEST['listing_title'])?$_REQUEST['listing_title']:'';*/
		/*$zip = isset($_POST['zip'])?mysql_real_escape_string($_POST['zip']):'';
		$message=isset($_REQUEST['message'])?mysql_real_escape_string($_REQUEST['message']):'';*/
		
		$dealer_name = $_POST['dealername'];
		$email_address = isset($_POST['emailaddress'])?mysql_real_escape_string($_POST['emailaddress']):'';
		$first_name = isset($_POST['firstname'])?mysql_real_escape_string($_POST['firstname']):'';
		$lastname = isset($_POST['lastname'])?mysql_real_escape_string($_POST['lastname']):'';
		$phone_number = isset($_POST['phone'])?mysql_real_escape_string($_POST['phone']):'';
		$msg_type = $_POST['msg_type'];
		$message_txtarea = $_POST['message'];
		
		$currentDate  = date("Y-m-d H:i:s");
		$user_id = $_POST['uid'];
		$user_type = "";
		define("year",'',true);
		
		$securitycode =	isset($_REQUEST['securitycode'])?$_REQUEST['securitycode']:false;

		
				
				/*$sql="INSERT INTO dealers_email(listing_id,listing_title,first_name,last_name,email_address,phone_number,comment,user_id,availability_question,amount_offer,user_type,AddDate)
				VALUES ('$lid','$listing_title','$first_name','$last_name','$email_address','$phone_number','$comment','$user_id','$available','$amount','$user_type','$currentDate')";
				
				$result = mysql_query($sql) or die(mysql_error());
				
				$sqlGetData = "SELECT
								listing.listing_id,
								listing.user_id,
								users.name,
								listing.`year`,
								users.contact_email
								FROM
								listing
								Inner Join users ON listing.user_id = users.user_id
								WHERE
								listing.listing_id =  '$lid'
								";
								
				$resultset = mysql_query($sqlGetData) or die(mysql_error());
				
				$seller_email =  mysql_result($resultset,0,"contact_email");
				$year = mysql_result($resultset,0,"year");*/
		 if(isset($_POST['submit']) or isset($_POST['submit_df'])) {
				
				$subject="Hot Buys Cars - Website Lead";
		
				$message="<p><h3>Hot BuysCars - Website Lead</h3></p>";
				$message="<p>Following is the data provided by the User</p><br/>";
				$message.="<p><strong>Dealer Name:</strong> $dealer_name</p><br>";
				
				$message.="<p><strong>First Name:</strong> $first_name</p><br>";
				$message.="<p><strong>Last Name:</strong> $lastname</p><br>";
				$message.="<p><strong>Phone:</strong> $phone_number</p><br>";
				$message.="<p><strong>Email:</strong> $email_address</p><br>";
				$message.="<p><strong>Message:</strong> $message_txtarea</p><br>";
				$message.="<p><strong>Listing Detail Link:</strong> <a href='wwww.hotbuycars.com/listingdetail.php?lid=$lid'>wwww.hotbuycars.com/listingdetail.php?lid=$lid</a></p><br>";
				$message.="<p><hr></p><br>";
				$message.="<p>This is auto generated email please do not reply to this email.<hr></p><br>";
			
				$headers = "From: support@hotbuycars.com \r\n";
				$headers.= "Content-Type: text/html; charset=ISO-8859-1 ";
				$headers .= "MIME-Version: 1.0 ";

				//$to=$seller_email;
				//$to = "glenn@impactsources.com";
				$to="lnllaurito@yahoo.com";
				mail($to,$subject,$message,$headers);
				
				$_SESSION['message_sent'] = "true";	
				if(isset($_POST['submit_df'])) {
					
					header("Location: dealerprofile.php?uid=".$user_id);
				}
				elseif(isset($_POST['submit'])) {
							
					header("Location: listingdetail.php?lid=".$lid);
				}
					
		}

		else
		{
			unset($_SESSION['message_sent']);
			echo "Unauthorized access to email has been blocked";
		}		
	
?>
