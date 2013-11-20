<?php
session_start();
include_once("includes.php");

$listing_obj  = new Listing();
$user_details = new User;

/*if($_REQUEST['search']=="Search") {
	
	$addsearchItemBlog = " and ((blog_title like '".$_REQUEST[blogname]."%') or (blog_description like '".$_REQUEST[blogname]."%'))";
	msgbox($addsearchItemBlog);
}*/
include_once("header.php"); ?>
    <div class="container_1">
    	    <?php include_once("menu.inc.php"); ?>
            <div class="container_2">   
            	  <div id="blog">
                  	<h2>Dixie Motors Blog</h2>
					<div class="separator"></div>
                  	<div class="blog-main">
                    	<div id="blog-post">
                        	<?php
            
						$blogs = new Blogs();
			
						$cond =false;
						$data = array();
						
						$blog_page = 1;//$_REQUEST["page"];
						
						if($blog_page == '' || $blog_page <= 0){
							$blog_page = 1;
						}
						
						$blog_paging_sql = $blogs->get_blogs(" and is_active='1'",'','','','','',1);
						
						$blog_page_arguments = '';//"blogs.php?".get_page_arguments();
						$blog_pagging = array();
						$blog_pagging = generate_pagination_sql_correct($blog_paging_sql,20,$blog_page,$blog_page_arguments);
						if($blog_pagging["totalrows"]>0){
								$data = $blogs->get_blogs(" and is_active='1'",'','','',$blog_pagging["limitvalue"],$blog_pagging["limit"]);
							}
						
						if(count($data)>0){
					
								foreach($data as $blog){
								
									if($blog["blog_image"]!=''){
									
										$photo_path=SITE_URL.SITE_BLOG_THUMB.$blog["blog_image"];
										
									}
									else{
										
										$photo_path=SITE_URL."images/no_blogimages.jpg";
										
									}
									
									$user = new User();
									
									$author = $user->get_user_detail($blog["added_by"]);
								
								?>
                        	<section class="blog-post-data">
                            	<h3><a href="blog_detail.php?id=<?php echo $blog['blog_id']; ?>"><?php echo $blog['blog_title']; ?></a></h3>
                                <p class="blog-date-posted"><?php echo date('d/m/Y',strtotime($blog['add_date'])); ?></p>
                                
                                <p class="blog-data-content">
                                	<?php
										
											$description = strip_tags($blog['blog_description']);

											if (strlen($description) > 250) {
											
											    // truncate string
											    $descriptionCut = substr($description, 0, 250);
											
											    // make sure it ends in a word so assassinate doesn't become ass...
											    $description = substr($descriptionCut, 0, strrpos($descriptionCut, ' ')).'... '; 
											}
											echo $description;
										
										?> 
                                </p>
                                <p class="blog-data-categories">
                                	Categories: <a href="">General</a>
                                </p>
                                
                                <a href="blog_detail.php?id=<?php echo $blog['blog_id']; ?>" class="blog-readmore">read more</a>
                            </section>
                        <?php } 
						
						}?>
                           
                            <!--<a href="#" style="font-size:12px;float: right;margin-right:20px;">Next &gt;&gt;</a>-->
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
                                <?php $blog_cat = $blogs->get_blogos_category(); ?>
                                <?php foreach($blog_cat as $newblogcat) { ?>
                                    <li>
                                   		 <a href="blog.php?id=<?php echo $newblogcat['category_id']; ?>"><?php echo $newblogcat['category_name']; ?></a>
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