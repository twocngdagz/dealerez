<div class="box-2">
              <h3 class="light">Featured Dealers</h3>
              <div class="box-2-container">
                <ul class="list-1-1 p2" id="scroller"  >
		 		   
				   <?php 
				   
				    $user_listing = new User;	
					$users = $user_listing->get_all_user(1);
					$site_url = SITE_URL.SITE_WEBISTE_HEADER_PATH;
                        foreach($users as $f_user){
							   $chk_featured = $f_user['is_featured'];
							if($chk_featured == 1){
								echo '<li><a href="dealerprofile.php?uid='.$f_user['user_id'].'" style="color:#fff; text-decoration:none;" >';
								if (file_exists($f_user['header_image'])) {
									$logo_url = $site_url.$f_user['header_image'];
									echo '<img src="'.$logo_url.'" style="width:177px;height:88px;"  alt="">';
								} else {
									echo '<div style="height:25px; text-align:center; padding-top:5px; background-color:#900; ">'.$f_user['company_name'].'</div>';
								}
								echo '</a></li>';
							}
                        }
                      ?>
                  
                  <!--<li><a href="#"><img src="images/feature_dealer2.jpg" style="width:177px;height:88px;"  alt=""></a></li>-->
                </ul>
              </div>
            </div>