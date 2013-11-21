<?php  session_start();
include_once("includes.php");

$listing_obj = new Listing();
$contents_obj = new Contents();
$user_listing = new User;
$admin_obj = new Admin;


$user_id =  $_GET['uid'];
$user_detail = $user_listing->get_user_detail($user_id);
$site_detail = $admin_obj->getSiteSettings($user_id);

$createdDate=now;
$data_page_count=array();
$data_page_count["table_name"]="page_visit_count";
$data_page_count['columns_name']["user_id"]=$user_id;
$data_page_count['columns_name']["user_type"]=USER_TYPE_DEALER;
$data_page_count['columns_name']["listing_id"]="";
$data_page_count['columns_name']["page_type"]=PAGE_TYPE_PROFILE;
$data_page_count['columns_name']["ip"]=get_user_ip();
$data_page_count['columns_name']["createdDate"]=$createdDate;
$page_count=$contents_obj->add_dynamic_data($data_page_count);
include("header.php");
?>
      <div class="container_12">
        <!--=================MAIN-MENU==========================-->
					<?php include("menu.inc.php"); ?>
        <!--===============END MAIN-MENU========================-->
      </div>
    </header>
    <!--==============================content================================-->
    <section id="content">
      <div class="container_12">
        <div class="wrapper">
          <div class="grid_8">
            <div class="clear"></div>
            <div class="clear"></div>
            <div class="profile_page">
              <div class="pro_back_listing"><a href="listings.php"><img src="images/back_listing_btn.jpg" width="118" height="20" alt=""></a></div>
              <div class="clear"></div>
              <div class="inner_padding">
              
              <?php
			  if($site_detail['header_image']!='')
					{
						$header_image_url= SITE_URL.SITE_WEBISTE_HEADER_PATH.$user_detail;
					}
					else
					{
					$header_image_url=SITE_URL."web/theme/images/banner_here.jpg";
					}
					
					?>
                    
                <div class="pro_hr_top_ads"><img src="<?php echo $header_image_url;?>"  width="574" height="116"></div>
                <h3>Welcome to <?php echo $user_detail['company_name'];?></h3>
                <p><?php echo $user_detail['user_comments'];?>

</p>
                <div class="fleft">
                  <div class="fcc">Contact: <span><br>
                  <?php echo $user_detail['phone'];?></span></div>
                  <div class="fcc"></div>
                  <div class="g_text">Days Open: <span>Mon-Sat</span><br>
                    Hours: <span>10am to 8pm</span><br>
                    Address: <span><?php echo $user_detail['address'];?></span><br>
                    City: <span><?php echo $user_detail['city'];?></span><br>
                    State/Prov: <span><?php echo $user_detail['state'];?></span><br>
                    Zip/Pc: <span><?php echo $user_detail['zip'];?></span><br>
                    <a href="<?php echo $user_detail['domain_name'];?>">View Website</a></div>
                  <div class="clear"></div>
                </div>
                <div class="fright">
                <div class="fcc">Directions</div>
                <div class="g_map"><?php include("google_map.php");?></div>
                </div>
                <div class="clear"></div>
                <div class="inventory_title">Inventory</div>
					<!--DEALER LISTING STARTS HERE-->
  				<?php include_once("profile_listing.php");?>                
					<!--DEALER LISTING ENDS HERE-->    
                <div class="clear"></div>
                <div class="fright"><a href="listings.php"><img src="images/back_listing_btn.jpg" width="118" height="20" alt=""></a></div>
                <div class="clear"></div>
              </div>
              <div class="clear"></div>
            </div>
            <div class="clear"></div>
          </div>
          <div class="grid_4">
          <?php include_once("ads_r.php"); ?>
          </div>
        </div>
      </div>
    </section>
<?php include("footer.php");?>