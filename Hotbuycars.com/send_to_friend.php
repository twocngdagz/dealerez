<?php  session_start();
include_once("includes.php");
$listing_obj = new Listing();
$user_object = new User();
$display=isset($_REQUEST['display'])?$_REQUEST['display']:'list';

$list_id = $_GET['id'];

$listing_id=isset($_REQUEST['listing_id'])?$_REQUEST['listing_id']:false;
$listing_type="Vehicle";
	$listing_detail=$listing_obj->get_listing_detail($list_id);
	$uid = $listing_detail['user_id'];
	$getUserData = $listing_obj->get_user_details($uid);
	//$image_url=SITE_URL.$listing_detail['images_array'][0]['thumbUrlPath2'];
	
	
	$detail_page_link=SITE_URL.$listing_detail['_link'];
	
	if($user_type==USER_TYPE_DEALER)
	{
		$year=$listing_detail['year'];
		$category=$listing_detail['p_category'];
	}
	
	$price=($listing_detail['price']);
	$title=$listing_detail['title'];
	$vin=$listing_detail['vin'];
	$stock_no=$listing_detail['stock_no'];
	$bodystyle=$listing_detail['bodyStyle'];
if(count($listing_detail)>0)
{
		$user_detail=$user_object->get_user_detail($listing_detail['createdByUserNum']);
}

?>	

<html><head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>DealerEZ</title>

<meta name="keywords" content="dealer,realtor,marchant,vehicle,product,services,realEstate">

<meta name="description" content="Dealer,realtor and merchant service,car dealing ,selling and buying">



<link rel="stylesheet" type="text/css" media="all" href="css/send_to_friend.css" title="Aqua">
<link rel="stylesheet" href="<?php echo SITE_URL.SITE_CSS_URL;?>validationEngine.jquery.css" type="text/css"/>
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
<script src="<?php echo SITE_URL.SITE_JSCRIPT_PATH;?>jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo SITE_URL.SITE_JSCRIPT_PATH;?>jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>

<style>



.corange {

color:#7AAD00;
}






</style>
<script>
		jQuery(document).ready(function(){
			jQuery("#email_form").validationEngine();
		});
		function checkName(field, rules, i, options){
			if (field.val() == "") {
				return options.allrules.validatefname.alertText;
			}
		}
		function checkMessage(field, rules, i, options){
			if (field.val() == "") {
				return options.allrules.validatemessage.alertText;
			}
		}
</script>

</head>

<body>



 	<center>



					<table width="540px" cellpadding="0" cellspacing="0" style="background-color:#FFFFFF">

					<tbody>

					<tr>

        				<td class="page_content_col" id="content_td" style="padding-top: 10px;">

<form action="thankyou.php?id=<?php echo $list_id ?>" name="email_form" id="email_form" method="POST">

							<input name="car_name" id="ci" type="hidden" value="<?php echo $listing_detail['title']; ?>">

							<input name="state" id="st" type="hidden" value="<?php echo $getUserData['state'];  ?>">

							<input name="zi" id="zi" type="hidden" value="<?php echo $getUserData['zip'];  ?>">
                            
                            <input name="url" id="url" type="hidden" value="<?php echo $url; ?>">

							<input name="listing_id" id="listing_id" type="hidden" value="<?php echo $list_id;?>">

                            <input name="user_type" id="user_type" type="hidden" value="Dealer">

                            <input name="Action" id="Action" type="hidden" value="send_email">

                           

							

							<table border="0" cellpadding="0" cellspacing="0">

							<tbody><tr>

                				<td class="cltblue page_header" valign="bottom">Send To A Friend</td>

              					</tr>

              					<tr>

									<td class="cdgrey form_text" style="padding-bottom: 20px;">Let

									someone know about a listing you found on this site. Type in their

									e-mail address, hit send, and we will send them information about this listing.

									</td>

              						</tr>

                              	<tr style="background-color:#E7E7E7">

                    				<td>

									<div class="featured_property">

										<table width="445" border="0" cellpadding="0" cellspacing="0">

