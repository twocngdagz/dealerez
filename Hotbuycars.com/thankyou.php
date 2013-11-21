<?php
include_once("includes.php");

$Action =isset($_POST['action'])?$_POST['action']:false;
$id = $_POST['listing_id'];

if($Action=="Send Email")
{
	
ob_start();
?>
<table cellpadding='0' cellspacing='5' width='650px' style='font-family:Verdana; font-size:13px'>
<tr>
	<td colspan='2'>
		<span style="width:100%; margin:0 auto;" ><img src="<?php echo SITE_URL."hotbuycars/images/logo.png";?>" border='0'/></span>
	</td>
</tr>
<tr>
	<td width='200px'>
	</td>
	<td  align='left' style='color:#8b0000'><br><b>Email from Hotbuycars</b>
	</td>
</tr>
<tr>
	<td width='200px'>
	</td>
	<td  align='left' style='color:#333333; text-decoration:none' ><br> <?= $_POST["name"];?> " has been on our web site and has found a Vehicle they would like you to look at.<br>Click on the link to see the <?php echo $_POST['vehicle_image']; ?>.
	</td>
</tr>
<tr>
	<td width='200px'>
	</td>
	<td align='left' style='color:#333333'><br><b><a href="www.dealerez.com/sandbox/hotbuycars/listings_details.php?lid=<?php echo $id; ?>" >View Link</a></b>
	</td>
</tr>
<tr>
	<td width='200px'>
	</td>
	<td  align='left' style='color:#8b0000'><br><b>message from <?=$_POST["name"];?> :</b>
	</td>
</tr>
<tr>
	<td width='200px'>
	</td>
	<td align='left' style='color:#333333'><?=$_POST["email_message"];?><br />
	</td>
</tr>
</table>
	
<?php

$contents= ob_get_contents();
ob_end_clean();


$from=$_POST["emailaddress"];
$to=$_POST["sendmailto"];
$subject='Important message from '.$_POST["name"];
$body=$contents;


send_email($from,$to,$subject,$body);

$display='thanks';
?>
  
 <?php

 }
 else{
	echo "FAILED!"; 
 }
 ?>

<html><head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>Hot Buys This Week</title>

<meta name="keywords" content="dealer,realtor,marchant,vehicle,product,services,realEstate">

<meta name="description" content="Dealer,realtor and merchant service,car dealing ,selling and buying">

<script type="text/javascript" src="http://www.hotbuysthisweek.com/web/theme/jscript/validation.js"></script>

<link rel="stylesheet" type="text/css" media="all" href="web/theme/css/style_sendto_friend.css" title="Aqua">

<style>



.corange {

color:#7AAD00;

}





</style>



</head>

<body>



  <table cellpadding="0" class="member_box" cellspacing="5" width="100%" style="font-family:Verdana; font-size:13px">

<tbody><tr>

	<td width="75px" height="150px">

	</td>

	<td></td>

	<td width="75px">

	</td>

</tr>

<tr>

	<td width="75px">

	</td>

	<td align="left" style="color:#333333"><br>Thank you for your request. An email has been sent to your friend with a link to view the details of the Vehicle.

	</td>

	<td width="75px">

	</td>

</tr>

</tbody></table>

<table class="member_box" border="0" width="100%" cellpadding="0 cellspacing=" 0="">

	<tbody>

		<tr align="right">

			<td width="75px">

			</td>

			<td style="padding-top: 12px;" align="right">

				<a href="#" style="text-decoration:none" onClick="javascript:window.close();"> <div style="-moz-border-radius-topleft: 4px; -moz-border-radius-topright: 4px; -moz-border-radius-bottomright: 4px; -moz-border-radius-bottomleft: 4px; height: 24px;

padding-top: 5px;

background: orange;

width: 100px;

text-align: center;

color: white;" tabindex="4" class="borange member_button"><span class="cwhite member_tab_text" > Closed</span></div></a>

			</td>

			<td width="75px">

			</td>

		</tr>

	</tbody>

</table>



</body></html>