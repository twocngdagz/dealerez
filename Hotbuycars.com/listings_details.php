<?php
session_start();
include_once("includes.php");

$listing_obj = new Listing();


$listing_id = $_GET['lid'];
$_SESSION["lid"] = $listing_id;

$getVehicleDetails = $listing_obj->get_listing_detail($listing_id);

$listing_url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
$queryString = $_SERVER['QUERY_STRING'];
$url =  "$listing_url?$queryString";
$_SESSION['url']=$url;

$user_id = $getVehicleDetails['user_id'];
//######################ADD PAGE COUNT#########################
$contents_obj = new Contents();                                                            
$createdDate=now;//get_today_date();                                                                        
$data_page_count=array();
$data_page_count["table_name"]=" page_visit_count ";
$data_page_count['columns_name']["user_id"]=$user_id;
$data_page_count['columns_name']["user_type"]=USER_TYPE_DEALER;
$data_page_count['columns_name']["listing_id"]=$listing_id;
$data_page_count['columns_name']["page_type"]=PAGE_TYPE_LISTING;
$data_page_count['columns_name']["ip"]=get_user_ip();
$data_page_count['columns_name']["createdDate"]="";

#################SAVE DATA TO DATABASE DYNAMCATICALLY,THI SCUNCTION CAN BE USE TO SAVE ANY DATA TO ANY TABLE########################

$page_count=$contents_obj->add_dynamic_data($data_page_count);                                                             

//######################UPDATE PAGE COUNT#########################

$data_page_count=array();

$table_name="listing ";
$condition="listing_id ='".$listing_id."'";
$column_values=" total_views=total_views+1";

$page_count=$contents_obj->update_site_visit($table_name,$column_values,$condition);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <title>Hotbuycars</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="css/reset.css" type="text/css" media="screen">
  <link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
  <link rel="stylesheet" href="css/grid.css" type="text/css" media="screen">
  <link rel="stylesheet" type="text/css" href="css/jquery.ad-gallery.css">
  <link rel="icon" href="images/favicon.ico" type="image/x-icon">
  <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
  <script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
  <link href="http://www.hotbuysthisweek.com/web/theme/css/lytebox.css" rel="stylesheet" type="text/css" /> 
  <script type="text/javascript" src="http://www.hotbuysthisweek.com/web/theme/jscript/lytebox.js"></script><!-- LIGHTBOX CSS-->
  <script type="text/javascript" src="js/jquery.ad-gallery.js"></script>
  <link rel="stylesheet" href="<?php echo SITE_URL.SITE_CSS_URL;?>validationEngine.jquery.css" type="text/css"/>
  <script src="<?php echo SITE_URL.SITE_JSCRIPT_PATH;?>jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
  <script src="<?php echo SITE_URL.SITE_JSCRIPT_PATH;?>jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
  <script>
		jQuery(document).ready(function(){
			jQuery("#formID").validationEngine();
			
				$('#taglineBttn').on('mouseover', function() {
					$('.tooltip1').show();
				});
			
				$('#taglineBttn').on('mouseout', function() {
					$('.tooltip1').hide();
				});
				
				//change background img when hover
				$('#taglineLinkBttn a').on('mouseover', function() {
					$('.tagline').addClass("hoverTagline");
				});
				$('#taglineLinkBttn a').on('mouseout', function() {
					$('.tagline').removeClass("hoverTagline");
				});
	
	
		});
		function checkHELLO(field, rules, i, options){
			if (field.val() != "HELLO") {
				return options.allrules.validate2fields.alertText;
			}
		}
		function checkName(field, rules, i, options){
			if (field.val() == "Name") {
				return options.allrules.validatefname.alertText;
			}
		}
		function checkPhone(field, rules, i, options){
			if (field.val() == "Phone") {
				return options.allrules.validatephone.alertText;
			}
		}
		function checkZip(field, rules, i, options){
			if (field.val() == "Zip/Pc") {
				return options.allrules.validatezip.alertText;
			}
		}
    </script>
  	
    <script type="text/javascript">
	var alt; //VARIABLE TO HANDLE IMAGE_NO OF THE SELECTED THUMB IMAGE
    $(function() {
      $('img.image1').data('');
      $('img.image1').data('ad-title', '');
      $('img.image4').data('ad-desc', '');
      $('img.image5').data('ad-desc', '');
      var galleries = $('.ad-gallery').adGallery();
      $('#switch-effect').change(
        function() {
          galleries[0].settings.effect = $(this).val();
          return false;
        }
      );
      $('#toggle-slideshow').click(
        function() {
          galleries[0].slideshow.toggle();
          return false;
        }
      );
	 $('ul li a img').click(
		function() {

		  alt = $(this).attr("alt");
		  
		}
	  );
	   $('ul li a img').mouseover(
		function() {

		  alt = $(this).attr("alt");
		  
		}
	  );
      $('#toggle-description').click(
        function() {
          if(!galleries[0].settings.description_wrapper) {
            galleries[0].settings.description_wrapper = $('#descriptions');
          } else {
            galleries[0].settings.description_wrapper = false;
          }
          return false;
        }
      );
    });
	function show_large_preview(listing_id)	{
	
		   	var urls="vehicle_images_preview.php?listing_id="+listing_id+"&img_no="+alt+"&sid="+Math.random()+"&";
	
			mywindow = window.open (urls,"mywindow","location=1,status=1,scrollbars=auto,width=510,height=510");

			mywindow.moveTo(50,50);	
	}

	</script>
    
  <!--[if lt IE 8]>
        <div style=' clear: both; text-align:center; position: relative;'>
            <a href="http://www.microsoft.com/windows/internet-explorer/default.aspx?ocid=ie6_countdown_bannercode"><img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0"  alt="" /></a>
        </div>
	<![endif]-->
  <!--[if lt IE 9]>
   		<script type="text/javascript" src="js/html5.js"></script>
        <link rel="stylesheet" href="css/ie.css" type="text/css" media="screen">
	<![endif]-->
  </head>
  <body id="page1">