<tbody><tr>

												<td rowspan="2" style="padding-right: 10px; cursor: pointer;" valign="middle">
                                                 <?php  if(empty($listing_detail['image_name'])):?>
                                                      <img src="images/lp_fl_no_image.jpg" height="62px" width="98px"/>
                                                  <?php endif; ?>
                                                  
                                                  <?php  foreach($listing_detail['image_name'] as $list_image => $image_name): ?>
                                                      
                                                      <img src="<?php echo SITE_URL.SITE_LISTING_THUM_PATH.$image_name['image_name']; ?>" height="62px" width="98px" alt="<?php echo $image_name['image_name']; ?>" /> 
                                                    
                                                    <input type="hidden" name = "vehicle_image" value = "<?php echo SITE_URL.SITE_LISTING_THUM_PATH.$image_name['image_name']; ?>">
                                                    
                                                  <?php endforeach; ?>
    											</td>
											
												<td rowspan="2" class="blgrey2" width="1px"><img src="send_to_friend.php_files/spacer.gif" width="1px" height="1px"></td>

												<td class="cdgrey featured_details" style="padding-left: 10px;" width="150px">

													<b>$<?php echo $listing_detail['price'] ?></b><br>

													 <?php echo $listing_detail['title'] ?> 

												</td>

												<td style="padding-left: 5px;" valign="top" align="right">

													<table width="200" align="center" border="0" cellpadding="0" cellspacing="0">

														<tbody><tr>

													

															<td class="cdgrey home_summary_text" style="  border-left: solid 1px #A7A7A7;border-bottom: 0px none; font-weight:bold;">Category</td>

															                                                            <td class="cdgrey home_summary_text" style="border-bottom: 0px none;font-weight:bold;">Stock#</td>

															<td class="cdgrey home_summary_text" style="border-bottom: 0px none;font-weight:bold;">Vin#</td>

                                                            															</tr>

														<tr>

															

															<td class="cdgrey home_summary_text" style="  border-left: solid 1px #A7A7A7;border-bottom: 0px none;"><?php echo $listing_details['cat_name']; ?></td>

                                                            															<td class="cdgrey home_summary_text" style="border-bottom: 0px none;"><?php echo $listing_detail['stock_no']; ?></td>

			<td class="cdgrey home_summary_text" style="border-bottom: 0px none; text-transform:uppercase;"><?php echo $listing_detail['vin']; ?></td>														  </tr>

													</tbody></table>

								</td>

											</tr>

											<tr>

												<td class="cdgrey featured_details" style="padding-left: 10px; cursor: pointer;" valign="middle" onClick="javascript:window.close();">&nbsp;&nbsp;View Details</td>

												<td class="cdgrey featured_details" style="padding-left: 5px;">&nbsp;</td>

											</tr>

										</tbody></table>

									</div>

									</td>

								</tr>

                          </tbody></table>



                      	<table class="member_box" border="0" width="100%" cellpadding="0" cellspacing="0">

                      	<tbody>

							<tr>

								<td class="cdgrey form_label" style="padding-top: 12px; padding-bottom: 4px;" width="170px">Your Name:</td>

								<td width="22px"></td>

							</tr>

							<tr>

								<td width="170px"><input tabindex="1" class="validate[required,funcCall[checkName]] text-input" type="text" name="name" id="name" style="width: 100%;"></td>

								<td width="22px"></td>

								<td rowspan="5" width="453px">

									<textarea tabindex="4" class="validate[required,funcCall[checkMessage]] text-input" style="width: 100%; height: 150px;" name="email_message" id="email_message" value=""></textarea>

								</td>

							</tr>

							<tr>

								<td class="cdgrey form_label" style="padding-top: 12px; padding-bottom: 4px;" width="170px">Your Email Address:</td>

								<td width="22px"></td>

							</tr>

							<tr>

								<td width="170px"><input tabindex="2" name="emailaddress" class="validate[groupRequired[payments],custom[email]] text-input" id="emailaddress" style="width: 100%;"  type="text"></td>

								<td width="22"></td>

							</tr>

							<tr>

								<td class="cdgrey form_label" style="padding-top: 12px; padding-bottom: 4px;" width="170">Send Email To:</td>

								<td width="22"></td>

							</tr>

							<tr>

								<td><input tabindex="3" name="sendmailto" class="validate[groupRequired[payments],custom[email]] text-input" id="sendmailto" style="width: 100%;" type="text"></td>

								<td width="22"></td>

							</tr>

                            <tr>

                                <td colspan="3" style="padding-top: 12px;" align="right">

                                    <input type="submit" style="-moz-border-radius-topleft: 4px; -moz-border-radius-topright: 4px; -moz-border-radius-bottomright: 4px; -moz-border-radius-bottomleft: 4px; height:30px;" tabindex="4" class="borange member_button" name="action" value="Send Email">

                                </td>

                            </tr>



                        </tbody>

						</table>

						

            </form>

        				</td>

    				</tr>

					</tbody>

					</table>

</center>



</body></html>
