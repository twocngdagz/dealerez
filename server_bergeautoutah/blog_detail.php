<?php
session_start();
include_once("includes.php");

$listing_obj  = new Listing();
$user_details = new User;

$bid = $_GET['id'];
$blog = new Blogs();

$blog_detail = $blog->get_blogs_detail($bid,false);
$blog_comments=$blog->get_blogs_comment($bid);

$action = isset($_POST['action']) ?$_POST['action'] :false;

if($action=="add_comment"){

	$blog_id = $_GET["id"];

	$name = isset($_POST['name']) ?$_POST['name'] :false;
	$email = isset($_POST['email']) ?$_POST['email'] :false;
	$comment = isset($_POST['comment']) ?$_POST['comment'] :false;
		
	$blog_detail=$blog->get_blogs_detail($blog_id,1);
	$added_ip=get_user_ip();
	
	if(count($blog_detail)>0 and $blog_detail["allow_comment"]==1){
		$add_date=get_today_date();
		
		$add_date = date('Y-m-d H:i:s');
		
		if($name==""){
			
			$_SESSION["msg_eror"][]="Please provide Name title";
		}
		if($email==""){
			$_SESSION["msg_eror"][]="Please provide Email";
		}
		else if(!check_email_address($email)){
			$_SESSION["msg_eror"][]="Please provide correct Email";
		}	
		
/*		if($comment==""){
			$_SESSION["msg_eror"][]="Please provide comments";
		}*/
		
		//ADD BLOG COMMENTS 
		if($_SESSION['msg_eror']==""){		
			$data_array['added_by']=$user_id;
			$data_array['name']=$name;
			$data_array['email']=$email;
			$data_array['comment']=$comment;
			$data_array['blog_id']=$blog_id;
			$data_array['add_date']=$add_date;
			$data_array['added_ip']=$added_ip;
			
			$result= $blog->add_comments($data_array);

			if(!isset($_SESSION['mysql_eror'])){
				$_SESSION['msg_alert']="Your comment has been created successfully";
				redirect_page("blog_detail.php?id=".$bid);
					msgbox("I love you love! :=*");
				exit;
			}
			else{
				$_SESSION['msg_eror']="There is some error while updating database ".display_sql_error()."";
			}
			
		}
	}
	else{
		$_SESSION["msg_eror"][]="Please provide valid information to add comments";	
	}
}