<div class="main-bg">
    <div class="top-line">
    <div class="main">
        <div class="container_12">
        <div class="wrapper">
            <div class="grid_12">
            <ul class="top-menu">
                <li><a href="#">VISIT OUR OTHER HOTBUY SITES ... </a></li>
                <li><a href="#">HotBuyTrucks</a></li>
                <li><a href="#">HotBuyRV</a></li>
                <li class="third"><a href="#">HotBuyBoats</a></li>
                <li class="four"><a href="#">HotBuyMotorsports</a></li>
                <li class="five"><a href="#">HotBuyHome</a></li>
                <li><a href="#"></a></li>
              </ul>
          </div>
          </div>
      </div>
      </div>
  </div>
    <div class="main"> 
    <!--==============================header=================================-->
    <header>
        <div class="wrapper indent-bot">
        <div class="right-box">
          <div class="header-search">
            <div class="wrapper header-search-ind">
              <ul class="top-links">
              <li class="first"><a href="#">Login</a></li>
              <li class="third"><a href="#">Tweet Us</a></li>
              <li class="second"><a href="#">Like Us</a></li>
            </ul>
            </div>
          </div>
          <div class="wrapper">
           <!--tooltip-->
			<div class="tooltip1" style="position: absolute; z-index: 99999; right: 383px; top: 10px; display: none;">
			    <div class="wrapper top" id="ism-wt" style="height:80px !important;">
			        <div class="tooltip-content" id="ism-tc" style="padding: 2px 26px !important; background-position: right center;">
			        	<p>
			            “Dealers guarantee their HotBuyCar listing is offered at lowest advertised priced on the internet!”
			        	</p>
			        </div>
			    </div>
			</div>
	 <!--end tooltip-->
     
			<span class="tagline"></span> 
            <div id="taglineBttn">&nbsp;</div>   
            <div id="taglineLinkBttn"><a href="#"></a></div>    
                  
          </div>
        </div>
        <h1><a href="index.php">car sale</a></h1>
      </div>
        <div class="container_12">
        <!--=================MAIN-MENU==========================-->
					<?php include("menu.inc.php"); ?>
        <!--===============END MAIN-MENU========================-->
      </div>
      </header>
    
    <!--==============================content================================-->
    <?php
		$uid  =			$getVehicleDetails['user_id'];
		$lid  =			$getVehicleDetails['listing_id'];
		$price =  		$getVehicleDetails['price'];
		$miles = 	    $getVehicleDetails['miles'];
		$doors	= 		$getVehicleDetails['doors'];
		$fuel=			$getVehicleDetails['fuel'];
		$drive=			$getVehicleDetails['drive'];
		$engine=		$getVehicleDetails['engine'];
		$trans=			$getVehicleDetails['trans'];
		$interior=		$getVehicleDetails['interior'];
		$exterior=		$getVehicleDetails['exterior'];
		$title_type=	$getVehicleDetails['title_type'];
		$vin=			$getVehicleDetails['vin'];
		$body_style=	$getVehicleDetails['body_style'];
		$model=			$getVehicleDetails['model'];
		$make=			$getVehicleDetails['make'];
		$year=			$getVehicleDetails['year'];
		$city=			$getVehicleDetails['city'];
		$state=			$getVehicleDetails['state'];

	
		$standard_feature  = $getVehicleDetails['standard_feature'];
		$toptional_feature = $getVehicleDetails['optional_feature'];
		
		
		$counter    =0;
		
		$getData = $listing_obj->get_user_details($lid);
		
		$phone   = $getData['phone'];
	?>
    <section id="content">
        <div class="container_12">
        <div class="wrapper">
            <div class="grid_8">
            <div class="listing_details">
                <div class="bk_listing"><a href="listings.php"><img src="images/back_listing_btn.jpg" width="118" height="20" alt=""></a></div>
                <div class="clear"></div>
               
                <div class="fv_LD_gaddiName"><?php echo $getVehicleDetails['title']; ?></div>
                <div id="gallery" class="ad-gallery">
                    <div class="ad-image-wrapper" onClick="show_large_preview('<?php echo $lid;?>');" style="color:transparent;"> </div>
                    <div class="ad-nav">
            <!--===================GET LISTING IMAGES THUM==========================-->
            <?php $images_list = $listing_obj->get_listing_images($lid); ?>

                    <div class="ad-thumbs" onClick="show_large_preview('<?php echo $lid;?>');return false">
                   
                        <ul class="ad-thumb-list">
                        <?php if(!empty($images_list)): ?>
                        <?php $count = count($images_list)-1;?>
                        <?php foreach($images_list as $newimages_list):$counter++; ?>
                        <?php $img = SITE_URL.SITE_LISTING_THUM_PATH.$newimages_list['image_name']; ?>
                		
                        <li> <a href="<?php echo $img; ?>"><img src="<?php echo $img; ?>" alt = "<?php echo $counter; ?>"class="image1"> </a> </li>

                        <?php endforeach; ?>
                        <?php else: ?>
                        <li> <a href=""> <img src="images/lp_fl_no_image.jpg" class="image1"> </a> </li>
                       	<?php endif; ?>
                        
                      </ul>
                        <div class="clear"></div>
                      </div>
             <!--===================END GET LISTING IMAGES THUM======================-->
                  </div>
                  <div class="clear"></div>
  </div>
                <div class="clear"></div>
                <div class="fv_LD_gal_right">
                    <div class="fleft" style="width:215px;">
                    <div class="fv_LD_gal_price">$<?php echo $price; ?><span></span>
                        <div class="fright" style="padding-top:3px"><a href="#"></a></div>
                      </div>
                    <div class="fv_LD_gal_distance">Miles:<?php echo $miles; ?></div>
                    <div class="fv_LD_gal_location"><?php echo $city.", ".$state?></div>
                    <div class="fv_LD_gal_call">Call: <span><?php echo $phone; ?></span></div>
                    <div class="fv_LD_gal_s_icon"><a href="#" target="_blank"><img src="images/fv_facebook_icon.jpg" width="16" height="16" alt="" /></a><a href="#" target="_blank"><img src="images/fv_twitter_icon.jpg" width="16" height="16" alt="" /></a><a href="#" target="_blank"><img src="images/fv_pintrest_cion.jpg" width="16" height="16" alt="" /></a><a href="#" target="_blank"><img src="images/fv_gplus_icon.jpg" width="18" height="18" alt="" /></a><a href="#" target="_blank"><img src="images/fv_youtube_icon.jpg" width="18" height="18" alt="" /></a><img src="images/icon_last_line.jpg" alt="" /> <a href="#" target="_blank"><img src="images/payment_icon.png" width="65" height="18" alt=""></a></div>
                  </div>
                    <div class="fright" style="margin-right:25px">
                    <div class="fv_LD_gal_date">Listed: 
                 	<?php echo date("n. j.  Y",strtotime($getVehicleDetails['created_date']));?>
                     </div>
                    <div class="fv_LD_gal_fav"><a href="#"><img src="images/add_fav_icon.jpg" width="59" height="16" alt="" /></a><a href="#"><img src="images/view_fav_icon.jpg" width="49" height="16" alt="" /></a></div>
                    <div align="right"><img src="images/promo_label.jpg" width="92" height="77" alt=""></div>
                  </div> 
                  <div class="clear"></div>
  </div>
               <div class="fv_LD_total_photo">Photo Gallery Total <span><?php echo count($images_list); ?> &nbsp;<img src="http://www.hotbuysthisweek.com/web/theme/images/productdetails/arrowup.jpg" width="11" height="12" style="vertical-align:baseline;"><a href="listing_virtual_tour.php?num=<?php echo $lid; ?>&user_type=Dealer&img_no=1"    rel="lyteframe" rev="width: 720px; height: 600px; scrolling: yes;" class="virtual_tour_link"  style="text-decoration:none;a:hover { color:#069;}">click here to view virtual tour</a></span></div>
               <div class="bk_listing_gcpc">
               <div class="ggr"><a href="#"></a></div>
               <div class="ya"><a href="#"></a></div>
               </div>
               <div class="clear"></div>
               <div class="bk_listing_heading">Comments</div>
               <div class="bk_listing_content">
              <?php
			  //USER_COMMENTS HERE
			  	if(empty($getVehicleDetails['description'])){
					echo "none.";	
				}
				else { 
			  		echo $getVehicleDetails['description']; ?>
                    <a href="#">More</a> <?php
				}
			  ?>
              </div>
               <div class="clear"></div>
               <div class="bk_listing_heading" style="margin-top:15px;">Features</div>
               <div class="bk_listing_content">
              	<?php
			   //FEATURE HERE
			  	if(empty($standard_feature)){
					echo "none.";
				}
				else {
					echo $standard_feature."<br>".$toptional_feature; ?>
                    <a href="#">More</a> <?php
				}
			   ?>       
               </div>
               <div class="listing_hrline"></div>
               <div class="clear"></div>
          <!--==================CONTACT INFO HERE=======================-->
          	
               <div class="bk_listing_seller_bx">
               <div class="bk_listing_seller_title">Seller</div>
               <div class="bk_listing_seller">
               <div class="sellername"><?php echo $getData['company_name']; ?></div>
              
               <div class="addrs"><?php echo $getData['address']; ?><br />
          	   <?php echo $getData['city'].", ".$getData['state'].". " .$getData['zip']; ?></div>
			   <div class="seller_contact">Contact: <?php echo $getData['name']; ?><br />
          		<span><?php echo $getData['phone']; ?></span></div>
          
          <!--==================END CONTACT INFO HERE=======================-->
               <div class="seller_view"><a href="#"><img src="images/monitor_icon.jpg" alt="" width="20" height="23" align="top" /> View Website</a></div>
               <div class="seller_email"><a href="#" onClick="window.open( 'send_to_friend.php?id=<?php echo $listing_id; ?>', 'myWindow', 
