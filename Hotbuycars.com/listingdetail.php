<?php
session_start();
include_once("includes.php");

$listing_obj  = new Listing();
$user_details = new User;

$listing_id = $_GET['lid'];
$_SESSION["lid"] = $listing_id;

$getVehicleDetails = $listing_obj->get_listing_detail($listing_id);

$userDetail = $user_details->get_user_detail($getVehicleDetails ["user_id"]);

$getVehicleDetails['is_featured'];

/*echo "<pre>";
print_r($getVehicleDetails);
print_r($userDetail);
echo "</pre>";
*/


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
include("header.php");
?>

  <link href="css/jquery.mCustomScrollbar.css" rel="stylesheet" />
  <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
  <script type="text/javascript" src="js/jquery.maskedinput-1.2.2.js"></script>
  
  <!-- Add fancyBox main JS and CSS files -->
  <script type="text/javascript" src="../source/jquery.fancybox.js?v=2.1.5"></script>
  <link rel="stylesheet" type="text/css" href="../source/jquery.fancybox.css?v=2.1.5" media="screen" />
    
  <script type="text/javascript">
  
    $(document).ready(function () {
			$('.fancybox').fancybox();

			$('.fancybox-inner').css({"height":"660px;","width":"660px","padding":"0 !important"});
      		var thumbs = $('a.aThumbs');
			
            $(".listing_images_thumb").mCustomScrollbar();
			$('.mCSB_buttonUp').remove();
			
			$('.mCSB_buttonDown').remove();
			$('.mCSB_scrollTools').css("width","2%");
			
			thumbs.on('mouseover', function(e) {
				e.preventDefault();
				
				var href = $(this).data('img'),
					alt  = $(this).find('img').attr('alt'),
			       _link = $(this).attr('href');

					 $('.listing_images_large img').attr({"src":href});	
					 $('.listing_images_large a').attr({"href":_link});				  
				
			});
			thumbs.on('click', function(e) {
				e.preventDefault();
				
				var href = $(this).data('img');
				
				$('.listing_images_large img').attr("src",href);

			});
			
			var msg_type		= $('#msg_type');
			var txtareaRounded	= $('.txtareaRounded');
			
			msg_type.live('change', function() {
				var index = $(this).val();
				txtareaRounded.text($('#val'+index).val());
			});
  
  		     //execute when form submit click
	//DIV with inputs descendant
	  grey = $('div.grey_box').find('input[type=text]');
	  grey.css({color:'grey'});
	  var listing_form	  = $(':input[type=text]');
	  
	   //execute every onchange
	 //validation for the form steps
	  
	  function isValidEmailAddress(emailAddress) {
		  var pattern = new RegExp(/^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/);
		  return pattern.test(emailAddress);
	  };	
	  
	  listing_form.each(function() 
	  {
		  $(this).on('change',function(){
			  			  
			  if($(this).val().length === 0 || $(this).val()=== ''){
				$(this).css({border:'1px solid red'});
				
				  e.preventDefault();	
				  $(this).focus();
				  		  
			  }
			  else if($(this).val().length > 0){
				$(this).css({border:'1px solid #A7A6AA'});	
			  }	
			  
		  });
	  });
	  
	  var codex = $('.disabledTxt').text();

	  $('#phone').mask("(999) 999-9999");
	  
	  $('#submit').click(function(e){
		
		listing_form.each(function() {

            if($(this).val().length === 0 || $(this).val()=== ''){
				$(this).css({border:'1px solid red'});
				
				  	e.preventDefault();
					
			}
		
			else if($(this).val().length > 0){
				$(this).css({border:'1px solid #A7A6AA'});	
			}
		
        });
		
		if(!isValidEmailAddress($("#emailaddress").val()) ) { 
				$("#emailaddress").css({border:'1px solid red'});
				$("#emailaddress").val("");
				
				$("#emailaddress").attr('placeholder','Please enter your real email address!');
				e.preventDefault();
		}
		
		if($('#verificationcode').val()!= codex) {
				$("#verificationcode").css({border:'1px solid red'});
				$("#verificationcode").val("");
				
				$("#verificationcode").attr('placeholder','Invalid Code!');
				e.preventDefault();
		}
	});
	grey = $('form').find('input[type=text]');
	$('.cleartxt').live('click', function(e) {
		$('.txtareaRounded').text("");
		listing_form.each(function() {
            grey.val('');
				
        });
	e.preventDefault();
	});
	
	$('.amore_st').on('click', function() {
		$('.scomplete_view').show();
		$('.sless_view').hide();
		$('.aless_st').show();
		$(this).hide();
		return false;
	});
	$('.aless_st').on('click', function() {
		$('.sless_view').show();
		$('.scomplete_view').hide();
		$('.amore_st').show();
		$(this).hide();
		return false;
	});
	
    });
  
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
<?php
if($_SESSION['message_sent']) {	?>
     <script type="text/javascript">
	 $.msgBox({
				title:"Message Sent!",
				content:"Thank you, Your Request has been sent.",
				type:"info"
			});
	 </script>
<?php	
}
unset($_SESSION['message_sent']);
?>
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
		$miles = 	        $getVehicleDetails['miles'];
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
		$fuelEC=		$getVehicleDetails['fuelEC'];
		$fuelEH=		$getVehicleDetails['fuelEH'];
		$hotbuy_title=$getVehicleDetails['hotbuy_title'];
		$condition_=$getVehicleDetails['condition_'];
		$cartitle=		$make." ".$model;
		
		$standard_feature  = $getVehicleDetails['standard_feature'];
		$toptional_feature = $getVehicleDetails['optional_feature'];
		
		
		$counter    =0;
		
		$getData = $listing_obj->get_user_details($lid);
		
		$user_comments =$getData['user_comments'];
		$dealername =$getData['name'];
		$phone   = $getData['phone'];
		
		$mail_subject = "Found this HotBuyCars listing that may interest you.";
		$mail_body	  = "Hey...I just saw this listing on www.HotBuyCars.com  and thought it may be of interest to you.";
		
		$user_detail = $user_details->get_user_detail($uid);
	
		define("DEALER_ADDRESS",$user_detail['address']);
		define("DEALER_CITY",$user_detail['city']);
		define("DEALER_STATE",$user_detail['state']);
		define("DEALER_ZIP",$user_detail['zip']);
		
		$address=DEALER_ADDRESS;
		$city=DEALER_CITY;
		$state =DEALER_STATE;
		$zip=DEALER_ZIP;
		
		$google_address	 = " $address $city, $state $zip";
 
	?>
    
    <section id="content">
        <div class="container_12">
        <div class="wrapper">
            <div class="grid_8">
             <div class="listing_details">
             	<div class="dSocialMedia">
                	<a href="listings.php" class="aLinks"><p class="redd">&lt;&lt; </p>Back to Search Results</a>
                  
                    <div class="smicons">
                        	<ul>
                            	<li id="share"><a>Share</a></li>
                                <li id="fb"><a href="http://www.facebook.com/share.php?u=http://www.hotbuycars.com/listingdetail.php?lid=<?php echo $lid;?>" target="_blank"></a></li>
                                <li id="tw"><a href="http://twitter.com/home?status=Check out our hotbuy listing - wwww.hotbuycars.com/listingdetail.php?lid=<?php echo $lid;?>" target="_blank"></a></li>
                                <li id="pin"><a href="http://pinterest.com/pin/create/button/?url=http://www.hotbuycars.com/listingdetail.php?lid=<?php echo $lid;?>" target="_blank"></a></li>
                                <li id="g"><a href="https://plus.google.com/share?url=http://www.hotbuycars.com/listingdetail.php?lid=<?php echo $lid;?>" target="_blank"></a></li>
                                <li id="liemail"><a href="mailto:?subject=<?php echo $mail_subject; ?>&body=<?php echo $mail_body; ?>"></a></li>
                                <li id="save"><a>Save</a></li>
                                <li id="saveicon"><a href="#"></a></li>
                            </ul>
                    </div>
                </div><!--end dSocialMedia -->
                <div class="clear"></div>
                <div class="listing_title_header">
                    <h2 class="carname"><span class="spanyear"><?php echo $year; ?></span><?php echo " ".$cartitle; ?></h2>
                    <p class="car_location_city"><?php echo $getData['city'].", ".$getData['state'].". " .$getData['zip']; ?></p>
					<p class="car_add_title"><?php echo $hotbuy_title;?> </p>
                    <div class="car_asking"> 
                        <div class="car_asking_divs">
                              <img src="images/images/hotbuy_tag.jpg" alt="HoyBuy!" class="hotbuyImg">
                        </div>
                        
                        <div class="car_asking_divs">
                              <p class="asking_title">Hurry!</p>
                              <p class="asking_price">$<?php echo number_format($price); ?></p>
                        </div>
                    </div>
                        
                </div><!-- end listing_title_header -->
                <div class="clear"></div>
                
                <?php $images_list = $listing_obj->get_listing_images($lid); ?>
			   
                <img src="loader.gif" class="ad-loader" style="display: none; margin-left: 150px;margin-top: 93px;opacity: 0.5; position: absolute;">
                <div class="listing_images">
                	<div class="listing_images_large">
                    	<a href="listing_gallery.php?lid=<?php echo $listing_id; ?>&amp;img_id=1" class="fancybox fancybox.iframe">
                    	<img src="<?php echo SITE_URL.SITE_LISTING_IMAGES_PATH.$images_list[0]['image_name']?>" alt="" width="322" height="217"/>
                        </a>
                    </div>
                    <div class="listing_images_thumb">
                    
					<?php 
					$imgarry = array();
					if(!empty($images_list)) {
					
                    	$count = count($images_list)-1;
			
						foreach($images_list as $newimages_list) {
							$counter++;
							
							$img_large = SITE_URL.SITE_LISTING_IMAGES_PATH.$newimages_list['image_name'];
							?>
                            	<img src="<?php echo $img_large; ?>" width="322" height="217" style="display: none;" /> <!-- for images cached! -->
                            <?php
							$img = SITE_URL.SITE_LISTING_THUM_PATH.$newimages_list['image_name'];
					 ?>
                    		<a href="listing_gallery.php?lid=<?php echo $listing_id; ?>&amp;img_id=<?php echo $counter; ?>" data-img = "<?php echo $img_large; ?>" class="aThumbs fancybox fancybox.iframe"><img src="<?php echo $img; ?>" height="59" width="69" alt="<?php echo $counter; ?>"/></a>
                      <?php 
						}
					}
					else { ?>
						<a href="images/lp_fl_no_image.jpg" class="aThumbs fancybox fancybox.iframe"><img src="images/lp_fl_no_image.jpg" height="59" width="69"/></a>						
					<?php
                    }						
						?>
                        
                     </div>
                    
                </div><!-- end listing images -->
                
                <a style="float:right;color:#C90008;" href="listing_gallery.php?lid=<?php echo $listing_id; ?>&amp;img_id=1" class="fancybox fancybox.iframe">View All (<?php echo count($images_list); ?>)</a>
                
                <div class="listing_specs nRow">
                	<h2>Information</h2>
                    
                    <ul>
                    	<li>Condition:  <p class="specs_value"><?php echo $condition_;?>, <?php echo $title_type;?></p></li>
                        <li>Body Style:  <p class="specs_value"><?php echo $body_style; ?></p></li>
                        <li>Miles/Km:  <p class="specs_value"><?php echo $miles; ?></p></li>
                        <li>Exterior Color:  <p class="specs_value"><?php echo $exterior; ?></p></li>
                        <li>Interior Color:  <p class="specs_value"><?php echo $interior; ?></p></li>
                        
                        
                   	</ul><!-- end lists of specs -->
                    
                    <ul class="rightColumn">    
                                   	    
                        <li>Engine:  <p class="specs_value"><?php echo $engine; ?></p></li>
                        <li>Fuel:  <p class="specs_value"><?php echo $fuel; ?></p></li>
                        <li>Trans:  <p class="specs_value"><?php echo $trans; ?></p></li>
                        <li>Drive:  <p class="specs_value"><?php echo $drive; ?></p></li>
                        <li>Vin #:  <p class="specs_value"><?php echo $vin; ?></p></li>
                        
                    </ul>
                    
                    <div class="otherColumn"  style="top:380px;">
                    	<ul>
                        	<li><p><strong>Cty MPG</strong></p></li>
                            <li><span id="mpg_img" ></span></li>
                            <li style="margin-top:1px"><p><strong>Hwy MPG</strong></p></li>
                        </ul>
                    </div>
                    <div class="otherColumn1">
                    	<ul>
                        	<li><p><?php echo $fuelEC; ?></p></li>
                       		<li><p>&nbsp;<?php echo $fuelEH; ?></p></li>
                        </ul>
                    </div>
                    
                    <a href="#"><img src="images/vin2.jpg" style="position: absolute; margin-top: -25px; margin-left: 487px;"/></a>
                </div><!-- end lisiting specs -->
                
                <div class="listing_features nRow">
                <?php if($standard_feature<>"") { ?>
                	<h2>Features</h2>
                 	
                    <p class="p_features">
                         <?php 
						 if(strlen($standard_feature) >= 430) {
							 $trim_standard_feature = limitStrLen($standard_feature,430);
							 ?>
                             <span class="sless_view"> 
								 <?php
                                  echo "This <q>". $year. " ".$cartitle ."</q> is equipped with "."<span style='color: #666666'>$trim_standard_feature</span>"; 
                                 ?>
							 </span>
                              <span class="scomplete_view" style="display:none;"> 
								 <?php
                                  echo "This <q>". $year. " ".$cartitle ."</q> is equipped with "."<span style='color: #666666'>$standard_feature</span>"; 
                                 ?>
							 </span>
                             <?php
							 ?>
                             <a href="#" class="amore_st">More</a>
                             <a href="#" class="aless_st" style="display:none;">Less</a>
                             <?php
						 }
						 else {
							  echo "This <q>". $year. " ".$cartitle ."</q> is equipped with "."<span style='color: #666666'>$standard_feature</span>"; 
							 
						 } 							
						 ?>
                    </p>
                     
                <?php } ?>
                    
                </div><!-- end lisiting features -->
               <form name="contact_form" id="contact_form" method="post" action="send_email.php">
                <div class="listing_contact_form nRow">
                	<h2 style="line-height: 2em;">Contact 
                    
                    	<div style="display: inline-block;float: right;margin-right: 9px;">
                    		<a href="getapproved.php?make=<?php echo $make; ?>&model=<?php echo $model; ?>&year=<?php echo $year; ?>&vin=<?php echo $vin; ?>&price=<?php echo $price; ?>&state=<?php echo $state; ?>&city=<?php echo $city; ?>&fax=<?php echo ""; ?>&vendor=<?php echo $dealername; ?>">
                            <img src="images/goodcredit.jpg" alt="good credit" /></a>
                           	<a href="getapproved.php?make=<?php echo $make; ?>&model=<?php echo $model; ?>&year=<?php echo $year; ?>&vin=<?php echo $vin; ?>&price=<?php echo $price; ?>&state=<?php echo $state; ?>&city=<?php echo $city; ?>&fax=<?php echo ""; ?>&vendor=<?php echo $dealername; ?>"><img src="images/badcredit.jpg" alt="good credit" /></a>
                    	</div>
                        
                    </h2>
                 	
              			<input type="hidden" name="dealername" value="<?php echo $dealername; ?>" />
                    	<input type="text" name="firstname" id="firstname" placeholder="First Name*"/>
                    	<input type="text" name="lastname" id="lastname" placeholder="Last Name*"/>
                        <input type="text" name="phone" id="phone" placeholder="Phone*"/>
                        <input type="text" name="emailaddress" id="emailaddress" placeholder="Email Address*"/>
                        
                        <label class="p_msg_required">*All Fields Required. <p>We will not share your info.</p></label>
                        
                        
                        <input type="text" name="verificationcode" id="verificationcode" class="shortTxt" placeholder="Enter Code"/>
                    
                        <p class="disabledTxt">XYZ12F7</p>
                        <?php $formatted_price = "$".number_format($price); ?>
                        <div class="contact_message">
                        	<div id="msgImage"></div>
                        	<Select name="msg_type" id="msg_type">
                                <option value="1">I'd like more information</option>
                                <option value="2">Schedule a test drive</option>
                                <option value="3">Get a quote</option>
                                <option value="4">Make an offer</option>
                                <option value="5">Your comment or question</option>
                            </Select>
                            <input type="hidden" name="val1" id="val1" value="Hello, I'm interested in this <?php echo $year.", ".$make.", ".$model; ?> you have listed for <?php echo $formatted_price; ?> on HotBuyCars.com and would like to know more. I can be reached by phone or email." />
                            <input type="hidden" name="val2" id="val2" value="Hello, I'm interested in scheduling a test drive of this <?php echo $year.", ".$make.", ".$model; ?> you have listed for <?php echo $formatted_price; ?> on HotBuyCars.com  Please contact me ASAP to schedule a time." />
                            <input type="hidden" name="val3" id="val3" value="Hello, I'm interested in a price quote on this <?php echo $year.", ".$make.", ".$model; ?> you have listed for <?php echo $formatted_price; ?> on HotBuyCars.com  Please contact me ASAP with your best price." />
                            <input type="hidden" name="val4" id="val4" value="Hello, I want this <?php echo $year.", ".$make.", ".$model; ?> you have listed for <?php echo $formatted_price; ?> on HotBuyCars.com and would like to make you the following offer $0000.00   Please let me know ASAP." />
                            <input type="hidden" name="val5" id="val5" value="Hello, Enter your comment or question here." />
                            
                            <textarea cols="31" rows="5" class="txtareaRounded" name="message">Hello,  I'm interested in this <?php echo $year.", ".$make.", ".$model; ?> you have listed for <?php echo $formatted_price; ?> on HotBuyCars.com and would like to know more. I can be reached by phone or email.</textarea>
                            
                            <p class="cleartxt"><a href="#">Clear Message</a></p>
                            
                            <input type="submit" value="Submit Your Request" name="submit" id="submit"> 
                        </div>
                        
                 
                   
                    
                </div><!-- end listing_contact_form -->
                </form>
                
                <div class="clear"></div>
                <?php
				$admin_obj = new Admin;
				$site_detail = $admin_obj->getSiteSettings($user_id);
				

				
				$user_listing = new User;	
				$user_detail = $user_listing->get_user_detail($user_id);
				$chk_featured = $user_detail['is_featured'];				
				
				?>
                
				<div class="listing_dealers nRow">
                
                <?php 
				  
				 {
               	?>
                	<!--Seller DIV-->
                	<div>
                	<h2>Seller </h2>  
                 	 <?php
					if($site_detail['header_image']!='' && $chk_featured==1)
					{
						$header_image_url= SITE_URL.SITE_WEBISTE_HEADER_PATH.$user_detail;
					}
					else
					{
						$header_image_url= SITE_URL."sandbox/web/theme/images/banner_here.jpg";
					}
					?>
                    
                   <img src="<?php echo $header_image_url;?>" style="padding-top:4px" width="210" height="85" alt="logo" />
                   <div class="listing_dealers_contact">
                        	<img src="images/telephone.jpg" alt="telephone"/>
                            <p class="phone"><?php echo $phone; ?></p>
                            
                            <p class="dealerName"><?php echo $getData['company_name']; ?></p>
                            
                            

                            <p class="dealerAddress"><?php echo  $getData['address']."<br />".$getData['city'].", ".$getData['state']." ".$getData['zip']; ?></p>
                            <?php if($site_detail['web_domain']!=""):?>
                            <p class="dealerWebsite"><a href="<?php echo $site_detail['web_domain'];?>" target="_blank">Website</a></p>
                            <?php else: ?>
                            <p class="dealerWebsite"><a >Website</a>
                            <?php endif; ?>
                            
                            
                            <a href="dealerprofile.php?uid=<?php echo $uid; ?>&year=<?php echo $year; ?>&make=<?php echo $make; ?>&price=<?php echo $formatted_price; ?>&model=<?php echo $model; ?>&p=<?php echo $phone; ?>" class="aLinks" style="text-decoration: none;font-weight: 600; float: right;"><strong>More Listings From this Seller</strong></a>
                            
                            
                            </p>
                        </div>
                        </div>
                        <!--Seller DIV End-->
					<?php }
                    
                    ?>   

                   <div class="clear"></div>
                   
                   
                   <div><!--MAP DIV-->
                   <?php if($user_comments<>"") {   ?>   
                   <p class="p_features">
                   <?php
				   	if(strlen($user_comments) >= 430) {
						echo limitStrlen($user_comments,430);
					}
				   ?>
                   </p>
                   <?php } ?>
               <?php $direction = "https://maps.google.com/maps?f=d&source=s_d&saddr=&daddr=".$google_address; ?>
              <div style="width:250px; float:left;">
               <h2 style="margin-bottom: 6px;">Map<a style="font-size:12px;font-weight:normal;padding-left:10px;line-height: 1.6em;" href="<?php echo $direction; ?>" target="_blank">Get Directions</a></h2>
               </div>
                
                
                
                   <div style="width: 563px; height: 238px;overflow: hidden;">
                   <?php include("google_map_listing_details.php"); ?>
                   </div><!--MAP DIV End-->
                   </div>
                   
                   
                   
                </div>
				 
                
                
                <!-- end lisiting features -->
                         
                <!--<div class="listing_icons_bottom nRow">
                       <ul class="listIconBttm">
                       		<li id="lisave"><a href="#">Save</a></li>
                            <li id="lishare"><a href="http://www.facebook.com/share.php?u=http://www.hotbuycars.com/listingdetail.php?lid="">Share</a></li>
                            <li id="liemail"><a href="#">Email</a></li>
                            <li id="lifinancing"><a href="#">Finance This Car</a></li>
                       </ul>            
                </div>--><!-- end listing_icons_bottom  -->
                <br />
               <div class="smicons">
                        	<ul>
                            	<li id="share"><a>Share</a></li>
                                <li id="fb"><a href="http://www.facebook.com/share.php?u=http://www.hotbuycars.com/listingdetail.php?lid=<?php echo $lid;?>" target="_blank"></a></li>
                                <li id="tw"><a href="http://twitter.com/home?status=Check out our hotbuy listing - wwww.hotbuycars.com/listingdetail.php?lid=<?php echo $lid;?>" target="_blank"></a></li>
                                <li id="pin"><a href="http://pinterest.com/pin/create/button/?url=http://www.hotbuycars.com/listingdetail.php?lid=<?php echo $lid;?>" target="_blank"></a></li>
                                <li id="g"><a href="https://plus.google.com/share?url=http://www.hotbuycars.com/listingdetail.php?lid=<?php echo $lid;?>" target="_blank"></a></li>
                                <li id="liemail"><a href="mailto:?subject=<?php echo $mail_subject; ?>&body=<?php echo $mail_body; ?>"></a></li>
                                <li id="save"><a>Save</a></li>
                                <li id="saveicon"><a href="#"></a></li>
                            </ul>
                </div>
                <div class="clear"></div>
                <div class="more_a nRow" style="margin-top: -20px;">
                       <a href="listings.php" class="aLinks"><p class="redd">&lt;&lt; </p>Back to Search Results</a>
                </div>
                

             </div>
             <div class="clear"></div>
             </div>
              
            
            <div class="grid_4 fright">
            <div class="listing_ad_right"><img src="images/berge_auto_ads.jpg" width="300" height="605" alt=""></div>
            <div class="listing_ad_right"><img src="images/murray_ad.jpg" width="300" height="605" alt=""></div>
          </div>
          <div class="clear"></div>
          </div>
          <div class="clear"></div>
      </div>
      </section>
    <center>
        <div style = "width:731px; height:91px; margin-top:20px;"><img src = "images/ads.png"></div>
      </center>
    <!--==============================footer=================================-->
    <footer>
        <div class="container_12">
        <div class="wrapper">
            <div class="grid_12">
            <div class="footer-menu">
                <div class="wrapper">
                <div class="footer-link-box"> <span class="footer-link">HotBuyCars.com &nbsp;&copy; 2010&nbsp; &nbsp; &nbsp; <a href="index-2.html" class="decor">Privacy Policy</a></span> </div>
                <ul class="footer-list">
                    <li><a href="findacar.html">Find A Car</a></li>
                  <li><a href="sellacar.html">Sell A Car</a></li>
                  <li><a href="financing.html">Financing</a></li>
                  <li><a href="insurance.html">Insurance</a></li>
                  <li><a href="#">Advertise</a></li>
                  <li><a href="#">Contact Us</a></li>
                  </ul>
              </div>
              </div>
            <div class="aligncenter"> <span class="footer-link"><!-- {%FOOTER_LINK} --></span> </div>
          </div>
          </div>
      </div>
      </footer>
    <div class="wrapper">
        <div style = "font-size:10px">HotBuyCars.com offers you a great way to buy a used car online or sell used cars online! You can also get a fast cash offer to buy your car. Use our easy car search to "find the best car deals on the web" HotBuyCars.com is powered by DealerEZ which is the easiest, fastest and most cost-effective way to manage your used car dealership and market your cars online!  DealersEZ.com gives you a Free 15 day trial to experience the one-stop dealer management solution to upload your vehicles and create an instant automotive dealer website and online manage and advertise your vehicles to all the top car websites such as Craigslist, AutoTrader and Cars.com where you can find cars for sale in Alabama, Alaska, Arizona, Arkansas, Utah, California, Colorado, Connecticut, Delaware Florida Georgia Hawaii Idaho Illinois Indiana Iowa Kansas Kentucky Louisiana Maine Maryland Massachusetts Michigan Minnesota Mississippi Missouri Montana Nebraska Nevada New Hampshire New Jersey New Mexico New York North Carolina North Dakota Ohio Oklahoma Oregon Pennsylvania Rhode Island South Carolina South Dakota Tennessee Texas Utah Vermont Virginia Washington West Virginia Wisconsin Wyoming. <br>
        <br>
      </div>
      </div>
  </div>
  </div>
<script defer src="http://server1.opentracker.net/?site=impactsources.com"></script>
<noscript>
</noscript>
<!-- OPENTRACKER HTML END -->
</body>
</html>