include_once("header.php"); ?>
<script>
$(function() {
	$("form").validate();
});
</script>
    <div class="container_1">
    	    <?php include_once("menu.inc.php"); ?>
            <div class="container_2">   
            	  <div id="blog">
                  	<h2>Dixie Motors Blog</h2>
					<div class="separator"></div>
                  	<div class="blog-main">
                    	<div id="blog-post">
                        	<section class="blog-post-data marginanTop">
                           <ul id="vehicle_social_buttons" class="social_buttons" style="display: block;">
                                    <li id="vehicle_google_plus_button"><div style="text-indent: 0px; margin: 0px; padding: 0px; background: none repeat scroll 0% 0% transparent; border-style: none; float: none; line-height: normal; font-size: 1px; vertical-align: baseline; padding-top: 2px;width: 70px; height: 15px;" id="___plusone_0"><iframe width="100%" scrolling="no" frameborder="0" hspace="0" marginheight="0" marginwidth="0" style="position: static; top: 0px; width: 70px; margin: 0px; border-style: none; left: 0px; visibility: visible; height: 15px;" tabindex="0" vspace="0" id="I0_1378375748290" name="I0_1378375748290" src="https://apis.google.com/_/+1/fastbutton?bsv=o&amp;usegapi=1&amp;size=small&amp;hl=en-US&amp;origin=http%3A%2F%2Fwww.velocitycars.com&amp;url=http%3A%2F%2Fwww.velocitycars.com%2Fweb%2Fused%2FAcura-TL-2009-Draper-Utah%2F8674630%2Fwww.velocitycars.com%2Fweb%2Fused%2FAcura-TL-2009-Draper-Utah%2F8674630%2F&amp;gsrc=3p&amp;ic=1&amp;jsh=m%3B%2F_%2Fscs%2Fapps-static%2F_%2Fjs%2Fk%3Doz.gapi.en.ED-YuaM3AT0.O%2Fm%3D__features__%2Fam%3DIQ%2Frt%3Dj%2Fd%3D1%2Frs%3DAItRSTNpo58QtV0_9nKV_7OZCUCDJsLsCg#_methods=onPlusOne%2C_ready%2C_close%2C_open%2C_resizeMe%2C_renderstart%2Concircled%2Cdrefresh%2Cerefresh&amp;id=I0_1378375748290&amp;parent=http%3A%2F%2Fwww.velocitycars.com&amp;pfname=&amp;rpctoken=19415795" data-gapiattached="true" title="+1"></iframe></div></li><li rel="http://www.velocitycars.com/web/used/Acura-TL-2009-Draper-Utah/8674630/" id="vehicle_facebook_like_button"><iframe scrolling="no" style="border: medium none; overflow: hidden; width: 90px; height: 20px;" allowtransparency="true" id="vehicle_social_facebook" src="http://www.facebook.com/plugins/like.php?href=http://www.velocitycars.com/web/used/Acura-TL-2009-Draper-Utah/8674630/&amp;layout=button_count&amp;show_faces=true&amp;width=90&amp;action=like&amp;colorscheme=light&amp;height=20"></iframe></li><li><iframe scrolling="no" frameborder="0" allowtransparency="true" src="http://platform.twitter.com/widgets/tweet_button.1378258117.html#_=1378375745163&amp;count=horizontal&amp;id=twitter-widget-0&amp;lang=en&amp;original_referer=http%3A%2F%2Fwww.velocitycars.com%2Fweb%2Fused%2FAcura-TL-2009-Draper-Utah%2F8674630%2F&amp;size=m&amp;text=Check%20out%20this%202009%20Acura%20TL%20%20at%20Velocity%20Auto%20Sales&amp;url=http%3A%2F%2Fwww.velocitycars.com%2Fweb%2Fused%2FAcura-TL-2009-Draper-Utah%2F8674630%2F" class="twitter-share-button twitter-count-horizontal" style="width: 109px; height: 20px;" title="Twitter Tweet Button" data-twttr-rendered="true"></iframe></li><li><a id="vehicle_social_addthis" title="Share this vehicle" onclick="return addthis_sendto()" onmouseout="addthis_close()" onmouseover="return addthis_open(this, '', '[URL]', '[TITLE]')" href="http://www.addthis.com/bookmark.php">Share</a></li><li><a title="Email this vehicle to a friend" rel="nofollow" id="vehicle_social_email" href="/web/emailvehicle/8674630/?KeepThis=true&amp;TB_iframe=true&amp;height=275&amp;width=675" class="thickbox">Email</a></li><li><a title="Print this vehicle" id="vehicle_social_print" href="/web/print_vehicle_v2/8674630">Print</a></li>
                                </ul>
                                <br />
                                <br />
                            	<h3><a href="#"><?php echo $blog_detail['blog_title'];?></a></h3>
                                <p class="blog-date-posted"><?php echo date('d/m/Y',strtotime($blog_detail['add_date']));?></p>
                                
                                <p class="blog-data-content">
									<?php echo $blog_detail['blog_description'];?>
                                </p>
                                <p class="blog-data-categories">
                                	Categories: <a href="">General</a>
                                </p>
                                <div class="separator"></div>
                                
                                <div id="blog-comments">
                                	<h3>Comments</h3>
                                    <?php
									
									if(count($blog_comments)>0 and $blog_detail["show_comment"]==1){
										foreach($blog_comments as $comments){
										?>
                                    <p class="comment-athor"><a href="mailto:<?php echo $comments["email"];?>"><?php echo $comments["name"];?></a></p>
                                    <p class="comment-date">posted on <?php echo date('d/m/Y h:i a',strtotime($comments['add_date'])); ?></p>
                                    <p class="comment-message">
                                    	<?php echo str_replace("\n","<br>",$comments["comment"]);?>
                                    </p>
                                    <?php }
									
									}?>
                                    <div class="separator"></div>
                                    <?php echo display_message();?>
                                    <h4>Post a comment:</h4>
                                    <form name="frmPostComment" id="frmPostComment" method="post">
                                    	<div class="cols-2">
                                            <div>
                                                <label>First Name <span>*</span></label><br />
                                                <input type="text" name="name" id="name" required="required"/>
                                            </div>
                                            <div>
                                                <label>Email <span>*</span></label><br />
                                                <input type="email" name="email" id="email" required="required">
                                            </div>
                                        </div>
                                         <div class="cols-1">
                                            <div>
                                                <label>Comments</label><br />
                                                <textarea cols="30" rows="5" name="comment" id="comment"></textarea>
                                            </div>
                                        </div>
                                         <input type="hidden" name="action" value="add_comment" />
						  				 <input type="hidden" name="blog_id" value="<?php echo ($bid);?>" />
                                         <input type="submit" name="submit" value="Submit">
                                    </form>
                                </div><!-- end blog comment -->
                            </section>
                        </div><!-- end blog post -->
                        <div id="blog-widget">
                        	<div class="widget-box">
                            	<h3>Search Blog</h3>
                                <form name="frmSearchBlog" id="frmSearchBlog" method="get">
                                	<input type="text" name="blogname" id="blogname">
                                    
                                    <input type="submit" value="Search" name="search">
                                </form>
                            </div>
                            <div class="widget-box">
                            	<h3>Categories</h3>
                                <ul>
                                <?php $blogcat = $blog->get_blogos_category(false); ?>
                                <?php foreach($blogcat as $newblogcat) { ?>
                                    <li>
                                   		 <a href="#"><?php echo $newblogcat['category_name']; ?></a>
                                    </li>
                                <?php } ?>
                               </ul>
                            </div>
                            <div class="widget-box">
                            	<h3>Date</h3>
                                <ul>
                                    <li>
                                   		 <a href="/blog/categories/Pre-OwnedInventory/index.htm">September 2012 (2)</a>
                                    </li>
                                    <li>
                                   		 <a href="/blog/categories/Service/index.htm">August 2012 (2)</a>
                                    </li>
                                    <li>
                                    	 <a href="/blog/categories/Finance/index.htm">July 2012 (2)</a>
                                    </li>
                                     <li>
                                    	 <a href="/blog/categories/Finance/index.htm">June (0)</a>
                                    </li>
                                    <li>
                                    	 <a href="/blog/categories/Finance/index.htm">May (10) </a>
                                    </li>
                                    <li>
                                    	 <a href="/blog/categories/Finance/index.htm">April (4) </a>
                                    </li>
                                    <li>
                                    	 <a href="/blog/categories/Finance/index.htm">March (4) </a>
                                    </li>
                                    <li>
                                    	 <a href="/blog/categories/Finance/index.htm">Febuary (1) </a>
                                    </li>
                                    <li>
                                    	 <a href="/blog/categories/Finance/index.htm">January (34) </a>
                                    </li>
                               </ul>
                            </div>
                        </div><!-- end blog widget -->
                    </div><!-- end blog main -->
                  </div>  					
<?php include_once("footer.php"); ?> 