'status = 1, height = 600, width = 600, resizable = 0' )"><img src="images/email.jpg" alt="" width="19" height="21" align="top" /> Send To Friend</a></div>
               <div class="seller_print">
               <a onClick="javascript:window.open('dealer_print_brochure.php?num=<?php echo $listing_id; ?>&amp;search_method=&amp;','load_window','width=720,height=600,left=200, top=100,resizable=yes,scrollbars=yes,toolbar=no,status=no');" class="extrabtn" href="#"><img src="images/print.jpg" alt="" width="21" height="22" align="top" /> Print Brochure</a></div>
               <div class="clear"></div>
               <div class="email_title">Email</div>
               <form action="send_email.php" method="post" id ="formID" name="message">
               <input type="text" name="emailaddress" class="validate[groupRequired[payments],custom[email]] text-input" id="emailaddress" value="Your email" onFocus="if(this.value=='Your email') this.value=''" onBlur="if(this.value=='')this.value='Your email'" style="background:url(images/bk_listing_frm1.jpg) no-repeat left top; width:137px; height:22px; border:0px; color:#878787; font-size:11px; padding-left:5px; margin-bottom:10px;"/>
               <input class="validate[required,funcCall[checkName]] text-input" type="text" value="Name" name="name" id="name" onFocus="if(this.value=='Name') this.value=''" onBlur="if(this.value=='')this.value='Name'" style="background:url(images/bk_listing_frm1.jpg) no-repeat left top; width:137px; height:22px; border:0px; color:#878787; font-size:11px; padding-left:5px; margin-bottom:10px;"/>
               <input class="validate[required,funcCall[checkPhone]] text-input" name="phone" id="phone" type="text" value="Phone"  onFocus="if(this.value=='Phone') this.value=''" onBlur="if(this.value=='')this.value='Phone'" style="background:url(images/bk_listing_frm1.jpg) no-repeat left top; width:137px; height:22px; border:0px; color:#878787; font-size:11px; padding-left:5px; margin-bottom:10px;"/>
               <input class="validate[required,funcCall[checkZip]] text-input" name="zip" id="zip" type="text" value="Zip/Pc" onFocus="if(this.value=='Zip/Pc') this.value=''" onBlur="if(this.value=='')this.value='Zip/Pc'" style="background:url(images/bk_listing_frm1.jpg) no-repeat left top; width:137px; height:22px; border:0px; color:#878787; font-size:11px; padding-left:5px; margin-bottom:10px;" />
               <textarea name="message" class="email_frm1" placeholder="Message"></textarea>
               <div class="clear"></div>
               <div class="fleft" style="line-height:12px;"><!--All <br>Field<br>Required--></div>
               <div class="fright" style="padding-top:15px;"><button type="submit" name="Action" value="Send Message" style="background-color:transparent;border:none;cursor:pointer"><img src="images/send_btn.jpg" alt=""></button></div>

               </form>
               </div>
               <div class="clear"></div>
               </div>
 <!-------==================================VEHICLE SPECS==============================-->

    <div class="fv_LD_specification">
      <h2>Specifications</h2>
      <div class="fv_LD_wRow">
        <div class="leftDiv">Year:</div>
        <div class="rightDiv"><?php echo $year; ?></div>
      </div>
      <div class="fv_LD_gRow">
        <div class="leftDiv">Make:</div>
        <div class="rightDiv"><?php echo $make; ?></div>
      </div>
      <div class="fv_LD_wRow">
        <div class="leftDiv">Model:</div>
        <div class="rightDiv"><?php echo $model; ?></div>
      </div>
      <div class="fv_LD_gRow">
        <div class="leftDiv">Body:</div>
        <div class="rightDiv"><?php echo $body_style; ?></div>
      </div>
      <div class="fv_LD_wRow">
        <div class="leftDiv">Milage:</div>
        <div class="rightDiv"><?php echo $miles; ?></div>
      </div>
      <div class="fv_LD_gRow">
        <div class="leftDiv">Vin:
          <div class="carfax"><a href="#">Get a CARFAX Report &raquo;</a></div>
        </div>
        <div class="rightDiv"><?php echo $vin; ?></div>
      </div>
      <div class="clear"></div>
      <div class="fv_LD_wRow">
        <div class="leftDiv">Title Type:</div>
        <div class="rightDiv"><?php echo $title_type; ?></div>
      </div>
      <div class="fv_LD_gRow">
        <div class="leftDiv">Exterior Color:</div>
        <div class="rightDiv"><?php echo $exterior; ?></div>
      </div>
      <div class="fv_LD_wRow">
        <div class="leftDiv">Interior Color:</div>
        <div class="rightDiv"><?php echo $interior; ?></div>
      </div>
      <div class="fv_LD_gRow">
        <div class="leftDiv">Transmission:</div>
        <div class="rightDiv"><?php echo $trans; ?></div>
      </div>
      <div class="fv_LD_wRow">
        <div class="leftDiv">Liters:</div>
        <div class="rightDiv"><span class="not_specified">not specified</span></div>
      </div>
      <div class="fv_LD_gRow">
        <div class="leftDiv">Cylinders:</div>
        <div class="rightDiv"><?php echo $engine; ?></div>
      </div>
      <div class="fv_LD_wRow">
        <div class="leftDiv">Fuel:</div>
        <div class="rightDiv"><?php echo $fuel; ?></div>
      </div>
      <div class="fv_LD_gRow">
        <div class="leftDiv">Number of Doors:</div>
        <div class="rightDiv"><?php echo $doors; ?></div>
      </div>
      <div class="fv_LD_wRow">
        <div class="leftDiv">Exterior Conditions:</div>
        <div class="rightDiv"><span class="not_specified">not specified</span></div>
      </div>
      <div class="fv_LD_gRow">
        <div class="leftDiv">Interior Condition:</div>
        <div class="rightDiv"><span class="not_specified">not specified</span></div>
      </div>
      
      <div class="fv_LD_wRow">
        <div class="leftDiv">Fuel Type:</div>
        <div class="rightDiv"><?php echo $fuel; ?></div>
      </div>
      <div class="fv_LD_gRow">
        <div class="leftDiv">Drive Type:</div>
        <div class="rightDiv"><?php echo $drive; ?></div>
      </div>
      <div class="morespec"><a href="profile.php?uid=<?php echo $uid; ?>">More listings from this Seller &raquo;</a></div>
      <div class="clear"></div>
      <div class="map_title">Map</div>
      <div align="right" style="width::370px;height:110px;"><?php include("google_map_ld.php"); ?></div>
      <div class="clear"></div>
      <div class="fright" style="padding:10px 0px"><a href="listings.php"><img src="images/back_listing_btn.jpg" width="118" height="20" alt=""></a></div>
    </div>
    <!-------================================== END VEHICLE SPECS==============================-->
               <div class="clear"></div>
            </div>
             <div class="clear"></div>
             </div>
            <div class="grid_4 fright">
           <?php include_once("ads_r.php"); ?>
          </div>
          <div class="clear"></div>
          </div>
          <div class="clear"></div>
      </div>
</section>
<?php include("footer.php");?>