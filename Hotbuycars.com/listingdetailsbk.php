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
include("header.php");
?>
  <link href="css/jquery.mCustomScrollbar.css" rel="stylesheet" />
  <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
  <script type="text/javascript" src="js/jquery.maskedinput-1.2.2.js"></script>
  <script type="text/javascript">
  
    $(document).ready(function () {
      		var thumbs = $('a.aThumbs');
			
            $(".listing_images_thumb").mCustomScrollbar({
					scrollButtons:{
						enable:true
					}
			});
			$('.mCSB_buttonUp').remove();
			
			$('.mCSB_buttonDown').remove();
			$('.mCSB_scrollTools').css("width","2%");
			
			thumbs.on('mouseover', function(e) {
				e.preventDefault();
				
				var href = $(this).attr("href");
				
			   $('.listing_images_large img')
					   .attr("src",href);									
									
				
			});
			thumbs.on('click', function(e) {
				e.preventDefault();
				
				var href = $(this).attr("href");
				
				$('.listing_images_large img').attr("src",href);
				
			});
			
			var msg_type		= $('#msg_type');
			var txtareaRounded	= $('.txtareaRounded');
			
			msg_type.on('change', function() {
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
	$('.cleartxt').on('click', function(e) {
		listing_form.each(function() {
            grey.val('');
				
        });
	e.preventDefault();
	});
    });
  
  </script>
  	<!-- CSS -->
	<style>
	@font-face {
		font-family: 'calibrib_0';
		src: url('fonts/calibrib_0.ttf') format('eot'),
		url('fonts/calibrib_0.ttf') format('truetype');
	}
	body {
		/*font-family: 'calibrib_0' !important;*/
	}
		* {margin: 0;
		padding: 0
	}
	.container {
		  width: 400px;
		  height: 300px;
		  margin: 20px auto;
		  background-color: #DCDCDC;
		  overflow: scroll; /* showing scrollbars */
	}
	
	p {
		margin: 0 0 2em 0;
	}
	
	::-webkit-scrollbar {
		  width: 15px;
	} /* this targets the default scrollbar (compulsory) */
	
	::-webkit-scrollbar-track {
		  background-color: #b46868;
	} /* the new scrollbar will have a flat appearance with the set background color */

	::-webkit-scrollbar-thumb {
		  background-color: rgba(0, 0, 0, 0.2); 
	} /* this will style the thumb, ignoring the track */

	::-webkit-scrollbar-button {
		  background-color: #7c2929;
	} /* optionally, you can style the top and the bottom buttons (left and right for horizontal bars) */

	::-webkit-scrollbar-corner {
		  background-color: black;
	} /* if both the vertical and the horizontal bars appear, then perhaps the right bottom corner also needs to be styled */	
	</style>
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
             	<div class="dSocialMedia">
                	<a href="listings.php" class="aLinks"><p class="redd">&lt;&lt; </p>Back to Search Results</a>
                    <div class="smicons">
                    	<a href="#">Save</a><span id="save"></span>
                    </div>
                </div><!--end dSocialMedia -->
                <div class="clear"></div>
                <div class="listing_title_header">
                	<h2 class="carname" title="<?php echo $getVehicleDetails['title']; ?>"><?php echo limitStrLen($getVehicleDetails['title'],22); ?></h2>
                    <p class="car_location_city"><?php echo $getData['city'].", ".$getData['state'].". " .$getData['zip']; ?></p>

                    
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
			   
                
                <div class="listing_images">
                	<div class="listing_images_large">
                    	<img src="<?php echo SITE_URL.SITE_LISTING_THUM_PATH.$images_list[0]['image_name']?>" alt="" width="322" height="217"/>
                    </div>
                    <div class="listing_images_thumb">
                    
					<?php 
					if(!empty($images_list)) {
					
                    	$count = count($images_list)-1;
						
						foreach($images_list as $newimages_list) {
							$counter++;
							
							$img = SITE_URL.SITE_LISTING_THUM_PATH.$newimages_list['image_name'];
					 ?>
                    		<a href="<?php echo $img; ?>" class="aThumbs"><img src="<?php echo $img; ?>" height="59" width="69"/></a>
                      <?php 
						}
					}
					else { ?>
						<a href="images/lp_fl_no_image.jpg" class="aThumbs"><img src="images/lp_fl_no_image.jpg" height="59" width="69"/></a>						
					<?php
                    }						
						?>
                        
                     </div>
                    
                </div><!-- end listing images -->
                
                <div class="listing_specs nRow">
                	<h2>Specifications</h2>
                    
                    <ul>
                    	<li>Condition: <p class="specs_value">Used, Clean Title</p></li>
                        <li>Miles: <p class="specs_value"><?php echo $miles; ?></p></li>
                        <li>Ext. Color: <p class="specs_value"><?php echo $exterior; ?></p></li>
                        <li>Int. Color: <p class="specs_value"><?php echo $interior; ?></p></li>
                        <li>Stock# : <p class="specs_value"><?php echo ""; ?></p></li>
                        
                   	</ul><!-- end lists of specs -->
                    
                    <ul class="rightColumn">    
                                   	    
                        <li>Engine:  <p class="specs_value"><?php echo $engine; ?></p></li>
                        <li>Fuel:<p class="specs_value"><?php echo $fuel; ?></p></li>
                        <li>Trans:<p class="specs_value"><?php echo $trans; ?></p></li>
                        <li>Drive:<p class="specs_value"><?php echo $drive; ?></p></li>
                        <li>Vin#:<p class="specs_value"><?php echo $vin; ?></p></li>
                        
                    </ul>
                    
                    <div class="otherColumn">
                    	<ul>
                        	<li><p>Cty MPG</p></li>
                            <li><span id="mpg_img"></span></li>
                            <li><p>Hwy MPG</p></li>
                        </ul>
                    </div>
                    <div class="otherColumn1">
                    	<ul>
                        	<li><p>17</p></li>
                       		<li><p>&nbsp;24</p></li>
                        </ul>
                    </div>
                    
                    <img src="images/vin.jpg" style="position: absolute; margin-top: -25px; margin-left: 487px;"/>
                </div><!-- end lisiting specs -->
                
                <div class="listing_features nRow">
                	<h2>Features</h2>
                 	
                    <p class="p_features">
                         WORK OR PLAY THIS TRUCK IS READY! 2007 CHEVY SILVERADO CK 2500 EXTENDEDED CAB 4X4 PICK UP 
                         TRUCK 6.0L 8 CYLINDER, AUTOMATIC TRANSMISSION, A/C, AM/FM/CD PLAYER RADIO, CUSTOM ALLOY
                         WHEELS AND NEW TIRES, POWER WINDOWS, POWER DOOR LOCKS AND CRUISE CONTROL AND ONLY 114K MILES. 
                         PRICED TO SELL FOR ONLY $15500 Installed Features Alloy Wheels Cruise Control CD Player Keyless 
                         Entry Power Door Locks Power Mirrors Power Windows Tinted Glass Tilt Wheel 
                    </p>
                    
                </div><!-- end lisiting features -->
               <form name="contact_form" id="contact_form" method="post" action="send_email.php">
                <div class="listing_contact_form nRow">
                	<h2>Contact</h2>
                 	
              
                    	<input type="text" name="firstname" id="firstname" placeholder="*First Name"/>
                    	<input type="text" name="lastname" id="lastname" placeholder="*Last Name"/>
                        <input type="text" name="phone" id="phone" placeholder="*Phone"/>
                        <input type="text" name="emailaddress" id="emailaddress" placeholder="*Email Address"/>
                        
                        <label class="p_msg_required">*All Fields Required. <p>We will not share your info.</p></label>
                        
                        
                        <input type="text" name="verificationcode" id="verificationcode" class="shortTxt" placeholder="Enter Code"/>
                    
                        <p class="disabledTxt">XYZ12F7</p>
                        
                        <div class="contact_message">
                        	<div id="msgImage"></div>
                        	<Select name="msg_type" id="msg_type">
                                <option selected value ="1">I’d like more information</option>
                                <option value="2">Schedule a test drive</option>
                                <option value="3">Get a quote</option>
                                <option value="4">Make an offer</option>
                                <option value="5">Your comment or question</option>
                            </Select>
                            <input type="hidden" name="val1" id="val1" value="Hello, I’m interested in this “Year, Make, Model” you have listed for “$price” on HotBuyCars.com and would like to know more. I can be reached by phone or email." />
                            <input type="hidden" name="val2" id="val2" value="Hello, I’m interested in scheduling a test drive of this “Year, Make, Model” you have listed for “$price” on HotBuyCars.com  Please contact me ASAP to schedule a time." />
                            <input type="hidden" name="val3" id="val3" value="Hello, I’m interested in a price quote on this “Year, Make, Model” you have listed for “$price”  on HotBuyCars.com  Please contact me ASAP with your best price." />
                            <input type="hidden" name="val4" id="val4" value="Hello, I want this “Year, Make, Model” you have listed for “$price”  on HotBuyCars.com and would like to make you the following offer $0000.00   Please let me know ASAP." />
                            <input type="hidden" name="val5" id="val5" value="Hello, Enter your comment or question here." />
                            
                            <textarea cols="31" rows="5" class="txtareaRounded" name="message">Hello,  I’m interested in this “Year, Make, Model” you have listed for “$price” on HotBuyCars.com and would like to know more. I can be reached by phone or email.</textarea>
                            
                            <p class="cleartxt"><a href="#">Clear Text</a></p>
                            
                            <input type="submit" value="Submit Your Request" name="submit" id="submit"> 
                        </div>
                        
                 
                   
                    
                </div><!-- end listing_contact_form -->
                </form>
                
                <div class="clear"></div>
                
                 <div class="listing_dealers nRow">
                	<h2>Seller</h2>
                 	
                   <img src="images/images/HotBuyCars_listing_customized-_10.jpg" width="189" height="81" alt="logo" />
                   
                        <div class="listing_dealers_contact">
                        	<img src="images/images/HotBuyCars_listing_customized-_07.jpg" />
                            <p class="phone">888-000-0000</p>
                            
                            <p class="dealerName"><?php echo $getData['company_name']; ?></p>
                            <p class="dealerAddress"><?php echo  $getData['address']." ".$getData['city'].", ".$getData['state']; ?></p>
                            <p class="dealerWebsite">Website: <a href="#"><?php echo ""; ?></a></p>
                        </div>
                        
                        <div class="clear"></div>
                        
                   <p class="p_features">
                   	We at Berge Auto are proud to be Voted The #1 Used Car Dealership in Utah County For 8 Consecutive Years!  We offer unparalleled customer service and support and carry a huge inventory of vehicles specializing in a premium selection of pre-owned Lexus Toyota Acura Honda Infinity Nissan and Mazda vehicles. We're conveniently located just off Interstate 15 and State Street. Come on in and see us today!                   
                   </p>
                   
                 
                   <div style="width: 563px; height: 238px;">
                   <?php include("google_map_listing_details.php"); ?>
                   </div>
                </div><!-- end lisiting features -->
                         
                <div class="listing_icons_bottom nRow">
                       <ul class="listIconBttm">
                       		<li id="lisave"><a href="#">Save</a></li>
                            <li id="lishare"><a href="http://www.facebook.com/share.php?u=http://www.hotbuycars.com/listingdetail.php?lid=<?php echo $lid; ?>">Share</a></li>
                            <li id="liemail"><a href="#">Email</a></li>
                            <li id="lifinancing"><a href="#">Finance This Car</a></li>
                       </ul>            
                </div><!-- end listing_icons_bottom  -->
                
                <div class="more_a nRow">
                       <a href="listings.php" class="aLinks"><p class="redd">&lt;&lt; </p>Back to Search Results</a>
                       <a href="dealerprofile.php?uid=<?php echo $uid; ?>" class="aLinks">More Listings From this Seller >></a>
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
<!--<script defer src="http://server1.opentracker.net/?site=impactsources.com"></script>
<noscript>
  </noscript>-->
<!-- OPENTRACKER HTML END -->
</body>
</html>